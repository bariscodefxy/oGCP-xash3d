<div class="row-fluid"><div class="widget widget-padding span12">
<div class="widget-header">
<i class="icon-font"></i>
<h5>Duyurular</h5>
            </div>
<div class="widget-body">
<div class="widget-tickets widget-tickets-large clearfix">
	<ul>
		<?php if($announcements != false): foreach($announcements as $duyuru): ?>
		<li>
			<h5><?="[#".$duyuru["AnnouncementID"]."] ".$duyuru["AnnouncementTT"]?></h5>
			<?=$duyuru["AnnouncementCont"]?>
			<div class="date">[ <?=$duyuru["UserName"]?> ] <?=$duyuru["AnnouncementCreate"]?></div>
			<div class="settings"><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sil&ID='.$duyuru["AnnouncementID"])?>"><i class="icon-trash"></i></a><a href="<?=$page->CreatePageLink('Adm_Duyuru_Duzenle','ID='.$duyuru["AnnouncementID"])?>"><i class="icon-edit"></i></a></div>
		</li>
		<?php endforeach; else: ?>
		<li>Sistemimizde duyuru bulunmamaktadır!..</li>
		<?php endif; ?>
	</ul>
</div><br>			
</div></div></div>