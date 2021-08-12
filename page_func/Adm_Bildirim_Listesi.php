<?php
	$tickets = Adm_GetTicketList();
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($tickets[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_tickets WHERE TicketID=".intval($_GET["ID"])."; DELETE FROM ogcp_ticketmessages WHERE MessageTicketID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($tickets[(int)$_GET["ID"]]);
			echo "Bildirim Silindi!";
		} else {
			echo "Bildirim Silinemedi!";
		}
	}
?>