<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\FileUpdateRequest;
use App\Models\Deliver;
use App\Models\DeliverItem;
use App\Models\DeliverLog;
use App\Models\Partner;
use App\Models\Task;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DeliverController extends Controller
{
    public function create($task_id)
    {
        $partner = Auth::user();
        $task = Task::findOrFail($task_id);
        return view('partner/deliver/create', compact('partner', 'task'));
    }

    public function store(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $auth = Auth::user();
        
        if($task->deliver){
            $deliver = Deliver::where('task_id', $request->task_id)->first();
            $deliver->deliver_comment = $request->deliver_comment;
            $deliver->save();
            // 再提出前の提出時にアプリケーションしたファイルをS3とmysqlから削除
            $delete_items = DeliverItem::where('deliver_id', $deliver->id)->get();
            foreach($delete_items as $item){
                \Storage::disk('s3')->delete("deliver-file/" . $auth->company_id . "/" . explode('/', $item->file)[5]);
            }
            DeliverItem::where('deliver_id', $deliver->id)->delete();
            if($request->files){
                foreach ($request->deliver_files as $file) {
                    $deliver_item = new DeliverItem;
                    $deliver_item->deliver_id = $deliver->id;
                    $path_file = \Storage::disk('s3')->putFileAs("deliver-file/$auth->company_id", $file, $file->getClientOriginalName());
                    
                    $deliver_item->file = \Storage::disk('s3')->url($path_file);
                    $deliver_item->save();
                    \Log::info('再納品', ['user_id(partner)' => $auth->id, 'task_id' => $task->id]);              
                }
            }
                 
            
        } else{
            
            $deliver = new Deliver;
            $deliver->task_id         = $request->task_id;
            $deliver->deliver_comment = $request->deliver_comment;
            $deliver->save();

            $deliver_item = new DeliverItem;
            $deliver_item->deliver_id = $deliver->id;
            if($request->deliver_files){
                foreach ($request->deliver_files as $file) {
                    $deliver_item = new DeliverItem;
                    $deliver_item->deliver_id = $deliver->id;
                    $path_file = \Storage::disk('s3')->putFileAs("deliver-file/$auth->company_id", $file, $file->getClientOriginalName());
                    $deliver_item->file       = \Storage::disk('s3')->url($path_file);

                    $deliver_item->save(); 
                    \Log::info('納品', ['user_id(partner)' => $auth->id, 'task_id' => $task->id]);                  
                }
            }
        }
        
        $deliverLog = new DeliverLog;
        $deliverLog->task_id = $request->task_id;
        $deliverLog->partner_id = $auth->id;
        $deliverLog->save();

        if($task->count()) {
            $prev_status             = $task->status;
            $task->status            = (int)$request->status;
            $task->status_updated_at = Carbon::now();
            $task->save();


            \Log::info('納品履歴', ['user_id(partner)' => $auth->id, 'task_id' => $task->id]);

            sendNotificationUpdatedTaskStatusFromPartner($task, $prev_status);
            sendNotificationUpdatedTaskStatusToProjectCompany($task, $prev_status);

            if ($task->status === config('const.APPROVAL_ACCOUNTING')) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    } 

    public function download(Request $request)
    {
        $disk = Storage::disk('s3');
        $file_path = explode('amazonaws.com/', $request->file)[1];
        $file_name = explode('deliver-file/', $request->file)[1];
        $mime_type = \File::extension($file_name);
        $headers = [
            'Content-Type' => $mime_type,
            'Content-Disposition' => ' attachment; filename="'.$file_name.'"',
        ];
        return \Response::make($disk->get($file_path), 200, $headers);
    }
}
