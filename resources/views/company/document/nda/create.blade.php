@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/nda/create.css') }}">
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

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    impro
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

@foreach($asignedProjectPartners as $asignedProjectPartner)
    <div>{{ $asignedProjectPartner->id }}</div>
@endforeach

<div>------------------------------------------------</div>

@foreach($companyUsers as $companyUser)
    <div>{{ $companyUser }}</div>
@endforeach

<div class="main__container">
    <div class="main__container__wrapper">
        <!--main__container__wrapperに記述していく-->
        <div class="page-title-container">
            <div class="page-title-container__page-title">機密保持契約書</div>
        </div>
        <div class="main-container">
            <form action="{{ url('company/document/nda') }}" method="post">
            @csrf
                <div class="main-container__wrapper">
                    <!-- タスク -->
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">
                            タスク
                        </div>
                    </div>
                    <div class="select-container">
                        <div class="select-container__wrapper select">
                            <select class="select-container__wrapper__select" name="task_id">
                                <option disabled selected></option>
                                <option disabled>-- 機密保持契約書 未作成 --</option>
                                @foreach($ndaUnDoneTasks as $ndaUnDoneTask)
                                <option value="{{ $ndaUnDoneTask->id }}">{{ $ndaUnDoneTask->name }}　[ {{ $ndaUnDoneTask->project->name }} ]</option>
                                @endforeach
                                <option disabled>-- 機密保持契約書 作成済み --</option>
                                @foreach($ndaDoneTasks as $ndaDoneTask)
                                <option value="{{ $ndaDoneTask->id }}">* {{ $ndaDoneTask->name }}　[ {{ $ndaDoneTask->project->name }} ]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- 担当者 -->
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">
                            担当者
                        </div>
                    </div>
                    <div class="select-container">
                        <div class="select-container__wrapper select">
                            <select class="select-container__wrapper__select" name='companyUser_id'>
                                <option disabled selected></option>
                                @foreach($companyUsers as $companyUser)
                                <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                @endforeach                            
                            </select>
                        </div>
                    </div>
                    <!-- パートナー -->
                    <div class="item-name-wrapper">
                        <div class="item-name-wrapper__item-name">
                            パートナー
                        </div>
                    </div>
                    <div class="select-container">
                        <div class="select-container__wrapper select">
                            <select class="select-container__wrapper__select" name='partner_id'>
                                <option disabled selected></option>
                                @foreach($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- 作成ボタン -->
                    <div class="button-container">
                        <button type="submit">作成</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection