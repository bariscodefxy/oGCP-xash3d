<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Komut Gönder</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body" align="center">
<form method="POST" action="<?=$page->CreatePageLink($cur_page)?>">
<table cellpadding="10"> 
<tr><td colspan="2"><textarea style="width: 600px;height: 350px;background-color:black;color:white;resize:none;" readonly="true"><?=$icerik?></textarea>
</td></tr>
<tr><td align="left"><input type="text" name="komut" style="width: 130%" placeholder="Buraya komut girebilirsiniz"><td align="right"><button class="btn btn-inverse" style="margin-top: -15px" name="yardir">Uygula!</button></td></tr></table>
</form>
<div align="left" style="width: 43%"><h4 style="color:red">Komut Gönderme Nedir?</h4>
Komut gönderme sunucu içerisine komutlarla yönetimi sağlmaktadır.Sunucu ile ilgili neredeyse tüm herşeyi yapabilirsiniz.Sunucu ayarları değiştirebilir.Sunucuya acil durumda bir müdahelede bulunabilirsiniz
<h5 style="color:red">Örnek Komutlar:</h5>
<span style="color:red"><u>NOT:</u></span> Cvar ayarlarını amx_cvar kullanmadan yazabilirsiniz..<br>
<u>mp_friendlyfire</u> [1|0] == [acar|kapatir]<br>
Kendi takımındaki arkadaşını vurmayı sağlamaktadır. Örnek: "mp_friendlyfire 1"<br>
<u>mp_footsteps</u> [1|0] == [acar|kapatir]<br>
Ayak seslerini açmayı/kapamayı sağlamaktadır.. Örnek: "mp_footsteps 1"<br>
<u>sv_restart</u> [sure] == [o sure zarfinda serveri restartlar]<br>
Örnek: "sv_restart 1" 1 saniyelik restart atar.Bu değer 1 değilde 3 olsaydı 3 saniye sonra restart atardı.<br>
<u>mp_startmoney</u> [miktar] == [baslangic parasinin miktarini belirler]<br>
Başlangıç parasını ayarlamayı sağlar Örnek: "mp_startmoney 800" başlangıç parası 800$ olarak belirlenir<br>
<u>mp_buytime</u> [sure] == [satin alma suresi]<br>
Başlangıçta satın alma süresini belirler Örnek: "mp_buytime 0.15" Tur başladıktan sonra 15 saniye içinde alıcağın ekipmanları alman gerekiyor<br>
<u>mp_hostagepenalty</u> [rehine sayisi]<br>
Belirli sayıda rehine öldürdüğünde sunucu (oyundan)kick atar.Örnek "mp_hostagepenalty 11" bu değeri 11 yaparsak 11 rehineden sonra oyuncuyu oyundan atar</div>
</div></div></div>