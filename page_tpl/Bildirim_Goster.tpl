<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Bildirim Bilgisi</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/GÃ¶ster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a></div>
</div>
<div class="widget-body">
	<table class="table table-striped">
		<tr><th style="text-align:right;width:150px;">Konu</th><th><?=$ticket[0]?></th></tr>
		<tr><th style="text-align:right;width:150px;">Tarih</th><th><?=$ticket["TicketCreateTime"]?></th></tr>
		<tr><th style="text-align:right;width:150px;">Durum</th><th><?=$bildirim_durum[$ticket[3]]?></th></tr>
		<tr><th style="text-align:right;width:150px;">Öncelik</th><th><?=$bildirim_acil[$ticket["TicketPriority"]]?></th></tr>
		<tr><th style="text-align:right;width:150px;">Sunucu</th><th><?=$ticket[4].":".$ticket[5]?></th></tr>
	</table>
</div>

</div>
</div>
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Bildirim Mesajları</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a></div>
</div>  
<div class="widget-header-under"> <b>Mesajlar eskiden yeniye doğru sıralanmaktadır </b></div>
<div class="widget-body">
<div class="widget-tickets widget-tickets-large clearfix">
	<ul>
		<?php foreach($ticket["messages"] as $message): ?>
		<li class="priority-<?=$ticket_priclass[$ticket["TicketPriority"]]?>" style="border-bottom: 1px solid #DDDDDD;">
			<h5><?=$message["UserName"]?></h5>
			<?=$message["MessageContent"]?>
			<div class="date"><?=$message["MessageCreateT"]?></div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
		<?php if($ticket["TicketStatus"] != 1 && $ticket["TicketStatus"] != 2): ?>
		<form method="POST" action="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"])?>">
                  <div class="control-group">
                    <div class="controls" align="center" style="padding-top:7px;">
                      <textarea class="span12 pop" style="resize:none; height:60px;" name="message" placeholder="Mesajınızı buraya giriniz..."></textarea>
                    </div>
                  </div>
		    <div class="control-group">
                    <div class="controls" align="center">
					<input type="checkbox" name="durum" style="margin-top:-4px;" /> Bildirimi Kapat<br/>
						<br/>
                      <button class="btn btn-primary" name="yardir">Gönder</button>
                    </div>
                  </div>
		</form>
		<?php endif; ?>
		</div></div></div>