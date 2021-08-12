<script type="text/javascript" src="<?=$page->LoadTheme_File('jscolor/jscolor.js')?>"></script>
<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Sunucu Reklamları</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse" data-original-title=""><i class="icon-chevron-up"></i></a>
              </div>
            </div>
            <div class="widget-body" align="center">
              <div class="widget-forms clearfix">
                <form class="form-horizontal" method="POST" action="<?=$page->CreatePageLink($cur_page)?>">
				
			<div class="control-group">
                    <label class="control-label" style="text-align:left">Reklam # 1</label>
                    <div class="controls" align="right">
                     <input class="span7 color" type="text" name="reklam1_renk" value="<?=rgb2hex(array( intval(substr($reklamlar['amx_imessage'][0][3],0,3)), intval(substr($reklamlar['amx_imessage'][0][3],3,3)), intval(substr($reklamlar['amx_imessage'][0][3],6,3))))?>" style="width:70px;"> <input class="span7" type="text" name="reklam1" value="<?=$reklamlar['amx_imessage'][0][1]?>">
                    </div>
           		</div>
				  
			<div class="control-group">
                    <label class="control-label" style="text-align:left">Reklam # 2</label>
                    <div class="controls" align="right">
			<input class="span7 color" type="text" name="reklam2_renk" value="<?=rgb2hex(array( intval(substr($reklamlar['amx_imessage'][1][3],0,3)), intval(substr($reklamlar['amx_imessage'][1][3],3,3)), intval(substr($reklamlar['amx_imessage'][1][3],6,3))))?>" style="width:70px;">
                     <input class="span7" type="text" name="reklam2" value="<?=$reklamlar['amx_imessage'][1][1]?>">
                    </div>
           		</div>
				 
			<div class="control-group">
                    <label class="control-label" style="text-align:left">Reklam # 3</label>
                    <div class="controls" align="right">
			<input class="span7 color" type="text" name="reklam3_renk" value="<?=rgb2hex(array( intval(substr($reklamlar['amx_imessage'][2][3],0,3)), intval(substr($reklamlar['amx_imessage'][2][3],3,3)), intval(substr($reklamlar['amx_imessage'][2][3],6,3))))?>" style="width:70px;">
                     <input class="span7" type="text" name="reklam3" value="<?=$reklamlar['amx_imessage'][2][1]?>" >
                    </div>
            </div>

			<div class="control-group">
                    <label class="control-label" style="text-align:left">Reklam # 4</label>
                    <div class="controls" align="right">
			<input class="span7 color" type="text" name="reklam4_renk" value="<?=rgb2hex(array( intval(substr($reklamlar['amx_imessage'][3][3],0,3)), intval(substr($reklamlar['amx_imessage'][3][3],3,3)), intval(substr($reklamlar['amx_imessage'][3][3],6,3))))?>" style="width:70px;">
                     <input class="span7" type="text" name="reklam4" value="<?=$reklamlar['amx_imessage'][3][1]?>">
                    </div>
            </div>

				  <div align="center">Alttan kayan yazı (amx_scrollmsg)</div><br>
				  
			<div class="control-group">
                    <label class="control-label" style="text-align:left">Reklam # 5</label>
                    <div class="controls" align="right" style="width: 80%">
                      <input type="text" name="kayanzaman" class="span7" value="<?=$reklamlar['amx_scrollmsg'][0][2]?>" style="width: 30px"> Saniye <input class="span7" type="text" name="kayanyazi" value="<?=$reklamlar['amx_scrollmsg'][0][1]?>">
                    </div>
            </div>

              </div>
            </div>
            <div class="widget-footer" align="right">
               <button class="btn btn-primary" type="submit" name="yardir">Kaydet</button>            </div>
          </div>
        </div>