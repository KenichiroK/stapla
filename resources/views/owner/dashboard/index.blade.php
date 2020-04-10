@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - Dashboars') }}</div>
                    @if (session('completed'))
                        <div class="complete-container">
                            <p>{{ session('completed') }}</p>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div for="gym_mobile_phone_number" class="col-md-4 col-form-label text-md-right">ジム</div>
                        <div class="col-md-4 col-form-label text-md-right">
                            @foreach($gyms as $gym)
                                <a href="{{ route('owner.gym.show', ['gym_id' => $gym->id]) }}">{{ $gym->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
