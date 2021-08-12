<div id="gritter-notice-wrapper">
	<div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class" style="">
		<div class="gritter-top"></div>
		<div class="gritter-item">
			<div class="gritter-without-image">
				<span class="gritter-title">Duyuru!</span>
				<p><i class="icon-bar-char" style="font-size:15px;"></i> Web FTP sistemimiz artık yüklediğiniz dosyaları otomatik olarak Fast Download sunucusuna yükleyecektir!</p>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="gritter-bottom"></div>
	</div>
</div>
<script type="text/javascript" src="http://panel.hepoyuncu.com/theme/js/ajax.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#gritter-notice-wrapper").click(function(){
		$("#gritter-notice-wrapper").hide(500);
	});
		var refreshId = setInterval(function() { $("#gritter-notice-wrapper").hide(500); }, 20000);
	});
</script>
<?php if($serverinfo["ServerFTPCon"] == 1): if(@$dosya != false): ?>
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Web FTP ( Dosya Düzenle )</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body" align="center">
<form method="POST" action="<?=$page->CreatePageLink($cur_page,"Duzenle=".$dosya["name"]);?>">
<table style="width:100%;">
<tr style="color:white;background-color:black;">
<td style="padding:10px;text-align:center;width:100%;" colspan=2><?=$dosya["name"]?></td>
</tr>
<tr><td colspan="3"><textarea name="icerikD" style="width: 100%;height: 350px"><?=$dosya["content"]?></textarea></td></tr>
<tr><td align="left"><a href="<?=$page->CreatePageLink($cur_page)?>" class="btn btn-inverse">Geri</a></td><td colspan="2" align="right"><button class="btn btn-inverse" name="yardir">Kaydet!</button></td></tr></table>
</form>
</div></div></div>
<?php else: ?>
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Web FTP</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:right;width:50px;">Konum:</th>
<th colspan=3 style="text-align:left"><b><?=$_SESSION["OGCP_WebFTP_Path"]?></b></th>
</tr>
<?php if( substr($_SESSION["OGCP_WebFTP_Path"],0,8) == "/models/" || substr($_SESSION["OGCP_WebFTP_Path"],0,5) == "/gfx/" || substr($_SESSION["OGCP_WebFTP_Path"],0,7) == "/sound/" || substr($_SESSION["OGCP_WebFTP_Path"],0,9) == "/sprites/"): ?>
<tr>
<form method="POST" action="<?=$page->CreatePageLink($cur_page);?>">
<th style="text-align:center;line-height:43px;">Yeni Klasör:</th><th style='padding-top:1px; padding-bottom:1px;line-height:43px;'><input type='text' name='klasor' /></th><th colspan=2 style='padding-top:1px; padding-bottom:1px;line-height:43px;'><button class="btn btn-inverse" name="klasor_olustur">Oluştur!</button></th>
</form>
</tr>
<?php endif; ?>
<tr>

<form method="POST" action="<?=$page->CreatePageLink($cur_page)?>" enctype="multipart/form-data">
	<td>Dosya Yükle:</td><td style="padding-top:0px; padding-bottom:0px;"><input name="dosya[]" type="file" multiple></td><td colspan=2><input class="btn btn-inverse" type="submit" name="yukle"></input></td>
</form>
</tr>
<tr>
<th style="text-align:center;width:200px;">İsim</th>
<th style="text-align:center;">Tür</th>
<th style="text-align:center;">Boyut</th>
<th style="text-align:center;">İşlem</th></tr>
</thead>
<tbody>
<?php if($files != false && @count($files) > 0): foreach($files as $file_key => $file_val): ?>
<tr<?=($file_val["type"] == $exts["dir"]) ? " style='color:blue'" : ""?>>
<td><?=$file_val["link"] != "#" ? ('<a href="'.$page->CreatePageLink($cur_page,$file_val["link"]).'">'.( ($file_val["type"] != $exts["dir"] && $file_val["type"] != $exts[".."]) ? $file_key : substr($file_key,0,-1)) .'</a>') : ($file_val["type"] != $exts["dir"] ? $file_key : substr($file_key,0,-1)) ?></td>
<td style="text-align:center"><?=$file_val["type"]?></td>
<td style="text-align:center"><?=$file_val["type"] == "dir" ? "" : $file_val["size"]?></td>
<td style="text-align:center">
	<form method="POST" action="<?=$page->CreatePageLink($cur_page)?>"><input hidden name="dosya" value="<?= $file_key ?>"><button type="submit" name="dosya_sil">Sil</button></form></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td colspan=4>Dizin okunamadı yada dosya bulunamadı!</td>
</tr>
<tr>
<td colspan=4><a href="<?=$page->CreatePageLink($cur_page,"Klasor=Sifirla")?>">Ana Dizine Dön!</a></td>
</tr>
<?php endif; ?>
</table>
</div></div></div>
<?php endif; endif;?>
