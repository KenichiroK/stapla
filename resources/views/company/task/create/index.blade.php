@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/task/create/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <form action="{{ route('company.task.taskPreview') }}" method='POST'>
        @csrf
        @if(count($errors) > 0)
        <div class="error-container">
            <p>入力に問題があります。再入力して下さい。</p>
        </div>
        @endif
        @if (session('completed'))
        <div class="complete-container">
            <p>{{ session('completed') }}</p>
        </div>
        @endif

        <div class="title-container">
            <h3>タスク・発注書作成</h3>
        </div>

        <div class="block-container">
            <div class="form-container">
                <div class="form-container__text">
                    <p class="form-container__text--title">プロジェクトを選択する</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="project_id">
                            <option disabled selected></option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ (old('project_id') === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="block-container">
            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">タスク名</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <input class="input" type="text" name="task_name" value="{{ old('task_name') }}">
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">タスク内容</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <textarea class="textarea" name="content" cols="30" rows="5">{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">担当者</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="task_company_user_id">
                            <option disabled selected></option>
                            @foreach($company_users as $company_user)
                                <option value={{ $company_user->id }} {{ (old('task_company_user_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">上長</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="superior_id">
                            <option selected></option>
                                @foreach($company_users as $company_user)
                                <option value={{ $company_user->id }} {{ (old('superior_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">経理</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="accounting_id">
                            <option selected></option>
                                @foreach($company_users as $company_user)
                                    <option value={{ $company_user->id }} {{ (old('accounting_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-container">
                <div class="form-container__text">
                    <p class="form-container__text--title">タスク期間</p>
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
                </div>
            </div>
        </div>

        <div class="block-container">
            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">発注書件名</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <input class="input" type="text" name="order_name" value="{{ old('order_name') }}">
                </div>
            </div>

            <div class="form-container">
                <div class="form-container__text">
                    <p class="form-container__text--title">担当者名 ( 発注書記載 ) </p>
                    <p class="form-container__text--optional"> ( 任意 ) </p>
                </div>

                <div class="form-container__body">
                    <input
                        class="input"
                        type="text"
                        name="order_company_user_id"
                        placeholder="発注書に記載する担当者名を変更したい場合"
                        value="{{ old('order_company_user_id') }}"
                    >
                </div>
            </div>
        </div>

        <div class="block-container">
            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">パートナー</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="select-arrow">
                        <select name="partner_id">
                            <option disabled selected></option>
                                @foreach($partners as $partner)
                                <option value="{{ $partner->id }}" {{ (old('partner_id') === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">発注金額 ( 税抜 ) </p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="price-container">
                        <div class="price-container__input">
                            <input class="input" type="text" name="order_price" value="{{ old('order_price') }}">
                        </div>
                        <span class="unit">円</span>
                    </div>
                </div>
            </div>

            <div class="form-container">
                <div class="form-container__text">
                    <p class="form-container__text--title">納期</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    <div class="date-container">
                        <div class="date-container__input">
                            <input
                                id="deliver_calendar"
                                class="date"
                                type="text"
                                name="delivery_date"
                                value="{{ old('delivery_date') ? old('delivery_date') : date('Y/m/d 23:00') }}"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-container">
            <button class="negative-btn">一時保存</button>
            <button class="positive-btn">プレビュー</button>
        </div>
    </form>
</div>
@endsection

@section('asset-js')
<script src="{{ mix('js/company/task/toggle-calendar.js') }}"></script>
@endsection
