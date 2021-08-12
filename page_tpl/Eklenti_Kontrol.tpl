<?php if($serverinfo["ServerPluginCon"] == 1): ?>
<div align="center">
<br /><div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Eklenti Kur/Kaldır</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/GÃ¶ster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-bordered">
<thead>
<tr><th colspan=2>Eklenti Adı</th><th>Durum</th><th>Kur/Kaldır</th></tr>
</thead>
<tbody>
<?php if(@count($plugin_info) > 0): foreach($plugin_info as $plugin): ?>
<tr>
<td colspan=2 style="width:70%"><?=$plugin["PluginName"]."<br/>".$plugin["PluginDesc"]?></td>
<td style="width:15%"><b><?=$eklenti_status[$plugin_status[$plugin["PluginFileName"]]]?></b></td>
<td style="width:15%"><?=$plugin_status[$plugin["PluginFileName"]] == 1 ? "<a href='".$page->CreatePageLink($cur_page,"Kaldir=".$plugin["PluginID"])."'>Kaldır</a>" : "<a href='".$page->CreatePageLink($cur_page,"Kur=".$plugin["PluginID"])."'>Kur</a>"?></td>
</tr>
<?php endforeach; else:?>
<tr><td colspan=4 style="text-align:center">Kontrol edebileceğiniz eklenti bulunmamaktadır...</td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>
</div>
<?php endif; ?>