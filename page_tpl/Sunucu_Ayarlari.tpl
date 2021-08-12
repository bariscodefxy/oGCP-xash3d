<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Sunucu Ayarları</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Gizle/Gö�ster" data-collapsed="false" class="tip collapse" data-original-title=""><i class="icon-chevron-up"></i></a>
              </div>
            </div>
            <div class="widget-body" align="center">
              <div class="widget-forms clearfix">
                <form class="form-horizontal" method="POST" action="<?=$page->CreatePageLink($cur_page)?>">
				
                  <div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Sunucu Adi</label>
                    <div class="controls" align="right">
                      <input class="span7 pop" name="hostname" data-content="Buraya sunucu adı girebilir değiştirebilirsiniz" type="text" value="<?=$oGCP['server.cfg']['hostname']?>">
                    </div>
                  </div>
				  
                  <div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Rcon Şifresi</label>
                    <div class="controls" align="right">
                      <input class="span7 pop" name="rcon_password" data-content="Bu şifre sayesinde Panelden başka araçlarla sunucunuzu yönetebilirsiniz(Örnek: HLSW)" type="text" value="<?=$oGCP['server.cfg']['rcon_password']?>">
                    </div>
                  </div>

                    <!-- <div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">sv_contact (say /admin yazısı)</label>
                    <div class="controls" align="right">
                      <input class="span7 pop" name="sv_contact" data-content="Buraya İletişim adresi yazabilirsiniz" type="text" value="<?=$oGCP['server.cfg']['sv_contact']?>" hidden>
                    </div>
                  </div> -->
				  <div align="center">Harita Ayarları</div><br><br>
				  
                  <div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Harita Süresi (mp_timelimit)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_timelimit" type="text" value="<?=$oGCP['server.cfg']['mp_timelimit']?>" style="width: 50px">
                    </div>
                  </div>

				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Tur Süresi (mp_roundtime)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_roundtime" type="text" value="<?=$oGCP['server.cfg']['mp_roundtime']?>" style="width: 50px">
                    </div>
                  </div>
				  
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Tur başı bekleme süresi (mp_freezetime)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_freezetime" type="text" value="<?=$oGCP['server.cfg']['mp_freezetime']?>" style="width: 50px">
                    </div>
                  </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Başlangıç Parası (mp_startmoney)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_startmoney" type="text" value="<?=$oGCP['server.cfg']['mp_startmoney']?>" style="width: 55px">
                    </div>
                  </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Satın Alma Süresi (mp_buytime)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_buytime" type="text" value="<?=$oGCP['server.cfg']['mp_buytime']?>" style="width: 50px">
                    </div>
                  </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">C4 Patlama Süresi (mp_c4timer)</label>
                    <div class="controls" align="right">
                      <input class="span7" name="mp_c4timer" type="text" value="<?=$oGCP['server.cfg']['mp_c4timer']?>" style="width: 50px">
                    </div>
                  </div>
				   <div align="center">Takım Dengeleme Ayarları</div><br><br>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Otomatik Takım Dengeleme (mp_autoteambalance)</label>
                    <div class="controls" align="right">
                     <select name="mp_autoteambalance"><option value="1" <?=$oGCP['server.cfg']['mp_autoteambalance'] == 1 ? "selected" : "" ?>>Açık</option><option value="0" <?=$oGCP['server.cfg']['mp_autoteambalance'] == 0 ? "select" : "" ?>>Kapalı</option></select>
                    </div><br>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Takım Değiştirmedeki Oyuncu Farkı (mp_limitteams)</label>
                    <div class="controls" align="right">
                     <input class="span7" name="mp_limitteams" type="text" value="<?=$oGCP['server.cfg']['mp_limitteams']?>" style="width: 50px">
                    </div>
					<div align="center">Ses Ayarları</div><br><br>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Konuşmalar (sv_voiceenable)</label>
                    <div class="controls" align="right">
                     <select name="sv_voiceenable"><option value="1" <?=$oGCP['server.cfg']['sv_voiceenable'] == 1 ? "selected" : "" ?>>Açık</option><option value="0" <?=$oGCP['server.cfg']['sv_voiceenable'] == 0 ? "selected" : "" ?>>Kapalı</option></select>
                    </div>
            </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Ses Kalitesi (sv_voicequality)</label>
                    <div class="controls" align="right">
                     <select name="sv_voicequality">
				<option value="5" <?=$oGCP['server.cfg']['sv_voicequality'] == 5 ? "selected" : "" ?>>5</option>
				<option value="4" <?=$oGCP['server.cfg']['sv_voicequality'] == 4 ? "selected" : "" ?>>4</option>
				<option value="3" <?=$oGCP['server.cfg']['sv_voicequality'] == 3 ? "selected" : "" ?>>3</option>
				<option value="2" <?=$oGCP['server.cfg']['sv_voicequality'] == 2 ? "selected" : "" ?>>2</option>
				<option value="1" <?=$oGCP['server.cfg']['sv_voicequality'] == 1 ? "selected" : "" ?>>1</option>
			</select>
                    </div>
            </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Codec Biçimi (sv_voicecodec)</label>
                    <div class="controls" align="right">
                     <select name="sv_voicecodec">
				<option value="voice_speex" <?=$oGCP['server.cfg']['sv_voicecodec'] == "voice_speex" ? "selected" : "" ?>>voice_speex</option>
				<option value="voice_miles" <?=$oGCP['server.cfg']['sv_voicecodec'] == "voice_miles" ? "selected" : "" ?>>voice_miles</option>
			</select>
                    </div>
            </div>
				<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Karşı takım ve ölüler sesleri duyabilmesi (sv_alltalk)</label>
                    <div class="controls" align="right">
                     <select name="sv_alltalk">
				<option value="1" <?=$oGCP['server.cfg']['sv_alltalk'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['sv_alltalk'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div align="center">Diğer Ayarlar (Bilginiz yoksa Dokunmayın!)</div><br><br>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Ayak Sesleri (mp_footsteps)</label>
                    <div class="controls" align="right">
                     <select name="mp_footsteps">
				<option value="1" <?=$oGCP['server.cfg']['mp_footsteps'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['mp_footsteps'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Fener Kullanımı (mp_flashlight)</label>
                    <div class="controls" align="right">
                     <select name="mp_flashlight">
				<option value="1" <?=$oGCP['server.cfg']['mp_flashlight'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['mp_flashlight'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Takım arkadaşını öldürme (mp_friendlyfire)</label>
                    <div class="controls" align="right">
                     <select name="mp_friendlyfire">
				<option value="1" <?=$oGCP['server.cfg']['mp_friendlyfire'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['mp_friendlyfire'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Takım arkadaşını öldüreni kickleme (mp_autokick)</label>
                    <div class="controls" align="right">
                     <select name="mp_autokick">
				<option value="1" <?=$oGCP['server.cfg']['mp_autokick'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['mp_autokick'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Takım arkadaşını öldüreni cezalandırma (mp_tkpunish)</label>
                    <div class="controls" align="right">
                     <select name="mp_tkpunish">
				<option value="1" <?=$oGCP['server.cfg']['mp_tkpunish'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['mp_tkpunish'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">İzleyici olma izni (allow_spectators)</label>
                    <div class="controls" align="right">
                     <select name="allow_spectators">
				<option value="1" <?=$oGCP['server.cfg']['allow_spectators'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['allow_spectators'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Kamera Açıları (mp_forcecamera)</label>
                    <div class="controls" align="right">
                     <select name="mp_forcecamera">
				<option value="0" <?=$oGCP['server.cfg']['mp_forcecamera'] == 0 ? "selected" : "" ?>>Tüm Oyuncuları Görebilir.</option>
				<option value="1" <?=$oGCP['server.cfg']['mp_forcecamera'] == 1 ? "selected" : "" ?>>Sadece Kendi Takımının Oyuncularını Görebilir</option>
				<option value="2" <?=$oGCP['server.cfg']['mp_forcecamera'] == 2 ? "selected" : "" ?>>Kimseyi izleyemez, Sadece olayları takip eder.</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Num ucunda oyuncu ismi (mp_playerid)</label>
                    <div class="controls" align="right">
                     <select name="mp_playerid">
				<option value="0" <?=$oGCP['server.cfg']['mp_playerid'] == 0 ? "selected" : "" ?>>Tam isim gözüksün</option>
				<option value="1" <?=$oGCP['server.cfg']['mp_playerid'] == 1 ? "selected" : "" ?>>Takım oyuncunun ismi gözüksün</option>
				<option value="2" <?=$oGCP['server.cfg']['mp_playerid'] == 2 ? "selected" : "" ?>>İsim Gözükmesin</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Sprey Kullanım Aralığı (decalfrequency)</label>
                    <div class="controls" align="right">
                     <input class="span7" name="decalfrequency" type="text" value="<?=$oGCP['server.cfg']['decalfrequency']?>" style="width: 50px">
                    </div>
            </div>
			<div align="center">sXe-Injected Ayarları</div><br><br>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">sXe Durumu (__sxei_required)</label>
                    <div class="controls" align="right">
                    <select name="__sxei_required">
				<option value="1" <?=$oGCP['server.cfg']['__sxei_required'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="2" <?=$oGCP['server.cfg']['__sxei_required'] == 2 ? "selected" : "" ?>>Fake sXe</option>
				<option value="0" <?=$oGCP['server.cfg']['__sxei_required'] == 0 ? "selected" : "" ?>>Opsiyonel</option>
				<option value="-1" <?=$oGCP['server.cfg']['__sxei_required'] == -1 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">16bpp Koruması (__sxei_16bpp)</label>
                    <div class="controls" align="right">
                     <select name="__sxei_16bpp">
				<option value="1" <?=$oGCP['server.cfg']['__sxei_16bpp'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['__sxei_16bpp'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Antiwall Koruması (__sxei_antiwall)</label>
                    <div class="controls" align="right">
                     <select name="__sxei_antiwall">
				<option value="1" <?=$oGCP['server.cfg']['__sxei_antiwall'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['__sxei_antiwall'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
			<div class="control-group">
                    <label class="control-label" style="text-align:left;width: 50%">Antispeed Koruması (__sxei_antispeed)</label>
                    <div class="controls" align="right">
                     <select name="__sxei_antispeed">
				<option value="1" <?=$oGCP['server.cfg']['__sxei_antispeed'] == 1 ? "selected" : "" ?>>Açık</option>
				<option value="0" <?=$oGCP['server.cfg']['__sxei_antispeed'] == 0 ? "selected" : "" ?>>Kapalı</option>
			</select>
                    </div>
            </div>
              </div>
            </div>
          </div>
        </div>
	<div class="widget-footer" align="right">
               <button class="btn btn-primary" type="submit" name="yardir">Kaydet</button>
               <a href="<?=$page->CreatePageLink($cur_page)?>"><button class="btn" type="button">Ayarları Sıfırla</button></a>
            </div>