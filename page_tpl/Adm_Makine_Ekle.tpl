<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Makine Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Makine Adres:</label>
<div class="controls"><input type="text" name="mach_ip"></div>
</div>
<div class="control-group">
<label class="control-label">Makine Port(SSH):</label>
<div class="controls"><input type="text" value="22" name="mach_port"></div>
</div>
<div class="control-group">
<label class="control-label">SSH Kullanıcı Adı:</label>
<div class="controls"><input type="text" name="mach_kadi"></div>
</div>
<div class="control-group">
<label class="control-label">SSH Sifre:</label>
<div class="controls"><input type="text" name="mach_pass"></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_addmach">Ekle</button>
</div>
</form>
</div>
</div></div>