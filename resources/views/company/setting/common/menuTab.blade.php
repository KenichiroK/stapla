@if(session('completed'))
<div class="complete-container">
    <p>{{ session('completed') }}</p>
</div>
@endif

@if(count($errors) > 0)
<div class="error-container">
    <p>入力に問題があります。再入力して下さい。</p>
</div>
@endif

<div class="title-container">
    <h3>設定</h3>
</div>

<div class="menu-container">
    <ul>
        <li><a href="{{ route('company.setting.general.create') }}" {!! Request::is('*/general') ? 'class="isActive"' : '' !!}>会社基本情報設定</a></li>
        <li><a href="{{ route('company.setting.userSetting.create') }}" {!! Request::is('*/userSetting') ? 'class="isActive"' : '' !!}>会社担当者設定</a></li>
        <li><a href="{{ route('company.setting.personalInfo.create') }}" {!! Request::is('*/personalInfo') ? 'class="isActive"' : '' !!}>個人情報の設定</a></li>
        <li><a href="{{ route('company.setting.email.create') }}" {!! Request::is('*/email') ? 'class="isActive"' : '' !!}>メールアドレスの設定</a></li>
    </ul>
</div>
