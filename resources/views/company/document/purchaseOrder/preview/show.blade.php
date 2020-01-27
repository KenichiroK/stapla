@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/show.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <form action="{{ route('company.task.store') }}" method='POST' class="main__container__wrapper main-wrapper__wrapper">
        @csrf
        @if(count($errors) > 0)
            <div class="error-container">
                <p>入力に問題があります。再入力して下さい。</p>
            </div>
        @endif
        <div class="main-wrapper__wrapper">

            <div class="head-container">
                <div class="title_btn-container__wrapper">
                    <div class="page-title-container">
                        <div class="page-title-container__page-title">発注書</div>
                    </div>
                    <div class="download-btn-container">
                        <a id="print_btn" class="button download-button">ダウンロード</a>
                    </div>
                </div>
            </div>

            <div id="print" class="document-container A4">
                <!-- 印刷用 -->
                <div class="pageout">
                    <div id="pdf_content" class="document-container__wrapper sheet padding-10mm">
                        <div class="title-container">
                            <h4>発注書</h4>
                        </div>
                        <div class="partner-name-container">
                            <h4>{{ $partner->name }} 様</h4>
                        </div>
                        
                        <div class="company-container">
                            <div class="right">
                                <p class="text">下記の通り、発注します。</p>
                                <p class="name">件名: {{ $request->order_name }}</p>
                                <p class="date">納期: {{ date("Y年m月d日", strtotime($request->delivery_date)) }}</p>
                            </div>
                            <div class="left">
                                <p class="date">発注日: {{ date("Y年m月d日", strtotime($ordered_at)) }}</p>
                                <p clss="name">{{ $task_company_user->company->company_name }}</p>
                                <p class="tel">{{ $task_company_user->company->company_tel }}</p>
                                <p classs="address">〒{{ $task_company_user->company->zip_code }} {{ $task_company_user->company->address_prefecture }}{{ $task_company_user->company->address_city }}</p>
                                <p class="building">{{ $task_company_user->company->address_building }}</p>
                                <p class="building">{{ $task_company_user->name }}</p>
                            </div>
                        </div>
            
                        <div class="order-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>商品名</th>
                                        <th>数量</th>
                                        <th>単価</th>
                                        <th>合計</th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    <tr>
                                        <td>{{ $request->task_name }}</td>
                                        <td>1</td>
                                        <td>{{ number_format($request->order_price) }}</td>
                                        <td>{{ number_format($request->order_price) }}</td>
                                    </tr>
                                    @for($i=1; $i<10; $i++)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
            
                            <div class="total-container">
                                <div class="text-container">
                                    <p>合計</p>
                                </div>
                                <div class="section-container">
                                    <p class="sub-column">税抜</p>
                                    <p>{{ number_format($request->order_price) }}</p>
                                </div>
                                <div class="section-container">
                                    <p class="sub-column">消費税</p>
                                    <!-- 定数化 -->
                                    <p>{{ number_format($request->order_price * 0.1) }}</p>
                                </div>
                                <div class="section-container">
                                    <p class="sub-column">総額</p>
                                    <!-- 定数化 -->
                                    <p class="total-text">{{ number_format($request->order_price * (1 + 0.1)) }}</p>
                                </div>
                            </div>
            
                            <div class="sub-container">
                                <span>備考</span>
                                {{ $request->content }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 表示用 -->
                <div class="document-container__wrapper sheet padding-10mm">
                    <div class="title-container">
                        <h4>発注書</h4>
                    </div>
                    <div class="partner-name-container">
                        <h4>{{ $partner->name }} 様</h4>
                        <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                    </div>
                    <div class="company-container">
                        <div class="right">
                            <p class="text">下記の通り、発注します。</p>
                            <p class="name">件名: 
                                @if(isset($request->order_name))
                                    {{ $request->order_name }}
                                    <input type="hidden" name="order_name" value="{{ $request->order_name }}">
                                @else
                                    {{ $request->task_name }}
                                @endif
                            </p>
                            <p class="date">納期: {{ date("Y年m月d日", strtotime($request->delivery_date)) }}</p>
                            <input type="hidden" name="delivery_date" value="{{ $request->delivery_date }}">
                        </div>
                        <div class="left">
                            <p class="date">発注日: {{ date("Y年m月d日", strtotime($ordered_at)) }}</p>
                            <input type="hidden" name="ordered_at" value="{{ $ordered_at }}">
                            <p clss="name">{{ $task_company_user->company->company_name }}</p>
                            <p class="tel">{{ $task_company_user->company->company_tel }}</p>
                            <p classs="address">〒{{ $task_company_user->company->zip_code }} {{ $task_company_user->company->address_prefecture }}{{ $task_company_user->company->address_city }}</p>
                            <p class="building">{{ $task_company_user->company->address_building }}</p>
                            <p class="building">{{ $task_company_user->name }}</p>
                        </div>
                    </div>

                    <div class="order-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>商品名</th>
                                    <th>数量</th>
                                    <th>単価</th>
                                    <th>合計</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $request->task_name }}</td>
                                    <input type="hidden" name="task_name" value="{{ $request->task_name }}">
                                    <td>1</td>
                                    <td>{{ number_format($request->order_price) }}</td>
                                    <input type="hidden" name="order_price" value="{{ $request->order_price }}">

                                    <td>{{ number_format($request->order_price) }}</td>
                                </tr>
                                @for($i=1; $i<10; $i++)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                        <div class="total-container">
                            <div class="text-container">
                                <p>合計</p>
                            </div>
                            <div class="section-container">
                                <p class="sub-column">税抜</p>
                                <p>{{ number_format($request->order_price) }}</p>
                            </div>
                            <div class="section-container">
                                <p class="sub-column">消費税</p>
                                <!-- TODO: 消費税の0.1を定数化する -->
                                <p>{{ number_format($request->order_price * 0.1) }}</p>
                            </div>
                            <div class="section-container">
                                <p class="sub-column">総額</p>
                                <!-- TODO: 消費税の0.1を定数化する -->
                                <p class="total-text">{{ number_format($request->order_price * (1 + 0.1)) }}</p>
                            </div>
                        </div>
                        <div class="sub-container">
                            <span>備考</span>
                            {{ $request->content }}
                            <input type="hidden" name="content" value="{{ $request->content }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 展開できていないパラメータ -->
            @isset($request->task_id)
                <input type="hidden" name="task_id" value="{{ $request->task_id }}">
            @endisset
            <input type="hidden" name="project_id" value="{{ $request->project_id }}">
            <input type="hidden" name="task_company_user_id" value="{{ $request->task_company_user_id }}">
            <input type="hidden" name="superior_id" value="{{ $request->superior_id }}">
            <input type="hidden" name="accounting_id" value="{{ $request->accounting_id }}">
            <input type="hidden" name="started_at" value="{{ $request->started_at }}">
            <input type="hidden" name="ended_at" value="{{ $request->ended_at }}">
            <input type="hidden" name="order_company_user_id" value="{{ $request->order_company_user_id }}">
            @if(isset($request->billing_to_text))
                <input type="hidden" name="billing_to_text" value="{{ $request->billing_to_text }}">
            @endif
            <div class="actionButton">
                <button class="undone" type="submit" onclick="submit();" formaction="{{ route('company.task.reCreate') }}">作成ページに戻る</button>
                <input type="hidden" name="status" value="{{ config('const.ORDER_SUBMIT_SUPERIOR') }}">
                <button type="button" class="done confirm" data-toggle="modal" data-target="#confirm">保存/上長に提出</button>
                <!-- Modal -->
                @component('components.confirm-modal')
                    @slot('modalID')
                        confirm
                    @endslot
                    @slot('confirmBtnLabel')
                        依頼
                    @endslot
                    タスク・発注書を新規作成し、 {{ $superior_user->name }} さんに上長確認を依頼します。
                @endcomponent
            </div>
            <div class="error-message-wrapper">
                @if ($errors->has('task_id'))
                    <div class="error-msg" role="alert">
                        <strong>{{ $errors->first('task_id') }}</strong>
                    </div>
                @elseif ($errors->has('status'))
                    <div class="error-msg" role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection

@section('asset-js')
    <script src="{{ asset('js/pdf.js') }}" defer></script>
    <script>
        const setPreview = (input) => {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        };
    </script>
@endsection
