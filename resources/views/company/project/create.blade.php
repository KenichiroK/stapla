@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/create.css') }}">
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
                <li class="isActive"><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <form action="{{ url('/company/project') }}" method='POST' enctype="multipart/form-data">
        @csrf
        <div class="main__container__wrapper">
            <div class="top-container">
                <h1 class="top-container__title">プロジェクト作成</h1>
            </div>
            <div class="project-create__container">
                <ul class="project-create__container__list">
                    <li class="project-create__container__list__item margin--none">
                        <div class="project-create__container__list__item__name">プロジェクト名 :</div>
                        <div class="input-container">
                            <input name="project_name" class="project-create__container__list__item__input" type="text" value="{{ old('project_name')}}">
                            @if($errors->has('project_name'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('project_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト詳細 :</div>
                        <div class="textarea-container">
                            <textarea class="project-create__container__list__item__textarea" name="project_detail" placeholder="">{{ old('project_detail') }}</textarea>
                            @if($errors->has('project_detail'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('project_detail') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">担当者 :</div>
                        <div class="select-container select id-normal">
                            <select name="company_user_id" class="select-box" id="company-staff-name-list">
                                <option></option>
                                @foreach( $company_users as $company_user )
                                <option value="{{ $company_user->id }}">{{ $company_user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company_user_id'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('company_user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">パートナー :</div>
                        <div class="select id-normal">
                            <select name="partner_id" class="select-box" id="partner-name-list">
                                <option value=""></option>
                                @foreach( $partner_users as $partner_user )
                                <option value="{{ $partner_user->id }}">{{ $partner_user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('partner_id'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('partner_id') }}</strong>
                                </div>
                            @endif
                        </div>      
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト期間 :</div>
                        <div class="calendars">
                            <div class="calendars__wrapper">
                                <div class="calendars__wrapper__title">開始日</div>
                                <input name="started_at" type="text" value="{{ old('started_at')}}">
                                @if($errors->has('started_at'))
                                    <div>
                                        <strong style='color: #e3342f;'>{{ $errors->first('started_at') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="calendars__wrapper right">
                                <div class="calendars__wrapper__title">終了日</div>
                                <input name="ended_at" type="text" value="{{ old('ended_at')}}">
                                @if($errors->has('ended_at'))
                                    <div>
                                        <strong style='color: #e3342f;'>{{ $errors->first('ended_at') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">予算 :</div>
                        <div class="budget-container input-container">
                            <input name="budget" type="text" placeholder="" value="{{ old('budget')}}"><span class="budget-container__yen">円</span>
                            @if($errors->has('budget'))
                                <div>
                                    <strong style='color: #e3342f;'>{{ $errors->first('budget') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">資料 :</div>
                        <div class="project-create__container__list__item__wrapper">
                            <div class="project-create__container__list__item__wrapper__description">アップロード</div>
                            <div class="file has-name is-boxed">
                            <label class="file-label">
                                <input id="inputFile" class="file-input" type="file" name="file">
                                <span id="upload-btn" class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                                </span>
                                <span id="fileName" class="file-name">
                                </span>
                            </label>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="button-wrapper">
                    <button type="submit" class="button-wrapper__btn button">作成</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
