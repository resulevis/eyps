<?php
$fn = new Fonksiyonlar();



$islem          		= array_key_exists( 'islem', $_REQUEST )  				? $_REQUEST[ 'islem' ] 	    	  	: 'ekle';
$gorev_kategori_id     	= array_key_exists( 'gorev_kategori_id', $_REQUEST ) 	? $_REQUEST[ 'gorev_kategori_id' ] 	: 0;
$ders_yili_donem_id     = array_key_exists( 'ders_yili_donem_id', $_REQUEST ) 	? $_REQUEST[ 'ders_yili_donem_id' ] : 0;
$ders_yili_id          	= array_key_exists( 'ders_yili_id', $_REQUEST ) 		? $_REQUEST[ 'ders_yili_id' ] 		: $_SESSION['aktif_yil'];
$program_id          	= array_key_exists( 'program_id', $_REQUEST ) 			? $_REQUEST[ 'program_id' ] 		: $_SESSION['program_id'];
$donem_id          		= array_key_exists( 'donem_id', $_REQUEST ) 			? $_REQUEST[ 'donem_id' ] 			: 0;

$kaydet_buton_yazi		= $islem == "guncelle"	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $islem == "guncelle"	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}

$SQL_ders_yillari_getir = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari
WHERE
	universite_id 	= ? AND
	id 			 	= ? AND
	aktif 		  	= 1
SQL;

$SQL_ogretim_elemani_getir = <<< SQL
SELECT
	dg.id AS id, 
	oe.id AS ogretim_elemani_id,
	CONCAT( u.adi, ' ', oe.adi, ' ', oe.soyadi ) AS adi 
FROM 
	tb_donem_gorevlileri as dg
RIGHT JOIN 
	tb_ders_yili_donemleri as dyd ON dyd.id = dg.ders_yili_donem_id
RIGHT JOIN 
	tb_ogretim_elemanlari as oe ON oe.id = dg.ogretim_elemani_id
LEFT JOIN 
	tb_unvanlar AS u ON u.id = oe.unvan_id
WHERE 
	dyd.ders_yili_id 		= ? AND
	dyd.program_id 			= ? AND
	dyd.donem_id 		 	= ? AND
	dg.gorev_kategori_id 	= ? 
SQL;

/*Tüm Görev Kategorileri*/
$SQL_gorev_kategorileri_getir = <<< SQL
SELECT 
	*
FROM  
	tb_gorev_kategorileri
WHERE 
	universite_id 		= ?
SQL;

/*Doneme Eklenmiiş Görevli listesine ait kategorileri listeler*/
$SQL_eklenmis_gorev_kategorileri_getir = <<< SQL
SELECT 
	gk.id AS id,
	gk.adi AS adi
FROM  
	tb_donem_gorevlileri as dg
LEFT JOIN 
	tb_gorev_kategorileri as gk ON dg.gorev_kategori_id = gk.id
LEFT JOIN 
	tb_ders_yili_donemleri AS dyd ON dyd.id = dg.ders_yili_donem_id
WHERE 
	gk.universite_id 	= ? AND
	dyd.ders_yili_id  	= ? AND
	dyd.program_id 		= ? AND
	dyd.donem_id 		= ?
GROUP BY gk.id
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

$SQL_donemler_getir = <<< SQL
SELECT 
	dyd.id as id, 
	d.id AS donem_id,
	d.adi AS adi 
FROM 
	tb_ders_yili_donemleri AS dyd
LEFT JOIN 
	tb_donemler AS d ON d.id = dyd.donem_id
WHERE 
	dyd.ders_yili_id = ? AND
	dyd.program_id 	 = ?
SQL;

/*Doneme Eklenmiş olan gorevlilerin donemini getirme*/
$SQL_giris_yapilmis_donem_getir = <<< SQL
SELECT
	dyd.id AS ders_yili_donem_id,
	d.id AS donem_id,
	d.adi AS adi
FROM tb_donemler AS d
RIGHT JOIN tb_ders_yili_donemleri AS dyd ON dyd.donem_id = d.id
RIGHT JOIN tb_donem_gorevlileri AS dg ON dg.ders_yili_donem_id = dyd.id
WHERE 
	dyd.ders_yili_id 	= ? AND
	dyd.program_id 		= ?
SQL;


$ders_yillari		= $vt->select( $SQL_ders_yillari_getir, array( $_SESSION[ 'universite_id' ], $_SESSION[ 'aktif_yil' ] ) )[ 2 ];
$donemler 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ 'aktif_yil' ], $_SESSION[ 'program_id' ] ) )[2];
$gorev_kategorileri = $vt->select( $SQL_gorev_kategorileri_getir, array( $_SESSION[ 'universite_id' ] ) )[2];
$donem_gorevlileri  = $vt->select( $SQL_ogretim_elemani_getir, array( $ders_yili_id, $program_id, $donem_id, $gorev_kategori_id ) )[2];
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
		<div class="card card-olive">
			<div class="card-header">
				<h3 class="card-title">Dönem Görevlisi Ekle / Güncelle</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form id = "kayit_formu" action = "_modul/donemGorevlileri/donemGorevlileriSEG.php" method = "POST">
				<input type = "hidden" name = "islem" value = "<?php echo $islem; ?>">
				<?php if ( $islem == "ekle") { ?>
					<div class="card-body">
						<div class="form-group">
							<label  class="control-label">Dönem</label>
							<select class="form-control select2 " name = "ders_yili_donem_id" required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $donemler AS $donem ){
										echo '<option value="'.$donem[ "id" ].'" >'.$donem[ "adi" ].'</option>';
									}

								?>
							</select>
						</div>
						<div class="form-group">
							<label  class="control-label">Görev Kategorisi</label>
							<select class="form-control select2 ajaxGetir" name = "gorev_kategori_id" id="" data-url="./_modul/ajax/ajax_data.php" data-islem="gorevliListesi" data-modul="<?php echo $_REQUEST['modul'] ?>" required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $gorev_kategorileri AS $kategori ){
										echo '<option value="'.$kategori[ "id" ].'" '.($kategori[ "id" ] == $gorev_kategori_id ? "selected" : null) .'>'.$kategori[ "adi" ].'</option>';
									}

								?>
							</select>
						</div>
						<div class="form-group" id="gorevliler"> </div>
					</div>
					
					<!-- /.card-body -->
					
				<?php }else{ ?>
					<input type = "hidden" name = "ders_yili_donem_id" value = "<?php echo $ders_yili_donem_id; ?>">
					<div class="card-body">
						<div class="form-group">
							<label  class="control-label">Dönem</label>
							<select class="form-control select2"  disabled required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $donemler AS $donem ){
										echo '<option value="'.$donem[ "id" ].'" '.( $donem[ "id" ] == $donem_id ? "selected" : null) .'>'.$donem[ "adi" ].'</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label  class="control-label">Görev Kategori</label>
							<select class="form-control select2"  disabled required>
								<option>Seçiniz...</option>
								<?php 
									foreach( $gorev_kategorileri AS $kategori ){
										echo '<option value="'.$kategori[ "id" ].'" '.( $kategori[ "id" ] == $gorev_kategori_id ? "selected" : null) .'>'.$kategori[ "adi" ].'</option>';
									}
								?>
							</select>
						</div>
						
						
					</div>
					<div class="col-sm-12">
						<div class="form-group " style="display: flex; align-items: center;">
							<div class="custom-control custom-checkbox col-sm-11 float-left">
								<b>Öğretim Görevlisi</b>
							</div>
							<div class="col-sm-1 float-left"><b>Sil</b></div>
						</div>
						<hr>
						<?php
						if ( count( $donem_gorevlileri ) < 1 ){
							echo '<div class="alert alert-danger text-center">Öğretim görevlisi eklenmemiş</div>';
						} 
						foreach ($donem_gorevlileri as $gorevli) {
								echo '
								<div class="form-group " style="display: flex; align-items: center;">
									<div class="custom-control custom-checkbox col-sm-11 float-left">
										<input name="gorevli_id[]" type="hidden" id="'.$gorevli[ "id" ].'" value="'.$gorevli[ "id" ].'">
										<label for="'.$gorevli[ "id" ].'">'.$gorevli[ "adi" ].'</label>
									</div>
									<a href="" class="btn btn-sm btn-danger m-1" modul= "donemGorevlileri" yetki_islem="sil" data-href="_modul/donemGorevlileri/donemGorevlileriSEG.php?islem=sil&ders_yili_id='.$ders_yili_id.'&program_id='.$program_id.'&donem_id='.$donem_id.'&gorev_kategori_id='.$gorev_kategori_id.'&donem_gorevli_id='.$gorevli[ "ogretim_elemani_id" ].'" data-toggle="modal" data-target="#sil_onay"> Sil</a>
								</div><hr>';
							}
						?>

					</div>
					
				<?php } ?>
					<div class="card-footer">
						
						<?php if ( $islem == "ekle" ){ ?>
							<button modul= 'programlar' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls ?> pull-right"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi ?></button>
						<?php } ?> 
						<button onclick="window.location.href = '?modul=donemGorevlileri&islem=ekle'" type="reset" class="btn btn-primary btn-sm pull-right" ><span class="fa fa-plus"></span> Temizle / Yeni Kayıt</button>
					</div>
			</form>
		</div>
		<!-- /.card -->
	</div>
	<!--/.col (left) -->
	<div class="col-md-7">
		<div class="card card-orange">
			<div class="card-header">
				<h3 class="card-title text-white">Dönem Görevlileri</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-0">

				<ul class="tree ">
				<?php  
					/*DERS Yılıllarını Getiriyoruz*/
					$ders_yillari = $vt->select( $SQL_ders_yillari_getir, array( $_SESSION[ "universite_id" ],$_SESSION[ "aktif_yil" ] ) )[2];

					foreach ($ders_yillari as $ders_yili ) { ?>
						
						<li><div class="ders-kapsa bg-renk1"><?php  echo $ders_yili[ "adi" ]; ?></div>
						<ul class="ders-ul" >
				<?php 		
						/*Dönemler Listesi*/
						$donemler = $vt->select( $SQL_donemler_getir, array( $_SESSION[ 'aktif_yil' ], $_SESSION[ 'program_id' ] ) )[2];
						foreach ( $donemler AS $donem ){ ?>
							<!--Dönemler-->
							<li>
								<div class="ders-kapsa bg-renk2">
									<?php echo $donem[ "adi" ]  ?>
								</div>
							<ul class="ders-ul">
				<?php 
						/*Görev Kategorileri  Listesi*/
						$gorev_kategorileri = $vt->select( $SQL_eklenmis_gorev_kategorileri_getir, array( $_SESSION[ 'universite_id' ], $_SESSION[ 'aktif_yil' ], $_SESSION[ 'program_id' ], $donem[ 'donem_id' ] ) )[2];
						foreach ($gorev_kategorileri as $kategori) { ?>
							
							<!--$kategorilar -->
							<li>
								<div class="ders-kapsa bg-renk3">
									<?php echo $kategori[ "adi" ] ?>
									<a href="?modul=donemGorevlileri&islem=guncelle&ders_yili_id=<?php echo $_SESSION[ 'aktif_yil' ]; ?>&program_id=<?php echo $_SESSION[ 'program_id' ]; ?>&donem_id=<?php echo $donem["donem_id"]; ?>&gorev_kategori_id=<?php echo $kategori['id'] ?>" class="btn btn-dark float-right btn-xs">Düzenle</a>		
								</div> <!-- Second level node -->
							<ul class="ders-ul">
				<?php 		
							/*Dönemler Listesi*/
							$ogretim_elemanlari = $vt->select( $SQL_ogretim_elemani_getir, array( $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ], $donem["donem_id"], $kategori[ "id" ] ) )[2];
							foreach ( $ogretim_elemanlari AS $ogretim_elemani ){ ?>
								<!--Dönemler-->
								<li>
									<div class="ders-kapsa bg-renk4">
										<?php echo $ogretim_elemani[ "adi" ]  ?>
									</div>
								</li>			
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
	
	$('.ajaxGetir').on("change", function(e) { 
	    var id 			= $(this).val();
	    var data_islem 	= $(this).data("islem");
	    var data_url 	= $(this).data("url");
	    var data_modul	= $(this).data("modul");
	    $("#gorevliler").empty();
	    $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
	        $("#gorevliler").append(response);
	    });
	});	
</script>
