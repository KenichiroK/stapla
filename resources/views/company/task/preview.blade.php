@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/show.css') }}">
@endsection

@section('content')

<div class="main__container">
    <div class="main__container__wrapper">
        <div class="top">
            <div class="page-title-container">
                <div class="page-title-container__page-title">{{ $request->task_name }} プレビュー</div>
            </div>
        </div>

        <form action="{{ route('company.task.previewStore') }}" method='POST'>
        @csrf
            <div class="detail">
                <dl class="first">
                    <dt>
                        プロジェクト名
                    </dt>
                    <dd>
                        {{ $project->name }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        タスク作成日
                    </dt>
                    <dd>
                        {{ date("Y年m月d日") }}
                    </dd>
                </dl>
                <dl>
                    <dt>
                        タスク名
                    </dt>
                    <dd>
                        {{ $request->task_name }}
                        <input type="hidden" name="task_name" value="{{ $request->task_name }}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        タスク内容
                    </dt>
                    <dd>
                        {!! nl2br(e($request->task_content)) !!}
                        <input type="hidden" name="task_content" value="{!! nl2br(e($request->task_content)) !!}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        担当者
                    </dt>
                    <dd class="flex01">
                        <div class="person-item">
                            <div class="imgbox">
                                <img src="{{ $companyUser->picture }}" alt="担当者プロフィール画像">
                            </div>
                            <p>{{ $companyUser->name }}</p>
                            <input type="hidden" name="company_user_id" value="{{ $companyUser->id }}">
                        </div>
                    </dd>
                </dl>
                @if(isset($superiorUser))
                <dl>
                    <dt>
                        上長
                    </dt>
                    <dd class="flex01">
                        <div class="person-item">
                            <div class="imgbox">
                                <img src="{{ $superiorUser->picture }}" alt="上長プロフィール画像">
                            </div>
                            <p>{{ $superiorUser->name }}</p>
                            <input type="hidden" name="superior_id" value="{{ $superiorUser->id }}">
                        </div>
                    </dd>
                </dl>
                @endif
                @if(isset($accountingUser))
                <dl>
                    <dt>
                        経理
                    </dt>
                    <dd class="flex01">
                        <div class="person-item">
                            <div class="imgbox">
                                <img src="{{ $accountingUser->picture }}" alt="経理プロフィール画像">
                            </div>
                            <p>{{ $accountingUser->name }}</p>
                            <input type="hidden" name="accounting_id" value="{{ $accountingUser->id }}">
                        </div>
                    </dd>
                </dl>
                @endif
                <dl class="term">
                    <dt>
                        プロジェクト期間
                    </dt>
                    <dd>
                        <div class="flex01 term-desc">
                            <p class="start"><span>開始日</span>{{ date("Y年m月d日H時", strtotime($request->started_at)) }}</p>
                            <input type="hidden" name="started_at" value="{{ $request->started_at }}">
                            <p><span>終了日</span>{{ date("Y年m月d日H時", strtotime($request->ended_at)) }}</p>
                            <input type="hidden" name="starteended_atd_at" value="{{ $request->ended_at }}">
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        予算
                    </dt>
                    <dd>
                        {{ number_format($request->budget) }}円
                        <input type="hidden" name="budget" value="{{ $request->budget }}">
                    </dd>
                </dl>
                <!-- <dl>
                    <dt>
                        資料
                    </dt>
                    <dd>
                        
                    </dd>
                </dl> -->
            </div>

            <div class="patner">
                <p class="ptnr-title">パートナー契約内容</p>
                <dl>
                    <dt>
                        パートナー
                    </dt>
                    <dd class="flex01">
                        <div class="person-item">
                            <div class="imgbox">
                                <img src="{{ $partner->picture }}" alt="パートナープロフィール画像">
                            </div>
                            <p>{{ $partner->name }}</p>
                            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        報酬形式
                    </dt>
                    <dd>
                        {{ $request->fee_format }}
                        <input type="hidden" name="fee_format" value="{{ $request->fee_format }}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        発注単価<span>(税抜)</span>
                    </dt>
                    <dd>
                        {{ number_format($request->price) }}円
                        <input type="hidden" name="price" value="{{ $request->price }}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        件数
                    </dt>
                    <dd>
                        {{ $request->cases }}件
                        <input type="hidden" name="cases" value="{{ $request->cases }}">
                    </dd>
                </dl>
                <dl>
                    <dt>
                        発注額
                    </dt>
                    <dd class="orderprice">
                        <span class="tax">税込</span><span class="yen">￥</span>{{ number_format( ($request->price * $request->cases) * (1 + $request->tax)) }}
                    </dd>
                </dl>
                <dl>
                    <dt>
                        ステータス
                    </dt>
                    <dd class="status-desc">
                        @if(($task_status) === 0)
                            下書き
                        @endif
                    </dd>
                </dl>
            </div>
            <div class="btn01-container">
                <button class="back_button" type="submit" onclick="submit();" name="backOrSave" value="back">戻る</button>
                <!-- 保存して上長に確認を依頼 -->
                <!-- <button type="button" onclick="submit();">保存して上長に確認を依頼</button> -->
                <button type="submit" onclick="submit();" style="width:155px;" name="backOrSave" value="save">保存/上長</button>
            </div>
        </form>
    </div>
</div>
@endsection
