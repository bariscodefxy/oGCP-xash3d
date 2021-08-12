<?php
	class ogcp_ssh2 {
		private $socket;
		private $sftp;
		private $error;

		##### Constructor #####
		public function __construct() {
			$this->socket = null;
			$this->sftp = null;
			$this->error = "";
		}

		public function Connect($host,$port = 22) {
			if($host == "") return false;
			$host = gethostbyname($host);
			if( $this->socket = @ssh2_connect($host,$port) ) {
				return true;
			} else {
				$this->error = 'Error #01: Server not found!';
				return false;
			}
		}

		public function ConnectwAuth($host,$port = 22,$user,$pass) {
			if($host == "" || $user == "" || $pass == "") return false;

			if( $this->Connect($host,$port) ) {
				if(@ssh2_auth_password($this->socket,$user,$pass)) {
					return true;
				} else {
					$this->error = 'Error #02: Autentication rejected by server!';
					return false;
				}
			}
			$this->error = 'Error #01: Server not found!';
			return false;
		}

		public function SFTP_DownloadFile($uzak,$yerel) {
			return ssh2_scp_recv($this->socket, $uzak, $yerel);
    		}

		public function SFTP_UploadFile($dosya,$dosya2) {
        		return ssh2_scp_send($this->socket, $dosya, $dosya2, 0755);
    		}

		public function SFTP_DeleteFile($dosya) {
				$this->OpenSFTP();
				return ssh2_sftp_unlink($this->sftp, $dosya);
			}

		public function OpenSFTP() {
			if($this->sftp = ssh2_sftp($this->socket)) {
				return true;
			} else {
				$this->error = 'Error #03: SFTP Connection rejected!';
				return false;
			}
		}

		public function SFTP_ReadFile($filepath) {
			if($filepath == "") return false;
			if(!$this->sftp) {
				$this->sftp = @ssh2_sftp($this->socket);
			}
			$filepath = 'ssh2.sftp://'.$this->sftp.'/'.$filepath;
			if( !file_exists($filepath) ) { return false; } else {
				$dosya = @fopen($filepath,'r');
				$buffer = "";
				while(!feof($dosya)) {
					$buffer .= fread($dosya,filesize($filepath));
				}
				return $buffer;
			}
		}

		public function SFTP_FileLink($filepath) {
			if($filepath == "") return false;
			if(!$this->sftp) {
				$this->sftp = @ssh2_sftp($this->socket);
			}

			$filepath = 'ssh2.sftp://'.$this->sftp.'/'.$filepath;
			return $filepath;
		}

		public function Disconnect() {
			if(function_exists('ssh2_disconnect')) {
				@ssh2_disconnect($this->socket);
			} else {
				@fclose($this->socket);
				unset($this->socket);
			}

			return NULL;
		}

		public function Exec($cmd) {
			$durum = @ssh2_exec($this->socket, $cmd);
			@stream_set_blocking( $durum, true );
			return $durum;
		}
	}
?>
