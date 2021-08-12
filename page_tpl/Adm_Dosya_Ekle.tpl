<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Dosya Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Dosya Adı:</label>
<div class="controls"><input type="text" name="file_name"></div>
</div>
<div class="control-group">
<label class="control-label">Dosya Yolu:</label>
<div class="controls"><input type="text" name="file_path"></div>
</div>
<div class="control-group" style="text-align:left; padding-left:40px;">
Dosyalar "serverdizini/cstrike" yolundan eklenecektir.<br/>Örnek: /server.cfg
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_addfile">Ekle</button>
</div>
</form>
</div>
</div></div>