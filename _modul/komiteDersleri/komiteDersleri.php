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

$SQL_dersler_getir = <<< SQL
SELECT 
	dd.id,
	dd.ders_id,
	dd.teorik_ders_saati,
	dd.uygulama_ders_saati,
	d.adi,
	d.ders_kodu
FROM  
	tb_donem_dersleri as dd
LEFT JOIN tb_dersler  as d ON d.id = dd.ders_id
LEFT JOIN tb_ders_yili_donemleri as dyd ON dyd.id = dd.ders_yili_donem_id
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

/**/
$SQL_komiteler_getir = <<< SQL
SELECT
	k.adi,
	k.id,
	k.ders_kodu 
FROM 
	tb_komiteler AS k
LEFT JOIN tb_ders_yili_donemleri AS dyd ON dyd.id = k.ders_yili_donem_id
WHERE 
	dyd.ders_yili_id 	= ? AND 
	dyd.donem_id 		= ? AND
	dyd.program_id 		= ?
SQL;


@$ders_yili_donemi  = $vt->select( $SQL_ders_yili_donem_oku, array( $_REQUEST[ "ders_yili_donem_id" ] ) )[2][0]; 

$ders_yili_id       = array_key_exists( 'ders_yili_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_id' ] 	: $ders_yili_donemi[ "ders_yili_id" ];
$program_id         = array_key_exists( 'program_id', $_REQUEST )  	? $_REQUEST[ 'program_id' ] 	: $ders_yili_donemi[ "program_id" ];
$donem_id          	= array_key_exists( 'donem_id', $_REQUEST )  	? $_REQUEST[ 'donem_id' ] 		:$ders_yili_donemi[ "donem_id" ];

$donemler 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $program_id ) )[2];
$ders_yillari		= $vt->select( $SQL_ders_yillari_getir, array($_SESSION[ 'universite_id' ] ) )[ 2 ];
$programlar			= $vt->select( $SQL_programlar, array( $_SESSION[ 'universite_id' ] ) )[ 2 ];
$dersler			= $vt->select( $SQL_dersler_getir, array( $ders_yili_id,$program_id, $donem_id ) )[ 2 ];

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
			<form id = "kayit_formu" action = "_modul/komiteDersleri/komiteDersleriSEG.php" method = "POST">
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
						<div class="form-group" id="komiteler"> </div>
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
						</div>
						
					</div>
					<div class="col-sm-12">
						<div class="form-group " style="display: flex; align-items: center;">
							<div class="custom-control custom-checkbox col-sm-7 float-left">
								<b>Ders</b>
							</div>
							<div class="col-sm-2 float-left"><b>Teaorik D.S.</b></div>
							<div class="col-sm-2 float-left"><b>Uygulama D.S.</b></div>
							<div class="col-sm-1 float-left"><b>Sil</b></div>
						</div>
						<?php 
						foreach ($dersler as $ders) {
								echo '
								<div class="form-group " style="display: flex; align-items: center;">
									<div class="custom-control custom-checkbox col-sm-7 float-left">
										<input name="ders_id[]" type="hidden" id="'.$ders[ "id" ].'" value="'.$ders[ "id" ].'">
										<label for="'.$ders[ "id" ].'">'.$ders[ "ders_kodu" ].' - '.$ders[ "adi" ].'</label>
									</div>
									<input  type="number" class="form-control col-sm-2 float-left" name ="teorik_ders_saati-'.$ders[ "id" ].'"  autocomplete="off" value="'.$ders[ "teorik_ders_saati" ].'">
									<input  type="number" class="form-control col-sm-2 float-left m-1" name ="uygulama_ders_saati-'.$ders[ "id" ].'"  autocomplete="off" value="'.$ders[ "uygulama_ders_saati" ].'">
									<a href="" class="btn btn-sm btn-danger m-1" modul= "komiteDersleri" yetki_islem="sil" data-href="_modul/komiteDersleri/komiteDersleriSEG.php?islem=sil&donem_ders_id='.$ders[ "id" ].'&ders_yili_id='.$ders_yili_id.'&program_id='.$program_id.'&donem_id='.$donem_id.'" data-toggle="modal" data-target="#sil_onay"> Sil</a>
								</div><hr>';
							}
						?>

					</div>
					
				<?php } ?>
					<div class="card-footer">
						<button modul= 'programlar' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls ?> pull-right"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi ?></button>
						<button onclick="window.location.href = '?modul=komiteDersleri&islem=ekle'" type="reset" class="btn btn-primary btn-sm pull-right" ><span class="fa fa-plus"></span> Temizle / Yeni Kayıt</button>
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
										<a href="?modul=komiteDersleri&islem=guncelle&ders_yili_id=<?php echo $ders_yili[ 'id' ] ?>&program_id=<?php echo $program[ 'id' ] ?>&donem_id=<?php echo $donem[ 'id' ] ?>" class="btn btn-warning float-right btn-xs">Düzenle</a>
									</div>
								<ul class="ders-ul">
				
				<?php  
								/*Komiteler Listesi*/
								$komiteler = $vt->select( $SQL_komiteler_getir, array( $ders_yili[ 'id' ],$donem[ 'id' ],$program[ 'id' ] ) )[2];


				?>


				<?php 			
								/*Ders Listesi*/
								$dersler = $vt->select( $SQL_dersler_getir, array( $ders_yili[ "id" ], $program[ "id" ], $donem[ "id" ] ) )[2];
								foreach ( $dersler as $ders ) { ?>
									<li><div class="ders-kapsa bg-light"><?php echo $ders[ "adi" ]; ?> <span class="float-right">(<?php echo $ders[ "ders_kodu" ]  ?>)</span></div></li>				
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
</script>
