@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/profile/index.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
  user name
</div>
<div class="navbar-item">
    <img src="../images/dummy_user.jpeg" alt="プロフィール画像">
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    fms
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/partner/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/partner/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/partner/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/partner/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/partner/setting/invoice" class="isActive"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('partner.logout') }}">
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
        <h3>プロフィール管理画面</h3>
    </div>

    <form action="" method="POST">
        @csrf
        <div class="body-container">
            <div class="title-container">
                <h4>プロフィール</h4>
            </div>

        
            <div class="edit-container">
                <div class="image-container">
                    <img src="../../images/preview.jpeg" alt="プレビュー画像" id="preview" width="140px" height="140px">
                    <label for="profile_image">
                        画像をアップロード
                        <input type="file" id="profile_image" style="display: none;" name="profile_image">
                    </label>
                </div>

                <div class="profile-container">
                    <div class="short-input-container">
                        <p>名前・ニックネーム</p>
                        <input type="text" name="name">
                    </div>

                    <div class="short-input-container">
                        <p>職種</p>
                        <input type="text" name="occupations">
                    </div>

                    <div class="long-input-container">
                        <p>Twitter</p>
                        <input type="text" name="twitter">
                    </div>

                    <div class="long-input-container">
                        <p>Facebook</p>
                        <input type="text" name="facebook">
                    </div>

                    <div class="long-input-container">
                        <p>Github</p>
                        <input type="text" name="github">
                    </div>

                    <div class="long-input-container">
                        <p>Instagram</p>
                        <input type="text" name="instagram">
                    </div>

                    <div class="long-input-container">
                        <p>Webサイト・ブログ</p>
                        <input type="text" name="relatedlinks">
                    </div>

                    <div class="textarea-container">
                        <p>自己紹介</p>
                        <textarea name="self_production" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-container">
            <button class="preview-btn" type="button">プレビュー</button>
            <button class="submit-btn" type="submit">保存</button>
        </div>
    </form>
</div>
@endsection
