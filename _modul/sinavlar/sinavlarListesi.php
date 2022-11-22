<?php
$fn = new Fonksiyonlar();

$islem          					= array_key_exists( 'islem', $_REQUEST )  		? $_REQUEST[ 'islem' ] 	    : 'ekle';
$ders_yili_donem_id          		= array_key_exists( 'ders_yili_donem_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_donem_id' ] 	: 0;

/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}


$SQL_sinavlar_getir = <<< SQL
SELECT
	s.id AS sinav_id,
	k.adi AS komite_adi,
	k.ders_kodu AS ders_kodu,
	s.adi AS sinav_adi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati,
	s.sinav_suresi,
	s.soru_sayisi
FROM
	tb_sinavlar AS s
LEFT JOIN tb_komiteler AS k ON s.komite_id = k.id 
WHERE
	s.universite_id 	= ? AND
	s.donem_id 			= ? AND
	s.aktif 			= 1
ORDER BY sinav_baslangic_tarihi DESC, sinav_baslangic_saati DESC
SQL;

$SQL_ogrenci_sinavlar_getir = <<< SQL
SELECT
	DISTINCT s.id AS sinav_id,
	k.adi AS komite_adi,
	k.ders_kodu AS ders_kodu,
	s.adi AS sinav_adi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati,
	s.sinav_suresi,
	s.soru_sayisi,
	(SELECT sinav_bitti_mi from tb_sinav_ogrencileri WHERE ogrenci_id = ko.ogrenci_id ) AS sinav_bitti_mi 
FROM
	tb_sinavlar AS s
LEFT JOIN tb_komiteler AS k ON s.komite_id = k.id 
LEFt JOIN tb_komite_ogrencileri AS ko ON ko.komite_id = k.id
LEFT JOIN tb_sinav_ogrencileri AS so ON so.sinav_id = s.id
WHERE
	s.universite_id 	= ? AND
	ko.ogrenci_id 		= ? AND 
	s.aktif 			= 1
SQL;
$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ]= $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
$komiteler 				= $vt->select( $SQL_komiteler_getir, array( $_SESSION[ "aktif_yil" ], $_SESSION[ "donem_id" ], $_SESSION[ "program_id" ] ) )[2];

if ( $_SESSION[ "kullanici_turu" ] == 'ogretmen' AND $_SESSION[ "super" ] == 0 ){
	$sinavlar 			= $vt->select( $SQL_ogretim_elemani_sinavlar_getir, array(  $_SESSION[ "kullanici_id" ],$_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
}else if( $_SESSION[ "kullanici_turu" ] == "ogrenci" AND $_SESSION[ "super" ] == 0 ){
	$sinavlar 			= $vt->select( $SQL_ogrenci_sinavlar_getir, array( $_SESSION[ "universite_id" ],$_SESSION[ "kullanici_id" ] ) )[2];
}else{
	$sinavlar 			= $vt->select( $SQL_sinavlar_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
}

?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-secondary " id = "card_sorular">
			<div class="card-header">
				<h3 class="card-title" id="dersAdi">Girebileceğiniz Sınav Listeleri</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-2 h-100">

				<?php
					if( count($sinavlar) > 0){
						foreach ($sinavlar as $sinav) {
							echo "<div class='sinav-kapsa rounded-lg d-flex flex-wrap justify-content-space-between align-items-center py-2'>
								<div class='col-sm-10 m-0 float-left d-flex align-items-center'>
									<span  class='sinav-baslik col-sm-10 float-left'>
										$sinav[ders_kodu] - $sinav[komite_adi]<br>
										<b class='text-success'>".date("d.m.Y", strtotime($sinav['sinav_baslangic_tarihi']))." - ".date("H:i", strtotime($sinav['sinav_baslangic_saati']))."</b>
									</span>
									<div class='col-sm-1 float-left text-center'>
										<span class='d-block text-center'><b class='sinav-dakika d-block h4 text-danger'>$sinav[sinav_suresi]</b>Dk.</span>
									</div>
									<div class='col-sm-1 float-left text-center'>
										<span class='d-block text-center'><b class='sinav-dakika d-block h4 text-danger'>$sinav[soru_sayisi]</b>Soru</span>
									</div>
									
								</div>
								<div class='col-sm-2 float-left text-right'>
									<button class='btn btn-outline-info rounded-circle sinav-btn' id='javascript:sinavDetay($sinav[sinav_id]);'><i class='far fa-eye'></i></button>
									".($sinav["sinav_bitti_mi"] == 0 ? "<a href='?modul=sinav&sinav_id=$sinav[sinav_id]' class='btn btn-success rounded-circle sinav-btn'><i class='fas fa-play icon-mt'></i></a>": '')."
								</div>
								<div class='clearfix'></div>
							</div>";
						}
					}else{
						echo "<div class='alert alert-warning'>Katılabileceğiniz Sınav Bulunmadı</div>";
					}
				?>
			</div>
			<!-- /.card -->
		</div>
		<!-- right column -->
	</div>

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
					<p><b>Bu Kaydı silmeniz durumunda tekrar geri alınmayacak</b></p>
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