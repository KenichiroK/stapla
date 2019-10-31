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
    <form action="{{ route('company.task.store') }}" method='POST' class="main__container__wrapper">
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
                            <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                <option disabled selected></option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ (old('project_id') === $project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
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
                                    <input class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name='name' type="text" value="{{ old('name')}}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- 項目：タスク作成日 -->
                        <!-- <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    タスク作成日
                                </div>
                            </div>
                            <div class="cre-datewrapper">
                                <div class="cre-date">
                                       本日 {{ date('Y') }}年{{ date('m') }}月{{ date('d') }}日<i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div> -->
                        <!-- 項目：タスク内容 -->
                        <div class="item-container">
                            <div class="item-name-wrapper contentsname">
                                <div class="item-name">
                                    タスク内容
                                </div>
                            </div>
                            <div class="textarea-wrp">
                                <textarea class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name='content'>{{ old('content') }}</textarea>
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
                                            <!-- <select v-model="taskInfo.staff"> -->
                                            <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                <option disabled selected></option>
                                                @foreach($companyUsers as $companyUser)
                                                    <option value="{{ $companyUser->id }}" {{ (old('company_user_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                    @if ($errors->has('company_user_id'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('company_user_id') }}</strong>
                                        </div>
                                    @endif
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
                                        <select name='superior_id'>
                                            <option disabled selected></option>
                                            @foreach($companyUsers as $companyUser)
                                                <option value={{ $companyUser->id }} {{ (old('superior_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                @if ($errors->has('superior_id'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('superior_id') }}</strong>
                                    </div>
                                @endif
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
                                        <select name='accounting_id'>
                                            <option disabled selected></option>
                                            @foreach($companyUsers as $companyUser)
                                                <option value={{ $companyUser->id }} {{ (old('accounting_id') === $companyUser->id) ? 'selected' : '' }}>{{ $companyUser->name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                @if ($errors->has('accounting_id'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('accounting_id') }}</strong>
                                    </div>
                                @endif
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
                                    <input
                                        type="datetime-local"
                                        name="started_at"
                                        class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                        value="{{ old('started_at') ? str_replace(" ", "T", old('started_at')) : date('Y-m-d\T00:00') }}"
                                    >

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
                                    <input
                                        type="datetime-local"
                                        class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                        name='ended_at'
                                        value="{{ old('ended_at') ? str_replace(" ", "T", old('ended_at')) : date('Y-m-d\T23:59') }}"
                                    >

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
                                    <input id="inputPrice" class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget')}}">
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
                                    <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                        <option disabled selected></option>
                                        @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}" {{ (old('partner_id') === $partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
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
                        <!-- 報酬形式 -->
                        <!-- <div class="item-container fee">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    報酬形式
                                </div>
                            </div>
                            
                            <div class="fee-container__control">
                                <label>
                                    <span class="title">固定</span>
                                    <input class="radio01-input" value="固定" name="fee_format" type="radio" checked>
                                    <span class="radio01-parts"></span>
                                </label>
                                <label>
                                    <span class="title">時間</span>
                                    <input class="radio01-input" value="時間" name="fee_format" type="radio">
                                    <span class="radio01-parts"></span>
                                </label>
                                <label>
                                    <span class="title">日</span>
                                    <input class="radio01-input" value="日" name="fee_format" type="radio">
                                    <span class="radio01-parts date"></span>
                                </label>
                            </div>
                        </div> -->
                        
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
                                        <input id="inputPrice" class="input form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name='price' type="text" value="{{ old('price')}}">
                                        @if ($errors->has('price'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                        <div class="aux-text">
                                            円
                                        </div>
                                    </div>  
                                    <!-- 件数 -->
                                    <!-- <div class="item-name-wrapper numbername">
                                        <div class="item-name">
                                            件数
                                        </div>
                                    </div>
                                    <div class="unit-num_contents">
                                        <input id="inputPrice" class="input form-control{{ $errors->has('cases') ? ' is-invalid' : '' }}" name='cases' type="text" value="{{ old('cases')}}">
                                        @if ($errors->has('cases'))
                                            <div class="invalid-feedback error-msg" role="alert">
                                                <strong>{{ $errors->first('cases') }}</strong>
                                            </div>
                                        @endif
                                        <div class="aux-text">
                                            件
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- 発注額 -->
                        <!-- <div class="item-container price">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    発注額
                                </div>
                            </div>
                            <div class="price-item">
                                <p><span class="tax">税抜</span>¥<span id='outputPrice' class="yen outputPrice"></span></p>
                                <p><span class="tax">税込</span>¥<span id='outputPriceWithTax' class="yen outputPriceWithTax"></span></p>
                                <p><span class="tax">税抜</span>¥<span id='outputPrice' class="yen"></span></p>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="btn01-container">
                    <button type="button" onclick="submit();" style="width:auto">作成/上長に提出</button>
                </div>
                
            </div>
        </div>
    </form>
</div>
@endsection
