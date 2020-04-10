@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - ジム情報登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('owner.gymInfo.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="gym_name" class="col-md-4 col-form-label text-md-right">ジム名</label>

                            <div class="col-md-6">
                                <input id="gym_name" type="text" class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}" name="gym_name" value="{{ old('gym_name') }}" required autofocus>

                                @if ($errors->has('gym_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gym_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gym_address_prefecture" class="col-md-4 col-form-label text-md-right">都道府県</label>
                            <div class="col-md-6">
                                <!-- <input 
                                    id="gym_address_prefecture"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_prefecture') ? ' is-invalid' : '' }}"
                                    name="gym_address_prefecture"
                                    value="{{ old('gym_address_prefecture') }}"
                                    required
                                    autofocus
                                > -->
                                <input 
                                    id="gym_address_prefecture"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_prefecture') ? ' is-invalid' : '' }}"
                                    name="gym_address_prefecture"
                                    value="{{ old('gym_address_prefecture') }}"
                                >
                                @if ($errors->has('gym_address_prefecture'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gym_address_prefecture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="gym_address_city" class="col-md-4 col-form-label text-md-right">市区町村</label>
                            <div class="col-md-6">
                                <!-- <input 
                                    id="gym_address_city"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_city') ? ' is-invalid' : '' }}"
                                    name="gym_address_city"
                                    value="{{ old('gym_address_city') }}"
                                    required
                                    autofocus
                                > -->
                                <input 
                                    id="gym_address_city"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_city') ? ' is-invalid' : '' }}"
                                    name="gym_address_city"
                                    value="{{ old('gym_address_city') }}"
                                >
                                @if ($errors->has('gym_address_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gym_address_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="gym_address_street" class="col-md-4 col-form-label text-md-right">住所1</label>
                            <div class="col-md-6">
                                <!-- <input 
                                    id="gym_address_street"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_street') ? ' is-invalid' : '' }}"
                                    name="gym_address_street"
                                    value="{{ old('gym_address_street') }}"
                                    required
                                    autofocus
                                > -->
                                <input 
                                    id="gym_address_street"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_street') ? ' is-invalid' : '' }}"
                                    name="gym_address_street"
                                    value="{{ old('gym_address_street') }}"
                                >
                                @if ($errors->has('gym_address_street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gym_address_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="gym_address_building" class="col-md-4 col-form-label text-md-right">住所2(建物)</label>
                            <div class="col-md-6">
                                <input 
                                    id="gym_address_building"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_address_building') ? ' is-invalid' : '' }}"
                                    name="gym_address_building"
                                    value="{{ old('gym_address_building') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gym_mobile_phone_number" class="col-md-4 col-form-label text-md-right">携帯番号</label>
                            <div class="col-md-6">
                                <!-- <input 
                                    id="gym_mobile_phone_number"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_mobile_phone_number') ? ' is-invalid' : '' }}"
                                    name="gym_mobile_phone_number"
                                    value="{{ old('gym_mobile_phone_number') }}"
                                    required
                                    autofocus
                                > -->
                                <input 
                                    id="gym_mobile_phone_number"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_mobile_phone_number') ? ' is-invalid' : '' }}"
                                    name="gym_mobile_phone_number"
                                    value="{{ old('gym_mobile_phone_number') }}"
                                >
                                @if ($errors->has('gym_mobile_phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gym_mobile_phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gym_landline_phone_number" class="col-md-4 col-form-label text-md-right">固定番号</label>
                            <div class="col-md-6">
                                <input 
                                    id="gym_landline_phone_number"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_landline_phone_number') ? ' is-invalid' : '' }}"
                                    name="gym_landline_phone_number"
                                    value="{{ old('gym_landline_phone_number') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gym_closest_station" class="col-md-4 col-form-label text-md-right">最寄り駅</label>
                            <div class="col-md-6">
                                <input 
                                    id="gym_closest_station"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_closest_station') ? ' is-invalid' : '' }}"
                                    name="gym_closest_station"
                                    value="{{ old('gym_closest_station') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gyme_maximum_capacity" class="col-md-4 col-form-label text-md-right">最大収容人数</label>
                            <div class="col-md-6">
                                <input 
                                    id="gyme_maximum_capacity"
                                    type="text"
                                    class="form-control{{ $errors->has('gyme_maximum_capacity') ? ' is-invalid' : '' }}"
                                    name="gyme_maximum_capacity"
                                    value="{{ old('gyme_maximum_capacity') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gym_size" class="col-md-4 col-form-label text-md-right">サイズ</label>
                            <div class="col-md-6">
                                <input 
                                    id="gym_size"
                                    type="text"
                                    class="form-control{{ $errors->has('gym_size') ? ' is-invalid' : '' }}"
                                    name="gym_size"
                                    value="{{ old('gym_size') }}"
                                >
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
