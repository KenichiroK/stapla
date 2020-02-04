@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/task/edit/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <form action="{{ route('company.task.update', ['task_id' => $task->id]) }}" method='POST'>
        @csrf
        @if(count($errors) > 0)
            <div class="error-container">
                <p>入力に問題があります。再入力して下さい。</p>
            </div>
        @endif

        <div class="page-title-container">
            <h3  class="page-title-container__text">「{{ $task->name }}」の編集</h3>
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
                                <option value="{{ $project->id }}" {{ ($task->project_id === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('project_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('project_id') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="block-container">
            @if($task->status <= config('const.TASK_SUBMIT_SUPERIOR'))
                <div class="form-container mb-5">
                    <div class="form-container__text">
                        <p class="form-container__text--title">タスク名</p>
                        <p class="form-container__text--required"> ( 必須 ) </p>
                    </div>

                    <div class="form-container__body">
                        <input class="input" type="text" name="task_name" value="{{ old('task_name',$task->name) }}">
                        @if($errors->has('task_name'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('task_name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-container mb-5">
                    <div class="form-container__text">
                        <p class="form-container__text--title">タスク内容</p>
                        <p class="form-container__text--required"> ( 必須 ) </p>
                    </div>

                    <div class="form-container__body">
                        <textarea class="textarea" name="content" cols="30" rows="5">{{ old('content', $task->content) }}</textarea>
                        @if($errors->has('content'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

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
                                <option value={{ $company_user->id }} {{ ($task->company_user_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('task_company_user_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('task_company_user_id') }}</strong>
                        </div>
                    @endif
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
                            <option disabled selected></option>
                                @foreach($company_users as $company_user)
                                    <option value={{ $company_user->id }} {{ ($task->superior_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    @if ($errors->has('superior_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('superior_id') }}</strong>
                        </div>
                    @endif
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
                            <option disabled selected></option>
                                @foreach($company_users as $company_user)
                                    <option value={{ $company_user->id }} {{ ($task->accounting_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    @if ($errors->has('accounting_id'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('accounting_id') }}</strong>
                        </div>
                    @endif

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
                                value="{{ old('started_at') ? old('started_at') : date('Y/m/d H:i', strtotime($task->started_at)) }}"
                            >
                        </div>

                        <div class="date-container__hyphen">〜</div>

                        <div class="date-container__input">
                            <input
                                id="end_calendar"
                                class="date"
                                type="text"
                                name="ended_at"
                                value="{{ old('ended_at') ?  old('ended_at') : date('Y/m/d H:i', strtotime($task->ended_at)) }}"
                            >
                        </div>  
                    </div>
                    @if($errors->has('started_at'))
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
        </div>

        @if($task->status <= config('const.TASK_SUBMIT_SUPERIOR'))
            <div class="block-container">
                <div class="form-container mb-5">
                    <div class="form-container__text">
                        <p class="form-container__text--title">発注書件名</p>
                        <p class="form-container__text--optional"> ( 任意 ) </p>
                    </div>

                    <div class="form-container__body">
                            <input 
                                class="input"
                                type="text"
                                name="order_name"
                                placeholder="未入力の場合、タスク名を表示します。"
                                value="{{ old('order_name', $purchase_order->task_name) }}"
                            >
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
                            name="order_company_user"
                            placeholder="発注書に記載する担当者名を変更したい場合には、こちらに記入してください。"
                            value="{{ old('order_company_user', $task->companyUser->name) }}"
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
                                        <option value="{{ $partner->id }}" {{ ($task->partner_id === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        @if ($errors->has('partner_id'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('partner_id') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-container mb-5">
                    <div class="form-container__text">
                        <p class="form-container__text--title">発注金額 ( 税抜 ) </p>
                        <p class="form-container__text--required"> ( 必須 ) </p>
                    </div>

                    <div class="form-container__body">
                        <div class="price-container">
                            <div class="price-input">
                                <input class="price-input__input" type="text" name="order_price" value="{{ old('order_price', $task->price) }}">
                            </div>
                        </div>
                        @if ($errors->has('order_price'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('order_price') }}</strong>
                            </div>
                        @endif
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
                                    value="{{ old('delivery_date') ?  old('delivery_date') : date('Y/m/d H:i', strtotime($task->delivery_date)) }}"
                                >
                            </div>
                        </div>
                        @if($errors->has('delivery_date'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('delivery_date') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <input type="hidden" name="task_status" value="{{ $task->status }}">
        <div class="btn-container">
            <button type="submit" class="positive-btn">保存</button>
        </div>
    </form>
</div>
@endsection

@section('asset-js')
<script src="{{ mix('js/pages/company/task/edit/index.js') }}"></script>
@endsection
