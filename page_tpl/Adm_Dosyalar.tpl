<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Dosya Listesi</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">

<?php if($dosyalar !== false): ?>
<thead>
<tr>
	<td>#</td>
	<td>Dosya Adı</td>
	<td>Dosya Yolu</td>
	<td>Kaldır</td>
</tr>
</thead>
<?php foreach($dosyalar as $dosya): ?>
<tr>
<td><?=$dosya["FileID"]?></td>
<td><a href="<?=$page->CreatePageLink("Adm_Dosya_Duzenle","ID=".$dosya["FileID"])?>"><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS"><?=$dosya["FileName"]?></span></a></td>
<td><?=$dosya["FilePath"]?></td>
<td><a href="<?=$page->CreatePageLink($cur_page,"Islem=Sil&ID=".$dosya["FileID"])?>"><button class="btn btn-small btn-inverse">Kaldır!</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td colspan=2 style="text-align:center;"><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS">Ayar Dosyası bulunmamaktadır..</span></td>
</tr>
<?php endif; ?>
</table>
</div></div></div>