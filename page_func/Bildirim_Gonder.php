<?php
	$sunucuip = $serverinfo["ServerIP"].":".$serverinfo["ServerPort"];

	foreach($servers as $server) {
		$serverlar .= " <option value='".$server["UserServerID"]."'>".$server["ServerIP"].":".$server["ServerPort"]."</option> ";
	}
	
	if(isset($_POST["yardir"])) {
		if( SendTicket(@$_POST["konu"],@$_POST["mesaj"],@$_POST["serverid"],@$_POST["priority"]) ) {
			print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">Ã—</button><strong>Başarılı!</strong> Bildirim başarılı bir şekilde gönderildi! </div>');
		} else {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">Ã—</button><strong>Başarısız!</strong> Bildirim gönderilirken bir problem oluştu! </div>');
		}
	}
?>