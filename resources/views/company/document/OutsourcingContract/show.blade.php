@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/outsourcingContract/show.css') }}">
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="{{ asset('images/icon_small-down.png') }}" alt="">
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
            <a href="/company/dashboard">
                <div class="menu__container--label">
                    <div class="menu-label">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                </div>
            </a>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_home.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_dashboard.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_inbox.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_products.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_invoices.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_customers.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_help-center.png') }}" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general" class="isActive">
                        <div class="icon-imgbox">
                            <img src="{{ asset('images/icon_setting-active.png') }}" alt="">
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
                    <div class="page-title-container__page-title">業務委託契約書</div>
                </div>
                <!-- printボタン -->
                <div class="head-container__wrapper__print-btn-container">
                    <a id="print_btn" class="button head-container__wrapper__print-btn-container__button">プリント</a>
                </div>
            </div>
        </div>
        
        <div class="main-container">
            <div class="main-container__wrapper">
                <!-- pdf -->
                <div id="print" class="A4 landscape shrink">
                    <div class="outsourcing-container">
                        <div class="outsourcing-container__wrapper">
                            <div class="pdf-container sheet">
                                <div class="pdf-container__pdf sheet padding-10mm">
                                    <div class="pdf-container__pdf__contract-type">業務委託契約書</div>

                                        <div class="cp_box">
                                            <input id="cp01" type="checkbox">
                                            <label for="cp01"></label>
                                            <div class="cp_container">

                                            <div class="pdf-container__pdf__main">
                                        
                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>
                                                    株式会社◯◯◯◯◯（以下、甲という）と＿＿　　　　　（以下、乙という）とは、甲が乙に委託する業務に関し次の条項により基本契約(以下｢本契約｣という。)を締結し、信義に従って誠実にこれを履行するものとする。
                                                    </div>
                                                </div>
                                            
                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第１条　（総則）</div>
                                                    <div>
                                                    本契約は、甲が第2条に定める業務の委託(以下｢委託業務｣という。)に関し、別に締結する個別の契約(以下｢個別契約｣という。)について基本となる事項を定める。乙は、委託業務に関し、本契約書、個別契約の業務委託書及び業務委託書に従いこれを履行しなければならない。
                                                    </div>
                                                </div>
                                            
                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第２条　(委託業務内容)</div>
                                                    <div>
                                                    本契約及び個別契約に基づき、甲が乙に発注する業務は次のとおりとする。
                                                    獣医師教育システムの開発業務。またこれに付随するドキュメント類の作成業務。
                                                    </div>
                                                </div>
                                            
                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第３条　(個別契約)</div>
                                                    <div>
                                                    １　　個別契約は、甲が乙に業務委託書を交付し、乙が甲に業務受託書を発行し甲がこれを受領することにより成立するものとする。<br>
                                                    ２　　業務委託の内容、成果物、委託料その他個別契約の締結に必要な事項は、業務委託書、業務受託書ならびにこれらに付随する資料に明示するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第４条　(基本契約と個別契約)</div>
                                                    <div>
                                                    個別契約において本契約と異なる定めをした場合は、その定めが優先的に適用されるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第５条　(業務内容の変更)</div>
                                                    <div>
                                                    甲は、個別契約成立後といえども、委託業務の内容の全部または一部を変更あるいは追加することができる。ただし、これにより個別契約を変更する必要が生じた場合には、甲乙協議のうえ変更するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第６条　(再委託の禁止)</div>
                                                    <div>
                                                    乙は、本契約に基づく委託業務を第三者に委託してはならない。ただし、事前に甲から書面による承諾を得た場合はこの限りではない。<br>
                                                    乙は、当該第三者に関して要求する書類、資料等を速やかに提出するとともに、当該第三者に委託した業務について監督指導するものとする。<br>
                                                    乙が第1項の規定により甲の承諾を得て委託業務を第三者に委託した場合においても、乙は本契約に基づく義務を免れるものではなく、甲は当該第三者の行為をすべて乙の行為と見なし、乙に対し本契約上の責を問うことができる。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第７条　(権利義務の譲渡の禁止)</div>
                                                    <div>
                                                    乙は、本契約または個別契約によって生ずる権利または義務を、第三者に譲渡し継承させまたは担保の目的に供することが出来ない。ただし、事前に甲と協議の上書面による承諾を得た場合はこの限りではない。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第８条　(機密保持)</div>
                                                    <div>
                                                    乙は、本契約により機密保持の対象とされた資料及び、情報及び、財産(以下｢機密｣という。)を業務委託契約の履行のためにのみ使用し、事前に甲から書面による承諾がない限り、これを複写、複製、販売、公表、その他第三者への開示を行わないものとする。<br>
                                                    乙は、機密を保管する場合は乙の事業所内の施錠可能な施設を用いて行うものとし、当該施設外に搬出する時は紛失、盗難等の事故を回避するために細心の注意を払うものとする。<br>
                                                    第6条に基づき乙が第三者に委託業務を再委託するときは、当該第三者との間に本契約に定める内容と同様の機密保持に関する契約を締結するほか、本契約での機密保持の主旨が阻害されないよう細心の注意を払うものとする。<br>
                                                    本契約が終了した場合でも、本条に規定する機密保持は、本契約から将来に渡り効力を有するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第９条　(機密保持の対象)</div>
                                                    <div>
                                                    前条の機密の対象は次のとおりとする。<br>
                                                    個別契約に基づき甲から乙へ貸与される物品、その他乙が委託業務を遂行するために甲から提供または開示された資料及び、情報及び、財産。<br>
                                                    (2)甲乙間で行われた打合せ等で乙が知り得た甲の営業、財務、人事、技術、事務手続、顧客についての資料及び、情報及び、財産。<br>
                                                    (3)業務委託契約が締結されていることの事実及び業務委託契約の内容。<br>
                                                    (4)個別契約に基づき開発及び、分析及び、構築されたシステム等の内容。<br>
                                                    前項に関わらず、すでに公表されている資料または情報、乙が第三者から適法に入手した資料または情報、事前に甲から書面による承諾を得た資料または情報は、機密の対象とはしないものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第10条　(機密保持に関する担当者の届出)</div>
                                                    <div>
                                                    甲は、業務委託契約が甲にとって重要な機密に関わるものである場合は、乙に対し当該委託業務に携わる乙の担当者のすべての氏名及び所属を記載した書面の提出を求めることができるものとする。<br>
                                                    乙は、前項に基づき書面の提出を求められた場合は速やかにこれに応ずるとともに、担当者の変更があった場合は直ちにその旨を甲に報告するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第11条　(損害の補填等)</div>
                                                    <div>
                                                    乙または乙の役職員、その他の乙の関係者が、万一機密を漏洩または悪用し、これにより甲に損害が生じた場合は、乙はただちにその原因を究明のうえ今後の対策を甲に報告するとともに、甲が蒙った損害の補填について本契約および法令の定めるところにより、速やかに誠意を持って対処するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第12条　（事業主の責任）</div>
                                                    <div>
                                                    乙は、甲に対し委託業務に関する作業上の全責任を負うとともに、事業主としての財政上及び法律上の責任を負う。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第13条　(業務遂行場所等)</div>
                                                    <div>
                                                    乙は、委託業務の遂行を乙の事業所内で行うものとする。ただし、機密保持または業務遂行上の必要から甲の事業所内で行うこともできるものとし、個別契約締結時に甲乙協議のうえいずれかに決定するものとする。<br>
                                                    乙は、甲の事業所で作業を行う場合、乙の就業規則の範囲において、甲の定める諸規則を遵守するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第14条（非常時の協力義務）</div>
                                                    <div>
                                                    乙が甲の事業所内で委託業務の遂行中に火災等の非常事態が発生したときは、乙は甲に協力して乙の使用する機器、資料等の損害を最小限に止めるよう努力しなければならない。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第15条　（要員の指揮命令）</div>
                                                    <div>
                                                    委託業務の遂行にあたり、乙は、乙の作業従事者に対する業務遂行に関する指示、労務管理、安全衛生等に関わる一切の指揮命令を行うものとする。<br>
                                                    乙は、前項の規定に基づき乙の作業従事者に対する指揮監督の任にあたる監督責任者を任命し、個別契約ごとに明示するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第16条　（要員の管理）</div>
                                                    <div>
                                                    乙の要員が甲の事業所内で作業する場合は、乙は委託業務を担当する乙の要員の品位の保持に努めるとともに、使用者として法律に定められたすべての義務を負うものとする。<br>
                                                    乙は、乙の要員がこの契約に定める事項ならびに甲の職場秩序を遵守するよう指揮監督し管理する義務を負うものとし、監督責任者をしてその人にあたらせるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第17条　（原票、資料、機器等の提供）</div>
                                                    <div>
                                                    甲は、乙が業務の完成のために必要とする原票、資料、材料、電子計算機組織などについて、乙より提供の要請があり甲が必要性を認めた場合には、別途双務契約を締結の上、乙へ貸与提供するものとする。<br>
                                                    乙が甲の事業所内で作業をする場合、必要があれば乙は甲に対して什器、備品、通信施設などの使用を要請する事ができる。<br>
                                                    前2項に定めるもののほか乙が業務を完成させるために必要な情報などについて、甲は可能な限り乙の便宜をはかるものとする。<br>
                                                    乙は、前3項により提供を受けた原票、情報等を委託業務遂行のためにのみ使用し、他の目的に使用してはならない。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第18条　(提供品の保管、返還)</div>
                                                    <div>
                                                    乙は、前条により貸与提供された原票、資料等(以下｢貸与品｣という。)を善良なる管理者の注意をもって使用保管するものとする。<br>
                                                    乙は、貸与品が委託業務の遂行のうえで不要になった場合、委託業務が完了した場合または甲の請求があった場合には、甲の指定する期限までに甲に返却するものとし、万一貸与品を汚損、破損または紛失した場合、甲の請求に従い、損害賠償の責を負うものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第19条　（作業状況の報告）</div>
                                                    <div>
                                                    乙は、甲に対して委託業務の作業状況について随時報告を行うものとし、報告形態、頻度については、甲乙協議のうえこれを定めるものとする。<br>
                                                    甲は、必要があると認める場合には、甲からの委託業務に関わる範囲において、乙の作業場所における作業状況及び作業環境の検査、ならびに作業の実施に関わる指示を行うことができるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第20条　(事故等の報告)</div>
                                                    <div>
                                                    乙は、委託業務の遂行に支障を生ずるおそれのある事故等の発生を知ったときは、その事故等発生の帰責の如何にかかわらず、直ちにその旨を甲に報告し、甲の指示するところにより必要な処置をとるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第21条　（検査）</div>
                                                    <div>
                                                    乙は、委託業務を完成した場合には、遅滞なく甲に業務完了報告書および成果物を納入し、甲の検査を受けるものとする。<br>
                                                    甲は、前項に定める検査を別途定める検査期限までに実施するものとし、必要があれば乙の立会いを求めることができるものとする。前2項による検査に合格したときをもって乙から甲への成果物の納品を完了したものとみなす。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第22条　（再検査）</div>
                                                    <div>
                                                    乙は、前条に定めた検査の結果、乙の責による不合格のものがあった場合は、検査期限内または甲の指定する期限内に、甲の指示に基づき成果物を修正のうえ納入し、甲の再検査を受けなければならない。再検査の手続および成果物の納品完了については、前条の定めによるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第23条　(納入期限の変更)</div>
                                                    <div>
                                                    甲乙双方またはいずれかのやむをえざる事由により成果物の納入期限の変更が必要となった場合には、甲乙協議してこれを変更することができるものとする。<br>
                                                    乙は、天災その他不可抗力により納入期限までに成果物を納入することが困難になったときは、甲に対して納入期限の延長を求めることができるものとする。<br>
                                                    甲は、前項の定めによる乙の求めに対して正当と認めた場合には、納入期限を延長するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第24条　（説明会の開催）</div>
                                                    <div>
                                                    甲は、必要があると認める場合には、成果物の納品完了前に、その成果物に関する説明会の開催を求めることができるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第25条　(成果物の譲渡禁止)</div>
                                                    <div>
                                                    乙は、成果物の全部または一部もしくは委託業務遂行の過程で取得した発明、考案等に関する工業所有権を受ける権利、著作権その他一切の権利、技術情報等(以下｢成果物等｣という。)を甲以外の第三者に提供または譲渡してはならない。ただし、事前に甲と協議のうえ書面による承諾を得た場合はこの限りではないものとする。<br>
                                                    前項により、乙が成果物等を有償で第三者に提供または譲渡する場合は、乙は甲に対し、成果物等を第三者に提供または譲渡する価額にその都度甲乙協議して定める比率を乗じた価額を支払うものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第26条　（成果物等に関する権利の帰属）</div>
                                                    <div>成果物等についての所有権および著作権(著作権法第21条から第28条に定めるすべての権利を含む)ならびに委託業務の遂行の過程においてなされた発明、考案、意匠の創作、著作に関する工業所有権を受ける権利、著作権等の一切の権利は、甲より乙に当該委託業務の委託料が完済されると同時に甲に無償で譲渡される。<br>
                                                    乙は、甲からの請求があるときは、甲に対し、成果物たるプログラムに関し、権利移転のための登録手続を行う。この場合、登録手続に要する費用は甲が負担する。<br>
                                                    乙は、甲が成果物等について、その使用のために改変し、また、甲または甲の指定する者の名をもって著作権表示することを認める。<br>
                                                    乙は、著作者人格権を主張しないものとする。<br>
                                                    乙の要員に著作者人格権が認められる場合、乙は当該要員が著作者人格権を主張しないよう必要な措置を講じなければならない。甲は、必要があると認める場合には、成果物の納品完了前に、その成果物に関する説明会の開催を求めることができるものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第27条　(著作権等に関する保証)</div>
                                                    <div>
                                                    乙は、成果物が第三者の著作権その他の権利を侵害していないことを保証する。ただし、甲の責に帰すべき事由に起因して第三者に対する権利侵害となる場合はこの限りではない。<br>
                                                    乙は、成果物等について第三者の著作権その他の権利を侵害していないことを証するために著作者、著作物完成の日、著作者と乙の関係、著作権取得の経緯等を示す資料を保存し、甲から請求があった場合これを開示または交付しなければならない。成果物等にかかる権利に関し第三者との間に紛争が生じた場合、乙はその費用と責任においてこれを解決する。ただし、第1項ただし書きの場合は、甲は、その費用と責任においてこれを解決する。<br>
                                                    甲または乙は、成果物等にかかる権利に関し第三者との間に紛争が生じた場合、直ちに相手方に通知しなければならない。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第28条　(成果物の使用に関する保証)</div>
                                                    <div>
                                                    乙は、成果物が甲に承認を受ける仕様書のとおり作成されることを保証する。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第29条　（瑕疵担保責任）</div>
                                                    <div>
                                                    乙は、第21条の納品完了後12ヶ月間に発生または発見された、乙の責による成果物の瑕疵について、甲の指示に従い、自己の費用負担と責任において速やかにその瑕疵ならびに瑕疵によって生じた書類等の過誤を修補し、甲の検査を受けなければならない。ただし、乙の行う修補は甲の損害賠償請求権の行使を妨げないものとする。<br>
                                                    乙は、前項に定める成果物の瑕疵以外の瑕疵については、甲の指示に従い、有償で速やかにこれを修補するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第30条　(委託料金の支払)</div>
                                                    <div>
                                                    甲は、期間契約および派遣契約については、当月末日までに検査合格したものについて、土曜、日曜、祝祭日を除く翌月第14営業日までに｢稼動実績確認通知書｣を乙に送付(メール等)する。<br>
                                                    乙は、｢稼動実績確認通知書｣を受領後5日以内に甲に対し書面による意義申入れをしない場合、甲に委託料金を請求するものとする。<br>
                                                    乙は、一括契約で納品物件があるものについては、｢業務完了報告書兼検収書｣に必要事項を記入の上、納品物件と同時に甲に提出するものとする。<br>
                                                    また、納品物件がないものについては、｢作業実績報告書兼確認書｣に必要事項を記入の上、甲に提出するものとする。<br>
                                                    甲は、｢業務完了報告書兼検収書｣または｢作業実績報告書兼確認書｣の内容を確認し、検査合格の場合には、検収(確認)印を捺印し、写しを乙に返送する。乙は、写しを受領後甲に委託料金を請求するものとする。<br>
                                                    乙は、甲に対して別紙「支払条件条項」記載の支払日より5営業日前以内に請求書を発行するものとする。<br>
                                                    甲は、検収月の25日までに委託料金を、別に指定する乙名義の銀行口座に振込みにより支払うものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第31条　（契約の解除）</div>
                                                    <div>
                                                    甲乙いずれか一方に次の事由の一があった場合には、なんらの催告なしに直ちにこの契約または個別契約の全部または一部を解除できるものとする。なお、これにより相手方に対する損害賠償の請求を妨げない。<br>
                                                    甲または乙が、本契約もしくは個別契約に違反した場合。<br>
                                                    乙が、契約の履行を遅延した場合。<br>
                                                    乙について、破産、和議開始、会社更生手続開始、会社整理開始もしくは特別清算開始の申し立てがあった場合。<br>
                                                    乙がその財産につき、仮差押え、仮処分、強制執行等を受けた場合。<br>
                                                    乙について、支払の停止、銀行取引停止処分、その他信用状態の著しい悪化を示す事実が生じた場合。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第32条　(損害賠償)</div>
                                                    <div>
                                                    甲または乙は、相手方が本契約または個別契約に違反したため損害を受けた場合、当該個別契約の委託料を限度とし相手方に損害の賠償を請求することができる。<br>
                                                    甲または乙は、前条により本契約または個別契約を解除したために損害を受けた場合、直接甲または乙が被った損害を範囲として前条各号の事由が生じた相手方に損害の賠償を請求することができる。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第33条　(契約終了後の措置)</div>
                                                    <div>
                                                    本契約が失効または解除された場合においても、その時点で未了の委託業務がある場合、本契約および当該委託業務に関する個別契約は、その終了のときまでなお効力を有するものとする。<br>
                                                    第8条、第9条、第10条、第11条(機密保持に関する条項)、第26条(成果物等に関する権利の帰属)、第27条(著作権等に関する保証)、第29条(瑕疵担保責任)の規定は本契約の失効または解除後も、なお効力を有するものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第34条　(管轄裁判所)</div>
                                                    <div>
                                                    この契約または個別契約に関して、争訟が生じた場合には、甲の本店所在地を所轄する裁判所をもって第一審の専属管轄裁判所とするものとする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第35条　(契約の有効期間)</div>
                                                    <div>
                                                    本契約の有効期間は、本契約の締結日より1年間とする。ただし、期間満了の１ヶ月前までに契約当事者が相手方に対し文書による特段の意思表示のない限り、本契約は同一条件で更に1年間更新されるものとし、以後も同様とする。
                                                    </div>
                                                </div>

                                                <div class="pdf-container__pdf__main__Paragraph">
                                                    <div>第36条　(協議)</div>
                                                    <div>
                                                    本契約または個別契約に定めなき事項および解釈の疑義については、その都度甲乙協議してこれを定めるものとする。<br>
                                                    本契約の成立を証するため、本契約書２通を作成し、甲乙記名押印の上、各々1通を保有するものとする。
                                                    </div>
                                                </div>

                                                <p class="date">2019年  5月  13日</p>

                                                <dl>
                                                    <dt>甲</dt>
                                                    <dd>
                                                        東京都港区南麻布4-10-22-麻布マンション103<br>
                                                        辻　佳佑　　　印
                                                    </dd>
                                                </dl>

                                                <dl>
                                                    <dt>乙</dt>
                                                    <dd>
                                                        東京都港区元麻布3-12−26c-MA2元麻布103<br>
                                                        株式会社HUMO 代表取締役　永瀬　達也　　　印
                                                    </dd>
                                                </dl>
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
