@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User - Dashboard') }}</div>
                
                    @if (session('completed'))
                        <div class="complete-container">
                            <p>{{ session('completed') }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="/user/reservation/index">ジムを予約する</a>
                            </div>
                        </div>   
                    </div>                     
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="">設定</a>
                            </div>
                        </div>   
                    </div>                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection