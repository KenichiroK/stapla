@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User - ジム予約') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.reservation.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="selected_gym" class="col-md-4 col-form-label text-md-right">予約するジム</label>

                            <div class="col-md-6">
                                <input id="selected_gym" type="text" class="form-control{{ $errors->has('selected_gym') ? ' is-invalid' : '' }}" name="selected_gym" value="{{ old('selected_gym') }}" required autofocus>

                                @if ($errors->has('selected_gym'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('selected_gym') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner_birthday" class="col-md-4 col-form-label text-md-right"></label>
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
                            <label for="owner_address_prefecture" class="col-md-4 col-form-label text-md-right">利用開始時間</label>
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
                            <label for="owner_address_city" class="col-md-4 col-form-label text-md-right">利用終了時間</label>
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
                        
                        <!-- <div class="form-group row">
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
                        </div> -->
                        
                        <!-- <div class="form-group row">
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
                        </div> -->

                        <!-- <div class="form-group row">
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
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('予約') }}
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
