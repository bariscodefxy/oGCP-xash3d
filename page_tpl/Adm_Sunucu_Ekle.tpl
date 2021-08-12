<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Sunucu Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Sunucu IP:</label>
<div class="controls"><input type="text" name="server_ip"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Port:</label>
<div class="controls"><input type="text" value="27015" name="server_port"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Makinesi:</label>
<div class="controls">
	<select name="server_mach" style="width:206px;">
	<?php if($machines != false): foreach($machines as $machine): ?>
	<option value="<?=$machine["MachID"]?>"><?=$machine["MachIP"].":".$machine["MachPort"]?></option>
	<?php endforeach; else:?>
	<option value="0">---</option>
	<?php endif; ?>
	</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Paketi:</label>
<div class="controls">	
	<select name="server_packet" style="width:206px;">
	<?php if($packets != false): foreach($packets as $packet): ?>
	<option value="<?=$packet["PacketID"]?>"><?=$packet["PacketName"]?></option>
	<?php endforeach; else:?>
	<option value="0">---</option>
	<?php endif; ?>
	</select></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Map:</label>
<div class="controls"><input type="text" name="server_map" value="de_dust2"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Max.Slot:</label>
<div class="controls">
	<select name="server_maxslot" style="width:206px;">
		<option value="10">10 Oyuncu</option>
		<option value="11">11 Oyuncu</option>
		<option value="12">12 Oyuncu</option>
		<option value="13">13 Oyuncu</option>
		<option value="14">14 Oyuncu</option>
		<option value="15">15 Oyuncu</option>
		<option value="16">16 Oyuncu</option>
		<option value="17">17 Oyuncu</option>
		<option value="18">18 Oyuncu</option>
		<option value="19">19 Oyuncu</option>
		<option value="20">20 Oyuncu</option>
		<option value="21">21 Oyuncu</option>
		<option value="22">22 Oyuncu</option>
		<option value="23">23 Oyuncu</option>
		<option value="24">24 Oyuncu</option>
		<option value="25">25 Oyuncu</option>
		<option value="26">26 Oyuncu</option>
		<option value="27">27 Oyuncu</option>
		<option value="28">28 Oyuncu</option>
		<option value="29">29 Oyuncu</option>
		<option value="30">30 Oyuncu</option>
		<option value="31">31 Oyuncu</option>
		<option value="32" selected="selected">32 Oyuncu</option>
	</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Dizini:</label>
<div class="controls"><input type="text" name="server_path"></div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_addserver">Ekle</button>
</div>
</form>
</div>
</div></div>