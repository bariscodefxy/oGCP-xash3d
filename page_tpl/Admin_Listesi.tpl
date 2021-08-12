<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Admin listesi</h5>
<div class="widget-buttons"><a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead><tr>
<th style="text-align:center">Nick & IP & SteamID</th>
<th style="text-align:center">Şifre</th>
<th style="text-align:center">Yetkiler</th>
<th style="text-align:center">Tür</th>
<th style="text-align:center">Açıklama</th>
<th style="text-align:center">İşlem</th>
</thead>
<tbody>
<?php if($admincount > 0):  foreach($admins as $admin_line => $admin_value): ?>
<tr>
<td><?=$admin_value["name"]?></td>
<td style="text-align:center"><?=$admin_value["password"] == "" ? "<span style='color:red'>Şifre yok</span>" : $admin_value["password"]?></td>
<td style="text-align:center"><?=$admin_value["flags"]?></td>
<td style="text-align:center"><?=$yetkiler[$admin_value["flags2"]]?></td>
<td style="text-align:center"><?=$admin_value["comment"]?></td>
<td style="text-align:center">
	<a href="<?=$page->CreatePageLink($cur_page,'Islem=Duzenle&ID='.$admin_line)?>"><button class="btn btn-mini btn-warning" style="border-radius:2px 0px 0px 2px;">Düzenle</button></a><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sil&ID='.$admin_line)?>"><button class="btn btn-mini btn-danger" style="border-radius:0px 2px 2px 0px;">Sil</button></a>
</td>
</tr>
<?php endforeach; ?> 
<tr><td colspan="6" style="text-align:center">Admin Sayısı: <span style='color:red'><b><?=$admincount?></b></span></td></tr>
<?php else: ?>
<tr><td colspan="6" style="text-align:center">Sunucunuzda admin bulunmamaktadır...</td></tr>
<?php endif; ?>
</table>
</div></div></div>