@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/preview.css') }}">
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
            <div class="page-title-container__page-title">{{ $request->name }} プレビュー</div>
        </div>

        <!-- プロジェクトを選択する エリア -->
        <div class="select-container">
            <div class="select-container__wrapper">
                <div class="select-textarea">
                    <div class="select-text">
                        プロジェクト名
                    </div>
                </div>
                <p class="preview_p">{{ $project->name }}</p>
                <input type="hidden" name="project_id" value="{{ $project->id }}" >
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
                            <p class="preview_p">{{ $request->name }}</p>
                            <input type="hidden" name='name' value="{{ $request->name }}">
                        </div>

                        <!-- 項目：タスク内容 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                タスク内容
                                </div>
                            </div>
                            <p class="preview_p">{!! nl2br(e($request->content)) !!}</p>
                            <input type="hidden" name="content" value="{{ $request->content }}">
                        </div>

                        <!-- 担当者 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    担当者
                                </div>
                            </div>
                            <p class="preview_p">{{ $company_user->name }}</p>
                            <input type="hidden" name="company_user_id" value="{{ $company_user->id }}">
                        </div>                        

                        <!-- 上長 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    上長
                                </div>
                            </div>
                            <p class="preview_p">{{ $superior_user->name }}</p>
                            <input type="hidden" name="superior_id" value="{{ $superior_user->id }}">
                        </div>

                        <!-- 経理 -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name">
                                    経理
                                </div>
                            </div>
                            <p class="preview_p">{{ $accounting_user->name }}</p>
                            <input type="hidden" name="accounting_id" value="{{ $accounting_user->id }}">
                        </div>
                        <!-- 項目：締め切り -->
                        <div class="item-container">
                            <div class="item-name-wrapper">
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
                                    <p>{{ date("Y年m月d日H時", strtotime($request->started_at)) }}</p>
                                    <input type="hidden" name="started_at" value="{{ $request->started_at }}">
                                </div>
                                <!-- 終了日カレンダー -->
                                <div class="calendar-item end">                               
                                    
                                    <div class="calendar-name">
                                        終了日<i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <p>{{ date("Y年m月d日H時", strtotime($request->ended_at)) }}</p>
                                    <input type="hidden" name="ended_at" value="{{ $request->ended_at }}">
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
                            <p class="preview_p">{{ $request->budget }}円</p>
                            <input type="hidden" name="budget" value="{{ $request->budget }}">
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
                            <p class="preview_p">{{ $partner->name }}</p>
                            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
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
                                <p class="preview_p">{{ $request->price }}円</p>
                                <input type="hidden" name="price" value="{{ $request->price }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="actionButton">
                    @if(isset($task))
                        <!-- 下書き保存されているタスクの場合 -->
                        <input type="text" name='task_id' value="{{ $task->id }}">
                        <button class="undone" type="submit" onclick="submit();" formaction="{{ route('company.task.reCreate') }}">更新作成ページに戻る</button>
                        <button class="done" type="submit" onclick="submit();" style="width:155px;" name="editOrStore" value="toStoreUpdate">更新保存/上長に提出</button>
                    @else
                        <!-- 新規作成のタスクの場合 -->
                        <button class="undone" type="submit" onclick="submit();" formaction="{{ route('company.task.reCreate') }}">作成ページに戻る</button>
                        <button class="done" type="submit" onclick="submit();" style="width:155px;" name="editOrStore" value="toStore">保存/上長に提出</button>
                    @endif
                </div>

            </div>
        </div>

    </form>
</div>
@endsection