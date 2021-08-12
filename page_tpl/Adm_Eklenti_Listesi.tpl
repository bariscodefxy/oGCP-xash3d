<div align="center">
<br /><div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Eklenti Listesi</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-bordered">
<thead>
<tr><th colspan=2>Eklenti Adı</th><th>Durum</th><th>İşlemler</th></tr>
</thead>
<tbody>
<?php if(@count($plugin_info) > 0): foreach($plugin_info as $plugin): ?>
<tr>
<td colspan=2 style="width:70%"><?=$plugin["PluginName"]."<br/>".$plugin["PluginDesc"]?></td>
<td style="width:15%"><b><?=$plugin["PluginShow"] == 1 ? "<span style='color:lightgreen;'>Gösteriliyor</span>" : "<span style='color:red;'>Gösterilmiyor</span>"?></b></td>
<td style="width:15%"><b><a href="<?=$page->CreatePageLink('Adm_Eklenti_Duzenle','ID='.$plugin["PluginID"])?>"><button class="btn btn-small btn-primary" style="border-radius:2px 0px 0px 2px;font-family:'Open Sans',sans-serif;">Düzenle</button></a><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sil&ID='.$plugin["PluginID"])?>"><button class="btn btn-small btn-danger" style="border-radius:0px 2px 2px 0px;font-family:'Open Sans',sans-serif;">Sil</button></a></b></td>
</tr>
<?php endforeach; else:?>
<tr><td colspan=4 style="text-align:center">Eklenti bulunamadı...</td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>
</div>