<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Bildirimlerim</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead><tr>
<th style="text-align:center">Konu</th>
<th style="text-align:center">Gönderen</th>
<th style="text-align:center">Sunucu</th>
<th style="text-align:center">Tarih</th>
<th style="text-align:center">Durum</th>
<th style="text-align:center">Aciliyet</th>
<th style="text-align:center">Kaldır</th>
</tr></thead>
<tbody>
<?php if($tickets != false): foreach($tickets as $ticket): ?>
<tr>
<td><a href="<?=$page->CreatePageLink('Adm_Bildirim_Goster','ID='.$ticket["TicketID"])?>"><?=$ticket["TicketTitle"]?></a></td>
<td style="text-align:center"><?=$ticket["UserName"]?></td>
<td style="text-align:center"><?=$ticket["ServerIP"].":".$ticket["ServerPort"]?></td>
<td style="text-align:center"><?=$ticket["TicketCreateTime"]?></td>
<td style="text-align:center"><?=$bildirim_durum[$ticket["TicketStatus"]]?></td>
<td style="text-align:center"><?=$bildirim_acil[$ticket["TicketPriority"]]?></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sil&ID='.$ticket["TicketID"])?>"><button class="btn btn-mini btn-danger">Kaldır</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td style="text-align:center" colspan=7>Bildiriminiz bulunmamaktadır..</td>
</tr>
<?php endif; ?>
</table>
</div></div></div>