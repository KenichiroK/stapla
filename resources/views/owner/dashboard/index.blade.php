@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - Dashboars') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('owner.gymInfo.store') }}">
                        @csrf

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
