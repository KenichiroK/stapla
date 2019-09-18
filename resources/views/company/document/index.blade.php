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
            <img src="{{ asset('images/icon_small-down.png') }}" alt="">
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
            <a href="/company/dashboard">
                <div class="menu__container--label">
                    <div class="menu-label">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                </div>
            </a>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_home.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_dashboard.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document" class="isActive">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_invoices-active.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_customers.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_help-center.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_setting.png') }}" alt="">
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
            <div class="page-title">書類一覧</div>
        </div>
        <div class="head-container">
            
            <div class="head-container__wrapper">
                <div class="item-container">
                    <div class="icon-container">
                        <div class="icon-imgbox"><img src="{{ asset('images/order.png') }}" alt=""></div>
                    </div>
                    <div class="content-container">
                        <div class="content-container__wrapper">
                            <div class="text">発注書未対応</div>
                            <div class="t-number">{{ $purchaseOrders_0status->count() }}</div>
                        </div>
                    </div>
                    <div class="create-container">
                        <!-- <div class="create"><a href="">確認</a></div> -->
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="item-container">
                    <div class="icon-container">
                        <div class="icon-imgbox"><img src="{{ asset('images/outsourcing.png') }}" alt=""></div>
                    </div>
                    <div class="content-container">
                        <div class="content-container__wrapper">
                            <div class="text">業務委託契約書未対応</div>
                            <div class="t-number">{{ $ndas_0status->count() }}</div>
                        </div>
                    </div>
                    <div class="create-container">
                        <!-- <div class="create"><a href="">確認</a></div> -->
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="item-container">
                    <div class="icon-container">
                        <div class="icon-imgbox"><img src="{{ asset('images/non-disclosur.png') }}" alt=""></div>
                    </div>
                    <div class="content-container">
                        <div class="content-container__wrapper">
                            <div class="text">機密保持契約書未対応</div>
                            <div class="t-number">{{ $ndas_0status->count() }}</div>
                        </div>
                    </div>
                    <div class="create-container">
                        <!-- <div class="create"><a href="">確認</a></div> -->
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="item-container">
                    <div class="icon-container">
                        <div class="icon-imgbox"><img src="{{ asset('images/invoice.png') }}" alt=""></div>
                    </div>
                    <div class="content-container">
                        <div class="content-container__wrapper">
                            <div class="text">請求書未対応</div>
                            <div class="t-number">{{ $invoices_0status->count() }}</div>
                        </div>
                    </div>
                    <div class="create-container">
                        <!-- <div class="create"><a href="">確認</a></div> -->
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
                    <div class="table-container">
                        <table class="document-table">
                            <tr class="head-row">
                                <th class="icon-th"></th>
                                <th>書類</th>
                                <th>未対応</th>
                                <th>他依頼中</th>
                                <th>パートナー依頼中</th>
                                <th>完了</th>
                            </tr>
                            <tr class="data-row">
                                <td><div class="icon-imgbox"><img src="{{ asset('images/order.png') }}" alt=""></div></td>
                                <td class="doc-title">発注書</td>
                                <td>{{ $purchaseOrders_0status->count() }}件</td>
                                <td>{{ $purchaseOrders_1status->count() }}件</td>
                                <td>{{ $purchaseOrders_2status->count() }}件</td>
                                <td>{{ $purchaseOrders_3status->count() }}件</td>
                            </tr>
                            <tr class="data-row">
                                <td><div class="icon-imgbox"><img src="{{ asset('images/outsourcing.png') }}" alt=""></div></td>
                                <td class="doc-title">業務委託契約書</td>
                                <td>件</td>
                                <td>件</td>
                                <td>件</td>
                                <td>件</td>
                            </tr>
                            <tr class="data-row">
                                <td><div class="icon-imgbox"><img src="{{ asset('images/non-disclosur.png') }}" alt=""></div></td>
                                <td class="doc-title">機密保持契約書</td>
                                <td>{{ $ndas_0status->count() }}件</td>
                                <td>{{ $ndas_1status->count() }}件</td>
                                <td>{{ $ndas_2status->count() }}件</td>
                                <td>{{ $ndas_3status->count() }}件</td>
                            </tr>
                            <tr class="data-row">
                                <td><div class="icon-imgbox"><img src="{{ asset('images/invoice.png') }}" alt=""></div></td>
                                <td class="doc-title">請求書</td>
                                <td>{{ $invoices_0status->count() }}件</td>
                                <td>{{ $invoices_1status->count() }}件</td>
                                <td>{{ $invoices_2status->count() }}件</td>
                                <td>{{ $invoices_3status->count() }}件</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
             <!-- 発注書 -->
             <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="{{ asset('images/order.png') }}" alt=""></div>
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
                                        <img src="/{{ str_replace('public/', 'storage/', $purchaseOrder->companyUser->picture) }}" alt="">
                                    </div>
                                    <div class="name">
                                        {{ $purchaseOrder->companyUser->name }}
                                    </div>
                                </td>
                                <td>{{ $purchaseOrder->task->price }}</td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="create">
                                            <a href="/company/document/purchaseOrder/{{ $purchaseOrder->id }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="invoiceShowMoreBtn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 業務委託契約書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="{{ asset('images/outsourcing.png') }}" alt=""></div>
                        <div class="item-name-wrapper__item-name">業務委託契約書</div>
                    </div>
                    <div class="table-container">
                        <table class="outsourcing-table table01">
                            <tr class="head-row">
                                <th>タスク</th>
                                <th>請求日</th>
                                <th>担当者</th>
                                <th>金額</th>
                                <th>PDF</th>
                                <th>作成済</th>
                            </tr>
                            <tr class="data-row">
                                <td class="task-data">
                                    コーディング
                                </td>
                                <td>
                                    2018年11月05日
                                </td>
                                <td class="staff-data">
                                    <div class="imgbox">
                                        <img src="{{ asset('images/photoimg.png') }}" alt="">
                                    </div>
                                    <div class="name">
                                        加藤 裕美子
                                    </div>
                                </td>
                                <td>
                                    100000
                                </td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="create">
                                            <a href="">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="invoiceShowMoreBtn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 機密保持契約書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                    <div class="icon-imgbox"><img src="{{ asset('images/non-disclosur.png') }}" alt=""></div>
                        <div class="item-name-wrapper__item-name">機密保持契約書</div>
                    </div>
                    <div class="table-container">
                        <table class="nda-table table01">
                            <tr class="head-row">
                                <th>タスク</th>
                                <th>請求日</th>
                                <th>担当者</th>
                                <th>金額</th>
                                <th>PDF</th>
                                <th>作成済</th>
                            </tr>
                            @foreach($ndas as $nda)
                            <tr class="data-row">
                                <td class="task-data">{{ $nda->task->name }}</td>
                                <td>{{ date("Y年m月d日", strtotime($nda->task->ended_at)) }}</td>
                                <td class="staff-data">
                                    <div class="imgbox">
                                    <img src="/{{ str_replace('public/', 'storage/', $nda->companyUser->picture) }}"alt="">
                                    </div>
                                    <div class="name">
                                            {{ $nda->companyUser->name }}
                                    </div>
                                </td>
                                <td>{{ $nda->task->price }}</td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="create">
                                            <a href="document/nda/{{ $nda->id }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="invoiceShowMoreBtn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 請求書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper icon-item-name-wrpper">
                        <div class="icon-imgbox"><img src="{{ asset('images/invoice.png') }}" alt=""></div>
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
                                        <img src="/{{ str_replace('public/', 'storage/', $invoice->companyUser->picture) }}" alt="">
                                    </div>
                                    <div class="name">
                                        {{ $invoice->companyUser->name }}
                                    </div>
                                </td>
                                <td>{{ $invoice->task->price }}</td>
                                <td>○</td>
                                <td>
                                    <div class="create-container">
                                        <div class="create">
                                            <a href="document/invoice/{{ $invoice->id }}">詳細</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <!-- Show More部分 -->
                        <div class="more-container">
                            <p id="invoiceShowMoreBtn" class="showmore">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
