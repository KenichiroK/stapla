@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - 個人情報登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('owner.personalInfo.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="owner_name" class="col-md-4 col-form-label text-md-right">氏名</label>

                            <div class="col-md-6">
                                <input id="owner_name" type="text" class="form-control{{ $errors->has('owner_name') ? ' is-invalid' : '' }}" name="owner_name" value="{{ old('owner_name') }}" required autofocus>

                                @if ($errors->has('owner_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner_birthday" class="col-md-4 col-form-label text-md-right">生年月日</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_birthday"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_birthday') ? ' is-invalid' : '' }}"
                                    name="owner_birthday"
                                    value="{{ old('owner_birthday') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('owner_birthday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner_address_prefecture" class="col-md-4 col-form-label text-md-right">都道府県</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_address_prefecture"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_address_prefecture') ? ' is-invalid' : '' }}"
                                    name="owner_address_prefecture"
                                    value="{{ old('owner_address_prefecture') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('owner_address_prefecture'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_address_prefecture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="owner_address_city" class="col-md-4 col-form-label text-md-right">市区町村</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_address_city"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_address_city') ? ' is-invalid' : '' }}"
                                    name="owner_address_city"
                                    value="{{ old('owner_address_city') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('owner_address_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_address_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="owner_address_street" class="col-md-4 col-form-label text-md-right">住所1</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_address_street"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_address_street') ? ' is-invalid' : '' }}"
                                    name="owner_address_street"
                                    value="{{ old('owner_address_street') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('owner_address_street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_address_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="owner_address_building" class="col-md-4 col-form-label text-md-right">住所2(建物)</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_address_building"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_address_building') ? ' is-invalid' : '' }}"
                                    name="owner_address_building"
                                    value="{{ old('owner_address_building') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner_mobile_phone_number" class="col-md-4 col-form-label text-md-right">携帯番号</label>
                            <div class="col-md-6">
                                <input 
                                    id="owner_mobile_phone_number"
                                    type="text"
                                    class="form-control{{ $errors->has('owner_mobile_phone_number') ? ' is-invalid' : '' }}"
                                    name="owner_mobile_phone_number"
                                    value="{{ old('owner_mobile_phone_number') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('owner_mobile_phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_mobile_phone_number') }}</strong>
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
