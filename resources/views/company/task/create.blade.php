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
// started_at
function set_started_at(){
    const started_at_year = document.getElementById('started_at_year').value;
    const started_at_month = document.getElementById('started_at_month').value;
    let startedDayOption;
    let startedToday =new Date();
    let lastStartedDay = (new Date(started_at_year, started_at_month, 0)).getDate();
    for(let d=1; d<=lastStartedDay; d++){
        if(d < 10){
            if(d == startedToday.getDate()){
                startedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            } else{
                startedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            }
        } else{
            if(d == startedToday.getDate()){
                startedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            } else{
                startedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            }
        }
    }
    document.getElementById('started_at_day').innerHTML = startedDayOption;
    
    const started_at_day = document.getElementById('started_at_day').value;
    const started_at_time = document.getElementById('started_at_time').value;
    const started_at = document.getElementById('started_at');
    started_at.value = started_at_year + started_at_month + started_at_day + started_at_time;
    console.log(started_at.value);
}
function setStartedDay(){
    const started_at_year = document.getElementById('started_at_year').value;
    const started_at_month = document.getElementById('started_at_month').value;
    const started_at_day = document.getElementById('started_at_day').value;
    const started_at_time = document.getElementById('started_at_time').value;
    const started_at = document.getElementById('started_at');
    started_at.value = started_at_year + started_at_month + started_at_day + started_at_time;
    console.log(started_at.value);
}
// ended_at
function set_ended_at(){
    const ended_at_year = document.getElementById('ended_at_year').value;
    const ended_at_month = document.getElementById('ended_at_month').value;
    let endedDayOption;
    let endedToday =new Date();
    let lastEndedDay = (new Date(ended_at_year, ended_at_month, 0)).getDate();
    for(let d=1; d<=lastEndedDay; d++){
        if(d < 10){
            if(d == endedToday.getDate()){
                endedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            } else{
                endedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            }
        } else{
            if(d == endedToday.getDate()){
                endedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            } else{
                endedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            }
        }
    }
    document.getElementById('ended_at_day').innerHTML = endedDayOption;
    
    const ended_at_day = document.getElementById('ended_at_day').value;
    const ended_at_time = document.getElementById('ended_at_time').value;
    const ended_at = document.getElementById('ended_at');
    ended_at.value = ended_at_year + ended_at_month + ended_at_day + ended_at_time;
    console.log(ended_at.value);
}
const setEndedDay = () => {
    const ended_at_year = document.getElementById('ended_at_year').value;
    const ended_at_month = document.getElementById('ended_at_month').value;
    const ended_at_day = document.getElementById('ended_at_day').value;
    const ended_at_time = document.getElementById('ended_at_time').value;
    const ended_at = document.getElementById('ended_at');
    ended_at.value = ended_at_year + ended_at_month + ended_at_day + ended_at_time;
    console.log(ended_at.value);
}
window.onload = function(){
    // started_at
    const started_at_year = document.getElementById('started_at_year').value;
    const started_at_month = document.getElementById('started_at_month').value;
    let startedDayOption;
    let startedToday =new Date();
    let lastStartedDay = (new Date(started_at_year, started_at_month, 0)).getDate();
    for(let d=1; d<=lastStartedDay; d++){
        if(d < 10){
            if(d == startedToday.getDate()){
                startedDayOption += '<option value="' +0+d+ '" selected>' +0+d+ '</option>';
            } else{
                startedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            }
        } else{
            if(d == startedToday.getDate()){
                startedDayOption += '<option value="' +d+ '" selected>' +d+ '</option>';
            } else{
                startedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            }
        }
    }
    document.getElementById('started_at_day').innerHTML = startedDayOption;
    const started_at_day = document.getElementById('started_at_day').value;
    const started_at_time = document.getElementById('started_at_time').value;
    const started_at = document.getElementById('started_at');
    started_at.value = started_at_year + started_at_month + started_at_day + started_at_time; 
    console.log(started_at.value);
     // ended_at
    const ended_at_year = document.getElementById('ended_at_year').value;
    const ended_at_month = document.getElementById('ended_at_month').value;
    let endedDayOption;
    let endedToday =new Date();
    let lastEndedDay = (new Date(ended_at_year, ended_at_month, 0)).getDate();
    for(let d=1; d<=lastEndedDay; d++){
        if(d < 10){
            if(d == endedToday.getDate()){
                endedDayOption += '<option value="' +0+d+ '" selected>' +0+d+ '</option>';
            } else{
                endedDayOption += '<option value="' +0+d+ '">' +0+d+ '</option>';
            }
        } else{
            if(d == endedToday.getDate()){
                endedDayOption += '<option value="' +d+ '" selected>' +d+ '</option>';
            } else{
                endedDayOption += '<option value="' +d+ '">' +d+ '</option>';
            }
        }
    }
    document.getElementById('ended_at_day').innerHTML = endedDayOption;
    const ended_at_day = document.getElementById('ended_at_day').value;
    const ended_at_time = document.getElementById('ended_at_time').value;
    const ended_at = document.getElementById('ended_at');
    ended_at.value = ended_at_year + ended_at_month + ended_at_day + ended_at_time;
    console.log(ended_at.value);
}
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
    <form aciton="{{ url('/company/task/create') }}" method='POST'  class="main__container__wrapper">
    {{ csrf_field() }}
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
                                    <input class="input form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name='task_name' type="text" value="{{ old('task_name')}}">
                                    @if ($errors->has('task_name'))
                                        <div class="invalid-feedback error-msg" role="alert">
                                            <strong>{{ $errors->first('task_name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- 項目：タスク作成日 -->
                        <div class="item-container">
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
                        </div>
                        <!-- 項目：タスク内容 -->
                        <div class="item-container">
                            <div class="item-name-wrapper contentsname">
                                <div class="item-name">
                                    タスク内容
                                </div>
                            </div>
                            <div class="textarea-wrp">
                                <textarea class="textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='task_content'>{{ old('task_content') }}</textarea>
                                @if ($errors->has('task_content'))
                                    <div class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $errors->first('task_content') }}</strong>
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
                                        <div class="select-wrp select-plusicon is-info">
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
                                    <div class="select-wrp select-plusicon is-info">
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
                                    <div class="select-wrp select-plusicon is-info">
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
                                    <div class="select-date-wrp">
                                        <div class="select-arrow year">
                                            <select class="select-box" id="started_at_year" name="started_at_year" onChange="set_started_at()">
                                            @for($y=date('Y')-5; $y<=date('Y')+20; $y++)
                                                @if(!empty(old('started_at_year')) === true )
                                                    <option value="{{ $y }}" {{ (old('started_at_year') == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                                @else
                                                    @if($y == date('Y'))
                                                        <option value="{{ $y }}" selected>{{ $y }}</option> 
                                                    @else
                                                        <option value="{{ $y }}">{{ $y }}</option> 
                                                    @endif
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                        年

                                        <div class="select-arrow">
                                            <select class="select-box" id="started_at_month" name="started_at_month" onChange="set_started_at()">
                                            @for($m=1; $m<=12; $m++)
                                                @if(!empty(old('started_at_month')) === true)
                                                    @if($m < 10)
                                                        <option value='0{{ $m }}' {{ (substr(old('started_at_month'), 1, 1) == $m) ? 'selected' : '' }}>{{ $m }}</option>
                                                    @else
                                                        <option value='{{ $m }}' {{ (substr(old('started_at_month'), 1, 2) == $m) ? 'selected' : '' }}>{{ $m }}</option>
                                                    @endif
                                                @else
                                                    @if($m < 10)
                                                        @if($m == date('m'))
                                                            <option value='0{{ $m }}' selected>{{ $m }}</option>
                                                        @else
                                                            <option value='0{{ $m }}'>{{ $m }}</option>
                                                        @endif
                                                    @else
                                                        @if($m == date('m'))
                                                            <option value='{{ $m }}' selected>{{ $m }}</option>
                                                        @else
                                                            <option value='{{ $m }}'>{{ $m }}</option>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                        月
                                        <div class="select-arrow">
                                            <select class="select-box" id="started_at_day" name="started_at_day" onChange="setStartedDay();"></select>
                                        </div>
                                        日
                                        <div class="select-arrow">
                                            <select class="select-box" id="started_at_time" name="started_at_time" onChange="setStartedDay()">
                                            @for($h=0; $h<=24; $h++)
                                                @if(!empty(old('started_at_time')) === true)
                                                    @if($h < 10)
                                                        <option value='0{{ $h }}0000' {{ (substr(old('started_at_time'), 1, 1) == $h) ? 'selected' : '' }}>{{ $h }}</option>
                                                    @else
                                                        <option value='{{ $h }}0000' {{ (substr(old('started_at_time'), 0, 2) == $h) ? 'selected' : '' }}>{{ $h }}</option>
                                                    @endif
                                                @else
                                                    @if($h < 10)
                                                        @if($h == date('H'))
                                                            <option value='0{{ $h }}0000' selected>{{ $h }}</option>
                                                        @else
                                                            <option value='0{{ $h }}0000'>{{ $h }}</option>
                                                        @endif
                                                    @else
                                                        @if($h == date('H'))
                                                            <option value='{{ $h }}0000' selected>{{ $h }}</option>
                                                        @else
                                                            <option value='{{ $h }}0000'>{{ $h }}</option>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                        @if($errors->has('started_at_time'))
                                            <div>
                                                <strong style='color: #e3342f;'>{{ $errors->first('started_at_time') }}</strong>
                                            </div>
                                        @endif
                                        時
                                    </div>

                                    <input name="started_at" id="started_at" type="hidden" value="{{ old('started_at')}}">
                                    @if($errors->has('started_at'))
                                        <div>
                                            <strong style='color: #e3342f;'>{{ $errors->first('started_at') }}</strong>
                                        </div>
                                    @endif
                                  
                                </div>
                                <!-- 終了日カレンダー -->
                                <div class="calendar-item end">                               
                                    
                                    <div class="calendar-name">
                                        終了日<i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="select-date-wrp">
                                        <div class="select-arrow year">
                                            <select class="select-box" id="ended_at_year" name="ended_at_year" onChange="set_ended_at()">
                                            @for($y=date('Y')-5; $y<=date('Y')+20; $y++)
                                                @if(!empty(old('ended_at_year')) === true )
                                                <option value="{{ $y }}" {{ (old('ended_at_year') == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                                @else
                                                    @if($y == date('Y'))
                                                        <option value="{{ $y }}" selected>{{ $y }}</option> 
                                                    @else
                                                        <option value="{{ $y }}">{{ $y }}</option> 
                                                    @endif
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                        年
                                        <div class="select-arrow">
                                            <select class="select-box" id="ended_at_month" name="ended_at_month" onChange="set_ended_at()">
                                                @for($m=1; $m<=12; $m++)
                                                    @if(!empty(old('ended_at_month')) === true)
                                                        @if($m < 10)
                                                        <option value='0{{ $m }}' {{ (substr(old('ended_at_month'), 1, 1) == $m) ? 'selected' : '' }}>{{ $m }}</option>
                                                    @else
                                                        <option value='{{ $m }}' {{ (substr(old('ended_at_month'), 1, 2) == $m) ? 'selected' : '' }}>{{ $m }}</option>
                                                        @endif
                                                    @else
                                                        @if($m < 10)
                                                            @if($m == date('m'))
                                                                <option value='0{{ $m }}' selected>{{ $m }}</option>
                                                            @else
                                                                <option value='0{{ $m }}'>{{ $m }}</option>
                                                            @endif
                                                        @else
                                                            @if($m == date('m'))
                                                                <option value='{{ $m }}' selected>{{ $m }}</option>
                                                            @else
                                                                <option value='{{ $m }}'>{{ $m }}</option>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                        月
                                        <div class="select-arrow">
                                            <select class="select-box" id="ended_at_day" name="ended_at_day" onChange="setEndedDay();"></select>
                                        </div>
                                        日
                                        <div class="select-arrow">
                                            <select class="select-box" id="ended_at_time" name="ended_at_time" onChange="setEndedDay()">
                                            @for($h=0; $h<=24; $h++)
                                                @if(!empty(old('ended_at_time')) === true)
                                                    @if($h < 10)
                                                        <option value='0{{ $h }}0000' {{ (substr(old('ended_at_time'), 1, 1) == $h) ? 'selected' : '' }}>{{ $h }}</option>
                                                    @else
                                                        <option value='{{ $h }}0000' {{ (substr(old('ended_at_time'), 0, 2) == $h) ? 'selected' : '' }}>{{ $h }}</option>
                                                    @endif
                                                @else
                                                    @if($h < 10)
                                                        @if($h == date('H'))
                                                            <option value='0{{ $h }}0000' selected>{{ $h }}</option>
                                                        @else
                                                            <option value='0{{ $h }}0000'>{{ $h }}</option>
                                                        @endif
                                                    @else
                                                        @if($h == date('H'))
                                                            <option value='{{ $h }}0000' selected>{{ $h }}</option>
                                                        @else
                                                            <option value='{{ $h }}0000'>{{ $h }}</option>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                        時
                                    </div>
                                    <input id="ended_at" class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}" name='ended_at' type="hidden" value="{{ old('ended_at')}}">
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
                        <!-- 項目：資料 -->
                        <!-- <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name document">
                                    資料
                                </div>
                            </div>
                            <div class="is-boxed filearea">
                                <p class="uplaod">アップロード</p> -->
                                <!-- <label class="file-label">
                                    <input class="file-input file-label" type="file" name="resume" >
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        <input type="file" name="">
                                        Choose a file…
                                    </span>
                                    </span>
                                </label> -->
                                <!-- <img src="../../../images/dragdrop.png" alt="">
                            </div>
                        </div> -->
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
                                <div class="select-wrp select-plusicon is-info">
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
                        <div class="item-container fee">
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
                             
                        </div>
                        
                        <!-- 発注単価・件数 -->
                        <div class="item-container order__unit-number">
                            <div class="order-wrp">
                                
                                    <!-- 発注単価　タイトル -->
                                    <div class="item-name-wrapper unitname">
                                        <div class="item-name">
                                            発注単価<span class="tax">（税抜）</span>
                                        </div>
                                    </div>
                                    
        
                                <div class="unit-num">
                                    <!-- 発注単位 input -->
                                    <div class="unit-num_contents">
                                        <input id="inputPrice" class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text" value="{{ old('price')}}">
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
                                    <div class="item-name-wrapper numbername">
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
                                    </div>
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

                <div class="button-wrapper">
                    <button type="button" onclick="submit();" class="button-wrapper__btn button">作成</button>
                </div>
                
            </div>
        </div>
    </form>
</div>
@endsection
