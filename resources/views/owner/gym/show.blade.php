@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - ジム詳細') }}</div>

                <div class="card-body">
                    <form method="get" action="{{ route('owner.reservation.create', ['gym_id' => $gym->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="owner_name" class="col-md-4 col-form-label text-md-right">ジム名</label>

                            <div class="col-md-6">
                                <p>{{ $gym->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner_birthday" class="col-md-4 col-form-label text-md-right">利用日を登録する</label>
                            <div class="col-md-6">
                                <input 
                                    id="date_of_use"
                                    type="date"
                                    class="form-control{{ $errors->has('date_of_use') ? ' is-invalid' : '' }}"
                                    name="date_of_use"
                                    value="{{ old('date_of_use') }}"
                                    required
                                    autofocus
                                >
                                @if ($errors->has('date_of_use'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_use') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('予約へ') }}
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
