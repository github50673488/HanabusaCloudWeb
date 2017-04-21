<div id="dataArea">
    <div id="divMsgOwner">
        <div id="divMsg" class="Message">施設空き状況 >> 施設情報入力 >> 宿泊空き状況 >> 宿泊情報入力 >> 利用者情報入力 >> <span style="color:#F00">申込確認</span> >> 申込完了</div>
    </div><!-- #divMsgOwner -->  
    <?php echo $Msg; ?>
    <?php echo form_open($baseUrl, array('id' => 'RoomDataForm', 'onkeydown' => 'if(event.keyCode==13){return false;}')); ?>
    <div id="divHallData">
        <div class="table9_3">
            <?php echo $hallListData; ?>
        </div>
        <div class="table9_3">
            <?php echo $roomListData; ?>
        </div>
        <div style="padding-bottom:15px; padding-top:15px; background-color:#FFF; font-size:36px;">
            <b>合計金額：<?php echo number_format($summary); ?>円(税込み)</b>
        </div>
        <div style="padding-bottom:10px; padding-top:10px; background-color:#FFF;">
            <table class="Userinfo">
                <caption style="color:#F00;font-size:18px;height:30px;">＜＜予約者情報＞＞</caption>
                <tr>
                    <td width="200" class="labelCol">会館を知った理由</td>
                    <td width="400" class="inputCol"><?php echo $FreeDs[2] ?></td>
                    <td width="200" class="labelCol">研修室前の表示名</td>
                    <td width="400" class="inputCol"><?php echo $ResvData->BeforeName; ?></td>
                </tr>
                <tr>
                    <td class="labelCol">団体名称</td>
                    <td class="inputCol"><?php echo $ResvData->GroupName; ?></td>
                    <td class="labelCol">団体カナ</td>
                    <td class="inputCol"><?php echo $ResvData->GroupKana; ?></td>
                </tr>
                <tr>
                    <td class="labelCol">代表者名</td>
                    <td class="inputCol"><?php echo $ResvData->Name; ?></td>
                    <td class="labelCol">代表者カナ</td>
                    <td class="inputCol"><?php echo $ResvData->Kana; ?></td>
                </tr>  
                <tr>
                    <td class="labelCol">電話</td>
                    <td class="inputCol"><?php echo $ResvData->Tel; ?></td>
                    <td class="labelCol">携帯電話</td>
                    <td class="inputCol"><?php echo $ResvData->PortableTel; ?></td>
                </tr>   
                <tr>
                    <td class="labelCol">Fax</td>
                    <td class="inputCol" colspan="3"><?php echo $ResvData->Fax; ?></td>
                </tr>  
                <tr>
                    <td class="labelCol">メール</td>
                    <td class="inputCol" colspan="3"><?php echo $ResvData->Mail; ?></td>
                </tr>      
                <tr>
                    <td class="labelCol">郵便番号</td>
                    <td class="inputCol" colspan="3"><?php echo $ResvData->ZipCode; ?></td>
                </tr>  
                <tr>
                    <td class="labelCol">都道府県</td>
                    <td class="inputCol"><?php echo $FreeDs[0] ?></td>
                    <td class="labelCol">市区町村</td>
                    <td class="inputCol"><?php echo $ResvData->Address2; ?></td>
                </tr>
                <tr>
                    <td class="labelCol">町域</td>
                    <td class="inputCol"><?php echo $ResvData->Address3; ?></td>
                    <td class="labelCol">番地</td>
                    <td class="inputCol"><?php echo $ResvData->Address4; ?></td>
                </tr>   
                <tr>    
                    <td class="labelCol">利用目的</td>
                    <td class="inputCol" colspan="3"><?php echo $ResvData->PurposeMemo; ?></td>
                </tr>   
                <tr>    
                    <td class="labelCol">メモ</td>
                    <td class="inputCol" colspan="3"><?php echo str_replace("\r\n", "<br>", $ResvData->Memo); ?></td>
                </tr>  
                <tr>
                    <td class="labelCol">入館時間</td>
                    <td class="inputCol"><?php echo $ResvData->CinTime; ?></td>
                    <td class="labelCol">退館時間</td>
                    <td class="inputCol"><?php echo $ResvData->CoutTime; ?></td>
                </tr>    
            </table>
        </div>
        <div align="left" class="kiyakuBox" style='layout-grid:18.0pt'>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>宿泊約款</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>平成</span><span
                    lang=EN-US>2 </span><span style='font-family:"ＭＳ 明朝",serif'>７年７月１日</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>&nbsp;(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>適用範囲</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第１条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館が宿泊客との間で締結する宿泊契約及びこれに関連する契約は、この約款の定めるところによるものとし、この約款に定めのない事項については、法令又は一般に確立された慣習によるものとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>当館が、法令及び慣習に反しない範囲で特約に応じたときは、前項の規定にかかわらず、その特約が優先するものとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊契約の申込み</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第２条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館に宿泊契約の申込みをしようとする者は、次の事項を当館に申し出ていただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>(1) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊者名</span></p>

            <p class=MsoNormal><span lang=EN-US>(2) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊日及び到着予定時刻</span></p>

            <p class=MsoNormal><span lang=EN-US>(3) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊料金</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>原則として<span
                        style='background:yellow'>別表第１</span>の基本宿泊料による。</span><span lang=EN-US>)</span></p>

            <p class=MsoNormal><span lang=EN-US>(4) </span><span style='font-family:"ＭＳ 明朝",serif'>その他当館が必要と認める事項</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が、宿泊中に前項第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>条の宿泊日を超えて宿泊の継続を申し入れた場合、</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>当館は、その申し出がなされた時点で新たな宿泊契約の申し込みがあったものとして処理します。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊契約の成立等</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第３条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊契約は、当館が前条の申し込みを承諾したときに成立するものとします。ただし、当館が承諾をしなかったことを証明したときは、この限りではありません。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>Ｗｅｂ予約の場合、オンライン上で申込完了後、当館予約係のご連絡、確認が終了した時点でご予約が成立するものとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>申込金の支払いを要しないこととする特約</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第４条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>前条第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>項の規定にかかわらず、当館は、契約の成立後同項の申込金の支払いを要しないこととする特約に応じることがあります。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊契約の申し込みを承諾するに当たり、当館が前条第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>項の申込金の支払いを求めなかった場合及び当該申込金の支払期日を指定しなかった場合は、前項の特約に応じたものとして取り扱います。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊契約締結の拒否</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第５条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、次に掲げる場合において、宿泊契約の締結に応じないことがあります。</span></p>

            <p class=MsoNormal><span lang=EN-US>(1) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊の申し込みが、この約款によらないとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(2) </span><span style='font-family:"ＭＳ 明朝",serif'>満室</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>員</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>により客室の余裕がないとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(3) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊しようとする者が、宿泊に関し、法令の規定、公の秩序若しくは善良の風俗に反する行為をするおそれがあると認められるとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(4) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊しようとする者が、次のイからハに該当すると認められるとき。</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>イ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>暴力団員による不当な行為の防止等に関する法律</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>平成</span><span
                    lang=EN-US>3</span><span style='font-family:"ＭＳ 明朝",serif'>年法律第</span><span
                    lang=EN-US>7 7</span><span style='font-family:"ＭＳ 明朝",serif'>号</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>条第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>号に規定する暴力団</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>以下「暴力団」という。</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>、同条第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>条第</span><span
                    lang=EN-US>6</span><span style='font-family:"ＭＳ 明朝",serif'>号に規定する暴力団員</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>以下「暴力団員」という。</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>、暴力団準構成員又は暴力団関係者その他の反社会的勢力</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ロ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>暴力団又は暴力団員が事業活動を支配する法人その他の団体であるとき</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ハ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>法人でその役員のうちに暴力団員に該当する者があるもの</span></p>

            <p class=MsoNormal><span lang=EN-US>(5) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊しようとする者が、他の宿泊客に著しい迷惑を及ぼす言動をしたとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(6) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊しようとする者が、伝染病者であると明らかに認められるとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(7) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊に関し暴力的要求行為が行われ、又は合理的な範囲を超える負担を求められたとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(8) </span><span style='font-family:"ＭＳ 明朝",serif'>天災、施設の故障、その他やむを得ない事由により宿泊させることができないとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊客の契約解除権</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第６条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客は、当館に申し出て、宿泊契約を解除することができます。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、宿泊客がその責めに帰すべき事由により宿泊契約の全部又は一部を解除した場合は、<span
                        style='background:yellow'>別表第</span></span><span lang=EN-US style='background:
                                                                 yellow'>2</span><span style='font-family:"ＭＳ 明朝",serif'>に掲げるところにより、違約金を申し受けます。ただし、当館が第</span><span
                                                                 lang=EN-US>4</span><span style='font-family:"ＭＳ 明朝",serif'>条第</span><span
                                                                 lang=EN-US>1</span><span style='font-family:"ＭＳ 明朝",serif'>項の特約に応じた場合にあっては、その特約に応じるに当たって、宿泊客が宿泊契約を解除したときの違約金支払義務について、当館が宿泊客に告知したときに限ります。</span></p>

            <p class=MsoNormal><span lang=EN-US>3. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、宿泊客が連絡をしないで宿泊日当日の午後</span><span
                    lang=EN-US>22</span><span style='font-family:"ＭＳ 明朝",serif'>時</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>あらかじめ到着予定時刻が明示されている場合は、その時刻を時間経過した時刻</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>になっても到着しないときは、その宿泊契約は宿泊客により解除されたものとみなし処理することがあります。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>当館の契約解除権</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第７条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、次に掲げる場合においては、宿泊契約を解除することがあります。</span></p>

            <p class=MsoNormal><span lang=EN-US>(1) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が宿泊に関し、法令の規定、公の秩序若しくは善良の風俗に反する行為をするおそれがあると認められるとき、又は同行為をしたと認められるとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(2) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が次のイからハに該当すると認められるとき。</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>イ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>暴力団、暴力団員、暴力団準構成員又は暴力団関係者その他の反社会的勢力</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ロ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>暴力団又は暴力団員が事業活動を支配する法人その他の団体であるとき</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ハ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>法人でその役員のうちに暴力団員に該当する者があるもの</span></p>

            <p class=MsoNormal><span lang=EN-US>(3) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が他の宿泊客に著しい迷惑を及ぼす言動をしたとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(4) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が伝染病者であると明らかに認められるとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(5) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊に関し暴力的要求行為が行われ、又は合理的な範囲を超える負担を求められたとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(6) </span><span style='font-family:"ＭＳ 明朝",serif'>天災等不可抗力に起因する事由により宿泊させることができないとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>(7) </span><span style='font-family:"ＭＳ 明朝",serif'>寝室での寝たばこ、消防用設備等に対するいたずら、その他当館が定める利用規則の禁止事項</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>火災予防上必要なものに限る。</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>に従わないとき。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊の登録</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第８条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客は、宿泊日以前または宿泊日当日、当館のフロントにおいて、次の事項を登録していただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>(1) </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客の氏名、年令、性別、住所及び職業</span></p>

            <p class=MsoNormal><span lang=EN-US>(2) </span><span style='font-family:"ＭＳ 明朝",serif'>外国人にあっては、国籍、旅券番号、入国地及び入国年月日</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>（確認のため、コピーをとらせていただきます）</span></p>

            <p class=MsoNormal><span lang=EN-US>(3) </span><span style='font-family:"ＭＳ 明朝",serif'>出発日及び出発予定時刻</span></p>

            <p class=MsoNormal><span lang=EN-US>(4) </span><span style='font-family:"ＭＳ 明朝",serif'>その他当館が必要と認める事項</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が第</span><span
                    lang=EN-US>12</span><span style='font-family:"ＭＳ 明朝",serif'>条の料金の支払いを、クレジットカード等通貨に代わり得る方法により行おうとするときは、あらかじめ、前項の登録時にそれらを呈示していただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>客室の使用時間</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第９条</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が当館の客室を使用できる時間は、午後１５時から翌朝１０時までとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>利用規則の遵守</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>10</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>宿泊客は、当館内においては、当館が定めて館内に掲示した利用規則に従っていただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>営業時間</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>11</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館の主な施設等の営業時間は次のとおりとし、その他の施設等の詳しい営業時間は備付けパンフレット、各所の掲示等で御案内いたします。</span></p>

            <p class=MsoListParagraph style='margin-left:18.0pt;text-indent:-18.0pt'><span
                    lang=EN-US>(1)<span style='font:7.0pt "Times New Roman"'>&nbsp; </span></span><span
                    style='font-family:"ＭＳ 明朝",serif'>サービス提供時間</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>イ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>フロントサービス時間</span><span
                    lang=EN-US>:6:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>22:00</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ロ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>キャッシャーサービス</span><span
                    lang=EN-US>:8:30</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>21:00</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ハ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>開館時間</span><span
                    lang=EN-US>:6:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>22:00</span></p>

            <p class=MsoNormal><span lang=EN-US>(2) </span><span style='font-family:"ＭＳ 明朝",serif'>飲食等</span><span
                    lang=EN-US>(</span><span style='font-family:"ＭＳ 明朝",serif'>施設</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>サービス時間</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>イ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>朝食</span><span
                    lang=EN-US>:7:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>8:30</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>口</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>昼食</span><span
                    lang=EN-US>:11:30</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>13:30</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ハ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>夕食</span><span
                    lang=EN-US>:18:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>20:00</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>二</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>ティータイム</span><span
                    lang=EN-US>:14:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>16:00</span></p>

            <p class=MsoNormal><span lang=EN-US>(3) </span><span style='font-family:"ＭＳ 明朝",serif'>附帯サービス施設時間</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>イ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>売店</span><span
                    lang=EN-US>:8:30</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>21:00</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ロ</span><span
                    lang=EN-US>)</span><span style='font-family:"ＭＳ 明朝",serif'>ビジネスセンター</span><span
                    lang=EN-US>:6:00</span><span style='font-family:"ＭＳ 明朝",serif'>～</span><span
                    lang=EN-US>22:00</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>前項の時間は、必要やむを得ない場合には臨時に変更することがあリます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>料金の支払い</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>12</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊者が支払うべき宿泊料金等の内訳は、<span
                        style='background:yellow'>別表第１</span>に掲げるところによります。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>前項の宿泊料金等の支払いは、通貨又は当館が認めたクレジットカード等これに代わり得る方法により、宿泊客の出発の際又は当館が請求した時、フロントにおいて行っていただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>3. </span><span style='font-family:"ＭＳ 明朝",serif'>当館が宿泊客に客室を提供し、使用が可能になったのち、宿泊客が任意に宿泊しなかった場合においても、宿泊料金は申し受けます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>当館の責任</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>13</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>当館は、宿泊契約及びこれに関連する契約の履行に当たり、又はそれらの不履行により宿泊客に損害を与えたときは、その損害を賠償します。ただし、それが当館の責めに帰すべき事由によるものでないときは、この限りではありません。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>契約した客室の提供ができないときの取扱い</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>14</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、宿泊客に契約した客室を提供できないときは、宿泊客の了解を得て、できる限り同一の条件による他の宿泊施設を斡旋するものとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>当館は、前項の規定にかかわらず他の宿泊施設の斡旋ができないときは、違約金相当額の補償料を宿泊客に支払い、その補償料は損害賠償額に充当します。ただし、客室が提供できないことについて、当館の責めに帰すべき事由がないときは、補償料を支払いません。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>寄託物等の取扱い</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>15</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客がフロントにお預けになった物品又は現金並びに貴重品について、滅失、毀損等の損害が生じたときは、それが、不可抗力である場合を除き、当館は、その損害を賠償します。ただし、現金及び貴重品については、当館がその種類及び価額の明告を求めた場合であって、宿泊客がそれを行わなかったときは、当館は</span><span
                    lang=EN-US>3</span><span style='font-family:"ＭＳ 明朝",serif'>万円を限度としてその損害を賠償します。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客が、当館内にお持込みになった物品又は現金並びに貴重品であってフロントにお預けにならなかったものについて、当館の故意又は過失により滅失、毀損等の損害が生じたときは、当館は、その損害を賠償します。</span></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>ただし、宿泊客からあらかじめ種類及び価額の明告のなかったものについては、当館に故意又は重大な過失がある場合を除き、</span><span
                    lang=EN-US>3</span><span style='font-family:"ＭＳ 明朝",serif'>万円を限度として当館はその損害を賠償します。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊客の手荷物又は携帯品の保管</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>16</span><span style='font-family:"ＭＳ 明朝",serif'>条</span></p>

            <p class=MsoNormal><span lang=EN-US>1. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客の手荷物が、宿泊に先立って当館に到着した場合は、その到着前に当館が了解したときに限って責任をもって保管し、宿泊客がフロントにおいてチェックインする際お渡しします。</span></p>

            <p class=MsoNormal><span lang=EN-US>2. </span><span style='font-family:"ＭＳ 明朝",serif'>宿泊客がチェックアウトしたのち、宿泊客の手荷物又は携帯品が当館に置き忘れられていた場合において、その所有者が判明したときは、当館は、当該所有者に連絡をするとともにその指示を求めるものとします。ただし、所有者の指示がない揚合又は所有者が判明しないときは、発見日を含め</span><span
                    lang=EN-US>3</span><span style='font-family:"ＭＳ 明朝",serif'>か月保管し、その後最寄りの警察署に届けます。（飲食物・雑誌に関しては即日処分させていただきます）</span></p>

            <p class=MsoNormal><span lang=EN-US>3. </span><span style='font-family:"ＭＳ 明朝",serif'>前</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>項の場合における宿泊客の手荷物又は携帯品の保管についての当館の責任は、第</span><span
                    lang=EN-US>1</span><span style='font-family:"ＭＳ 明朝",serif'>項の場合にあっては前条第</span><span
                    lang=EN-US>1</span><span style='font-family:"ＭＳ 明朝",serif'>項の規定に、前項の場合にあっては同条第</span><span
                    lang=EN-US>2</span><span style='font-family:"ＭＳ 明朝",serif'>項の規定に準じるものとします。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>駐車の責任</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>17</span><span style='font-family:"ＭＳ 明朝",serif'>条宿泊客が当館の駐車場をご利用になる場合、車両のキーの寄託の如何にかかわらず、当館は場所をお貸しするものであって、車両の管理責任まで負うものではありません。ただし、駐車場の管理に当たり、当館の故意又は過失によって損害を与えたときは、その賠償の責めに任じます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

            <p class=MsoNormal><b><span lang=EN-US style='font-size:12.0pt'>(</span></b><b><span
                        style='font-size:12.0pt;font-family:"ＭＳ 明朝",serif'>宿泊客の責任</span></b><b><span
                        lang=EN-US style='font-size:12.0pt'>)</span></b></p>

            <p class=MsoNormal><span style='font-family:"ＭＳ 明朝",serif'>第</span><span
                    lang=EN-US>18</span><span style='font-family:"ＭＳ 明朝",serif'>条宿泊客の故意又は過失により当館が損害を被ったときは、当該宿泊客は当館に対し、その損害を賠償していただきます。</span></p>

            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>
            <p class=MsoNormal>
                <span style='font-family:"ＭＳ 明朝",serif;background:yellow'>別表第１（平成２８年４月１日現在）</span>
                 <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>
                <img width=556
                     height=252 src="<?php echo $baseUrl.'images/image001.png'?>" alt=" "></p>
            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>
            <p class=MsoNormal><span
                    style='font-family:"ＭＳ 明朝",serif;background:yellow'>別表第２</span>
            <p><img width=624
                    height=317 src="<?php echo $baseUrl.'images/image002.png'?>" alt=" "></p>
            <p class=MsoNormal><span lang=EN-US>&nbsp;</span></p>

        </div>

        <div class="content_center" >
            <div class="consent">
                <input type="checkbox" name="flgAgreement" id="agree" value="on" />
                <label for="agree">上記約款に同意する</label>
            </div>
        </div>

        <div id="divStepOwner">
            <?php echo $hiddenData; ?>
            <table style="width: 400px; text-align: center; margin: auto;">
                <tr>
                    <td><input type="submit" value="前へ" id="ResvConfirmBack" name="ResvConfirmBack" class="buttonstyle"/></td>
                    <td><input type="submit" value="申込" id="ResvFinish" name="ResvFinish" class="btnreg" /></td>
                </tr>
            </table>
        </div><!-- #divStepOwner -->  
        <div style="clear: both;height:5px;"></div>
        <?php echo form_close(); ?>
    </div><!-- #divHallData -->  
</div><!-- #dataArea -->  
