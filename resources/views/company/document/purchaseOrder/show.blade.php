@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/show.css') }}">
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
                        <!-- <i class="fas fa-home"></i> -->
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
                        <!-- <i class="fas fa-chart-bar"></i> -->
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
                        <!-- <i class="fas fa-envelope"></i> -->
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
                        <!-- <i class="fas fa-tasks"></i> -->
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
                        <!-- <i class="fas fa-newspaper"></i> -->
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
                        <!-- <i class="fas fa-user-circle"></i> -->
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
                        <!-- <i class="fas fa-calendar-alt"></i> -->
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
                        <!-- <i class="fas fa-question"></i> -->
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
                        <!-- <i class="fas fa-cog"></i> -->
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
    <div class="main-wrapper__wrapper">
        <div class="head-container">
            <div class="head-container__wrapper">
                <div class="page-title-container">
                    <div class="page-title-container__page-title">発注書</div>
                </div>
                <!-- printボタン -->
                <div class="head-container__wrapper__print-btn-container">
                    <a id="print_btn" class="button head-container__wrapper__print-btn-container__button">プリント</a>
                </div>
            </div>
        </div>
    
        <div id="print" class="document-container A4">
            <!-- 印刷用 -->
            <div class="pageout">
                <div id="pdf_content" class="document-container__wrapper sheet padding-10mm">
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
                            <p class="date">納期: {{ explode(' ', $purchaseOrder->task_ended_at)[0] }}</p>
                        </div>
        
                        <div class="left">
                            <p class="date">発注日: {{ explode(' ', $purchaseOrder->task_started_at)[0] }}</p>
                            <p clss="name">{{ $purchaseOrder->company_name }}</p>
                            <p class="tel">{{ $purchaseOrder->company_tel }}</p>
                            <p classs="address">〒{{ $purchaseOrder->company_zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                            <p class="building">{{ $purchaseOrder->company_streetAddress }}</p>
                            <p class="building">{{ $purchaseOrder->companyUser_name }}</p>
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
                        <p class="date">納期: {{ explode(' ', $purchaseOrder->task_ended_at)[0] }}</p>
                    </div>
    
                    <div class="left">
                        <p class="date">発注日: {{ explode(' ', $purchaseOrder->task_started_at)[0] }}</p>
                        <p clss="name">{{ $purchaseOrder->company_name }}</p>
                        <p class="tel">{{ $purchaseOrder->company_tel }}</p>
                        <p classs="address">〒{{ $purchaseOrder->company_zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                        <p class="building">{{ $purchaseOrder->company_streetAddress }}</p>
                        <p class="building">{{ $purchaseOrder->companyUser_name }}</p>
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
    </div>


    @if($purchaseOrder->task->status === 5 && in_array($company_user->id, $company_user_ids))
    <div class="submit-btn-container">
        <form action="{{ url('company/task/status') }}" method="POST">
        @csrf
            <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
            <input type="hidden" name="status" value="6">
            <button type="submit" class="button submit-btn-container__button">提出</button>
        </form>
    </div>
    @elseif($purchaseOrder->task->status === 7 && $purchaseOrder->task->superior->id === $company_user->id)
    <div class="actionButton">
        <form action="{{ url('company/task/status') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="6">
                <button type="submit" class="undone">発注書を承認しない</button>
            </form>
            <form action="{{ url('company/task/status') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="8">
                <button type="submit" class="done">発注書を承認する</button>
        </form>
    </div>
    @elseif($purchaseOrder->task->status > 7 && $purchaseOrder->task->superior->id === $company_user->id)
    <p class="send-done">この発注書は承認済みです</p>
    @elseif($purchaseOrder->task->status > 5 && in_array($company_user->id, $company_user_ids))
    <p class="send-done">この発注書は提出済みです</p>
    @else
    <p class="send-done">必要なアクションはありません</p>
    @endif
</div>
@endsection
