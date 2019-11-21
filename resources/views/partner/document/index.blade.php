@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div class="page-title-container">
            <div class="page-title">書類一覧</div>
        </div>
        <div>
             <!-- 発注書 -->
             <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="{{ env('AWS_URL') }}/common/order.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">発注書</div>
                    </div>
                    <div class="table-container">
                        <table class="order-table table01">
                            <tr class="head-row">
                                <th>タスク</th>
                                <th>請求日</th>
                                <th>担当者</th>
                                <th>金額</th>
                                <th>PDF</th>
                                <th>作成済</th>
                            </tr>
                            @foreach($purchaseOrders as $purchaseOrder)
                            <tr class="data-row">
                                <td class="task-data">{{ $purchaseOrder->task_name }}</td>
                                <td>{{ date("Y年m月d日", strtotime($purchaseOrder->task_ended_at)) }}</td>
                                <td class="staff-data">
                                    <div class="imgbox">
                                        <img src="{{ $purchaseOrder->companyUser->picture }}" alt="">
                                    </div>
                                    <div class="name">
                                        {{ $purchaseOrder->companyUser->name }}
                                    </div>
                                </td>
                                <td>{{ $purchaseOrder->task->price }}</td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="btn-a-container">
                                            <a href="{{ route('partner.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="order_show_more_btn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 請求書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                        <div class="icon-imgbox"><img src="{{ env('AWS_URL') }}/common/invoice.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">請求書</div>
                    </div>
                    <div class="table-container">
                        <table class="invoice-table table01">
                            <tr class="head-row">
                                <th>タスク</th>
                                <th>請求日</th>
                                <th>担当者</th>
                                <th>金額</th>
                                <th>PDF</th>
                                <th>作成済</th>
                            </tr>
                            @foreach($invoices as $invoice)
                            <tr class="data-row">
                                <td class="task-data">{{ $invoice->task->name }}</td>
                                <td>{{ date("Y年m月d日", strtotime($invoice->task->ended_at)) }}</td>
                                <td class="staff-data">
                                    <div class="imgbox">
                                        <img src="{{ $invoice->companyUser->picture }}" alt="">
                                    </div>
                                    <div class="name">
                                        {{ $invoice->companyUser->name }}
                                    </div>
                                </td>
                                <td>{{ $invoice->task->price }}</td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="btn-a-container">
                                            <a href="{{ route('partner.document.invoice.show', ['invoice_id' => $invoice->id]) }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="invoice_show_more_btn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection