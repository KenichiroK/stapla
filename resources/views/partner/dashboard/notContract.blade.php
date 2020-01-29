@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-title-container" style="
        flex-direction: column;
        align-items: baseline;
    ">
        <h3 class="page-title-container__text" style="margin-bottom: 30px;">ダッシュボード</h3>

        @if (!isset($outsourceContract) || $outsourceContract->status === 'uncontracted')
        {{-- HACK: 該当のcssに汚染しないようにstyleタグで直接指定してるところ --}}
        <p style="
            font-family: HiraginoSans-W3;
            font-size: 14px;
            line-height: 1.5;
            letter-spacing: 0.44px;
            color: #333333;
        ">
            企業と契約締結後にサービスをご利用いただけます。<br>
            企業からの契約依頼をお待ちください。
        </p>
        @elseif ($outsourceContract->status === 'progress')
        <p style="
            margin-bottom: 20px;
            font-family: HiraginoSans-W3;
            font-size: 14px;
            line-height: 1.5;
            letter-spacing: 0.44px;
            color: #333333;
        ">
            企業からの契約確認が届いています。
        </p>

        <button
            type="button"
            style="
                border-radius: 100px;
                background-color: #43425d;
                color: #ffffff;
                font-weight: bold;
                padding: 8px 30px;
                font-size: 16px;
                border: solid 2px #43425d;
                cursor: pointer;
                outline: none;
                
            "
        >
            <a href="{{ route('partner.document.outsourceContracts.edit', ['outsource_contract_id' => $outsourceContract->id ]) }}" style="color: white; text-decoration: none;">契約内容を確認する</a>
        </button>
        @endif
    </div>
</div>
@endsection

@section('asset-js')
@endsection
