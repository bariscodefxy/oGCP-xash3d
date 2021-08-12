<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 80%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Duyuru Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Gönderen:</label>
<div class="controls"><?="[#{$userinf["UserID"]}] ".$userinf["UserName"]?></div>
</div>
<div class="control-group">
<label class="control-label">Duyuru Başlığı:</label>
<div class="controls"><input class="span9" type="text" name="duyuru_baslik"></div>
</div>
<div class="control-group">
<label class="control-label">İçerik:</label>
<div class="controls"><textarea class="span9" name="duyuru_icerik" style="resize:none; height:200px;"></textarea></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_addannoun">Ekle</button>
</div>
</form>
</div>
</div></div>