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
        <li><a href="{{ route('company.setting.general.create') }}" {!! $activeClass == "general" ? 'class="isActive"' : '' !!}>会社基本情報設定</a></li>
        <li><a href="{{ route('company.setting.userSetting.create') }}" {!! $activeClass == "userSetting" ? 'class="isActive"' : '' !!}>会社担当者設定</a></li>
        <li><a href="{{ route('company.setting.personalInfo.create') }}" {!! $activeClass == "personalInfo" ? 'class="isActive"' : '' !!}>個人情報の設定</a></li>
        <li><a href="{{ route('company.setting.email.create') }}" {!! $activeClass == "email" ? 'class="isActive"' : '' !!}>メールアドレスの設定</a></li>
    </ul>
</div>