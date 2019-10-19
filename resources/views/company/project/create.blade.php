@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/create.css') }}">
@endsection

@section('content')
<div class="main__container">
    <form action="{{ route('company.project.store') }}" method='POST' enctype="multipart/form-data">
        @csrf
        <div class="main__container__wrapper">
            <div class="top-container">
                <h1 class="top-container__title">プロジェクト作成</h1>
            </div>
            <div class="project-create__container">
                <ul class="project-create__container__list">
                    <li class="project-create__container__list__item margin--none">
                        <div class="project-create__container__list__item__name">プロジェクト名</div>
                        <div class="input-container">
                            <input class="project-create__container__list__item__input input form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}" name="project_name"  type="text" value="{{ old('project_name')}}">
                            @if ($errors->has('project_name'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('project_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト詳細</div>
                        <div class="textarea-container">
                            <textarea class="project-create__container__list__item__textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name="project_detail" placeholder="">{{ old('project_detail') }}</textarea>
                            @if ($errors->has('project_detail'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('project_detail') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">担当者</div>
                        <div class="select-wrp">
                            <div class="select-container select id-normal select-plusicon is-multiple"> 
                                <select name="company_user_id" class="select-box form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}" id="company-staff-name-list">
                                    <option disabled selected></option>
                                    @foreach( $company_users as $company_user )
                                    <option value="{{ $company_user->id }}" {{ (old('company_user_id') === $company_user->id)? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('company_user_id'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('company_user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>

                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト期間</div>
                        <div class="calendars">
                            <div class="calendars__wrapper">
                                <div class="calendars__wrapper__title start">開始日<i class="fas fa-calendar-alt"></i></div>
                                <input
                                    type="date"
                                    name="started_at"
                                    value="{{ old('started_at', date('Y-m-d')) }}"
                                >

                                @if($errors->has('started_at'))
                                    <div class="error-mes-wrp">
                                        <strong style='color: #e3342f;'>{{ $errors->first('started_at') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="calendars__wrapper right">
                                <div class="calendars__wrapper__title">終了日<i class="fas fa-calendar-alt"></i></div>
                                <input
                                    type="date"
                                    name="ended_at"
                                    value="{{ old('ended_at', date('Y-m-d')) }}"
                                >

                                @if ($errors->has('ended_at'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('ended_at') }}</strong>
                                    </div>
                                @endif   
                            </div>
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">予算</div>
                        <div class="budget-container input-container">
                            <input id="inputPrice" name="budget" type="text" placeholder="" value="{{ old('budget')}}"><span class="budget-container__yen">円</span>
                            @if ($errors->has('budget'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('budget') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <!-- <li class="project-create__container__list__item document">
                        <div class="project-create__container__list__item__name">資料</div>
                        <div class="project-create__container__list__item__wrapper document-item">
                            <div class="project-create__container__list__item__wrapper__description upload">アップロード</div>
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
                            <img src="{{ env('AWS_URL') }}/common/dragdrop.png" alt="">
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="button-container">
                <!-- <div class="preview-button-wrapper">
                    <button type="submit" class="preview-button-wrapper__btn button">プレビュー</button>
                </div> -->
                <div class="btn01-container">
                    <button type="button" onclick="submit();">作成</button>
                </div>
            </div>
        
        </div>
    </form>
</div>
@endsection
