<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 80%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Duyuru Düzenle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page,"ID=".$_GET["ID"]);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Gönderen:</label>
<div class="controls"><?="[#{$duyuru["AnnouncementUserID"]}] ".$duyuru["UserName"]?></div>
</div>
<div class="control-group">
<label class="control-label">Gönderme Zamanı:</label>
<div class="controls"><?=$duyuru["AnnouncementCreate"]?></div>
</div>
<div class="control-group">
<label class="control-label">Duyuru Başlığı:</label>
<div class="controls"><input class="span9" type="text" value="<?=$duyuru["AnnouncementTT"]?>" name="duyuru_baslik"></div>
</div>
<div class="control-group">
<label class="control-label">İçerik:</label>
<div class="controls"><textarea class="span9" name="duyuru_icerik" style="resize:none; height:200px;"><?=$duyuru["AnnouncementCont"]?></textarea></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_updateannoun">Kaydet</button>
</div>
</form>
</div>
</div></div>