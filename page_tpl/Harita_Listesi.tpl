<br/><br/><div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Harita Listesi</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Harita Adı</th>
<th style="text-align:center">Uygula</th>
</thead>
<tbody>
<?php if(count($maps) > 0): foreach($maps as $map): ?>
<tr>
<td><b><?=$map?></b></td>
<td style="text-align:center"><a href="map=<?=$map?>">Aç</a></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="7" style="text-align:center;"><b>Sunucuda harita bulunmamaktadır..</b></td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>