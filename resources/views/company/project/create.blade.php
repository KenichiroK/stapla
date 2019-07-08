@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/create.css') }}">
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
                <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li class="isActive"><a href="/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <form action="{{ url('/company/project') }}" method='POST'>
    @csrf
    <div class="main__container__wrapper">
        <div class="top-container">
            <h1 class="top-container__title">プロジェクト作成</h1>
        </div>
        <div class="project-create__container">
            <ul class="project-create__container__list">
                <li class="project-create__container__list__item margin--none">
                    <div class="project-create__container__list__item__name">プロジェクト名 :</div>
                    <div class="control">
                        <input name="name" class="project-create__container__list__item__input under-border input" type="text" placeholder="プロジェクト名">
                    </div>
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">プロジェクト詳細 :</div>
                    <div class="control">
                        <textarea class="project-create__container__list__item__textarea textarea has-fixed-size" name="detail" placeholder=""></textarea>
                    </div>
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">担当者 :</div>
                    <div class="select id-normal">
                        <select name="company_user_id" class="select-box" id="company-staff-name-list">
                            <option></option>
                            @foreach( $company_infos as $company_info )
                            <option value={{ $company_info->id }}>{{ $company_info->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">パートナー :</div>
                    <div class="select id-normal">
                        <select name="partner_id" class="select-box" id="partner-name-list">
                            <option value=""></option>
                            @foreach( $partner_infos as $partner_info )
                            <option value={{ $partner_info->id }}>{{ $partner_info->name }}</option>
                            @endforeach
                        </select>
                    </div>      
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">プロジェクト期間 :</div>
                    <div class="calendars">
                        <div class="calendars__wrapper">
                            <div class="calendars__wrapper__title">開始日</div>
                            <input name="started_at" type="text">
                        </div>
                        <div class="calendars__wrapper">
                            <div class="calendars__wrapper__title">終了日</div>
                            <input name="ended_at" type="text">
                        </div>
                    </div>
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">予算 :</div>
                    <div class="budget-container control">
                        <input name="budget" class="input is-normal" type="text" placeholder=""><span class="budget-container__yen">円</span>
                    </div>      
                </li>
                <li class="project-create__container__list__item">
                    <div class="project-create__container__list__item__name">資料 :</div>
                    <div class="project-create__container__list__item__wrapper">
                        <div class="project-create__container__list__item__wrapper__description">Upload</div>
                        <div class="file is-boxed project-create__container__list__item__wrapper__filearea">
                            <label class="file-label project-create__container__list__item__wrapper__filearea__label">
                                <input class="file-input project-create__container__list__item__wrapper__filearea__label" type="file">
                                <span class="file-cta project-create__container__list__item__wrapper__filearea__label__file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
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
