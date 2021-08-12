<div class="row-fluid"><div class="widget widget-padding span12">
<div class="widget-header">
<i class="icon-font"></i>
<h5>Duyurular</h5>
            </div>
<div class="widget-body">
<div class="widget-tickets widget-tickets-large clearfix">
	<ul>
		<?php if($duyurular != false): foreach($duyurular as $duyuru): ?>
		<li>
			<h5><?=$duyuru["AnnouncementTT"]?></h5>
			<?=$duyuru["AnnouncementCont"]?>
			<div class="date">[ <?=$duyuru["UserName"]?> ] <?=$duyuru["AnnouncementCreate"]?></div>
		</li>
		<?php endforeach; else: ?>
		<li>Duyuru bulunmuyor..</li>
		<?php endif; ?>
	</ul>
</div><br>			
</div></div></div>