@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/project/create/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    @if(count($errors) > 0)
    <div class="error-container">
        <p>入力に問題があります。再入力して下さい。</p>
    </div>
    @endif

    <div class="page-title-container">
        <h3 class="page-title-container__text">プロジェクト作成</h3>
    </div>

    <form action="{{ route('company.project.store') }}" method="POST">
    @csrf
        <div class="block-container">
            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">プロジェクト名</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <input class="input" type="text" name="project_name"  value="{{ old('project_name')}}">
                    @if ($errors->has('project_name'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('project_name') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">プロジェクト詳細</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <textarea class="textarea" name="project_detail">{{ old('project_detail') }}</textarea>
                    @if ($errors->has('project_detail'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('project_detail') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">担当者</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="company_user_id">
                            <option selected></option>
                            @foreach($company_users as $company_user)
                            <option value="{{ $company_user->id }}" {{ (old('company_user_id') === $company_user->id)? 'selected' : '' }}>
                                {{ $company_user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('company_user_id'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('company_user_id') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">プロジェクト期間</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="date-container">
                        <div class="date-container__input">
                            <input
                                id="start_calendar"
                                class="date"
                                type="text"
                                name="started_at"
                                value="{{ old('started_at') ? old('started_at') : date('Y/m/d 00:00') }}"
                            >
                        </div>

                        <div class="date-container__hyphen">〜</div>

                        <div class="date-container__input">
                            <input
                                id="end_calendar"
                                class="date"
                                type="text"
                                name="ended_at"
                                value="{{ old('ended_at') ? old('ended_at') : date('Y/m/d 23:00') }}"
                            >
                        </div>  
                    </div>
                    @if ($errors->has('started_at'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('started_at') }}</strong>
                    </div>
                    @endif
                    @if ($errors->has('ended_at'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('ended_at') }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-container">
                <div class="form-container__text">
                    <p class="form-container__text--title">予算</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="price-container">
                        <div class="price-container__input">
                            <input class="input" type="text" name="budget" value="{{ old('budget') }}">
                        </div>
                        <span class="unit">円</span>
                    </div>
                    @if ($errors->has('budget'))
                    <div class="invalid-feedback error-msg" role="alert">
                        <strong>{{ $errors->first('budget') }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="btn-container">
            <button class="positive-btn" data-impro-button="once" type="button" onclick="submit();">作成</button>
        </div>
    </form>
</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/company/project/create/index.js') }}"></script>
@endsection
