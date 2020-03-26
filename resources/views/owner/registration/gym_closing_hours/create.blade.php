@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Owner - Gym_Closing_hour') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('owner.opening_hour_setting.store') }}">
                        @csrf

                        <div class="form-group row">
                            <div>
                                <div>月</div>
                                <div><input name="mon_open" type="time"></div>
                                <div><input name="mon_close" type="time"></div>
                            </div>
                            <div>
                                <div>火</div>
                                <div><input name="tue_open" type="time"></div>
                                <div><input name="tue_close" type="time"></div>
                            </div>
                            <div>
                                <div>水</div>
                                <div><input name="wed_open" type="time"></div>
                                <div><input name="wed_close" type="time"></div>
                            </div>
                            <div>
                                <div>木</div>
                                <div><input name="thu_open" type="time"></div>
                                <div><input name="thu_close" type="time"></div>
                            </div>
                            <div>
                                <div>金</div>
                                <div><input name="fri_open" type="time"></div>
                                <div><input name="fri_close" type="time"></div>
                            </div>
                            <div>
                                <div>土</div>
                                <div><input name="sut_open" type="time"></div>
                                <div><input name="sut_close" type="time"></div>
                            </div>
                            <div>
                                <div>日</div>
                                <div><input name="sun_open" type="time"></div>
                                <div><input name="sun_close" type="time"></div>
                            </div>
                            <!-- <table>
                                <tr>
                                    <th>月</th>
                                    <th>火</th>
                                    <th>水</th>
                                    <th>木</th>
                                    <th>金</th>
                                    <th>土</th>
                                    <th>日</th>
                                </tr>
                                <tr>
                                    <td><input name="mon_open" type="time"></td>
                                    <td><input name="tue_open" type="time"></td>
                                    <td><input name="wed_open" type="time"></td>
                                    <td><input name="thu_open" type="time"></td>
                                    <td><input name="fri_open" type="time"></td>
                                    <td><input name="sut_open" type="time"></td>
                                    <td><input name="sun_open" type="time"></td>
                                </tr>
                                <tr>
                                    <td><input name="mon_close" type="time"></td>
                                    <td><input name="tue_close" type="time"></td>
                                    <td><input name="wed_close" type="time"></td>
                                    <td><input name="thu_close" type="time"></td>
                                    <td><input name="fri_close" type="time"></td>
                                    <td><input name="sut_close" type="time"></td>
                                    <td><input name="sun_close" type="time"></td>
                                </tr>
   
                            </table> -->
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

@section('asset-js')
<script src="{{ mix('js/pages/owner/registration/gym_closing_hours/create.js') }}"></script>
@endsection

