<?php
$fn = new Fonksiyonlar();

$islem          					= array_key_exists( 'islem', $_REQUEST )  		? $_REQUEST[ 'islem' ] 	    	: 'ekle';
$ders_yili_donem_id          		= array_key_exists( 'ders_yili_donem_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_donem_id' ] 	: 0;


$kaydet_buton_yazi		= $islem == "guncelle"	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $islem == "guncelle"	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}

$donem_desleri_id	= array_key_exists( 'donem_desleri_id'	,$_REQUEST ) ? $_REQUEST[ 'donem_desleri_id' ]	: 0;

//bolume Ait bölüleri getirme
$SQL_programlar = <<< SQL
SELECT
	*
FROM
	tb_programlar
WHERE 
	universite_id = ? AND
	aktif 	 = 1
SQL;

$SQL_ders_yillari_getir = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari
WHERE
	universite_id = ? AND
	aktif 		  = 1
SQL;

$SQL_donemler_getir = <<< SQL
SELECT
	*
FROM
	tb_donemler
WHERE
	universite_id 	= ? AND
	program_id 		= ? AND
	aktif 		  	= 1
SQL;

$SQL_komiteler_getir = <<< SQL
SELECT 
	k.id,
	k.adi,
	k.ders_kodu,
	k.baslangic_tarihi,
	k.bitis_tarihi,
	k.sinav_tarihi
FROM  
	tb_komiteler as k
LEFT JOIN tb_ders_yili_donemleri as dyd ON dyd.id = k.ders_yili_donem_id
WHERE 
	dyd.ders_yili_id  	= ? AND
	dyd.program_id 		= ? AND 
	dyd.donem_id 		= ?
SQL;

$SQL_ders_yili_donem_oku = <<< SQL
SELECT 
	*
FROM  
	tb_ders_yili_donemleri
WHERE 
	id 		= ?
SQL;


$ders_yili_donemi   = $vt->select( $SQL_ders_yili_donem_oku, array( $_REQUEST[ "ders_yili_donem_id" ] ) )[2][0]; 

$ders_yili_id       = array_key_exists( 'ders_yili_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_id' ] 	: $ders_yili_donemi[ "ders_yili_id" ];
$program_id         = array_key_exists( 'program_id', $_REQUEST )  	? $_REQUEST[ 'program_id' ] 	: $ders_yili_donemi[ "program_id" ];
$donem_id          	= array_key_exists( 'donem_id', $_REQUEST )  	? $_REQUEST[ 'donem_id' ] 		:$ders_yili_donemi[ "donem_id" ];

$donemler 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $program_id ) )[2];
$ders_yillari		= $vt->select( $SQL_ders_yillari_getir, array($_SESSION[ 'universite_id' ] ) )[ 2 ];
$programlar			= $vt->select( $SQL_programlar, array( $_SESSION[ 'universite_id' ] ) )[ 2 ];
$komiteler			= $vt->select( $SQL_komiteler_getir, array( $ders_yili_id,$program_id, $donem_id ) )[ 2 ];

?>
<!-- UYARI MESAJI VE BUTONU-->
<div class="modal fade" id="sil_onay">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Lütfen Dikkat!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><b>Bu kategoriyi sildiğinizde kategori altındaki alt kategoriler de silinecektir.</b></p>
				<p>Bu kaydı <b>Silmek</b> istediğinize emin misiniz?</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
				<a type="button" class="btn btn-danger btn-evet">Evet</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
	$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
		$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
	} );
</script>

<script>  
	$(document).ready(function() {
		$('#limit-belirle').change(function() {

			$(this).closest('form').submit();

		});
	});
</script>
<div class="row">
	<!-- left column -->
	<div class="col-md-5">
		<!-- general form elements -->
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Dönem Dersi Ekle / Güncelle</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form id = "kayit_formu" action = "_modul/komiteler/komitelerSEG.php" method = "POST">
				<input type = "hidden" name = "islem" value = "<?php echo $islem; ?>">
				<input type = "hidden" name = "ders_yili_id" value = "<?php echo $ders_yili_id; ?>">
				<input type = "hidden" name = "program_id" value = "<?php echo $program_id; ?>">
				<input type = "hidden" name = "donem_id" value = "<?php echo $donem_id; ?>">
				<?php if ( $islem == "ekle") { ?>
					<div class="card-body">
						<div class="form-group">
							<label  class="control-label">Program</label>
							<select class="form-control select2" name = "program_id" id="program-sec" data-url="./_modul/ajax/ajax_data.php" data-islem="dersYillariListe" data-modul="<?php echo $_REQUEST['modul'] ?>" required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $programlar AS $program ){
										echo '<option value="'.$program[ "id" ].'" '.($program[ "program_id" ] == $program[ "id" ] ? "selected" : null) .'>'.$program[ "adi" ].'</option>';
									}

								?>
							</select>
						</div>
						<div class="form-group" id="dersYillari"> </div>
						<div class="form-group" id="donemListesi"> </div>
						<div class="form-group" id="dersler"> </div>
					</div>
					<!-- /.card-body -->
					
				<?php }else{ ?>
					<input type = "hidden" name = "ders_yili_donem_id" value = "<?php echo $ders_yili_donem_id; ?>">
					<div class="card-body">
						<div class="form-group">
							<label  class="control-label">Ders Yılı</label>
							<select class="form-control select2" disabled required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $ders_yillari AS $ders_yili ){
										echo '<option value="'.$ders_yili[ "id" ].'" '.($ders_yili[ "id" ] == $ders_yili_id ? "selected" : null) .'>'.$ders_yili[ "adi" ].'</option>';
									}
								?>
							</select>
						</div>
						
						<div class="form-group">
							<label  class="control-label">Program</label>
							<select class="form-control select2" disabled required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $programlar AS $program ){
										echo '<option value="'.$program[ "id" ].'" '.($program[ "id" ] == $program_id ? "selected" : null) .'>'.$program[ "adi" ].'</option>';
									}

								?>
							</select>
						</div>
						<div class="form-group">
							<label  class="control-label">Dönem</label>
							<select class="form-control select2"  disabled required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $donemler AS $donem ){
										echo '<option value="'.$donem[ "id" ].'" '.($donem[ "id" ] == $donem_id ? "selected" : null) .'>'.$donem[ "adi" ].'</option>';
									}
								?>
							</select>
						</div><br>
						<?php  
							if ( $islem == "guncelle" ) { 
								foreach ($komiteler as $komite) { ?>
							<hr>
							<div>
								<div class=" col-sm-11 float-left p-0 m-0" >
									<div class=" col-sm-4 float-left">
										<input type="text" name="ders_kodu" class="form-control" placeholder="Ders Kodu" value="<?php echo $komite[ 'ders_kodu' ] ?>">
									</div>
									<div class="form-group  col-sm-8 float-left">
										<input type="text" name="adi[]" class="form-control" placeholder="Ders Adı"  value="<?php echo $komite[ 'adi' ] ?>">
									</div>
									
									<div class="form-group col-sm-4 float-left">
										<input type="text" name="baslangic_tarihi[]"   class="form-control " data-toggle="datetimepicker" id="datetimepicker1" placeholder="Başlangıç Tarihi" required value="<?php echo $fn->tarihFormatiDuzelt($komite[ 'baslangic_tarihi' ]) ?>">
									</div>
									<div class="form-group col-sm-4 float-left">
										<input type="text" name="bitis_tarihi[]" class="form-control " placeholder="Bitiş Tarihi" data-toggle="datetimepicker"  id="datetimepicker2" required value="<?php echo $fn->tarihFormatiDuzelt($komite[ 'bitis_tarihi' ]) ?>">
									</div>
									<div class="form-group col-sm-4 float-left">
										<input type="text" name="sinav_tarihi[]" class="form-control" placeholder="Sınav Tarihi" data-toggle="datetimepicker"  id="datetimepicker3" required value="<?php echo $fn->tarihFormatiDuzelt($komite[ 'sinav_tarihi' ]) ?>">
									</div>
								</div>
								<div class="col-sm-1 p-0 float-left" style="display: flex;align-items: center;height: 93px;justify-content: center;">
										<a href="" class="btn btn-danger">Sil</a>
								</div>
							</div>	
							<div class="clearfix"></div>
						<?php } } ?>							
					</div>
						
						<?php 
						foreach ($komiteler as $komite) {
								echo '
								';
							}
						?>
					
				<?php } ?>
				<div class="clearfix"></div>
					<div class="card-footer">
						<button modul= 'programlar' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls ?> pull-right"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi ?></button>
						<button onclick="window.location.href = '?modul=komiteler&islem=ekle'" type="reset" class="btn btn-primary btn-sm pull-right" ><span class="fa fa-plus"></span> Temizle / Yeni Kayıt</button>
					</div>
			</form>
		</div>
		<!-- /.card -->
	</div>
	<!--/.col (left) -->
	<div class="col-md-7">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">Dönem Dersleri</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-0">

				<ul class="tree ">
				<?php  
					/*DERS Yılıllarını Getiriyoruz*/
					$ders_yillari = $vt->select( $SQL_ders_yillari_getir, array( $_SESSION[ "universite_id" ] ) )[2];

					foreach ($ders_yillari as $ders_yili ) { ?>
						
						<li><div class="ders-kapsa bg-secondary"><?php  echo $ders_yili[ "adi" ]; ?></div>
						<ul class="ders-ul" >
				<?php 
						/*Programların  Listesi*/
						$programlar = $vt->select( $SQL_programlar, array( $_SESSION[ "universite_id" ] ) )[2];
						foreach ($programlar as $program) { ?>
							
							<!-- Programlar -->
							<li><div class="ders-kapsa bg-danger"><?php echo $program[ "adi" ] ?></div> <!-- Second level node -->
							<ul class="ders-ul">
				<?php 		
							/*Dönemler Listesi*/
							$donemler = $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $program[ "id" ] ) )[2];
							foreach ( $donemler AS $donem ){ ?>
								<!--Dönemler-->
								<li>
									<div class="ders-kapsa">
										<?php echo $donem[ "adi" ]  ?>
										<a href="?modul=komiteler&islem=guncelle&ders_yili_id=<?php echo $ders_yili[ 'id' ] ?>&program_id=<?php echo $program[ 'id' ] ?>&donem_id=<?php echo $donem[ 'id' ] ?>" class="btn btn-warning float-right btn-xs">Düzenle</a>
									</div>
								<ul class="ders-ul">
				<?php 
								/*Ders Listesi*/
								$komiteler = $vt->select( $SQL_komiteler_getir, array( $ders_yili[ "id" ], $program[ "id" ], $donem[ "id" ] ) )[2];
								foreach ( $komiteler as $komite ) { ?>
									<li><div class="ders-kapsa bg-light">(<?php echo $komite[ "ders_kodu" ]  ?>) - <?php echo $komite[ "adi" ]; ?> <span class="float-right">(<?php echo $fn->tarihFormatiDuzelt($komite[ "baslangic_tarihi" ]).' - '. $fn->tarihFormatiDuzelt($komite[ "baslangic_tarihi" ])   ?>)</span></div></li>				
				<?php			
								}
								echo '</ul></li>';
							}
							echo '</ul></li>';
						}
						echo '</ul></li>';
					} 
				?>
				</ul>
			</div>
			<!-- /.card -->
		</div>
		<!-- right column -->
	</div>
<script type="text/javascript">
	
	$('#program-sec').on("change", function(e) { 
	    var $program_id = $(this).val();
	    var $data_islem = $(this).data("islem");
	    var $data_url 	= $(this).data("url");
	    var $data_modul	= $(this).data("url");
	    $("#dersYillari").empty();
	    $.post($data_url, { islem : $data_islem, program_id : $program_id, modul : $data_modul }, function (response) {
	        $("#dersYillari").append(response);
	    });
	});	

	$(function () {
		$('#datetimepicker1').datetimepicker({
			//defaultDate: simdi,
			format: 'DD.MM.yyyy',
			icons: {
			time: "far fa-clock",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
			}
		});

		$('#datetimepicker2').datetimepicker({
			//defaultDate: simdi,
			format: 'DD.MM.yyyy',
			icons: {
			time: "far fa-clock",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
			}
		});

		$('#datetimepicker3').datetimepicker({
			//defaultDate: simdi,
			format: 'DD.MM.yyyy',
			icons: {
			time: "far fa-clock",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
			}
		});
	});
	


</script>
