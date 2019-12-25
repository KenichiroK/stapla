@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/purchaseOrder/show.css') }}">
<script>
const setPreview = (input) => {
  const preview = document.getElementById('preview');
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3>確認画面</h3>
    </div>

    <div class="main-wrapper__wrapper">
        <div id="print" class="document-container A4">


            <!-- 表示用 -->
            <div class="document-container__wrapper sheet padding-10mm">
                <div class="title-container">
                    <h4>発注書</h4>
                </div>
    
                <div class="partnerName-container">
                    <h4>{{ $purchaseOrder->partner_name }} 様</h4>
                </div>
                
                <div class="company-container">
                    <div class="right">
                        <p class="text">下記の通り、発注します。</p>
                        <p class="name">件名: {{ $purchaseOrder->task_name }}</p>
                        <p class="date">納期: {{ date("Y年m月d日", strtotime($purchaseOrder->task_ended_at)) }}</p>
                    </div>
    
                    <div class="left">
                        <p class="date">発注日: {{ date("Y年m月d日", strtotime($purchaseOrder->ordered_at)) }}</p>
                        <p clss="name">{{ $purchaseOrder->company_name }}</p>
                        <p class="tel">{{ $purchaseOrder->company_tel }}</p>
                        <p classs="address">〒{{ $purchaseOrder->company_zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                        <p class="building">{{ $purchaseOrder->company_streetAddress }}</p>
                        @if($purchaseOrder->billing_to_text)
                            <p class="building">{{ $purchaseOrder->billing_to_text }}</p>
                        @else
                         <p class="building">{{ $purchaseOrder->companyUser_name }}</p>
                        @endif                            
                        <p class="symbol">印</p>
                    </div>
                </div>
    
                <div class="order-container">
                    <table>
                        <thead>
                            <tr>
                                <th>商品名</th>
                                <th>数量</th>
                                <th>単価</th>
                                <th>合計</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td>{{ $purchaseOrder->task_name }}</td>
                                <td>1</td>
                                <td>{{ number_format($purchaseOrder->task_price) }}</td>
                                <td>{{ number_format($purchaseOrder->task_price) }}</td>
                            </tr>
                            @for($i=1; $i<10; $i++ )
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
    
                    <div class="total-container">
                        <div class="text-container">
                            <p>合計</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">税抜</p>
                            <p>{{ number_format($purchaseOrder->task_price) }}</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">消費税</p>
                            <p>{{ number_format($purchaseOrder->task->price * $purchaseOrder->task_tax) }}</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">総額</p>
                            <p class="total-text">{{ number_format($purchaseOrder->task_price * (1 + $purchaseOrder->task_tax)) }}</p>
                        </div>
                    </div>
    
                    <div class="sub-container">
                        <span>備考</span>
                    </div>
                </div>
            </div>

        </div>

    @if($purchaseOrder->task->status === config('const.ORDER_SUBMIT_PARTNER') && $purchaseOrder->partner->id === Auth::user()->id)
        <div class="actionButton">
            <form action="{{ route('partner.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="{{ config('const.TASK_APPROVAL_PARTNER') }}">
                <button type="submit" class="undone">断る</button>
            </form>
            <form action="{{ route('partner.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="{{ config('const.ORDER_APPROVAL_PARTNER') }}">
                <button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">この案件を受ける</button>
                <!-- Modal -->
                @component('components.confirm-modal')
                    @slot('modalID')
                        confirm
                    @endslot
                    @slot('confirmBtnLabel')
                        承認
                    @endslot
                    発注書を承認します。
                @endcomponent
            </form>
        </div>
    @elseif($purchaseOrder->task->status > config('const.WORKING') && $purchaseOrder->partner->id === Auth::user()->id)
        <p class="send-done">この発注書は承認済みです</p>
    @else
        <p class="send-done">必要なアククションはありません</p>
    @endif
    <div class="error-message-wrapper">
        @if ($errors->has('task_id'))
            <div class="error-msg" role="alert">
                <strong>{{ $errors->first('task_id') }}</strong>
            </div>
        @endif
        @if ($errors->has('status') && !$errors->has('task_id'))
            <div class="error-msg" role="alert">
                <strong>{{ $errors->first('status') }}</strong>
            </div>
        @endif
        <div class="error-message-wrapper">
            @if ($errors->has('task_id'))
                <div class="error-msg" role="alert">
                    <strong>{{ $errors->first('task_id') }}</strong>
                </div>
            @endif
            @if ($errors->has('status') && !$errors->has('task_id'))
                <div class="error-msg" role="alert">
                    <strong>{{ $errors->first('status') }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
