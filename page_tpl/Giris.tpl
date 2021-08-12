<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Oynucaz Dev Team">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link href="<?=$page->LoadTheme_File('css/bootstrap.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/theme.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/alertify.css')?>" rel="stylesheet">
    <link rel="Favicon Icon" href="favicon.ico">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrap">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          	<div class="row-fluid">
				<div class="widget container-narrow">
					<div class="widget-header">
						<i class="icon-user"></i>
						<h5>oGCP - Giriş</h5>
					</div>  
					<div class="widget-body clearfix" style="padding:25px;">
		      			<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST">
							<div class="control-group">
								<div class="controls">
									<input class="btn-block" type="text" name="ogcp_email" id="inputEmail" placeholder="Kullanıcı Adı"<?=@$_COOKIE["OGCP_Login_Mail"] != "" ? " value='".$_COOKIE["OGCP_Login_Mail"]."'" : "" ?>>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input class="btn-block" type="password" name="ogcp_pass" id="inputPassword" placeholder="Şifre">
								</div>
							</div>
							 <div class="control-group">
								<div class="controls clearfix">
									<label style="width:auto" class="checkbox pull-left">
										<input type="checkbox" name="beni_hatirla"> Beni Hatırla!
									</label>
									<a style="padding: 5px 0px 0px 5px;" href="#" class="pull-right">Şifrenizi mi unuttunuz?</a>
								</div>
							</div>					
							<button type="submit" name="ogcp_submit" class="btn pull-right">Giriş Yap</button>
		      			</form>
					</div>  
				</div>  
        	</div><!--/row-fluid-->
        </div><!--/span10-->
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
    </div><!-- wrap ends-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src='assets/js/sparkline.js'></script>
    <script type="text/javascript" src='assets/js/morris.min.js'></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="assets/js/jquery.masonry.min.js"></script>   
    <script type="text/javascript" src="assets/js/jquery.imagesloaded.min.js"></script>   
    <script type="text/javascript" src="assets/js/jquery.facybox.js"></script>   
    <script type="text/javascript" src="assets/js/jquery.elfinder.min.js"></script> 
    <script type="text/javascript" src="assets/js/jquery.alertify.min.js"></script> 
    <script type="text/javascript" src="assets/js/realm.js"></script>
  </body>
</html>
