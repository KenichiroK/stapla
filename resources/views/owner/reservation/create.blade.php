@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - ジム予約') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('owner.reservation.store', ['gym_reservation_id' => $gym_reservation->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="gym_name" class="col-md-4 col-form-label text-md-right">予約日</label>

                            <div class="col-md-6">
                                <p>
                                    {{ $gym_reservation->reservation_date }}
                                    (
                                    @if($date === 0)
                                        日
                                    @elseif($date === 1)
                                        月
                                    @elseif($date === 2)
                                        火
                                    @elseif($date === 3)
                                        水
                                    @elseif($date === 4)
                                        木
                                    @elseif($date === 5)
                                        金
                                    @else
                                        土
                                    @endif
                                    )
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gym_address_prefecture" class="col-md-4 col-form-label text-md-right">
                                @if($date === 0)
                                    日
                                @elseif($date === 1)
                                    月
                                @elseif($date === 2)
                                    火
                                @elseif($date === 3)
                                    水
                                @elseif($date === 4)
                                    木
                                @elseif($date === 5)
                                    金
                                @else
                                    土
                                @endif
                                曜日の営業時間
                            </label>
                            <div class="col-md-6">
                                <p>
                                    @if($date === 0)
                                        {{ $gym->sun_opening }} ~ {{ $gym->sun_closing }}
                                    @elseif($date === 1)
                                        {{ $gym->mon_opening }} ~ {{ $gym->mon_closing }}
                                    @elseif($date === 2)
                                        {{ $gym->tue_opening }} ~ {{ $gym->tue_closing }}
                                    @elseif($date === 3)
                                        {{ $gym->wed_opening }} ~ {{ $gym->wed_closing }}
                                    @elseif($date === 4)
                                        {{ $gym->thu_opening }} ~ {{ $gym->thu_closing }}
                                    @elseif($date === 5)
                                        {{ $gym->fri_opening }} ~ {{ $gym->fri_closing }}
                                    @else
                                        {{ $gym->sat_opening }} ~ {{ $gym->sat_closing }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="reservation_start_time" class="col-md-4 col-form-label text-md-right">利用開始時間</label>
                            <div class="col-md-6">
                                <input 
                                    id="reservation_start_time"
                                    type="time"
                                    class="form-control{{ $errors->has('reservation_start_time') ? ' is-invalid' : '' }}"
                                    name="reservation_start_time"
                                    value="{{ old('reservation_start_time') }}"
                                >
                                @if ($errors->has('reservation_start_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reservation_start_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="reservation_end_time" class="col-md-4 col-form-label text-md-right">利用終了時間</label>
                            <div class="col-md-6">
                                <input 
                                    id="reservation_end_time"
                                    type="time"
                                    class="form-control{{ $errors->has('reservation_end_time') ? ' is-invalid' : '' }}"
                                    name="reservation_end_time"
                                    value="{{ old('reservation_end_time') }}"
                                >
                                @if ($errors->has('reservation_end_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reservation_end_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @isset($gym_reserved)
                        <div class="form-group row">
                            <label for="reservation_end_time" class="col-md-4 col-form-label text-md-right">予約済み</label>
                            <div class="col-md-6">
                                @foreach($gym_reserved as $reserved)
                                    <p>{{ $reserved->reservation_start_time }} ~ {{ $reserved->reservation_end_time }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endisset

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
