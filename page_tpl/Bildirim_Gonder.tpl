<div align="center">
<div class="row-fluid" style="width: 70%"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Bildirim Gönder</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body" align="center">
<form action="<?=$page->CreatePageLink($cur_page)?>" method="POST">
<table cellpadding="10">
<tr><td>Ad, Soyad:</td><td><?=$userinf["UserName"]?></td></tr>
<tr><td>Sunucu:</td><td> <select name="serverid"><?=$serverlar?></select> </td></tr>
<tr><td>Konu:</td><td><input type="text" name="konu" style="width: 100%" /></tr>
<tr><td>Öncelik:</td><td><select name="priority"><option value="1">Düşük</option><option value="2">Orta</option><option value="3">Yüksek</option></select></tr>
<tr><td colspan="2">Mesaj</td></tr>
<tr><td colspan="2"><textarea style="width: 600px;height: 350px" name="mesaj"></textarea></td></tr>
<tr><td align="center" colspan="2"><button class="btn btn-inverse" name="yardir">Gönder!</button></td></tr></table>
</form>
</div></div></div></div>