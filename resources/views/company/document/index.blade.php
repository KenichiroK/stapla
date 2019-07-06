@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/index.css') }}">
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
                <ul class="menu-list menu menu__container__menu-list">
                    <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                    <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                    <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                    <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                    <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                    <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
                    <li>
                        <form method="POST" action="{{ route('company.logout') }}">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <!--main__container__wrapperに記述していく-->
        <div class="page-title-container">
            <div class="page-title-container__page-title">タスク作成</div>
        </div>
        <div class="head-container">
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div><i class="icon fa fa-file" aria-hidden="true"></i></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">請求書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">{{ $invoices_0data->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <div class="head-container__wrapper__item-container__wrapper__create-container__create">確認</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div><i class="icon fa fa-file" aria-hidden="true"></i></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">発注書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">{{ $purchaseOrders_0data->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <div class="head-container__wrapper__item-container__wrapper__create-container__create">確認</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-container__wrapper">
                <div class="head-container__wrapper__item-container">
                    <div class="head-container__wrapper__item-container__wrapper">
                        <div class="head-container__wrapper__item-container__wrapper__icon-container">
                            <div><i class="icon fa fa-file" aria-hidden="true"></i></div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__content-container">
                            <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper">
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__number">機密保持契約書未対応</div>
                                <div class="head-container__wrapper__item-container__wrapper__content-container__wrapper__text">{{ $ndas_0data->count() }}</div>
                            </div>
                        </div>
                        <div class="head-container__wrapper__item-container__wrapper__create-container">
                            <div class="head-container__wrapper__item-container__wrapper__create-container__create">確認</div>
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
                                    <th class="document-table__head-row__table-header"></th>
                                    <th class="document-table__head-row__table-header">書類</th>
                                    <th class="document-table__head-row__table-header">未対応</th>
                                    <th class="document-table__head-row__table-header">他依頼中</th>
                                    <th class="document-table__head-row__table-header">パートナー依頼中</th>
                                    <th class="document-table__head-row__table-header">完了</th>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data">icon</td>
                                    <td class="document-table__data-row__table-data">請求書</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_0data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_1data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_2data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $invoices_3data->count() }}</td>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data">icon</td>
                                    <td class="document-table__data-row__table-data">発注書</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_0data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_1data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_2data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $purchaseOrders_3data->count() }}</td>
                                </tr>
                                <tr class="document-table__data-row">
                                    <td class="document-table__data-row__table-data">icon</td>
                                    <td class="document-table__data-row__table-data">機密保持契約書</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_0data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_1data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_2data->count() }}</td>
                                    <td class="document-table__data-row__table-data">{{ $ndas_3data->count() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 請求書 -->
            <div class="main-container">
            <div class="main-container__wrapper">
                <div class="item-name-wrapper">
                    <div class="item-name-wrapper__item-name">請求書</div>
                </div>
                <div class="main-container__wrapper__table-container">
                    <div class="main-container__wrapper__table-container__wrapper">
                    <table class="invoice-table">
                        <tr class="invoice-table__head-row">
                            <th class="invoice-table__head-row__table-header">ステータス</th>
                            <th class="invoice-table__head-row__table-header">タスク</th>
                            <th class="invoice-table__head-row__table-header">請求日</th>
                            <th class="invoice-table__head-row__table-header">担当者</th>
                            <th class="invoice-table__head-row__table-header">金額</th>
                            <th class="invoice-table__head-row__table-header">PDF</th>
                            <th class="invoice-table__head-row__table-header">作成</th>
                        </tr>
                        @foreach($invoices as $invoice)
                        <tr class="invoice-table__data-row">
                            <td class="invoice-table__data-row__table-data">
                                @if($invoice->status === 0)
                                    未対応
                                @elseif($invoice->status === 1)
                                    1
                                @elseif($invoice->status === 2)
                                    2
                                @else
                                    完了
                                @endif
                            </td>
                            <td class="invoice-table__data-row__table-data">{{ $invoice->task->name }}</td>
                            <td class="invoice-table__data-row__table-data">{{ explode(' ', $invoice->task->ended_at)[0] }}</td>
                            <td class="invoice-table__data-row__table-data">
                                <p>担当者</p>
                            </td>
                            <td class="invoice-table__data-row__table-data">{{ $invoice->task->price }}</td>
                            <td class="invoice-table__data-row__table-data">◯</td>
                            <td class="invoice-table__data-row__table-data">
                                <div class="invoice-table__data-row__table-data__create-container">
                                    <div class="invoice-table__data-row__table-data__create-container__create">
                                        <a href="document/invoice/create">作成</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <!-- Show More部分 -->
                    <div class="more-container">
                        <div class="more-container__wrapper">
                        <a class="more-container__wrapper__showmore" href="#">Show More</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- 発注書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">発注書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="invoice-table">
                                <tr class="invoice-table__head-row">
                                    <th class="invoice-table__head-row__table-header">ステータス</th>
                                    <th class="invoice-table__head-row__table-header">タスク</th>
                                    <th class="invoice-table__head-row__table-header">請求日</th>
                                    <th class="invoice-table__head-row__table-header">担当者</th>
                                    <th class="invoice-table__head-row__table-header">金額</th>
                                    <th class="invoice-table__head-row__table-header">PDF</th>
                                    <th class="invoice-table__head-row__table-header">作成</th>
                                </tr>
                                @foreach($purchaseOrders as $purchaseOrder)
                                <tr class="invoice-table__data-row">
                                    <td class="invoice-table__data-row__table-data">
                                        @if($purchaseOrder->status === 0)
                                            未対応
                                        @elseif($purchaseOrder->status === 1)
                                            1
                                        @elseif($purchaseOrder->status === 2)
                                            2
                                        @else
                                            完了
                                        @endif
                                    </td>
                                    <td class="invoice-table__data-row__table-data">{{ $purchaseOrder->task->name }}</td>
                                    <td class="invoice-table__data-row__table-data">{{ explode(' ', $purchaseOrder->task->ended_at)[0] }}</td>
                                    <td class="invoice-table__data-row__table-data">
                                        <p>担当者</p>
                                    </td>
                                    <td class="invoice-table__data-row__table-data">{{ $purchaseOrder->task->price }}</td>
                                    <td class="invoice-table__data-row__table-data">◯</td>
                                    <td class="invoice-table__data-row__table-data">
                                        <div class="invoice-table__data-row__table-data__create-container">
                                            <div class="invoice-table__data-row__table-data__create-container__create">
                                                <a href="document/invoice/create">作成</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <!-- Show More部分 -->
                            <div class="more-container">
                                <div class="more-container__wrapper">
                                    <a class="more-container__wrapper__showmore" href="#">Show More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 機密保持契約書 -->
            <div class="main-container">
                <div class="main-container__wrapper">
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">機密保持契約書</div>
                    </div>
                    <div class="main-container__wrapper__table-container">
                        <div class="main-container__wrapper__table-container__wrapper">
                            <table class="invoice-table">
                                <tr class="invoice-table__head-row">
                                    <th class="invoice-table__head-row__table-header">ステータス</th>
                                    <th class="invoice-table__head-row__table-header">タスク</th>
                                    <th class="invoice-table__head-row__table-header">請求日</th>
                                    <th class="invoice-table__head-row__table-header">担当者</th>
                                    <th class="invoice-table__head-row__table-header">金額</th>
                                    <th class="invoice-table__head-row__table-header">PDF</th>
                                    <th class="invoice-table__head-row__table-header">作成</th>
                                </tr>
                                @foreach($ndas as $nda)
                                <tr class="invoice-table__data-row">
                                    <td class="invoice-table__data-row__table-data">
                                        @if($nda->status === 0)
                                            未対応
                                        @elseif($nda->status === 1)
                                            1
                                        @elseif($nda->status === 2)
                                            2
                                        @else
                                            完了
                                        @endif
                                    </td>
                                    <td class="invoice-table__data-row__table-data">{{ $nda->task->name }}</td>
                                    <td class="invoice-table__data-row__table-data">{{ explode(' ', $nda->task->ended_at)[0] }}</td>
                                    <td class="invoice-table__data-row__table-data">
                                        <p>担当者</p>
                                    </td>
                                    <td class="invoice-table__data-row__table-data">{{ $nda->task->price }}</td>
                                    <td class="invoice-table__data-row__table-data">◯</td>
                                    <td class="invoice-table__data-row__table-data">
                                        <div class="invoice-table__data-row__table-data__create-container">
                                            <div class="invoice-table__data-row__table-data__create-container__create">
                                                <a href="document/invoice/create">作成</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <!-- Show More部分 -->
                            <div class="more-container">
                                <div class="more-container__wrapper">
                                    <a class="more-container__wrapper__showmore" href="#">Show More</a>
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