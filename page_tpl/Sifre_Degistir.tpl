<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 50%">
<?php
	if(@$hata != "" && @$tamam == "") {
		print($hata);
	} else if(@$hata == "" && @$tamam != "") {
		print($tamam);
	}
?>
<div class="widget-header"><i class="icon-list-alt"></i><h5>Şifre Değiştir</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body" style="min-height:330px;">
<div class="widget-forms clearfix"><br/>
<div class="control-group ">
<label class="control-label">Eski Şifre:</label>
<div class="controls"><input type="password" name="password" id="form_password"></div>
</div>
<div class="control-group ">
<label class="control-label">Yeni Şifre:</label>
<div class="controls"><input type="password" name="password_confirm" id="password_confirm"></div>
</div>
<div class="control-group ">
<label class="control-label">Yeni Şifreyi Tekrarla:</label>
<div class="controls"><input type="password" name="password_confirm2" id="password_confirm"></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-left btn btn-info btn-small" name="ogcp_changepass">Uygula</button>
</div>
</form>
</div>
</div></div>