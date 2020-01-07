@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/partner/profile/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    @if (session('completed'))
    <div class="complete-container">
        <p>{{ session('completed') }}</p>
    </div>
    @endif

    @if(count($errors) > 0)
    <div class="error-container">
        <p>入力に問題があります。再入力して下さい。</p>
    </div>
    @endif
    
    <div class="title-container">
        <h3>プロフィール設定</h3>
    </div>

    <div class="menu-container">
		<ul>
			<li><a href="{{ route('partner.profile.create') }}">プロフィール</a></li>
			<li><a href="{{ route('partner.profile.email') }}" class="isActive">メールアドレス</a></li>
		</ul>
	</div>

    <form action="{{ route('partner.profile.email.sendMail') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body-container">
            <div class="edit-container">
                <div class="profile-container">
                    <div class="short-input-container">
                        <p>メールアドレス</p>
                        @if (Auth::user())
                            <input type="text" name="email" value="{{ old('email', Auth::user()->email) }}">
                        @else
                            <input type="text" name="email" value="{{ old('email') }}">
                        @endif

                        @if ($errors->has('email'))
                            <div class="error-msg">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-container">
            <div class="save-btn">
                <button data-impro-button="once" type="button" onclick="submit()">メールアドレスを変更する</button>
            </div>
        </div>
    </form>
</div>
@endsection
