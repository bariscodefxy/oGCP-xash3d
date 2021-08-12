<?php
	class CS16_RCon {
	
		private $server_ip;
		private $server_port;
		private $server_conn;
		private $server_pass;
		private $rcon_challenge;
		
		// Socket Var
		private $Connection;
		
		public function __construct() 
		{
			$this->server_ip		= null;
			$this->server_port		= 27015;
			$this->server_conn		= false;
			$this->server_pass		= "";
			$this->rcon_challenge	= "";
			$this->Connection		= null;
		}
		
		private function Write($packet) 
		{
			return fputs($this->Connection,$packet,strlen($packet));
		} 
		
		private function Read()
		{
			return fread($this->Connection,2048);
		}
		
		public function Connect($server_ip,$server_port = 27015,$server_password) 
		{	
			// Sunucu bilgileri alýnýyor..
			$this->server_ip	= gethostbyname($server_ip);
			$this->server_port	= $server_port;
			$this->server_pass	= $server_password;
			
			// Sunucuya baðlantý oluþturuluyor...
			$socket = fsockopen("udp://".$this->server_ip,$this->server_port,$errno,$errstr,2);
			stream_set_timeout($socket,2);
			
			if($socket) { // Soket durumu kontrol ediliyor ve soket durumu doðru ise soket ayarlanýyor..
				$this->Connection = $socket;
				$this->server_conn = true;
				return true;
			}
			
			return false;
		}
		
		public function IsConnected() {
			return $this->server_conn;
		}
		
		####### Buffer Functions
		private function Buffer_Set($buffer) {
			if(strlen($buffer) <= 0) return false;
			
			$this->currentBuffer 	= $buffer;
			$this->currentPos		= 0;
			$this->currentLen		= strlen($buffer);
			
			return true;
		}
		
		private function Buffer_Get($Length = -1) {
			if($Length == 0) return "";
			if($Length > $this->Buffer_Left()) return "";
			if($Length == -1) $Length = $this->Buffer_Left();
			
			$Data = substr($this->currentBuffer,$this->currentPos,$Length);
			$this->currentPos += $Length;
			
			return $Data;
		}
		
		private function Buffer_Skip($Length = 0) {
			if($Length != 0) $this->currentPos += $Length;
		}
		
		private function Buffer_GetInt8() {
			return ord($this->Buffer_Get(1));
		}
		
		private function Buffer_GetInt16() {
			$get = unpack("v",$this->Buffer_Get(2));
			return $get[1];
		}
		
		private function Buffer_GetInt32() {
			$get = unpack("l",$this->Buffer_Get(4));
			return $get[1];
		}
		
		private function Buffer_GetFloat() {
			$get = unpack("f",$this->Buffer_Get(4));
			return $get[1];
		}
		
		private function Buffer_GetString() {
			$nullbyte_pos = strpos($this->currentBuffer,"\x00",$this->currentPos);
			
			if($nullbyte_pos === false) {
				$data = "";
			} else {
				$data = $this->Buffer_Get($nullbyte_pos - $this->currentPos);
				$this->currentPos++;
			}
			return $data;
		}
		
		private function Buffer_Left() {
			return $this->currentLen - $this->currentPos;
		}


function ServerInfo()
  {
    //If there is no open connection return false
    if(!$this->server_conn)
      return $this->server_conn;

    //get server information
    $status = $this->RconCommand("status");
    if(substr($status,strlen($status) - 8, -2) != "users") $status .= substr($this->Read(),10,-2);

    //If there is no open connection return false
    //If there is bad rcon password return "Bad rcon_password."
    if(!$status || substr(trim($status),0,18) == "Bad rcon_password." || substr(trim($status),0,39) == "You have been banned from this server.")
      return false;


   //format global server info
    $line = explode("\n", $status);
    $map = substr(@$line[3], strpos(@$line[3], ":") + 1);
    $players = trim(substr(@$line[4], strpos(@$line[4], ":") + 1));
    $active = explode(" ", $players);

    $result["ip"] = trim(substr(@$line[2], strpos(@$line[2], ":") + 1));
    $result["name"] = trim(substr(@$line[0], strpos(@$line[0], ":") + 1));
    $result["map"] = trim(substr($map, 0, strpos($map, "at:")));
    $result["mod"] = "Counterstrike " . trim(substr(@$line[1], strpos(@$line[1], ":") + 1));
    $result["game"] = "Halflife";
    $result["activeplayers"] = @$active[0];
    $result["maxplayers"] = substr(@$active[2], 1);

    //format player info
    for($i = 1; $i <= $result["activeplayers"]; $i++)
    {
      //get possible player line
      $tmp = @$line[$i + 6];

      //break if no more players are left
      if(substr_count($tmp, "#") <= 0)
        break;

      //name
      $begin = strpos($tmp, "\"") + 1;
      $end = strrpos($tmp, "\"");
      $result[$i]["name"] = substr($tmp, $begin, $end - $begin);
      $tmp = trim(substr($tmp, $end + 1));

      //ID
      $end = strpos($tmp, " ");
      $result[$i]["id"] = substr($tmp, 0, $end);
      $tmp = trim(substr($tmp, $end));

      //WonID
      $end = strpos($tmp, " ");
      $result[$i]["wonid"] = substr($tmp, 0, $end);
      $tmp = trim(substr($tmp, $end));

      //Frag
      $end = strpos($tmp, " ");
      $result[$i]["frag"] = substr($tmp, 0, $end);
      $tmp = trim(substr($tmp, $end));

      //Time
      $end = strpos($tmp, " ");
      $result[$i]["time"] = substr($tmp, 0, $end);
      $tmp = trim(substr($tmp, $end));

      //Ping
      $end = strpos($tmp, " ");
      $result[$i]["ping"] = substr($tmp, 0, $end);
      $tmp = trim(substr($tmp, $end));

      //Loss
      $result[$i]["loss"] = 0;
      //$tmp = trim(substr($tmp, $end));

      //Adress
      $tmp1 = explode(" ", trim($tmp));
      $tmp = explode(':',trim($tmp1[count($tmp1) - 1]));
      $result[$i]["adress"] = $tmp[0];

    } //for($i = 1; $i < $result["activeplayers"]; $i++)

    //return formatted result
    return $result;

  } 
		

		public function RconCommand($command) 
		{
			if(!$this->server_conn) return false;
			
			if($this->rcon_challenge == "") { // Challenge number alýnmadý ise al.
				$challenge = "\xff\xff\xff\xffchallenge rcon\n";
				$this->Write($challenge);
				$buffer = $this->Read();
				if(trim($buffer) == "")
				{
					$this->server_conn = false;
					return false;
				}
				
				$buffer = explode(" ", $buffer);
				$this->rcon_challenge = trim($buffer[2]);
			}
			
			$command = "\xff\xff\xff\xffrcon $this->rcon_challenge \"$this->server_pass\" $command\n";
			
			$result = "";
			$buffer = "";
			$this->Write($command);
			$i = 0;
			do {
				$buffer = "";
				$buffer = $this->Read();
				$i++;
				$result .= $i > 1 ? substr($buffer,5) : $buffer;
			} 
			while(strlen($buffer) > 1300);			

			return substr($result,5);
		}
		
		public function GetCvar($cvarname) {
			if(!$this->server_conn) return false; // Sunucu durum kontrolü
			if($cvarname == "") return ""; // Cvar adý boþ ise boþ yanýt döndür.
			$cvar_yanit = $this->RconCommand($cvarname);
			if($cvar_yanit == "" || trim($cvar_yanit) == "Bad rcon_password." || trim($cvar_yanit) == "You have been banned from this server.") return "<span style='color:red'>-----</span>";
			$tmp = explode('"',$cvar_yanit);
			if(@$tmp[1] != $cvarname) $cvar_yanit = $this->RconCommand($cvarname);
			$tmp = explode('"',$cvar_yanit);
			return @$tmp[3];
		}
	}
?>
