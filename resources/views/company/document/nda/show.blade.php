@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/nda/show.css') }}">
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    impro
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
                <li>
					<form method="POST" action="{{ route('company.logout') }}">
						@csrf
						<button type="submit">ログアウト</button>
					</form>
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
                    <a @click="download()" class="button head-container__wrapper__print-btn-container__button">Print</a>
                </div>
            </div>
        </div>
        
        <div class="main-container">
            <div class="main-container__wrapper">
                <!-- pdf -->
                <div id="print" class="A4 landscape">
                    <div class="secrecy-container">
                        <div class="secrecy-container__wrapper">
                            <div class="pdf-container sheet">
                                <div class="pdf-container__pdf">
                                    <div class="pdf-container__pdf__contract-type">機密保持契約書</div>

                                    <div class="pdf-container__pdf__main">
                                        {{ explode('-', explode(' ', $nda->created_at)[0])[0] }}年
                                        {{ explode('-', explode(' ', $nda->created_at)[0])[1] }}月
                                        {{ explode('-', explode(' ', $nda->created_at)[0])[2] }}日
                                        
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
        <div class="submit-btn-container">
            <a href="" class="button submit-btn-container__button">提出</a>
        </div>
    </div>
</div>
@endsection