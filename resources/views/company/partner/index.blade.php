@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/partner/index.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        @if(session('completed'))
            <div class="complete-container">
                <p>{{ session('completed') }}</p>
            </div>
        @endif

        <div class="top-container">
            <h1 class="top-container__title">パートナ一覧</h1>
            <div class="btn-a-container">
                <a href="{{ route('company.invite.partner') }}">パートナー追加</a>
            </div>
        </div>

        <div class="partner-content">
            <h3 class="partner-content__title">ステータス</h3>
            <ul class="partner-content__tab">
                <li
                    @if (is_null(Request::query('status')))
                    class="is-active"
                    @endif
                >
                    <a
                        class="tab-btn"
                        href="{{ route('company.partner.index') }}"
                    >
                        全て<span class="counter">({{ $outsourceContractCount['all'] }})</span>
                    </a>
                </li>
                <li
                    @if (Request::query('status') == 'complete')
                    class="is-active"
                    @endif
                >
                    <a
                        class="tab-btn"
                        href="{{ route('company.partner.index', ['status' => 'complete']) }}"
                    >
                        契約締結済<span class="counter">({{ $outsourceContractCount['complete'] }})</span>
                    </a>
                </li>
                <li
                    @if (Request::query('status') == 'progress')
                    class="is-active"
                    @endif
                >
                    <a
                        class="tab-btn"
                        href="{{ route('company.partner.index', ['status' => 'progress']) }}"
                    >
                        契約作業中<span class="counter">({{ $outsourceContractCount['progress'] }})</span>
                    </a>
                </li>
                <li
                    @if (Request::query('status') == 'uncontracted')
                    class="is-active"
                    @endif
                >
                    <a
                        class="tab-btn"
                        href="{{ route('company.partner.index', ['status' => 'uncontracted']) }}"
                    >
                        未契約<span class="counter">({{ $outsourceContractCount['uncontracted'] }})</span>
                    </a>
                </li>
            </ul>

            <div class="partner-content__card-wrapper">
                @foreach( $partners as $partner )
                <div class="card">
                    @if (!isset($partner->outsourceContract))
                    <a href="{{ route('company.document.outsourceContracts.create', ['partner_id' => $partner->id]) }}">    
                    @else
                    <a href="{{ route('company.document.outsourceContracts.preview', [
                        'outsource_contract_id' => $partner->outsourceContract->id
                    ]) }}">
                    @endif
                        <div class="card__content">
                            <div class="image-wrapper">
                                @if (isset($partner->picture))
                                <img class="profile-image" src="{{ $partner->picture }}">
                                @else
                                <img class="profile-image" src="{{ env('AWS_URL').'/common/dummy_profile_icon.png' }}">
                                @endif
                            </div>
                            <div class="name-wrapper">
                                <p class="name">{{ $partner->name }}</p>
                                <p class="occupations">{{ $partner->occupations }}</p>
                            </div>
                        </div>
                        <div class="card__footer">
                            @if (!isset($partner->outsourceContract))
                            <div class="circle uncontracted-color"></div>
                            {{-- HACK: ステータスの定数化 --}}
                            <p class="status">未契約</p>
                            @elseif ($partner->outsourceContract->status == "complete")
                            <div class="circle complete-color"></div>
                            <p class="status">契約締結済</p>
                            @else
                            <div class="circle progress-color"></div>
                            <p class="status">契約作業中</p>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="pagenate-container">
                <div class="pagenate-container__wrapper">
                    {{ $partners->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
