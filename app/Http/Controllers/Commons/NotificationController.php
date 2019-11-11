<?php

namespace App\Http\Controllers\Commons;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAsRead(Request $requset)
    {
        $notifications = DatabaseNotification::where('notifiable_id', $requset->user_id)->get();
        $notifications->markAsRead();

        return $notifications;
    }
}
