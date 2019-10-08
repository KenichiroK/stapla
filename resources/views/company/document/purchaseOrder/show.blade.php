@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/purchaseOrder/show.css') }}">
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
}
</script>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="main-wrapper__wrapper">
        <div class="head-container">
            <div class="title_btn-container__wrapper">
                <div class="page-title-container">
                    <div class="page-title-container__page-title">発注書</div>
                </div>
                <!-- downloadボタン -->
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
        
                    <div class="partnerName-container">
                        <h4>{{ $purchaseOrder->partner_name }} 様</h4>
                    </div>
                    
                    <div class="company-container">
                        <div class="right">
                            <p class="text">下記の通り、発注します。</p>
                            <p class="name">件名: {{ $purchaseOrder->task_name }}</p>
                            <p class="date">納期: {{ date("Y年m月d日", strtotime($purchaseOrder->task_ended_at)) }}</p>
                        </div>
        
                        <div class="left">
                            <p class="date">発注日: {{ date("Y年m月d日", strtotime($purchaseOrder->ordered_at)) }}</p>
                            <p clss="name">{{ $purchaseOrder->company_name }}</p>
                            <p class="tel">{{ $purchaseOrder->company_tel }}</p>
                            <p classs="address">〒{{ $purchaseOrder->company_zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                            <p class="building">{{ $purchaseOrder->company_streetAddress }}</p>
                            <p class="building">{{ $purchaseOrder->companyUser_name }}</p>
                            <p class="symbol">印</p>
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
                                    <td>{{ $purchaseOrder->task_name }}</td>
                                    <td>1</td>
                                    <td>{{ number_format($purchaseOrder->task_price) }}</td>
                                    <td>{{ number_format($purchaseOrder->task_price) }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
        
                        <div class="total-container">
                            <div class="text-container">
                                <p>合計</p>
                            </div>
        
                            <div class="section-container">
                                <p class="sub-column">税抜</p>
                                <p>{{ number_format($purchaseOrder->task_price) }}</p>
                            </div>
        
                            <div class="section-container">
                                <p class="sub-column">消費税</p>
                                <p>{{ number_format($purchaseOrder->task->price * $purchaseOrder->task_tax) }}</p>
                            </div>
        
                            <div class="section-container">
                                <p class="sub-column">総額</p>
                                <p class="total-text">{{ number_format($purchaseOrder->task_price * (1 + $purchaseOrder->task_tax)) }}</p>
                            </div>
                        </div>
        
                        <div class="sub-container">
                            <span>備考</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 表示用 -->
            <div class="document-container__wrapper sheet padding-10mm">
                <div class="title-container">
                    <h4>発注書</h4>
                </div>
    
                <div class="partnerName-container">
                    <h4>{{ $purchaseOrder->partner_name }} 様</h4>
                </div>
                
                <div class="company-container">
                    <div class="right">
                        <p class="text">下記の通り、発注します。</p>
                        <p class="name">件名: {{ $purchaseOrder->task_name }}</p>
                        <p class="date">納期: {{ date("Y年m月d日", strtotime($purchaseOrder->task_ended_at)) }}</p>
                    </div>
    
                    <div class="left">
                        <p class="date">発注日: {{ date("Y年m月d日", strtotime($purchaseOrder->ordered_at)) }}</p>
                        <p clss="name">{{ $purchaseOrder->company_name }}</p>
                        <p class="tel">{{ $purchaseOrder->company_tel }}</p>
                        <p classs="address">〒{{ $purchaseOrder->company_zip_code }} {{ $purchaseOrder->company->address_prefecture }}{{ $purchaseOrder->company->address_city }}{{ $purchaseOrder->company->address_streetAddress }}</p>
                        <p class="building">{{ $purchaseOrder->company_streetAddress }}</p>
                        <p class="building">{{ $purchaseOrder->companyUser_name }}</p>
                        <p class="symbol">印</p>
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
                                <td>{{ $purchaseOrder->task_name }}</td>
                                <td>1</td>
                                <td>{{ number_format($purchaseOrder->task_price) }}</td>
                                <td>{{ number_format($purchaseOrder->task_price) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
    
                    <div class="total-container">
                        <div class="text-container">
                            <p>合計</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">税抜</p>
                            <p>{{ number_format($purchaseOrder->task_price) }}</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">消費税</p>
                            <p>{{ number_format($purchaseOrder->task->price * $purchaseOrder->task_tax) }}</p>
                        </div>
    
                        <div class="section-container">
                            <p class="sub-column">総額</p>
                            <p class="total-text">{{ number_format($purchaseOrder->task_price * (1 + $purchaseOrder->task_tax)) }}</p>
                        </div>
                    </div>
    
                    <div class="sub-container">
                        <span>備考</span>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @if($purchaseOrder->task->status === 5 && in_array($company_user->id, $company_user_ids))
    <div class="submit-btn-container">
        <form action="{{ route('company.task.status.change') }}" method="POST">
        @csrf
            <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
            <input type="hidden" name="status" value="6">
            <button type="submit" class="button submit-btn-container__button">提出</button>
        </form>
    </div>
    @elseif($purchaseOrder->task->status === 7 && $purchaseOrder->task->superior->id === $company_user->id)
    <div class="actionButton">
        <form action="{{ route('company.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="6">
                <button type="submit" class="undone">発注書を承認しない</button>
            </form>
            <form action="{{ route('company.task.status.change') }}" method="POST">
            @csrf
                <input type="hidden" name="task_id" value="{{ $purchaseOrder->task->id }}">
                <input type="hidden" name="status" value="8">
                <button type="submit" class="done">発注書を承認する</button>
        </form>
    </div>
    @elseif($purchaseOrder->task->status > 7 && $purchaseOrder->task->superior->id === $company_user->id)
    <p class="send-done">この発注書は承認済みです</p>
    @elseif($purchaseOrder->task->status > 5 && in_array($company_user->id, $company_user_ids))
    <p class="send-done">この発注書は提出済みです</p>
    @else
    <p class="send-done">必要なアクションはありません</p>
    @endif
    
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
@endsection

@section('pdf-js')
    <script src="{{ asset('js/pdf.js') }}" defer></script>
@endsection
