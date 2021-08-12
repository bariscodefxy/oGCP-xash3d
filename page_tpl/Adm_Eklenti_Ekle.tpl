<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Eklenti Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Eklenti Adı:</label>
<div class="controls"><input type="text" name="plugin_name"></div>
</div>
<div class="control-group">
<label class="control-label">Eklenti Açıklama:</label>
<div class="controls"><input type="text" name="plugin_desc"></div>
</div>
<div class="control-group">
<label class="control-label">Eklenti Dosya İsmi:</label>
<div class="controls"><input type="text" placeholder="ornek.amxx" name="plugin_file"></div>
</div>
<div class="control-group">
<label class="control-label"></label>
<div class="controls"><input type="checkbox" name="plugin_show" checked="checked"> Müşterilere gözüksün</div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_addplugin">Ekle</button>
</div>
</form>
</div>
</div></div>