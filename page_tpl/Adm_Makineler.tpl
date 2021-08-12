<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Makineler</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead><tr>
<th style="width:30px;">#</th>
<th style="text-align:center">Adres</th>
<th style="text-align:center">Kullanıcı Adı</th>
<th style="text-align:center">Şifre</th>
<th style="text-align:center">Kaldır</th>
</tr></thead>
<tbody>
<?php if($machines != false): foreach($machines as $machine): ?>
<tr>
<td><?=$machine["MachID"]?></td>
<td><a href="<?=$page->CreatePageLink('Adm_Makine_Duzenle','ID='.$machine["MachID"])?>"><?=$machine["MachIP"].":".$machine["MachPort"]?></a></td>
<td style="text-align:center"><?=$machine["MachUser"]?></td>
<td style="text-align:center">*****</td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink('Adm_Makineler','Islem=Sil&ID='.$machine["MachID"])?>"><button class="btn btn-mini btn-danger">Kaldır</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td style="text-align:center" colspan=3>Bildiriminiz bulunmamaktadır..</td>
</tr>
<?php endif; ?>
</table>
</div></div></div>