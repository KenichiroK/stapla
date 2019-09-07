@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/document/purchaseOrder/index.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $partner->name }}
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
                    <form method="POST" action="{{ route('partner.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <a href="/partner/profile">
            <img src="/{{ str_replace('public/', 'storage/', $partner->picture) }}" alt="プロフィール画像">
        </a>
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
                    <a href="/partner/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
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
                    <a href="/partner/setting/invoice">
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
<div class="main-wrapper">
    <div class="title-container">
        <h3>確認画面</h3>
    </div>

    <div class="message-container">
        <h3>{{ $purchaseOrder->company->company_name }}様から{{ $purchaseOrder->task->name }}の以来が来ています。</h3>
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
                <p class="date">納期: {{ explode(' ', $purchaseOrder->task->ended_at)[0] }}</p>
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


    @if($purchaseOrder->task->status === 9 && $purchaseOrder->partner->id === $partner->id)
    <div class="actionButton">
        <form action="{{ url('partner/task/status') }}" method="POST">
        @csrf
            <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
            <input type="hidden" name="status" value="8">
            <button type="submit" class="undone">断る</button>
        </form>
        <form action="{{ url('partner/task/status') }}" method="POST">
        @csrf
            <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
            <input type="hidden" name="status" value="10">
            <button type="submit" class="done">この案件を受ける</button>
        </form>
    </div>
    @elseif($purchaseOrder->task->status > 9 && $purchaseOrder->partner->id === $partner->id)
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
