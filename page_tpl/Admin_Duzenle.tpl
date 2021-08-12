				<script type="text/javascript" src="http://panel.hepoyuncu.com/theme/js/ajax.js"></script>
				<script type="text/javascript"> 
$(document).ready(function(){ 
 
$("#hsec").click(function() {var checked_status = this.checked; $(".hasmet").each(function() {this.checked = true; }); });
$("#hsil").click(function() {var checked_status = this.checked; $(".hasmet").each(function() {this.checked = false; }); }); 

$('.hasmet').change(function() {
document.getElementById('yetkikutu').value='';
if ($('#a').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'a'; });}
if ($('#b').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'b'; });}
if ($('#c').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'c'; });}
if ($('#d').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'd'; });}
if ($('#e').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'e'; });}
if ($('#f').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'f'; });}
if ($('#g').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'g'; });}
if ($('#h').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'h'; });}
if ($('#i').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'i'; });}
if ($('#j').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'j'; });}
if ($('#k').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'k'; });}
if ($('#l').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'l'; });}
if ($('#m').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'm'; });}
if ($('#n').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'n'; });}
if ($('#o').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'o'; });}
if ($('#p').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'p'; });}
if ($('#q').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'q'; });}
if ($('#r').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'r'; }); }
if ($('#s').is(':checked')) {$("#yetkikutu").each(function() {this.value += 's'; }); }
if ($('#t').is(':checked')) {$("#yetkikutu").each(function() {this.value += 't'; }); }
if ($('#u').is(':checked')) { $("#yetkikutu").each(function() {this.value += 'u'; }); }
if ($('#w').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'w'; }); }
if ($('#v').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'v'; }); }
if ($('#y').is(':checked')) { $("#yetkikutu").each(function() {this.value += 'y'; }); }
});

if( $('#yetkie4').is(':checked') ) {
$('#siyahbg').show(500), $('#resimbuyuk').show(500), $('#secenekler').show(500), $('#kapat').show(50); 
}

});
 
$(function() {

$("#tmm").click(function() {
if( document.getElementById('yetkikutu').value == "" ) {
$('#siyahbg').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50) ; 
}
});

$('#yetkie').click(function() {
	$('#siyahbg').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50);
	document.getElementById('yetkikutu').value='abcdefghijklmnopqrstu';
});

$('#yetkie2').click(function() {
	$('#siyahbg').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50);
	document.getElementById('yetkikutu').value='abcdefijkmnopqrstu';
});

$('#yetkie3').click(function() {
	$('#siyahbg').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50);
	document.getElementById('yetkikutu').value='b';
});

$('#yetkie4').click(function() {
	$('#siyahbg').show(500), $('#resimbuyuk').show(500), $('#secenekler').show(500), $('#kapat').show(50);
	document.getElementById('yetkikutu').value='';
	if ($('#a').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'a'; });}
	if ($('#b').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'b'; });}
	if ($('#c').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'c'; });}
	if ($('#d').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'd'; });}
	if ($('#e').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'e'; });}
	if ($('#f').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'f'; });}
	if ($('#g').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'g'; });}
	if ($('#h').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'h'; });}
	if ($('#i').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'i'; });}
	if ($('#j').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'j'; });}
	if ($('#k').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'k'; });}
	if ($('#l').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'l'; });}
	if ($('#m').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'm'; });}
	if ($('#n').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'n'; });}
	if ($('#o').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'o'; });}
	if ($('#p').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'p'; });}
	if ($('#q').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'q'; });}
	if ($('#r').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'r'; }); }
	if ($('#s').is(':checked')) {$("#yetkikutu").each(function() {this.value += 's'; }); }
	if ($('#t').is(':checked')) {$("#yetkikutu").each(function() {this.value += 't'; }); }
	if ($('#u').is(':checked')) { $("#yetkikutu").each(function() {this.value += 'u'; }); }
	if ($('#w').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'w'; }); }
	if ($('#v').is(':checked')) {$("#yetkikutu").each(function() {this.value += 'v'; }); }
	if ($('#y').is(':checked')) { $("#yetkikutu").each(function() {this.value += 'y'; }); }
});

$("#yetkiler_sec").click(function() {$('#siyahbg').show(50), $('#kapat').show(500), $('#secenekler').show(1500); });
$("#kapat").click(function() {$('#siyahbg').hide(500),$('#duyuru_all').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50); });
$("#resimjan").click(function() {$('#resimbuyuk').css("background", "url(user_motd_images/#RESIM#) no-repeat"), $('#siyahbg').show(50), $('#resimbuyuk').show(1500), $('#kapat').show(500); }); 
});


</script> 

<div align="center">
<div class="row-fluid" style="width: 70%">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Admin Düzenle</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse" data-original-title=""><i class="icon-chevron-up"></i></a>
              </div>
            </div>
            <div class="widget-body" align="center">
              <div class="widget-forms clearfix">
                <form class="form-horizontal" method="POST" action="<?=$page->CreatePageLink($cur_page,"ID=".$_GET["ID"])?>">
				
				<div class="control-group" style="padding-left:15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Nick</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="nick" value="<?=$admins[$_GET["ID"]]["name"]?>" style="width: 200px">
                    </div> 
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Şifre</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="sifre233" value="<?=$admins[$_GET["ID"]]["password"]?>" style="width: 200px">
                    </div>
                  </div>

				  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Tür</label>
                    <div class="controls" align="right">
                      <select name="tur">
				<option value="a" <?=$admins[$_GET["ID"]]["flags2"] == "a" ? "selected" : ""?><?=$admins[$_GET["ID"]]["flags2"] == "ab" ? "selected" : ""?>>Nick</option>
				<option value="d" <?=$admins[$_GET["ID"]]["flags2"] == "d" ? "selected" : ""?><?=$admins[$_GET["ID"]]["flags2"] == "de" ? "selected" : ""?>>IP</option>
				<option value="c" <?=$admins[$_GET["ID"]]["flags2"] == "c" ? "selected" : ""?><?=$admins[$_GET["ID"]]["flags2"] == "ce" ? "selected" : ""?>>SteamID</option>
			</select>
                    </div>
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Açıklama</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="aciklama" value="<?=$admins[$_GET["ID"]]["comment"]?>" style="width: 200px">
                    </div>
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Yetkiler</label>
                    <div class="controls" style="text-align:left;width: 40%">		
				<input type="text" id="yetkikutu" value="<?=$admins[$_GET["ID"]]["flags"]?>" readonly="true" name="yetki2" class="text_ekle" maxlength="100" style="width: 200px;"></div></div> <div class="control-group" style="padding-left: -60%"><div class="controls" style="margin-left:0%;">
				<input name="yetkie" id="yetkie" type="radio" value="1" <?=$admins[$_GET["ID"]]["flags"] == "abcdefghijklmnopqrstu" ? "checked" : ""?>><span class="style8"> Tam Yetki Admin</span> | <input name="yetkie" id="yetkie2" type="radio"  value="2" <?=$admins[$_GET["ID"]]["flags"] == "abcdefijkmnopqrstu" ? "checked" : ""?>><span class="style8"> Normal Admin</span> | <input name="yetkie" id="yetkie3" type="radio" onclick="javascript: document.getElementById('yetkikutu').value='b'" value="3" <?=$admins[$_GET["ID"]]["flags"] == "b" ? "checked" : ""?>><span class="style8"> Slot</span> | <input name="yetkie" id="yetkie4" type="radio" value="4" <?=($admins[$_GET["ID"]]["flags"] != "abcdefghijklmnopqrstu" && $admins[$_GET["ID"]]["flags"] != "abcdefijkmnopqrstu" && $admins[$_GET["ID"]]["flags"] != "b") == 1 ? "checked" : ""?>><span class="style8"> Özel Ayarla</span>
				<div id="secenekler" style="display:none;"> 
	<div id="secenekler_ic" style="text-align:left;">
	<br />
	<b>Not: İstediğiniz yetkileri seçtikten sonra aşağıdaki "Tamam" butonuna basmayı unutmayınız.</b> <br />
	<input name="list" type="checkbox" class="hasmet" id="a" <?=strpos($admins[$_GET["ID"]]["flags"],'a') !== false ? "checked" : ""?>> Dokunulmazlık <br /> 
	<input name="slothakki" type="checkbox" class="hasmet" id="b" <?=strpos($admins[$_GET["ID"]]["flags"],'b') !== false ? "checked" : ""?>> Slot hakkı <br /> 
	<input name="amx_kick" type="checkbox" class="hasmet" id="c" <?=strpos($admins[$_GET["ID"]]["flags"],'c') !== false ? "checked" : ""?>> amx_kick kullanma hakkı <br /> 
	<input name="amx_ban" type="checkbox" class="hasmet" id="d" <?=strpos($admins[$_GET["ID"]]["flags"],'d') !== false ? "checked" : ""?>> amx_ban, amx_unban kullanma hakkı <br /> 
	<input name="amx_slay" type="checkbox" class="hasmet" id="e" <?=strpos($admins[$_GET["ID"]]["flags"],'e') !== false ? "checked" : ""?>> amx_slay, amx_slap kullanma hakkı <br /> 
	<input name="amx_map" type="checkbox" class="hasmet" id="f" <?=strpos($admins[$_GET["ID"]]["flags"],'f') !== false ? "checked" : ""?>> amx_map kullanma hakkı <br /> 
	<input name="amx_cvar" type="checkbox" class="hasmet" id="g" <?=strpos($admins[$_GET["ID"]]["flags"],'g') !== false ? "checked" : ""?>> amx_cvar kullanma hakkı <br /> 
	<input name="amx_cfg" type="checkbox" class="hasmet" id="h" <?=strpos($admins[$_GET["ID"]]["flags"],'h') !== false ? "checked" : ""?>> amx_cfg kullanma hakkı <br /> 
	<input name="amx_chat" type="checkbox" class="hasmet" id="i" <?=strpos($admins[$_GET["ID"]]["flags"],'i') !== false ? "checked" : ""?>> amx_chat kullanma hakkı <br /> 
	<input name="amx_vote" type="checkbox" class="hasmet"  id="j" <?=strpos($admins[$_GET["ID"]]["flags"],'j') !== false ? "checked" : ""?>> amx_vote kullanma hakkı <br /> 
	<input name="sifre" type="checkbox" class="hasmet" id="k" <?=strpos($admins[$_GET["ID"]]["flags"],'k') !== false ? "checked" : ""?>> Şifre koyup kaldırma hakkı <br /> 
	<input name="rcon" type="checkbox" class="hasmet" id="l" <?=strpos($admins[$_GET["ID"]]["flags"],'l') !== false ? "checked" : ""?>> amx_rcon kullanma hakkı <br /> 
	<input name="oza" type="checkbox" class="hasmet" id="m" <?=strpos($admins[$_GET["ID"]]["flags"],'m') !== false ? "checked" : ""?>> Özel Yetki &raquo; A <br /> 
	<input name="ozb" type="checkbox" class="hasmet" id="n" <?=strpos($admins[$_GET["ID"]]["flags"],'n') !== false ? "checked" : ""?>> Özel Yetki &raquo; B <br /> 
	<input name="ozc" type="checkbox" class="hasmet" id="o" <?=strpos($admins[$_GET["ID"]]["flags"],'o') !== false ? "checked" : ""?>> Özel Yetki &raquo; C <br /> 
	<input name="ozd" type="checkbox" class="hasmet" id="p" <?=strpos($admins[$_GET["ID"]]["flags"],'p') !== false ? "checked" : ""?>> Özel Yetki &raquo; D <br /> 
	<input name="oze" type="checkbox" class="hasmet" id="q" <?=strpos($admins[$_GET["ID"]]["flags"],'q') !== false ? "checked" : ""?>> Özel Yetki &raquo; E <br /> 
	<input name="ozf" type="checkbox" class="hasmet" id="r" <?=strpos($admins[$_GET["ID"]]["flags"],'r') !== false ? "checked" : ""?>> Özel Yetki &raquo; F <br /> 
	<input name="ozg" type="checkbox" class="hasmet" id="s" <?=strpos($admins[$_GET["ID"]]["flags"],'s') !== false ? "checked" : ""?>> Özel Yetki &raquo; G <br /> 
	<input name="ozh" type="checkbox" class="hasmet" id="t" <?=strpos($admins[$_GET["ID"]]["flags"],'t') !== false ? "checked" : ""?>> Özel Yetki &raquo; H <br /> 
	<input name="menu" type="checkbox" class="hasmet" id="u" <?=strpos($admins[$_GET["ID"]]["flags"],'u') !== false ? "checked" : ""?>> Menü kullanma hakkı <br />
	<input name="ozw" type="checkbox" class="hasmet" id="w" <?=strpos($admins[$_GET["ID"]]["flags"],'w') !== false ? "checked" : ""?>> Özel Yetki &raquo; W <br /> 
	<input name="ozv" type="checkbox" class="hasmet" id="v" <?=strpos($admins[$_GET["ID"]]["flags"],'v') !== false ? "checked" : ""?>> Özel Yetki &raquo; V <br /> 
	<input name="ozy" type="checkbox" class="hasmet" id="y" <?=strpos($admins[$_GET["ID"]]["flags"],'y') !== false ? "checked" : ""?>> Özel Yetki &raquo; Y <br /><br />  
	</div> 
</div>
				                    </div>
                  </div>
				 


            </div>
              </div>

            <div class="widget-footer" align="center">
               <button class="btn btn-primary" type="submit" name="yardir" id="tmm">Ekle</button>
            </div>
          </div>
        </div>
</div>