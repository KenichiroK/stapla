@extends('index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/invite/partner/create.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
	<div class="title-container">
		<h3>招待メールを送る</h3>
	</div>
	<div class="main_container">
		<div class="form_wrapper">
            <form method="POST" action="{{ route('company.invitePreRegister') }}">
				@csrf
				<div class='input-container'>
					<p>メールアドレス</p>
					<input class="input_text" type="email" name="email" value="{{ old('email') }}" placeholder="impro@example.com">
                    @if($errors->has('email'))
                        <div class="invalid-feedback error-msg" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
				</div>

				<div class='input-container'>
					<input class="input_text" type="hidden" name="company_id" value="{{ Auth::user()->company_id }}">
				</div>

				<div class='button-container'>
					<button type="button" onclick="submit();">メールを送信する</button>
				</div>
			</form>
			
		</div>
	</div>
</div>
@endsection