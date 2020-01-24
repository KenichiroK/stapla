@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
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
                                @if(isset($task->project_id))
                                    <option value="{{ $project->id }}" {{ ($task->project_id === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                @else
                                    @if(isset($quoted_project))
                                        <option value="{{ $quoted_project->id }}" selected>{{ $quoted_project->name }}</option>
                                    @else
                                        <option value="{{ $project->id }}" {{ (old('project_id') === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endif
                                @endif
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
            <div class="form-container mb-5">
                <div class="form-container__text">
                    <p class="form-container__text--title">タスク名</p>
                    <p class="form-container__text--required"> ( 必須 ) </p>
                </div>

                <div class="form-container__body">
                    @if(isset($task->name))
                        <input class="input" type="text" name="task_name" value="{{ old('task_name',$task->name) }}">
                    @else
                        <input class="input" type="text" name="task_name" value="{{ old('task_name') }}">
                    @endif
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
                    @if(isset($task->content))
                        <textarea class="textarea" name="content" cols="30" rows="5">{{ old('content', $task->content) }}</textarea>
                    @else
                        <textarea class="textarea" name="content" cols="30" rows="5">{{ old('content') }}</textarea>
                    @endif
                    @if($errors->has('content'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
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
                        <select name="task_company_user_id">
                            <option disabled selected></option>
                            @foreach($company_users as $company_user)
                                @if(isset($task->company_user_id))
                                    <option value={{ $company_user->id }} {{ ($task->company_user_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @else
                                    <option value={{ $company_user->id }} {{ (old('task_company_user_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                @endif
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
                            <option selected></option>
                                @foreach($company_users as $company_user)
                                    @if(isset($task->superior_id))
                                        <option value={{ $company_user->id }} {{ ($task->superior_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @else
                                        <option value={{ $company_user->id }} {{ (old('superior_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @endif
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
                            <option selected></option>
                                @foreach($company_users as $company_user)
                                    @if(isset($task->accounting_id))
                                        <option value={{ $company_user->id }} {{ ($task->accounting_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @else
                                        <option value={{ $company_user->id }} {{ (old('accounting_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @endif
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
                                @if(isset($task->started_at))
                                    value="{{ old('started_at') ? old('started_at') : date('Y/m/d H:i', strtotime($task->started_at)) }}"
                                @else
                                    value="{{ old('started_at') ? old('started_at') : date('Y/m/d 00:00') }}"
                                @endif
                            >
                        </div>

                        <div class="date-container__hyphen">〜</div>

                        <div class="date-container__input">
                            <input
                                id="end_calendar"
                                class="date"
                                type="text"
                                name="ended_at"
                                @if(isset($task->ended_at))
                                    value="{{ old('ended_at') ?  old('ended_at') : date('Y/m/d H:i', strtotime($task->ended_at)) }}"
                                @else
                                    value="{{ old('ended_at') ? old('ended_at') : date('Y/m/d 23:00') }}"
                                @endif
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
                            @if(isset($purchaseOrder->task_name))
                                value="{{ old('order_name', $purchaseOrder->task_name) }}"
                            @else
                                value="{{ old('order_name') }}"
                            @endif
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
                        @if(isset($purchaseOrder->companyUser_id))
                            value="{{ old('order_company_user', $task->companyUser->name) }}"
                        @else
                            value="{{ old('order_company_user') }}"
                        @endif
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
                                    @if(isset($task->partner_id))
                                        <option value="{{ $partner->id }}" {{ ($task->partner_id === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                    @else
                                        <option value="{{ $partner->id }}" {{ (old('partner_id') === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                    @endif
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
                        <div class="price-container__input">
                            @if(isset($task->price))
                                <input class="input" type="text" name="order_price" value="{{ old('order_price', $task->price) }}">
                            @else
                                <input class="input" type="text" name="order_price" value="{{ old('order_price') }}">
                            @endif
                        </div>
                        <span class="unit">円</span>
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
                                @if(isset($task->delivery_date))
                                    value="{{ old('delivery_date') ?  old('delivery_date') : date('Y/m/d H:i', strtotime($task->delivery_date)) }}"
                                @else
                                    value="{{ old('delivery_date') ? old('delivery_date') : date('Y/m/d 23:00') }}"
                                @endif
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

        <div class="btn-container">
            @if(isset($task->id))
                <input type="hidden" name='task_id' value="{{ $task->id }}">
            @endif
            <button class="negative-btn" formaction="{{ route('company.task.draft') }}">一時保存</button>
            <button class="positive-btn">プレビュー</button>
        </div>
    </form>
</div>
@endsection

@section('asset-js')
<script src="{{ mix('js/pages/company/task/create/index.js') }}"></script>
@endsection
