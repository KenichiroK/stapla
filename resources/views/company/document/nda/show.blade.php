@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/pdf/paper.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/nda/show.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="../../../images/icon_small-down.png" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
                        </div>
                        <div class="textbox">
                            設定
                        </div>
                    </a>
                </li>
            </ul>
            
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <!--main__container__wrapperに記述していく-->
        <div class="head-container">
            <div class="head-container__wrapper">
                <div class="page-title-container">
                    <div class="page-title-container__page-title">機密保持契約書</div>
                </div>
                <!-- printボタン -->
                <div class="head-container__wrapper__print-btn-container">
                    <a id="print_btn" class="button head-container__wrapper__print-btn-container__button">プリント</a>
                </div>
            </div>
        </div>
        
        <div class="main-container">
            <div class="main-container__wrapper">
                <!-- 印刷用 -->
                <div id="print" class="A4">
                    <div class="secrecy-container">
                        <div class="pageout">
                            <div id="pdf_content" class="secrecy-container__wrapper">
                                <div class="pdf-container sheet">
                                    <div class="pdf-container__pdf sheet padding-10mm">
                                        <div class="pdf-container__pdf__contract-type">機密保持契約書</div>
    
                                        <div class="pdf-container__pdf__main">
                                            {{ date("Y年m月d日", strtotime($nda->created_at)) }}
                                            
                                            <div class="pdf-container__pdf__main__Paragraph1">
                                                <div>
                                                    {{ $nda->company_name }}（以下、甲という）と{{ $nda->partner_name }}（以下、乙という）（以下それぞれを「当事者」又は「各当事者」といい、総称して「両当事者」という）とは、
                                                        甲乙間で既に締結され、または今後締結される全ての契約（以下、「原契約」という。）に基づき甲が乙に委託する業務（以下「本件業務」という）に関連して
                                                    相互に開示される機密情報の取扱いに関して、次の通り契約（以下「本契約」という）する。
                                                    </div>
                                            </div>
                                        
                                            <div class="pdf-container__pdf__main__Paragraph2">
                                                <div>（定義）</div>
                                                <div>
                                                    「機密情報」とは、甲又は乙の営業上又は技術上の情報で、口頭、文書又は電子媒体等の情報の提供方法を問わず、機密として取扱うよう指定された情報であって、
                                                    媒体上に「機密情報」又は「CONFIDENTIAL」等の表示が明示されているか、又は口頭での開示時に「機密情報」である旨の告知がなされ、かつ開示後速やかにその対象が特定された情報をいう。
                                                </div>
                                            </div>
                                        
                                            <div class="pdf-container__pdf__main__Paragraph3">
                                                <div>（機密情報の取扱い）</div>
                                                <div>
                                                    各当事者は、相手方の事前の文書による承認を得た場合を除き、開示された機密情報の機密を保持し、如何なる第三者にも開示及び漏洩しないものとし、また複製しないものとする。
                                                    各当事者は、相手方から開示された機密情報を本件以外の目的に使用してはならないものとする。
                                                    各当事者は、開示された機密情報をその社内において、開示目的に必要な従業員に対してのみ、かつ本契約に規定する機密保持義務を遵守させることを条件として、開示できるものとする。
                                                    各当事者は、開示された機密情報を、本件業務以外の目的のためにやむをえず、当事者以外の者（以下、「二次受領者」という）に開示する必要のある場合は、相手方当事者の事前の文書に
                                                    よる承認を得て、かつ本契約と同様の機密保持義務を課した場合に限り、開示することができるものとする。 その場合、開示当事者は当該二次受領者による機密情報の開示、
                                                    漏洩及び目的外使用について、総ての責任を負うものとする。
                                                    各当事者は機密情報を自己の情報と物理的に隔離し、施錠された空間に保管するものとする。
                                                </div>
                                            </div>
                                        
                                            <div class="pdf-container__pdf__main__Paragraph4">
                                                <div>（限定保証）</div>
                                                <div>
                                                    各当事者は、故意に不正確又は不完全な機密情報を相手方に開示した場合を除いて、相手方による機密情報の利用結果には一切の責任を負わないものとする。
                                                    各当事者は、不正確又は不完全な機密情報を提供しないように注意を払うものとするが、当該機密情報の正確性及び完全性について保証しないものとする。
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 表示用 -->
                    <div class="secrecy-container">
                        <div class="secrecy-container__wrapper">
                            <div class="pdf-container sheet">
                                <div class="pdf-container__pdf sheet padding-10mm">
                                    <div class="pdf-container__pdf__contract-type">機密保持契約書</div>

                                    <div class="pdf-container__pdf__main">
                                        {{ date("Y年m月d日", strtotime($nda->created_at)) }}
                                        
                                        <div class="pdf-container__pdf__main__Paragraph1">
                                            <div>
                                                {{ $nda->company_name }}（以下、甲という）と{{ $nda->partner_name }}（以下、乙という）（以下それぞれを「当事者」又は「各当事者」といい、総称して「両当事者」という）とは、
                                                    甲乙間で既に締結され、または今後締結される全ての契約（以下、「原契約」という。）に基づき甲が乙に委託する業務（以下「本件業務」という）に関連して
                                                相互に開示される機密情報の取扱いに関して、次の通り契約（以下「本契約」という）する。
                                                </div>
                                        </div>
                                    
                                        <div class="pdf-container__pdf__main__Paragraph2">
                                            <div>（定義）</div>
                                            <div>
                                                「機密情報」とは、甲又は乙の営業上又は技術上の情報で、口頭、文書又は電子媒体等の情報の提供方法を問わず、機密として取扱うよう指定された情報であって、
                                                媒体上に「機密情報」又は「CONFIDENTIAL」等の表示が明示されているか、又は口頭での開示時に「機密情報」である旨の告知がなされ、かつ開示後速やかにその対象が特定された情報をいう。
                                            </div>
                                        </div>
                                    
                                        <div class="pdf-container__pdf__main__Paragraph3">
                                            <div>（機密情報の取扱い）</div>
                                            <div>
                                                各当事者は、相手方の事前の文書による承認を得た場合を除き、開示された機密情報の機密を保持し、如何なる第三者にも開示及び漏洩しないものとし、また複製しないものとする。
                                                各当事者は、相手方から開示された機密情報を本件以外の目的に使用してはならないものとする。
                                                各当事者は、開示された機密情報をその社内において、開示目的に必要な従業員に対してのみ、かつ本契約に規定する機密保持義務を遵守させることを条件として、開示できるものとする。
                                                各当事者は、開示された機密情報を、本件業務以外の目的のためにやむをえず、当事者以外の者（以下、「二次受領者」という）に開示する必要のある場合は、相手方当事者の事前の文書に
                                                よる承認を得て、かつ本契約と同様の機密保持義務を課した場合に限り、開示することができるものとする。 その場合、開示当事者は当該二次受領者による機密情報の開示、
                                                漏洩及び目的外使用について、総ての責任を負うものとする。
                                                各当事者は機密情報を自己の情報と物理的に隔離し、施錠された空間に保管するものとする。
                                            </div>
                                        </div>
                                    
                                        <div class="pdf-container__pdf__main__Paragraph4">
                                            <div>（限定保証）</div>
                                            <div>
                                                各当事者は、故意に不正確又は不完全な機密情報を相手方に開示した場合を除いて、相手方による機密情報の利用結果には一切の責任を負わないものとする。
                                                各当事者は、不正確又は不完全な機密情報を提供しないように注意を払うものとするが、当該機密情報の正確性及び完全性について保証しないものとする。
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- submitボタン -->
        <!-- <div class="submit-btn-container">
            <a href="" class="button submit-btn-container__button">提出</a>
        </div> -->
    </div>
</div>
@endsection

@section('pdf-js')
    <script src="{{ asset('js/pdf.js') }}" defer></script>
@endsection
