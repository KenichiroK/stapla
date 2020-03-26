@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User - Dashboard') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.personalInfo.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">氏名</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required autofocus>

                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_birthday" class="col-md-4 col-form-label text-md-right">生年月日</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_birthday"
                                    type="text"
                                    class="form-control{{ $errors->has('user_birthday') ? ' is-invalid' : '' }}"
                                    name="user_birthday"
                                    value="{{ old('user_birthday') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_birthday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_address_prefecture" class="col-md-4 col-form-label text-md-right">都道府県</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_address_prefecture"
                                    type="text"
                                    class="form-control{{ $errors->has('user_address_prefecture') ? ' is-invalid' : '' }}"
                                    name="user_address_prefecture"
                                    value="{{ old('user_address_prefecture') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_address_prefecture'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_address_prefecture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="user_address_city" class="col-md-4 col-form-label text-md-right">市区町村</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_address_city"
                                    type="text"
                                    class="form-control{{ $errors->has('user_address_city') ? ' is-invalid' : '' }}"
                                    name="user_address_city"
                                    value="{{ old('user_address_city') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_address_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_address_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="user_address_street" class="col-md-4 col-form-label text-md-right">住所1</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_address_street"
                                    type="text"
                                    class="form-control{{ $errors->has('user_address_street') ? ' is-invalid' : '' }}"
                                    name="user_address_street"
                                    value="{{ old('user_address_street') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_address_street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_address_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="user_address_building" class="col-md-4 col-form-label text-md-right">住所2(建物)</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_address_building"
                                    type="text"
                                    class="form-control{{ $errors->has('user_address_building') ? ' is-invalid' : '' }}"
                                    name="user_address_building"
                                    value="{{ old('user_address_building') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_address_building'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_address_building') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_mobile_phone_number" class="col-md-4 col-form-label text-md-right">携帯番号</label>
                            <div class="col-md-6">
                                <input 
                                    id="user_mobile_phone_number"
                                    type="text"
                                    class="form-control{{ $errors->has('user_mobile_phone_number') ? ' is-invalid' : '' }}"
                                    name="user_mobile_phone_number"
                                    value="{{ old('user_mobile_phone_number') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('user_mobile_phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_mobile_phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('保存') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection