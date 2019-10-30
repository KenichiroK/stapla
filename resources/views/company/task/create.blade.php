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
    @if(isset($request))
    <form action="{{ route('company.task.store') }}" method='POST' class="main__container__wrapper">
    @else
    <form action="{{ route('company.task.preview') }}" method='POST' class="main__container__wrapper">
    @endif
        @csrf
        @if(count($errors) > 0)
            <div class="error-container">
                <p>入力に問題があります。再入力して下さい。</p>
            </div>
        @endif
       
        <!-- ページタイトル エリア -->
        <div class="page-title-container">
            <div class="page-title-container__page-title">タスク作成</div>
        </div>
        <!-- プロジェクトを選択する エリア -->
        <div class="select-container">
            <div class="select-container__wrapper">
                <!-- プロジェクトを選択する -->
                <div class="select-textarea">
                    <div class="select-text">
                        プロジェクトを選択する
                    </div>
                </div>
                <!-- セレクトエリア -->
                <div class="select-error-wrp">
                    <div class="select-area control">
                        <div class="select-wrp select is-info">
                            @if(isset($request))
                                <p>{{ $project->name }}</p>
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                            @else
                                @if(isset($response))
                                    <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                        <option disabled selected></option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ ($response->project_id === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                        <option disabled selected></option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ (old('project_id') === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @endif
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
                                @if(isset($request))
                                    <p class="preview_p">{{ $request->task_name }}</p>
                                    <input type="hidden" name="task_name" value="{{ $request->task_name }}">
                                @else
                                    <div class="inputarea">
                                        <div class="input-control">
                                            @if(isset($response))
                                                <input class="input form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name='task_name' type="text" value="{{ old('task_name', $response->task_name) }}">
                                            @else
                                                <input class="input form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name='task_name' type="text" value="{{ old('task_name') }}">
                                            @endif
                                            @if ($errors->has('task_name'))
                                                <div class="invalid-feedback error-msg" role="alert">
                                                    <strong>{{ $errors->first('task_name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                        </div>

                        <!-- 項目：タスク内容 -->
                        <div class="item-container">
                            <div class="item-name-wrapper contentsname">
                                <div class="item-name">
                                    タスク内容
                                </div>
                            </div>
                            <div class="textarea-wrp">
                                @if(isset($request))
                                    <p>{!! nl2br(e($request->task_content)) !!}</p>
                                    <input type="hidden" name="task_content" value="{{ $request->task_content }}">
                                @else
                                    @if(isset($response))
                                        <textarea class="textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='task_content'>{{ $response->task_content }}</textarea>
                                    @else
                                        <textarea class="textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='task_content'>{{ old('task_content') }}</textarea>
                                    @endif
                                    @if ($errors->has('task_content'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('task_content') }}</strong>
                                        </div>
                                    @endif
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
                                        <!-- <select v-model="taskInfo.staff"> -->
                                        @if(isset($request))
                                            <p class="">{{ $companyUser->name }}</p>
                                            <input type="hidden" name="company_user_id" value="{{ $companyUser->id }}">
                                        @else
                                            @if(isset($response))
                                                <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                    @foreach($companyUsers as $companyUser)
                                                        <option value="{{ $companyUser->id }}" {{ ($response->company_user_id === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                    <option disabled selected></option>
                                                    @foreach($companyUsers as $companyUser)
                                                        <option value="{{ $companyUser->id }}" {{ (old('company_user_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if ($errors->has('company_user_id'))
                                                <div class="invalid-feedback error-msg" role="alert">
                                                    <strong>{{ $errors->first('company_user_id') }}</strong>
                                                </div>
                                            @endif
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
                                    @if(isset($request))
                                        @if(isset($superiorUser))
                                            <p class="">{{ $superiorUser->name }}</p>
                                            <input type="hidden" name="superior_id" value="{{ $superiorUser->id }}">
                                        @endif
                                    @else
                                        @if(isset($response))
                                            <select name='superior_id'>
                                                <option disabled selected></option>
                                                @foreach($companyUsers as $companyUser)
                                                <option value={{ $companyUser->id }} {{ ($superiorUser->id === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name='superior_id'>
                                                <option disabled selected></option>
                                                @foreach($companyUsers as $companyUser)
                                                <option value={{ $companyUser->id }} {{ (old('superior_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($errors->has('superior_id'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('superior_id') }}</strong>
                                            </div>
                                        @endif
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
                                    @if(isset($request))
                                        @if(isset($accountingUser))
                                            <p class="">{{ $accountingUser->name }}</p>
                                            <input type="hidden" name="accounting_id" value="{{ $accountingUser->id }}">
                                        @endif
                                    @else
                                        @if(isset($response))
                                            <select name='accounting_id'>
                                                <option disabled selected></option>
                                                @foreach($companyUsers as $companyUser)
                                                    <option value={{ $companyUser->id }} {{ ($accountingUser->id === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name='accounting_id'>
                                                <option disabled selected></option>
                                                @foreach($companyUsers as $companyUser)
                                                    <option value={{ $companyUser->id }} {{ (old('accounting_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($errors->has('accounting_id'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('accounting_id') }}</strong>
                                            </div>
                                        @endif
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
                                    @if(isset($request))
                                        <div class="calendar-name start">
                                            開始日
                                        </div>
                                        <p>{{ date("Y年m月d日H時", strtotime($request->started_at)) }}</p>
                                        <input type="hidden" name="started_at" value="{{ $request->started_at }}">
                                    @else
                                        <div class="calendar-name start">
                                            開始日<i class="fas fa-calendar-alt"></i>
                                        </div>
                                        @if(isset($response))
                                            <input
                                                type="datetime-local"
                                                name="started_at"
                                                class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                                value="{{ $response->started_at }}"
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
                                    @endif
                                </div>
                                <!-- 終了日カレンダー -->
                                <div class="calendar-item end">                               
                                    @if(isset($request))
                                        <div class="calendar-name">
                                            終了日
                                        </div>
                                        <p>{{ date("Y年m月d日H時", strtotime($request->ended_at)) }}</p>
                                        <input type="hidden" name="ended_at" value="{{ $request->ended_at }}">
                                    @else
                                        <div class="calendar-name">
                                            終了日<i class="fas fa-calendar-alt"></i>
                                        </div>
                                        @if(isset($response))
                                            <input
                                                type="datetime-local"
                                                class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                                name='ended_at'
                                                value="{{ $response->ended_at }}"
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
                                @if(isset($request))
                                    <p>{{ $request->budget }}円</p>
                                    <input type="hidden" name="budget" value="{{ $request->budget }}">
                                @else
                                    @if(isset($response))
                                        <input id="inputPrice" class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ $response->budget }}">
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
                                @endif
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
                                @if(isset($request))
                                    <p class="">{{ $partner->name }}</p>
                                    <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                                @else
                                    @if(isset($response))
                                        <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                            @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}" {{ (old('partner_id') === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
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
                                    @if(isset($request))
                                        <p>{{ $request->price }}円</p>
                                        <input type="hidden" name="price" value="{{ $request->price }}">
                                    @else
                                        @if(isset($response))
                                            <input id="inputPrice" class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text" value="{{ $response->price }}">    
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
                                    @endif
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($request))
                <input type="hidden" name="">
                <div class="actionButton">
                        <button class="undone" type="submit" name="action" value="toEdit" onclick="submit();" style="width:auto">修正</button>
                        <button class="done" type="submit" name="action" value="toStore" onclick="submit();" style="width:auto">作成/上長に提出</button>
                    </div>
                @else
                    <div class="btn01-container">
                        <button type="button" onclick="submit();" style="width:auto">プレビュー</button>
                    </div>
                @endif

                
                
            </div>
        </div>

    </form>
</div>
@endsection