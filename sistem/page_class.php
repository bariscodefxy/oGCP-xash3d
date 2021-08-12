<?php 
	class PageFrmwork {
		public $currentPage = null;
		public $pageInfo	= null;
		public $siteAddr	= null;
		private $userStatus = null;
		
		public function __construct($pageInfo,$siteAddr) {
			$this->pageInfo 	= $pageInfo;
			$this->siteAddr	= $siteAddr;
		} 
		
		public function __destruct() {
			$this->currentPage 	= null;
			$this->pageInfo 	= null;
			$this->siteAddr		= null;
			$this->userStatus	= null;
		}
		
		public function CreatePageLink($page,$extra = '') {
			if(!isset($this->pageInfo[$page])) return $this->siteAddr."/".$this->DefaultPage()."/";
			return $this->siteAddr."/".$this->pageInfo[$page]["URL"]."/".$extra;
		}
		
		public function LoadTheme_File($file) {
			return $this->siteAddr."/theme/".$file;
		}
		
		public function LoadFunction_File($page) {
			return "page_func/".$page.".php";
		}
		
		public function LoadTemplate_File($page) {
			return "page_tpl/".$page.".tpl";
		}
		
		public function DefaultPage() {
			if(@$_SESSION["OGCP_UserLogged"] == 1) return "Anasayfa";
			return "Giris";
		}

		public function GoLocation($link) {
			if($link == "") $link = "index.php";
			if (!headers_sent()){  
       			header('Location: '.$link); exit; 
    			}else{ 
       			echo '<script type="text/javascript">'; 
        			echo 'window.location.href="'.$link.'";'; 
        			echo '</script>'; 
        			echo '<noscript>'; 
        			echo '<meta http-equiv="refresh" content="0;url='.$link.'" />'; 
        			echo '</noscript>'; exit; 
    			}
		}
		
		public function PageControl() {
			if(@$_GET["Page"]!=""&&isset($this->pageInfo[@$_GET["Page"]])&&(@$_SESSION["OGCP_UserLogged"]==$this->pageInfo[@$_GET["Page"]]["Status"] || $this->pageInfo[@$_GET["Page"]]["Status"] == 2)) return 1;
			else return 0;
		}
		public function Adm_PermControl($userinf,$page) {
			if(@$this->pageInfo[$page]["Perm"] == "") return true;
			if($_SESSION["OGCP_UserAdmin"] && $userinf[@$this->pageInfo[$page]["Perm"]] == 1) return true; else return false;
		}
	}
?>