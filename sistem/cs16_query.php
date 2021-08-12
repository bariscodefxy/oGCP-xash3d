<?php 
	class CS16_Query {
		// Buffer
		private $currentBuffer 	= "";
		private $currentPos		= 0;
		private $currentLen		= 0;
		
		// Socket Connection
		private $SOCK			= null;
		private $IsConnected	= null;
		
		// Server Information
		private $ServerIP		= null;
		private $ServerPort		= 27015;
		private $ChallengeNumb	= null;
		
		// Rcon Information
		private $Rcon_Password	= null;
		private $Rcon_Challenge	= null;
		
		// Server Queries
		const A2S_CHALLENGE		= "\x56\x00\x00\x00\x00";
		const A2S_PING			= "\x69";
		const A2S_INFO			= "\x54Source Engine Query\x00";
		const A2S_PLAYERS		= "\x55{challenge_number}";
		const A2S_RULES			= "\x56{challenge_number}";
		
		// Challenge Status
		const GETCHALLENGE_FAILED 		= 0;
		const GETCHALLENGE_SUCCESS 		= 1;
		const GETCHALLENGE_IN_ANSWER	= 2;
		
		// Server Answers
		const S2A_CHALLENGE		= "A";
		const S2A_PING			= "j";
		const S2A_INFO			= "m";
		const S2A_PLAYERS		= "D";
		const S2A_RULES			= "E";
		const S2A_RCON      	= "l";
		
		// Rcon Sent
		const SERVERDATA_EXECCOMMAND    = 2;
		const SERVERDATA_AUTH           = 3;
		
		// Rcon Received
		const SERVERDATA_RESPONSE_VALUE = 0;
		const SERVERDATA_AUTH_RESPONSE  = 2;
		
		
		####### Constructor
		public function __construct() {
			// Clearing Server Information
			$this->ServerIP 	= "";
			$this->ServerPort 	= 27015;
			
			// Clearing Rcon Information
			$this->Rcon_Password  = "";
			$this->Rcon_Challenge = "";
			
			// Clearing Socket Connection
			$this->SOCK			= null;
			$this->IsConnected 	= false;
			
			// Clearing Buffer
			$this->currentBuffer= "";
			$this->currentPos	= 0;
			$this->currentLen	= 0;
		}
		
		####### Destructor
		public function __destruct() {
			self::Disconnect();
		}
		
		####### Connect Function
		public function Connect($IP,$PORT=27015) {
			if($this->IsConnected || $IP == "") return false;
		
			if($PORT <= 0) $PORT=27015;
			$this->ServerIP 	= $IP;
			$this->ServerPort 	= 27015;
				
			// Creating Socket Connection
			$this->SOCK = fsockopen("udp://".$this->ServerIP,$this->ServerPort,$errno,$errstr,2);
			
			if($this->SOCK) {
				$this->IsConnected = true;
				stream_set_timeout($this->SOCK,2,0);
				stream_set_blocking($this->SOCK,true);
			}
			return true;
		}
		
		####### Disconnect Function
		public function Disconnect() {
			// Clearing Server Information
			$this->ServerIP 	= "";
			$this->ServerPort 	= 27015;
			
			// Clearing Rcon Information
			$this->Rcon_Password  = "";
			$this->Rcon_Challenge = "";
			
			// Clearing Socket Connection
			$this->SOCK			= null;
			if($this->SOCK) fclose($this->SOCK);
			$this->IsConnected 	= false;
			
			// Clearing Buffer
			self::Buffer_Reset();
		}
		
		####### GetChallenge Function
		private function GetChallenge($Ret_Header) {
			if(!$this->IsConnected) return false; // Sunucuya baðlanýlmamýþsa false döndür.
			
			$this->WritePacket(self::A2S_CHALLENGE);
			$data = $this->ReadPacket();
			if(substr($data,4,1) == "I") $data = $this->ReadPacket();
			$this->ChallengeNumb = $data;
			if( ( ($Ret_Header == self::S2A_RULES) ? substr($data,13,1) : substr($data,4,1) ) == $Ret_Header) return 2;
			else if($data[4] == self::S2A_CHALLENGE) { $this->ChallengeNumb = substr($this->ChallengeNumb,5); return 1; }
			
			return 0;
		}
		
		####### Info Function
		public function Info() {
			if(!$this->IsConnected) return false; // Sunucuya baðlanýlmamýþsa false döndür.
			
			$this->WritePacket(self::A2S_INFO);
			$data = $this->ReadPacket();
			
			if(!trim($data) || !$data || $data[4] != self::S2A_INFO ) return false; // Gelen veri istenilen veri deðilse false döndür.
			$this->Buffer_Set(substr($data,5));
			$server_inf["address"] 	= $this->Buffer_GetString();
			$server_inf["hostname"] = $this->Buffer_GetString();
			$server_inf["map"] 		= $this->Buffer_GetString();
			$server_inf["folder"] 	= $this->Buffer_GetString();
			$server_inf["game"] 	= $this->Buffer_GetString();
			$server_inf["players"]	= $this->Buffer_GetInt8();
			$server_inf["mplayers"]	= $this->Buffer_GetInt8();
			$server_inf["protocol"]	= $this->Buffer_GetInt8();
			$server_inf["stype"]	= chr($this->Buffer_GetInt8());
			$server_inf["serveros"]	= chr($this->Buffer_GetInt8());
			$server_inf["password"]	= $this->Buffer_GetInt8();
			$server_inf["IsMod"]		= $this->Buffer_GetInt8();
			if($server_inf["IsMod"] == 1) {
				$server_inf["Mod"]["mod_link"] 	= $this->Buffer_GetString();
				$server_inf["Mod"]["mod_downlink"] = $this->Buffer_GetString();
				$server_inf["Mod"]["mod_nullbyte"] = $this->Buffer_GetInt8();
				$server_inf["Mod"]["mod_version"]	= $this->Buffer_GetInt32();
				$server_inf["Mod"]["mod_size"]		= $this->Buffer_GetInt32();
				$server_inf["Mod"]["mod_type"] 	= $this->Buffer_GetInt8();
				$server_inf["Mod"]["mod_dll"] 		= $this->Buffer_GetInt8();
			}
			$server_inf["vac"]		= $this->Buffer_GetInt8();
			$server_inf["bots"]		= $this->Buffer_GetInt8();
			
			$this->Buffer_Reset();
			
			return $server_inf;
		}
		
		####### Players Function
		public function Players() {
			if(!$this->IsConnected) return false; // Sunucuya baðlanýlmamýþsa false döndür.
			
			$challenge_status = $this->GetChallenge(self::S2A_PLAYERS);
			
			if($challenge_status == self::GETCHALLENGE_FAILED) return false;
			
			if($challenge_status == self::GETCHALLENGE_IN_ANSWER) {
				$data = $this->ChallengeNumb;
			} else if($challenge_status == self::GETCHALLENGE_SUCCESS) {
				$packet = str_replace('{challenge_number}',$this->ChallengeNumb,self::A2S_PLAYERS);
				$this->WritePacket($packet);
				$data = $this->ReadPacket();
				if($data[4] == self::S2A_CHALLENGE) $data = $this->ReadPacket();
			}
			if(!trim($data) || !$data) return false;
			
			if( $challenge_status > 1 && $data[4] != self::S2A_PLAYERS) return false;
			
			$data = substr($data,5);
			$this->Buffer_Set($data);
			$players_num = $this->Buffer_GetInt8();
			
			$players = array();
			while($players_num-- > 0 && $this->Buffer_Left() > 0) {
				$player["Index"]	= $this->Buffer_GetInt8();
				$player["Name"]		= $this->Buffer_GetString();
				$player["Score"]	= $this->Buffer_GetInt32();
				$player["Duration"]	= (int)$this->Buffer_GetFloat();
				
				$players[] = $player;
			}
			
			$this->Buffer_Reset();
			return $players;
		}
		
		####### Rules Function
		public function Rules() {
			if(!$this->IsConnected) return false; // Sunucuya baðlanýlmamýþsa false döndür.
			
			$challenge_status = $this->GetChallenge(self::S2A_RULES);
			
			if($challenge_status == self::GETCHALLENGE_FAILED) return false;
			if($challenge_status == self::GETCHALLENGE_IN_ANSWER) {
				$data = $this->ChallengeNumb;
				$packet_num = ord(substr($data,8,1));
				
				for($i=1; $i < $packet_num; $i++) {
					$data2 = $this->ReadPacket();
					$data2 = substr($data2,8); 
					$data .= $data2;
				}
				
			} else if($challenge_status == self::GETCHALLENGE_SUCCESS) {
				$this->WritePacket(str_replace('{challenge_number}',$this->ChallengeNumb,self::A2S_RULES));
				$data = $this->ReadPacket();
				if($data[4] == self::S2A_CHALLENGE) $data = $this->ReadPacket();
				$packet_num = ord(substr($data,8,1));
				
				for($i=1; $i < $packet_num; $i++) {
					$data2 = $this->ReadPacket();
					$data2 = substr($data2,8); 
					$data .= $data2;
				}
				
			}
			if(!trim($data) || !$data ) return false; // Gelen veri istenilen veri deðilse false döndür.
			if( $challenge_status > 1 && substr($data,13,1) != self::S2A_RULES) return false;
			$data = substr($data,14);
			
			$this->Buffer_Set($data);
			$num_count = $this->Buffer_GetInt8();
			$this->Buffer_Skip(1);
			
			$rules = array();
			
			while($num_count-- > 0 && $this->Buffer_Left() > 0) {
				$RuleName 	= $this->Buffer_GetString();
				$RuleValue 	= $this->Buffer_GetString();
				
				if($RuleName != "") {
					$rules[$RuleName] = $RuleValue;
				}
			}
			
			return $rules;
		}
		
		####### Read and Write Functions
		private function ReadPacket() {
			return fread($this->SOCK,2048);
		}
		
		private function WritePacket($write_packet) {
			fputs($this->SOCK,"\xff\xff\xff\xff".$write_packet,strlen("\xff\xff\xff\xff".$write_packet));
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
		
		private function Buffer_Reset() {
			$this->currentBuffer	= "";
			$this->currentPos 		= 0;
			$this->currentLen		= 0;
		}
		
		public function RconPassword($password){
			if(!$this->IsConnected || $password == "") return false; // Sunucuya baðlanýlmamýþsa false döndür.
			$this->Rcon_Password = $password;
			return $this->Rcon_Auth();
		}
		
		private function Rcon_Auth() {
			if(!$this->IsConnected) return false; // Sunucuya baðlanýlmamýþsa false döndür.
			$this->WritePacket("challenge rcon");
			$data = $this->ReadPacket();
			if(!$data || !trim($data) ) return false;
			while(substr($data,4,1) != "c") { 
				$data = $this->ReadPacket();
			}
			$this->Buffer_Set($data);
			$this->Buffer_Skip(4);
			if($this->Buffer_Get(14) != "challenge rcon") return false;
			
			$data2 = $this->Buffer_Get();
			$this->Rcon_Challenge = Trim($data2);
			return true;
		}

	function ServerInfo()
  	{
    		if(!$this->IsConnected)
      			return $this->IsConnected;

    		$status = $this->RconCommand("status");
    		if(!$status || trim($status) == "Bad rcon_password.")
      			return $status;

    		$line = explode("\n", $status);
    		$map = substr($line[3], strpos($line[3], ":") + 1);
    		$players = trim(substr($line[4], strpos($line[4], ":") + 1));
    		$active = explode(" ", $players);

    		$result["ip"] = trim(substr($line[2], strpos($line[2], ":") + 1));
    		$result["name"] = trim(substr($line[0], strpos($line[0], ":") + 1));
   		$result["map"] = trim(substr($map, 0, strpos($map, "at:")));
    		$result["mod"] = "Counterstrike " . trim(substr($line[1], strpos($line[1], ":") + 1));
    		$result["game"] = "Halflife";
    		$result["activeplayers"] = $active[0];
    		$result["maxplayers"] = substr($active[2], 1);

   		for($i = 1; $i <= $result["activeplayers"]; $i++)
    		{
      			$tmp = $line[$i + 6];

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
			$end = strpos($tmp, " ");
     			$result[$i]["loss"] = substr($tmp, 0, $end);
    			$tmp = trim(substr($tmp, $end));

      			//Adress
      			$result[$i]["adress"] = $tmp;

    		}

   		return $result;

  	}
		
		public function RconCommand($com22mand) 	{
			if(!$this->IsConnected || $this->Rcon_Challenge == "") return false; // Sunucuya baðlanýlmamýþsa false döndür.
			$writepack = trim("rcon ".$this->Rcon_Challenge." \"".$this->Rcon_Password."\" $com22mand\n");
			$this->WritePacket($writepack);
			$data = $this->ReadPacket();
			if(!$data || !trim($data) || @$data[4] != "l" ) return false;
			
			$new_data = trim(substr($data,5));
			
			if($new_data == 'Bad rcon_password.' || $new_data == 'You have been banned from this server.' ) return $new_data;
			
			$MultiPacket = strlen( $new_data ) > 1000;

			do
			{
				$data3 = $this->ReadPacket();
				$this->Buffer_Set(substr($data3,4));
				$MultiPacket = $this->Buffer_Left( ) > 0 && $this->Buffer_Get(1) == "l";
				if( $MultiPacket )
				{
					$data3  = $this->Buffer_Get( );
					$data .= substr( $data3, 0, -2 );
					$MultiPacket = strlen( $new_data ) > 1000;
				}
			}
			while($MultiPacket);
			
			$data = substr($data,5);
			$this->Buffer_Reset();
			return $data;
		}
	}
?>