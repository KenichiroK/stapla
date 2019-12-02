@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/purchaseOrder/index.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3>確認画面</h3>
    </div>

    <div class="message-container">
        <h3>{{ $purchaseOrder->company->company_name }}様から{{ $purchaseOrder->task->name }}の依頼が来ています。</h3>
    </div>

    <div class="document-container">
        <div class="title-container">
            <h4>発注書</h4>
        </div>

        <div class="partnerName-container">
            <h4>{{ $purchaseOrder->partner->name }} 様</h4>
        </div>

        <div class="company-container">
            <div class="right">
                <p class="text">下記の通り、発注します。</p>
                <p class="name">件名: {{ $purchaseOrder->task->name }}</p>
                <p class="date">納期: {{ date("Y年m月d日", strtotime($purchaseOrder->task->ended_at)) }}</p>
            </div>

            <div class="left">
                <p class="date">発注日: {{ explode(' ', $purchaseOrder->task->started_at)[0] }}</p>
                <p clss="name">{{ $purchaseOrder->company->company_name }}</p>
                <p class="tel">{{ $purchaseOrder->company->tel }}</p>
                <p classs="address">〒{{ $purchaseOrder->company->zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                <p class="building">{{ $purchaseOrder->company->address_streetAddress }}</p>
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
                        <td>{{ $purchaseOrder->task->name }}</td>
                        <td>1</td>
                        <td>{{ number_format($purchaseOrder->task->price) }}</td>
                        <td>{{ number_format($purchaseOrder->task->price) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="total-container">
                <div class="text-container">
                    <p>合計</p>
                </div>

                <div class="section-container">
                    <p class="sub-column">税抜</p>
                    <p>{{ number_format($purchaseOrder->task->price) }}</p>
                </div>

                <div class="section-container">
                    <p class="sub-column">消費税</p>
                    <p>{{ number_format($purchaseOrder->task->price * $purchaseOrder->task->tax) }}</p>
                </div>

                <div class="section-container">
                    <p class="sub-column">総額</p>
                    <p class="total-text">{{ number_format($purchaseOrder->task->price * (1 + $purchaseOrder->task->tax)) }}</p>
                </div>
            </div>

            <div class="sub-container">
                <span>備考</span>
            </div>
        </div>
    </div>


    @if($purchaseOrder->task->status === 7 && $purchaseOrder->partner->id === Auth::user()->id)
        <div class="actionButton">
            <form action="{{ route('partner.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="4">
                <button type="submit" class="undone">断る</button>
            </form>
            <form action="{{ route('partner.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="8">
                <button type="button" class="done confirm" data-toggle="modal" data-target="#exampleModalCenter">この案件を受ける</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-header border border-0">
                                <h5 class="center-block" id="exampleModalLabel">確認</h5>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">発注書を承認します。</p>
                                <p class="text-center">よろしいですか？</p>
                            </div>
                            <div class="modal-footer center-block border border-0">
                                <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                                <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >承認</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @elseif($purchaseOrder->task->status > 9 && $purchaseOrder->partner->id === Auth::user()->id)
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
    </div>
</div>
@endsection
