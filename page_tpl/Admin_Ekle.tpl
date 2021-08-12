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
$('#siyahbg').hide(500), $('#resimbuyuk').hide(500), $('#secenekler').hide(500), $('#kapat').hide(50) ;
 
 
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
              <i class="icon-list-alt"></i><h5>Admin Ekle</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse" data-original-title=""><i class="icon-chevron-up"></i></a>
              </div>
            </div>
            <div class="widget-body" align="center">
              <div class="widget-forms clearfix">
                <form class="form-horizontal" method="POST" action="<?=$page->CreatePageLink($cur_page)?>" onSubmit="return Admin_onsubmit()">
				
				<div class="control-group" style="padding-left:15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Nick</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="nick" style="width: 200px">
                    </div> 
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Şifre</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="sifre" style="width: 200px">
                    </div>
                  </div>

				  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Tür</label>
                    <div class="controls" align="right">
                      <select name="tur"><option value="a">Nick</option><option value="d">IP</option><option value="c">SteamID</option></select>
                    </div>
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Açıklama</label>
                    <div class="controls" align="right">
                      <input class="span7" type="text" name="aciklama" style="width: 200px">
                    </div>
                  </div>
				  
                  <div class="control-group" style="padding-left: 15%;padding-right: 55%">
                    <label class="control-label" style="text-align:left;width: 40%">Yetkiler</label>
                    <div class="controls" style="text-align:left;width: 40%">		
				<input type="text" id="yetkikutu" value="abcdefghijklmnopqrstu" readonly="true" name="yetki2" class="text_ekle" maxlength="100" style="width: 200px;"></div></div> <div class="control-group" style="padding-left: -60%"><div class="controls" style="margin-left:0%;">
				<input name="yetkie" id="yetkie" type="radio" value="1" checked><span class="style8"> Tam Yetki Admin</span> | <input name="yetkie" id="yetkie2" type="radio"  value="2"><span class="style8"> Normal Admin</span> | <input name="yetkie" id="yetkie3" type="radio" onclick="javascript: document.getElementById('yetkikutu').value='b'" value="3"><span class="style8"> Slot</span> | <input name="yetkie" id="yetkie4" onclick="javascript: document.getElementById('yetkikutu').value=''" id="yetkiler_sec" type="radio" value="4"><span class="style8"> Özel Ayarla</span>
				<div id="secenekler" style="display:none;"> 
	<div id="secenekler_ic" style="text-align:left;">
	<br />
	<b>Not: İstediğiniz yetkileri seçtikten sonra aşağıdaki "Tamam" butonuna basmayı unutmayınız.</b> <br />
	<input name="list" type="checkbox" class="hasmet" id="a"> Dokunulmazlık <br /> 
	<input name="slothakki" type="checkbox" class="hasmet" id="b"> Slot hakkı <br /> 
	<input name="amx_kick" type="checkbox" class="hasmet" id="c"> amx_kick kullanma hakkı <br /> 
	<input name="amx_ban" type="checkbox" class="hasmet" id="d"> amx_ban, amx_unban kullanma hakkı <br /> 
	<input name="amx_slay" type="checkbox" class="hasmet" id="e"> amx_slay, amx_slap kullanma hakkı <br /> 
	<input name="amx_map" type="checkbox" class="hasmet" id="f"> amx_map kullanma hakkı <br /> 
	<input name="amx_cvar" type="checkbox" class="hasmet" id="g"> amx_cvar kullanma hakkı <br /> 
	<input name="amx_cfg" type="checkbox" class="hasmet" id="h"> amx_cfg kullanma hakkı <br /> 
	<input name="amx_chat" type="checkbox" class="hasmet" id="i"> amx_chat kullanma hakkı <br /> 
	<input name="amx_vote" type="checkbox" class="hasmet"  id="j"> amx_vote kullanma hakkı <br /> 
	<input name="sifre" type="checkbox" class="hasmet" id="k"> Şifre koyup kaldırma hakkı <br /> 
	<input name="rcon" type="checkbox" class="hasmet" id="l"> amx_rcon kullanma hakkı <br /> 
	<input name="oza" type="checkbox" class="hasmet" id="m"> Özel Yetki &raquo; A <br /> 
	<input name="ozb" type="checkbox" class="hasmet" id="n"> Özel Yetki &raquo; B <br /> 
	<input name="ozc" type="checkbox" class="hasmet" id="o"> Özel Yetki &raquo; C <br /> 
	<input name="ozd" type="checkbox" class="hasmet" id="p"> Özel Yetki &raquo; D <br /> 
	<input name="oze" type="checkbox" class="hasmet" id="q"> Özel Yetki &raquo; E <br /> 
	<input name="ozf" type="checkbox" class="hasmet" id="r"> Özel Yetki &raquo; F <br /> 
	<input name="ozg" type="checkbox" class="hasmet" id="s"> Özel Yetki &raquo; G <br /> 
	<input name="ozh" type="checkbox" class="hasmet" id="t"> Özel Yetki &raquo; H <br /> 
	<input name="menu" type="checkbox" class="hasmet" id="u"> Menü kullanma hakkı <br /><br />  
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