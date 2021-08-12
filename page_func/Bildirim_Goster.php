<?php
	if(@$_GET["ID"] == 0) $page->GoLocation($page->CreatePageLink('Bildirim_Listesi'));
	$ticket = GetTicket(@$_GET["ID"]);
	if($ticket == false) $page->GoLocation($page->CreatePageLink('Bildirim_Listesi'));

	$ticket_priclass = array(
		1 => "low","medium","high"
	);

	if(isset($_POST["yardir"])) {
		if(SendTicketMessage($_GET["ID"],@$_POST["message"])) {
			echo "Gonderildi";
			if(@$_POST["durum"] == "on") $baglan->query("UPDATE ogcp_tickets SET TicketStatus = 1 WHERE TicketID=".$_GET["ID"]);
			else if(@$_POST["durum"] != "on" && strlen(@$_POST["message"]) > 0) $baglan->query("UPDATE ogcp_tickets SET TicketStatus = 4 WHERE TicketID=".$_GET["ID"]); 
			$ticket = GetTicket(@$_GET["ID"]);
		} else {
			echo "Gonderilemedi";
		}
	}
?>