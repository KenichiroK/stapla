@extends('index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/auth/initialRegister/terms.css') }}">
@endsection

@section('content')
<main>
    <div class="main-wrapper">
        <div class="terms-title">
            <h3>ご利用規約</h3>
            <p>法律上ご利用規約を最後までお読みいただき、合意することが義務付けられています。<br/>
                大変お手数ですが最後までお読みいただいてからサービスを開始してください。
            </p>
        </div>

        <div id="terms" class="terms-box-wrapper">
            <div class="terms-box-inner">
                <p class="terms-box-inner-title">impro登録企業利用規約</p>
                <p>
                株式会社HUMO（以下「当社」といいます。）は、登録企業（本サービスに登録された企業をいいます。以下同じ。）と、登録企業から一定の業務を委託する個人又は法人の受託者（以下「パートナー」といいます。）との間の業務委託に関するマネジメントプラットフォームである「impro」（以下「本サービス」といいます。）について、以下のとおり、登録企業向けの利用規約（以下「本規約」といいます。）を定めます。
                </p>

                <p class="sub-title">第1条　本規約の適用</p>
                <p>本規約は、本サービスの利用に関して当社と登録企業の間の権利義務関係を定めることを目的とし、当社と登録企業の間の本サービスの利用に係る一切の関係に適用されます。</p>

                <p class="sub-title">第2条　サービス概要</p>
                <p>1.	本サービスは、登録企業とパートナーとの間における業務委託に関する事務処理のマネジメントを行うプラットフォームをいいます。<br/>
                &emsp;当社は、登録企業とパートナーとの間で契約締結、請求書発行等の事務処理等を行う場・機会を提供するにとどまり、両者の業務委託に関して<br/>
                &emsp;は、すべて登録企業とパートナー間の自己責任とします。業務の依頼、遂行、品質等に関して万一トラブルが発生した場合、登録企業とパートナ<br/>
                &emsp;ーの間で一切の解決を図るものとし、当社に何らの負担・迷惑をかけないものとします。</p>
                <p>2.	本サービスにおいて登録企業が利用できるサービスは下記のとおりです。</p>
                <p>&emsp;①	業務委託契約書、秘密保持契約書等に係るパートナーとの連絡、交渉、締結等</p>
                <p>&emsp;②	業務の発注、履行、納入までのパートナーとの一連の連絡等</p>
                <p>&emsp;③	パートナー評価システムの利用</p>
                <p>&emsp;④	パートナーのプロフィールの閲覧等</p>

                <p class="sub-title">第3条　企業登録</p>
                <p>1.	本サービスへの登録を希望する企業は、あらかじめ本規約の全文を読み、その内容に同意した上で、所定の登録フォームに必要情報を入力し、本<br/>
                &emsp;サービスの登録企業ID及びパスワード（以下「アカウント情報」といいます。）の発行をお申込みいただく必要があります。なお、貴社の担当者<br/>
                &emsp;がお申込みをされた場合、本サービスへの申込みを行う正当な権限を有する者であるとみなし、貴社からの正式な申込みと取り扱います。</p>
                <p>2.	当社は、前項に基づく申込みを受けた場合、当社の基準に従って登録の可否の審査し、本サービスへの登録を認めた企業に対して、アカウント情<br/>
                &emsp;報の発行にかかる情報が記載された登録完了通知を電子的方法により送付します。企業が登録完了通知を受領することにより、本サービスへの企<br/>
                &emsp;業登録の手続が完了し、当社と登録企業との間で、本規約の内容に基づく契約（以下「本契約」といいます。）が成立するものとします</p>
                <p>3.	登録企業は、登録情報に変更があった場合、当社の定める方法により、変更の内容を当社に遅滞なく通知するものとします。</p>

                <p class="sub-title">第4条　アカウント情報の管理</p>
                <p>1.	登録企業は、自らの責任において、アカウント情報を適切に管理及び保管するものとし、これを第三者に利用させ又は貸与、譲渡、名義変更、売<br/>
                &emsp;買等してはならないものとします。</p>
                <p>2.	登録企業は、アカウント情報の管理不十分、使用上の過誤、第三者の使用等により発生した損害について自ら責任を負うものとし、これらが第三<br/>
                &emsp;者によって不正に使用されていることが判明した場合には、速やかに当社に連絡するものとします。</p>
                <p>3.	アカウント情報が不正に利用された場合であっても、当社は、当該利用により発生した一切の損害等につき何らの責任も負わないものとします。<br/>
                &emsp;但し、かかる不正利用が当社の責めに帰すべき事由による場合はこの限りではありません。</p>

                <p class="sub-title">第5条　利用期間及び利用料</p>
                <p>1.	登録企業は、本サービスの利用の対価として、当社に対し本サービスの利用料を支払うものとします。利用料の金額、並びに利用料の発生時期及<br/>
                &emsp;び支払方法については、当社が別途定める内容（http:www.xxx.co.jp/）によります。</p>
                <p>2.	当社は、本サービスの内容の変更その他の事情により、登録企業に通知することで、本サービスの利用料を変更することができるものとします</p>

                <p class="sub-title">第6条　知的財産権の帰属</p>
                <p>本サービスを提供するシステム（以下「本システム」といいます。）に含まれるコンテンツ（文章、図表、画像、写真、映像、音声、プログラム等）の商標・特許・著作権・営業秘密・ノウハウ及び他のいかなる知的財産権に基づく権利（以下「知的財産権等」といいます。）は、当社又は当社にその利用を許諾した権利者に帰属しています。パートナーは、本システムの利用により、明示、黙示を問わず、知的財産権等の複製、改変、翻案等の実施をすることはできません。</p>

                <p class="sub-title">第7条　商標等の利用</p>
                <p>1.	登録企業は当社に対し、当社が本サービスを提供する目的の範囲内において、登録企業に帰属する名称、標章、商標もしくは登録企業が指定した<br/>
                &emsp;情報等の使用を無償で許諾するものとします。</p>
                <p>2.	本システムに掲載される商標及びロゴマーク等に関する権利は、当社又は個々の権利者に帰属し、商標法、不正競争防止法等により保護されてい<br/>
                &emsp;ます。登録企業が上記権利の利用を希望する場合、事前に当社に連絡し、当社の承諾を得た場合にのみ利用できるものとします。</p>

                <p class="sub-title">第8条　禁止事項</p>
                <p>登録企業は、本サービスの利用にあたり、以下の各号のいずれかに該当する又は該当すると当社が判断する行為をしてはなりません。登録企業は、本条に違反した場合に、事前の通知なく、本サービスの利用を停止される場合があることにあらかじめ同意します。</p>
                <p>&emsp;(1)	法令（下請代金支払遅延等防止法を含みますが、これに限りません。）に違反する行為又は犯罪行為に関連する行為</p>
                <p>&emsp;(2)	公序良俗に反する行為</p>
                <p>&emsp;(3)	当社、本サービスの他の登録企業、パートナー又はその他の第三者に対する詐欺又は脅迫行為</p>
                <p>&emsp;(4)	当社、他の登録企業、パートナー又はその他の第三者の財産権（知的財産権を含む）、プライバシー権、名誉権、その他の権利もしくは利益を<br/>
                &emsp;&emsp;&ensp;侵害する行為、又は誹謗中傷その他不利益を与える行為</p>
                <p>&emsp;(5)	虚偽の情報を故意に登録する行為</p>
                <p>&emsp;(6)	本サービスに関して情報を改竄する行為、有害なコンピュータプログラム等を送信又は書き込む行為</p>
                <p>&emsp;(7)	本サービスのネットワーク又は本システム等に過度な負荷をかける行為</p>
                <p>&emsp;(8)	当社のネットワーク又は本システム等に不正にアクセスし、又は不正なアクセスを試みる行為</p>
                <p>&emsp;(9)	第三者に成りすます行為、又は他の登録企業のアカウント情報を利用する行為</p>
                <p>&emsp;(10)	本サービスの運営を妨害するおそれのある行為（過去に当社との契約に違反した者又はその関係者による本サービスの利用行為を含みます<br/>
                &emsp;&emsp;&emsp;が、これに限りません。）</p>
                <p>&emsp;(11)	その他、当社が前各号に準じて不適切と判断する行為</p>

                <p class="sub-title">第9条　利用期間及び中途解約</p>
                <p>1.	本サービスは、契約成立日から1年間（以下「利用期間」といいます。）利用することができます。ただし、利用期間終了日の1ヶ月前までに契約<br/>
                &emsp;終了の申出が書面又は電子的方法により当社になされなかった場合、本サービスの契約は同一条件で1年間更新されるものとし、以後も同様としま<br/>
                &emsp;す。</p>
                <p>2.	前項の規定にかかわらず、登録企業は、利用期間中においても、1か月前までに所定の退会フォームから当社に退会の申し出をすることにより、本<br/>
                &emsp;契約を中途解約し、本サービスから退会することができます。この場合、登録企業が当社に負っている一切の債務については、退会日に当然に期<br/>
                &emsp;限の利益を喪失するものとし、登録企業は、直ちに当該債務を当社に支払わなければなりません。</p>

                <p class="sub-title">第10条　当社による解除</p>
                <p>1.	当社は、登録企業が以下の各号のいずれかに該当した場合、何らの催告なしに、本契約を解除し、その店舗登録を抹消することができるものとし<br/>
                &emsp;ます。なお、本条の規定は、登録企業に対する損害賠償請求を妨げるものではありません。</p>
                <p>&emsp;(1)	本契約上の義務に違反したとき</p>
                <p>&emsp;(2)	振り出した手形又は小切手を不渡りとし又は支払を停止したとき</p>
                <p>&emsp;(3)	第三者より差押、仮差押、仮処分、競売、強制執行の申立て又は公租公課の延滞処分を受けたとき</p>
                <p>&emsp;(4)	破産手続、民事再生手続、会社更生手続又は特別清算手続の申立てを受け又は自らこれを申し立てたとき</p>
                <p>&emsp;(5)	監督官庁から営業の取消、停止等の処分を受けたとき</p>
                <p>&emsp;(6)	資産、信用又は事業に重大な変化が生じ、本契約に基づく債務の履行が困難になるおそれがあると当社が判断したとき</p>
                <p>&emsp;(7)	登録企業が、反社会的勢力（暴力団、暴力団員、暴力団員でなくなった時から5年を経過しない者、暴力団準構成員、暴力団関係企業、総会屋<br/>
                &emsp;&emsp;&ensp;等、社会運動標榜ゴロ、特殊知能暴力集団等又はこれらに準じる者をいいます。以下同じ。）に該当する場合、その経営に反社会的勢力が実質<br/>
                &emsp;&emsp;&ensp;的に関与していると認められる場合、反社会的勢力を利用していると認められる場合、反社会的勢力に対して資金等を提供しもしくは便宜を供<br/>
                &emsp;&emsp;&ensp;与するなどの関与をしていると認められる場合、又は、反社会的勢力と社会的に非難されるべき関係を有している場合</p>
                <p>&emsp;(8)	自ら又は第三者を利用して、以下のいずれかに該当する行為を行ったとき</p>
                <p>&emsp;&emsp;①	暴力的な要求行為</p>
                <p>&emsp;&emsp;②	法的な責任を超えた不当な要求行為</p>
                <p>&emsp;&emsp;③	取引に関して、脅迫的な言動をし、又は暴力を用いる行為</p>
                <p>&emsp;&emsp;④	風説を流布し、偽計を用いもしくは威力を用いて相手方の信用を毀損し、又は相手方の業務を妨害する行為</p>
                <p>2.	当社は、前項各号の規定にかかわらず、当社の判断により本契約の継続が困難と認めたときは、登録企業に対し、書面又は電子的方法により通知<br/>
                &emsp;の上、本契約を解除し、その登録を抹消することができるものとします。</p>
                <p class="sub-title">第11条　本サービスの変更・停止等</p>
                <p>1.	当社は、当社の都合により、本サービスの内容を変更し、又は本サービスの提供を終了することができます。本サービスの提供を終了する場合、<br/>
                &emsp;当社は登録企業に対して事前に通知するものとします。</p>
                <p>2.	本サービスの運営上やむをえない事由（ソフトウェア等の点検・修理・補修、コンピュータ・通信回線等の事故を含みますが、これらに限られま<br/>
                &emsp;せん。）が生じた場合、当社は、事前又は事後速やかに通知をして、本サービスを一時停止することができます。</p>
                <p>3.	登録企業は、本条に基づく本サービスの変更、終了及び停止についてあらかじめ同意するものとし、これにより登録企業に生じた損害について、<br/>
                &emsp;当社に一切の負担及び責任を問わないものとします。</p>

                <p class="sub-title">第12条　免責</p>
                <p>1.	本サービスの利用は、登録企業の判断及び責任において行われるものとし、当社は、登録企業が本サー<br/>
                &emsp;ビスを利用したこと、パートナーの本サービスの利用態様、登録企業とパートナー又は<br/>
                &emsp;第三者との間に生じた一切の紛争に関連して登録企業又は第三者に生じた損害について、その理由の如何を問わず、一切の責任を負いません。<br/>
                &emsp;但し、当社の故意または重大な過失により生じた損害については、この限りではありません。</p>
                <p>2.	当社は、通信障害等による本システムの中断、中止、本システム上のデータの消失やデータへの不正アクセスにより生じた損害、その他本サービ<br/>
                &emsp;スに関して登録企業に生じた損害について、一切責任を負わないものとします。</p>
                <p>3.	当社は本システムに不具合がないこと、本システム上のサーバ等にウイルス等の有害な要素が含まれていないこと、その他本サービス提供のため<br/>
                &emsp;のインフラ、システム等に瑕疵がないこと等につき保証するものではありません。</p>
                <p>4.	当社は、登録企業に提供する情報のうち、パートナー等の第三者に関する情報、その他第三者より提供される情報内容の正確性につき保証するも<br/>
                &emsp;のではありません。</p>
                <p>5.	本サービスに関連して、何らかの理由により当社が登録企業に対して責任を負う場合であっても、当社は、過去6か月間に登録企業が当社に支払っ<br/>
                &emsp;た利用料の総額を超えて賠償する責任を負わないものとし、また、付随的損害、間接損害、特別損害、将来の損害及び逸失利益に関する損害につ<br/>
                &emsp;いては賠償する責任を負わないものとします。</p>

                <p class="sub-title">第13条　損害賠償</p>
                <p>登録企業は、本サービスに関連して、自ら又は自らの従業員の責に帰すべき事由により、当社に損害を与えた場合には、その一切の損害（弁護士費用を含みます。）を賠償するものとします。</p>

                <p class="sub-title">第14条　本規約の変更</p>
                <p>当社は、登録企業に対して事前に通知する（本サービスにかかるサイト上での告知その他当社が適当と認める方法を含みます。）ことにより、本規約を改定できるものとします。変更内容の通知後、登録企業が本サービスを利用した場合又は当社の定める期間内に登録抹消の手続をとらなかった場合には、登録企業は、本規約の変更に同意したものとみなされます。当社は、本規約の変更により登録企業に生じたすべての損害について一切の責任を負いません。</p>

                <p class="sub-title">第15条　通知</p>
                <p>本規約に基づく通知については、本規約上に別段の定めがない限り、登録企業が登録したメールアドレスに宛てて行うものとし、別段の異議がない限り通知日をもって登録企業が当該通知の内容に同意したものとみなします。</p>

                <p class="sub-title">第16条　契約上の地位の譲渡</p>
                <p>1.	登録企業は、当社の事前の書面による承諾なく、本契約により生じる権利及び義務又は本契約上の当事者たる地位を、第三者に対し、譲渡、移<br/>
                &emsp;転、担保設定、その他の処分をすることはできません。</p>
                <p>2.	当社は、本サービスに係る事業を他社に譲渡した場合（会社法に基づく事業譲渡に限らず、方式を問わず、事業が移転する一切の場合を含みま<br/>
                &emsp;す。）には、当該事業譲渡に伴い、本契約により生じる権利ならびに義務又は本契約上の当事者たる地位、ならびに登録企業の登録情報その他の<br/>
                &emsp;顧客情報を事業譲渡の譲受人に譲渡することができるものとし、登録企業は、かかる譲渡につきあらかじめ同意したものとします。</p>

                <p class="sub-title">第17条　個人情報の取扱い</p>
                <p>1.	当社は、パートナーの個人情報（氏名、メールアドレス等のほか、プロフィールや評価に関するデータを含みます。）を当社が別途定める「プラ<br/>
                &emsp;イバシーポリシー」に基づき、適切に管理するものとします。</p>
                <p>2.	登録企業は、パートナーの個人情報を、個人情報保護法及び登録企業において定めるプライバシーポリシー等の個人情報取扱いに関する指針に従<br/>
                &emsp;い、適切に管理するものとします。</p>

                <p class="sub-title">第18条　情報の抹消</p>
                <p>1.	当社は、本サービスを提供するために必要な期間が経過したと判断した場合、当社が保有するサーバ上に蓄積されている、登録企業と当社又はパ<br/>
                &emsp;ートナーとのやり取りに関する情報、及びパートナーの登録情報等を抹消することがあります。</p>
                <p>2.	登録企業は、前項に基づいて情報が抹消される場合があることについてあらかじめ同意し、かかる抹消によって自己に損害が発生しないために必<br/>
                &emsp;要な措置を、自己の責任と費用負担において講じるものとします。</p>

                <p class="sub-title">第19条　秘密保持</p>
                <p>当社及び登録企業は、本契約の有効期間中、相手方から開示された営業上又は技術上の一切の秘密情報及び個人情報（個人情報にはパートナーに関する情報及び評価に関するデータを含みます。その開示の方法を問わず、かかる秘密情報及び個人情報を以下「秘密情報」といいます。）につき、相手方の事前の書面又は電子メールによる同意を得ることなく、第三者（法令上の守秘義務を負った弁護士・公認会計士等のアドバイザーを除く。）に開示又は漏洩してはならず、また、本サービスの利用と関連する目的以外の目的で使用してはなりません。但し、以下のいずれかに該当する情報は秘密情報から除外されるものとします。</p>
                <p>&emsp;(1)	受領した時点で公知であった情報又は受領後にその責めによることなく公知となった情報</p>
                <p>&emsp;(2)	受領した時点で既に適法に保有していた情報</p>
                <p>&emsp;(3)	秘密保持についての義務を負っていない正当な権限を有する第三者から適法に取得した情報</p>
                <p>&emsp;(4)	秘密情報によらずに独自に開発した情報</p>

                <p class="sub-title">第20条　分離可能性</p>
                <p>本契約のいずれかの条項又はその一部が法令等により無効又は執行不能と判断された場合でも、本契約の残りの規定及び一部が無効又は執行不能と判断された規定の残りの部分は、継続して完全に効力を有します。</p>

                <p class="sub-title">第21条　準拠法及び裁判管轄</p>
                <p>本契約の準拠法は日本法とし、本契約に起因し又は関連する一切の紛争については、東京地方裁判所を第一審の専属的合意管轄裁判所とします。</p>

                <p class="sub-title">第22条　誠実協議</p>
                <p>本契約に定めのない事項又は各条項の解釈に疑義が生じた場合には、当社と登録企業が誠実に協議して解決するものとします。</p>

                <p>（制定）2020年1月31日</p>
            </div>
        </div>

        <form action="{{ route('company.register.terms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="agree-terms" type="checkbox" id="checkbox" name="is_agree" value=1>
            <label for="checkbox"> ご利用規約に同意する</label>

            <input type="hidden" name="companyUser_id" value="{{ $companyUser->id }}">
            <div class="btn-container">
                <button class="button" type="button" id="register_btn" onclick="submit();">登録</button>
            </div>
        </form>

        <div class="register-step">
            <div class="register-step-company-info">
                <p class="step1">Step1</p>
                <p class="company-info-title">情報登録</p>
            </div>

            <div class="register-step-bar"> </div>

            <div class="register-step-terms">
                <p class="step2">Step2</p>
                <p class="terms-title">ご利用規約</p>
            </div>
        </div>
    </div>
</main>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/company/initial-register/terms/index.js') }}"></script>
@endsection