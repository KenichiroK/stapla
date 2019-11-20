@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/create.css') }}">
<script
  src="https://code.jquery.com/jquery-3.4.1.slim.js"
  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous">
</script>

<script>
$(function(){
    let $inputPrice = $('#inputPrice');
    let $outputPrice = $('.outputPrice');
    let $outputPriceWithTax = $('.outputPriceWithTax');
    $inputPrice.on('input', function(event){
        let $value = $inputPrice.val();
        $outputPrice.text($value);
        $outputPriceWithTax($value);
    });
})
</script>
@endsection

@section('content')
<div class="main__container">
    <form action="{{ route('company.task.preview') }}" method='POST' class="main__container__wrapper">
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

        
        <!-- ページタイトル エリア -->
        <div class="page-title-container">
            <div class="page-title-container__page-title">タスク作成</div>
        </div>

        <!-- プロジェクトを選択する エリア -->
        <div class="select-container">
            <div class="select-container__wrapper">
                <div class="select-textarea">
                    <div class="select-text">
                        プロジェクトを選択する
                    </div>
                </div>
                <div class="select-error-wrp">
                    <div class="select-area control">
                        <div class="select-wrp select is-info">

                            @if(isset($task->project_id))
                                <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                    <option disabled selected></option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ ($task->project_id === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                    <option disabled selected></option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ (old('project_id') === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('project_id'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('project_id') }}</strong>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-container">
            <div class="content-container__wrapper">

                <!-- main -->
                <div class="main-container">
                    <div class="main-container__wrapper">
                        <!-- 項目：タスク名 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    タスク名
                                </div>
                            </div>
                            <div class="inputarea">
                                <div class="input-control">

                                    @if(isset($task->name))
                                        <input class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name='name' type="text" value="{{ old('name', $task->name) }}">
                                    @else
                                        <input class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name='name' type="text" value="{{ old('name') }}">
                                    @endif
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- 項目：タスク内容 -->
                        <div class="item-container">
                            <div class="item-name-wrapper contentsname">
                                <div class="item-name">
                                    タスク内容
                                </div>
                            </div>
                            <div class="textarea-wrp">

                                @if(isset($task->content))
                                    <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name='content'>{{ old('content', $task->content) }}</textarea>
                                @else
                                    <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name='content'>{{ old('content') }}</textarea>
                                @endif
                                @if ($errors->has('content'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- 担当者 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    担当者
                                </div>
                            </div>
                            <div class="select-error-wrp">
                                <div class="select-area control staff">
                                    <div class="select-wrp select is-info">

                                        @if(isset($task->company_user_id))
                                            <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                @foreach($company_users as $company_user)
                                                    <option value="{{ $company_user->id }}" {{ ($task->company_user_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                <option disabled selected></option>
                                                @foreach($company_users as $company_user)
                                                    <option value="{{ $company_user->id }}" {{ (old('company_user_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($errors->has('company_user_id'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('company_user_id') }}</strong>
                                            </div>
                                        @endif

                                    </div>
                                </div> 
                            </div>
                        </div>                        

                        <!-- 上長 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    上長
                                </div>
                            </div>
                            <div class="select-error-wrp">
                                <div class="select-area control staff">
                                    <div class="select-wrp select is-info">

                                        @if(isset($task->superior_id))
                                            <select name='superior_id'>
                                                <option selected></option>
                                                @foreach($company_users as $company_user)
                                                <option value={{ $company_user->id }} {{ ($task->superior_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name='superior_id'>
                                                <option selected></option>
                                                @foreach($company_users as $company_user)
                                                <option value={{ $company_user->id }} {{ (old('superior_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($errors->has('superior_id'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('superior_id') }}</strong>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 経理 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    経理
                                </div>
                            </div>
                            <div class="select-error-wrp">
                                <div class="select-area control staff">
                                    <div class="select-wrp select is-info">
                                    
                                        @if(isset($task->accounting_id))
                                            <select name='accounting_id'>
                                                <option selected></option>
                                                @foreach($company_users as $company_user)
                                                    <option value={{ $company_user->id }} {{ ($task->accounting_id === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name='accounting_id'>
                                                <option selected></option>
                                                @foreach($company_users as $company_user)
                                                    <option value={{ $company_user->id }} {{ (old('accounting_id') === $company_user->id) ? 'selected' : '' }}>{{ $company_user->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($errors->has('accounting_id'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('accounting_id') }}</strong>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 項目：締め切り -->
                        <div class="item-container">
                            <div class="item-name-wrapper period">
                                <div class="item-name">
                                    タスク期間
                                </div>
                            </div>
                            <div class="calendar-wrp">
                                <!-- 開始日カレンダー -->
                                <div class="calendar-item">                               
                                    <div class="calendar-name start">
                                        開始日<i class="fas fa-calendar-alt"></i>
                                    </div>

                                    @if(isset($task->started_at))
                                        <input
                                            type="datetime-local"
                                            name="started_at"
                                            class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                            value="{{ old('started_at') ? str_replace(" ", "T", old('started_at')) : str_replace(" ", "T", ($task->started_at)) }}"
                                        >
                                    @else
                                        <input
                                            type="datetime-local"
                                            name="started_at"
                                            class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                            value="{{ old('started_at') ? str_replace(" ", "T", old('started_at')) : date('Y-m-d\T00:00') }}"
                                        >
                                    @endif
                                    @if($errors->has('started_at'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('started_at') }}</strong>
                                        </div>
                                    @endif

                                </div>
                                <!-- 終了日カレンダー -->
                                <div class="calendar-item end">
                                    <div class="calendar-name">
                                        終了日<i class="fas fa-calendar-alt"></i>
                                    </div>

                                    @if(isset($task->ended_at))
                                        <input
                                            type="datetime-local"
                                            class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                            name='ended_at'
                                            value="{{ old('ended_at') ? str_replace(" ", "T", old('ended_at')) : str_replace(" ", "T", ($task->ended_at)) }}"
                                        >
                                    @else
                                        <input
                                            type="datetime-local"
                                            class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                            name='ended_at'
                                            value="{{ old('ended_at') ? str_replace(" ", "T", old('ended_at')) : date('Y-m-d\T23:59') }}"
                                        >
                                    @endif
                                    @if ($errors->has('ended_at'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('ended_at') }}</strong>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- 予算 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    予算
                                </div>
                            </div>
                            <div class="inputarea">
                                <div class="input-control budget">

                                    @if(isset($task->budget))
                                        <input id="inputPrice" class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget', $task->budget) }}">
                                    @else
                                        <input id="inputPrice" class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget') }}">
                                    @endif
                                    @if ($errors->has('budget'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('budget') }}</strong>
                                        </div>
                                    @endif
                                    <div class="input-yen">
                                        円
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>      
                </div>

                <!-- パートナー契約内容 -->
                <div class="partner-container">
                    <p class="partner-container__title">パートナー契約内容</p>
                    <div class="partner-container__wrpper">
                        <!-- パートナー -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    パートナー
                                </div>
                            </div>
                            <div class="select-area control">
                                <div class="select-wrp select is-info">

                                    @if(isset($task->partner_id))
                                        <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                            @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}" {{ ($task->partner_id === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                            <option disabled selected></option>
                                            @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}" {{ (old('partner_id') === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    @if ($errors->has('partner_id'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('partner_id') }}</strong>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- 発注単価・件数 -->
                        <div class="item-container order__unit-number">
                            <div class="order-wrp">
                                
                                <!-- 発注単価 タイトル -->
                                <div class="item-name-wrapper unitname">
                                    <div class="item-name">
                                        発注単価<span class="tax">（税抜）</span>
                                    </div>
                                </div>

                                <div class="unit-num">
                                    <!-- 発注単位 input -->
                                    <div class="unit-num_contents">

                                        @if(isset($task->price))
                                            <input id="inputPrice" class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text" value="{{ old('price', $task->price) }}">
                                        @else
                                            <input id="inputPrice" class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text" value="{{ old('price') }}">
                                        @endif
                                        @if ($errors->has('price'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                        <div class="aux-text">
                                            円
                                        </div>

                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="actionButton">
                    @if(isset($task->status))
                        <input type="hidden" name='task_id' value="{{ $task->id }}">
                        <button class="undone" type="submit" onclick="submit();" name="temporarySaveOrPreview" value="toTemporaryUpdate">下書更新</button>
                        <button class="done" type="submit" onclick="submit();" name="temporarySaveOrPreview" value="toPreviewUpdate" style="width:auto">updateプレビュー</button>
                    @else
                        <button class="undone" type="submit" onclick="submit();" name="temporarySaveOrPreview" value="toTemporarySave">下書保存</button>
                        <button class="done" type="submit" onclick="submit();" name="temporarySaveOrPreview" value="toPreview" style="width:auto">プレビュー</button>
                    @endif
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
