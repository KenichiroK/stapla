@extends('company.index')

@section('assets')
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
<div class="navbar-item">
    {{ $company_user->name }}
</div>
<div class="navbar-item">
    <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
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
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
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
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3>発注書</h3>
    </div>
    <div class="head-container__wrapper__print-btn-container">
        <a @click="download()" class="button head-container__wrapper__print-btn-container__button">Print</a>
    </div>

    <form action="">
        
        <div class="document-container">
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

        <div class="submit-btn-container">
            <a @click="toggleModal()" class="button submit-btn-container__button">提出</a>
        </div>
    </form>
</div>
@endsection
