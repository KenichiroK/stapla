@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/index.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="../../../images/icon_small-down.png" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
                        </div>
                        <div class="textbox">
                            設定
                        </div>
                    </a>
                </li>
            </ul>
            
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <div class="page-title-container">
            <div class="page-title-container__page-title">書類一覧</div>
        </div>
        <div class="head-container">
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div class="icon-imgbox"><img src="../../../images/invoice.png" alt=""></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">請求書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">{{ $invoices_0status->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <!-- <div class="head-container__wrapper__item-container__wrapper__create-container__create"><a href="">確認</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div class="icon-imgbox"><img src="../../../images/order.png" alt=""></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">発注書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">{{ $purchaseOrders_0status->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <!-- <div class="head-container__wrapper__item-container__wrapper__create-container__create"><a href="">確認</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div class="icon-imgbox"><img src="../../../images/outsourcing.png" alt=""></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">業務委託契約書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">{{ $ndas_0status->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <!-- <div class="head-container__wrapper__item-container__wrapper__create-container__create"><a href="">確認</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div class="icon-imgbox"><img src="../../../images/non-disclosur.png" alt=""></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">機密保持契約書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">{{ $ndas_0status->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <!-- <div class="head-container__wrapper__item-container__wrapper__create-container__create"><a href="">確認</a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">書類</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="document-table">
                                <tr class="document-table__head-row">
                                    <th class="document-table__head-row__table-header icon-th"></th>
                                    <th class="document-table__head-row__table-header">書類</th>
                                    <th class="document-table__head-row__table-header">未対応</th>
                                    <th class="document-table__head-row__table-header">他依頼中</th>
                                    <th class="document-table__head-row__table-header">パートナー依頼中</th>
                                    <th class="document-table__head-row__table-header">完了</th>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data"><div class="icon-imgbox"><img src="../../../images/invoice.png" alt=""></div></td>
                                    <td class="document-table__data-row__table-data doc-title">請求書</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_0status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_1status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_2status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_3status->count() }}件</td>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data"><div class="icon-imgbox"><img src="../../../images/order.png" alt=""></div></td>
                                    <td class="document-table__data-row__table-data doc-title">発注書</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_0status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_1status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_2status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_3status->count() }}件</td>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data"><div class="icon-imgbox"><img src="../../../images/outsourcing.png" alt=""></div></td>
                                    <td class="document-table__data-row__table-data doc-title">業務委託契約書</td>
                                    <td class="document-table__data-row__table-data">件</td>
                                    <td class="document-table__data-row__table-data">件</td>
                                    <td class="document-table__data-row__table-data">件</td>
                                    <td class="document-table__data-row__table-data">件</td>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data"><div class="icon-imgbox"><img src="../../../images/non-disclosur.png" alt=""></div></td>
                                    <td class="document-table__data-row__table-data doc-title">機密保持契約書</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_0status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_1status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_2status->count() }}件</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_3status->count() }}件</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 請求書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                        <div class="icon-imgbox"><img src="../../../images/invoice.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">請求書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                        <table class="invoice-table">
                            <tr class="invoice-table__head-row">
                                <th class="invoice-table__head-row__table-header">タスク</th>
                                <th class="invoice-table__head-row__table-header">請求日</th>
                                <th class="invoice-table__head-row__table-header">担当者</th>
                                <th class="invoice-table__head-row__table-header">金額</th>
                                <th class="invoice-table__head-row__table-header">PDF</th>
                                <th class="invoice-table__head-row__table-header">作成</th>
                            </tr>
                            @foreach($invoices as $invoice)
                            <tr class="invoice-table__data-row">
                                <td class="invoice-table__data-row__table-data task-data">{{ $invoice->task->name }}</td>
                                <td class="invoice-table__data-row__table-data">{{ explode(' ', $invoice->task->ended_at)[0] }}</td>
                                <td class="invoice-table__data-row__table-data staff-data">
                                    <div class="imgbox">
                                        <img src="/{{ str_replace('public/', 'storage/', $invoice->companyUser->picture) }}" alt="">
                                    </div>
                                    <div class="name">
                                        {{ $invoice->companyUser->name }}
                                    </div>
                                </td>
                                <td class="invoice-table__data-row__table-data">{{ $invoice->task->price }}</td>
                                <td class="invoice-table__data-row__table-data">○</td>
                                <td class="invoice-table__data-row__table-data">
                                    <div class="invoice-table__data-row__table-data__create-container">
                                        <div class="invoice-table__data-row__table-data__create-container__create">
                                            <a href="document/invoice/{{ $invoice->id }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <div class="more-container__wrapper">
                                <p id="invoiceShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- 発注書 -->
             <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="../../../images/order.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">発注書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="order-table">
                                <tr class="order-table__head-row">
                                    <th class="order-table__head-row__table-header">タスク</th>
                                    <th class="order-table__head-row__table-header">請求日</th>
                                    <th class="order-table__head-row__table-header">担当者</th>
                                    <th class="order-table__head-row__table-header">金額</th>
                                    <th class="order-table__head-row__table-header">PDF</th>
                                    <th class="order-table__head-row__table-header">作成</th>
                                </tr>
                                @foreach($purchaseOrders as $purchaseOrder)
                                <tr class="order-table__data-row">
                                    <td class="order-table__data-row__table-data task-data">{{ $purchaseOrder->task_name }}</td>
                                    <td class="order-table__data-row__table-data">{{ explode(' ', $purchaseOrder->task_ended_at)[0] }}</td>
                                    <td class="order-table__data-row__table-data staff-data">
                                        <div class="imgbox">
                                            <img src="/{{ str_replace('public/', 'storage/', $purchaseOrder->companyUser->picture) }}" alt="">
                                        </div>
                                        <div class="name">
                                            {{ $purchaseOrder->companyUser->name }}
                                        </div>
                                    </td>
                                    <td class="order-table__data-row__table-data">{{ $purchaseOrder->task->price }}</td>
                                    <td class="order-table__data-row__table-data">○</td>
                                    <td class="order-table__data-row__table-data">
                                        <div class="order-table__data-row__table-data__create-container">
                                            <div class="order-table__data-row__table-data__create-container__create">
                                                <a href="/company/document/purchaseOrder/{{ $purchaseOrder->id }}">詳細</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <!-- Show More部分 -->
                            <div class="more-container">
                                <div class="more-container__wrapper">
                                    <p id="orderShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 業務委託契約書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="../../../images/outsourcing.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">業務委託契約書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="outsourcing-table">
                                <tr class="outsourcing-table__head-row">
                                    <th class="outsourcing-table__head-row__table-header">タスク</th>
                                    <th class="outsourcing-table__head-row__table-header">請求日</th>
                                    <th class="outsourcing-table__head-row__table-header">担当者</th>
                                    <th class="outsourcing-table__head-row__table-header">金額</th>
                                    <th class="outsourcing-table__head-row__table-header">PDF</th>
                                    <th class="outsourcing-table__head-row__table-header">作成</th>
                                </tr>
                                
                                <tr class="outsourcing-table__data-row">
                                    
                                    <td class="outsourcing-table__data-row__table-data task-data">
                                        コーディング
                                    </td>
                                    <td class="outsourcing-table__data-row__table-data">
                                        2018-11-05
                                    </td>
                                    <td class="outsourcing-table__data-row__table-data staff-data">
                                        <div class="imgbox">
                                            <img src="../../../images/photoimg.png" alt="">
                                        </div>
                                        <div class="name">
                                            加藤 裕美子
                                        </div>
                                    </td>
                                    <td class="outsourcing-table__data-row__table-data">
                                        100000
                                    </td>
                                    <td class="outsourcing-table__data-row__table-data">○</td>
                                    <td class="outsourcing-table__data-row__table-data">
                                        <div class="outsourcing-table__data-row__table-data__create-container">
                                            <div class="outsourcing-table__data-row__table-data__create-container__create">
                                                <a href="">作成</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            </table>
                            <!-- Show More部分 -->
                            <div class="more-container">
                                <div class="more-container__wrapper">
                                    <p id="outsourcingShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 機密保持契約書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="../../../images/non-disclosur.png" alt=""></div>
                        <div class="item-name-wrapper__item-name">機密保持契約書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="nda-table">
                                <tr class="nda-table__head-row">
                                    <th class="nda-table__head-row__table-header">タスク</th>
                                    <th class="nda-table__head-row__table-header">請求日</th>
                                    <th class="nda-table__head-row__table-header">担当者</th>
                                    <th class="nda-table__head-row__table-header">金額</th>
                                    <th class="nda-table__head-row__table-header">PDF</th>
                                    <th class="nda-table__head-row__table-header">作成</th>
                                </tr>
                                @foreach($ndas as $nda)
                                <tr class="nda-table__data-row">
                                    <td class="nda-table__data-row__table-data task-data">{{ $nda->task->name }}</td>
                                    <td class="nda-table__data-row__table-data">{{ explode(' ', $nda->task->ended_at)[0] }}</td>
                                    <td class="nda-table__data-row__table-data staff-data">
                                        <div class="imgbox">
                                        <img src="/{{ str_replace('public/', 'storage/', $nda->companyUser->picture) }}"alt="">
                                        </div>
                                        <div class="name">
                                                {{ $nda->companyUser->name }}
                                        </div>
                                    </td>
                                    <td class="nda-table__data-row__table-data">{{ $nda->task->price }}</td>
                                    <td class="nda-table__data-row__table-data">○</td>
                                    <td class="nda-table__data-row__table-data">
                                        <div class="nda-table__data-row__table-data__create-container">
                                            <div class="nda-table__data-row__table-data__create-container__create">
                                                @if($nda->status === 3)
                                                    <a href="document/invoice/create">詳細</a>
                                                @else
                                                    <a href="document/invoice/create">作成</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <!-- Show More部分 -->
                            <div class="more-container">
                                <div class="more-container__wrapper">
                                    <p id="ndaShowMoreBtn" class="more-container__wrapper__showmore">もっと見る</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
