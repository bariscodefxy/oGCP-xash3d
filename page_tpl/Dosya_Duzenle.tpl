<?php if(intval(@$_GET["ID"]) == 0): ?>
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Dosya Düzenle</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<?php if($dosyalar !== false): foreach($dosyalar as $dosya): ?>
<tr>
<td><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS"><?=$dosya["FileName"]?></span></td>
<td><a href="<?=$page->CreatePageLink("Dosya_Duzenle","ID=".$dosya["FileID"])?>"><button class="btn btn-small btn-inverse">Düzenle!</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td colspan=2 style="text-align:center;"><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS">Ayar Dosyası bulunmamaktadır..</span></td>
</tr>
<?php endif; ?>
</table>
</div></div></div>
<?php else: ?>
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Dosya Düzenle</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body" align="center">
<form method="POST" action="<?=$page->CreatePageLink($cur_page,"ID=".$dosya["FileID"]);?>">
<table cellpadding="10"><tr bgcolor="black" style="color:white"><td align="center"><a href="<?=$page->CreatePageLink($cur_page);?>"><= Geri</a> <?=$dosya["FileName"]?></td></tr> 
<tr><td><textarea name="icerikD" style="width: 600px;height: 350px"><?=$dosya["FileContent"]?></textarea></td></tr>
<tr><td align="right"><button class="btn btn-inverse" name="yardir">Uygula!</button></td></tr></table>
</form>
</div></div></div>
<?php endif; ?>