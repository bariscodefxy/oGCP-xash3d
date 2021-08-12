<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header" style="font-family:'Open Sans',sans-serif;"><i class="icon-list-alt"></i><h5>Makine Düzenle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page,"ID=".$_GET["ID"]);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Makine Adres:</label>
<div class="controls"><input type="text" value="<?=$machine["MachIP"]?>"   name="mach_ip"></div>
</div>
<div class="control-group">
<label class="control-label">Makine Port(SSH):</label>
<div class="controls"><input type="text" value="<?=$machine["MachPort"]?>" name="mach_port"></div>
</div>
<div class="control-group">
<label class="control-label">SSH Kullanıcı Adı:</label>
<div class="controls"><input type="text" value="<?=$machine["MachUser"]?>" name="mach_kadi"></div>
</div>
<div class="control-group">
<label class="control-label">SSH Sifre:</label>
<div class="controls"><input type="text" value="<?=$machine["MachPass"]?>" name="mach_pass"></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_editmach">Düzenle</button>
</div>
</form>
</div>
</div></div>