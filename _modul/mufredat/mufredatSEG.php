<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )		 	? $_REQUEST[ 'islem' ]				: 'ekle';
$komite_ders_id 	= array_key_exists( 'komite_ders_id', $_REQUEST ) 	? $_REQUEST[ 'komite_ders_id' ]		: 0;
$ogretim_uyesi_id 	= array_key_exists( 'ogretim_uyesi_id', $_REQUEST ) ? $_REQUEST[ 'ogretim_uyesi_id' ]	: 0;


/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_komite_ders_ogretim_uyesi_ekle = <<< SQL
INSERT INTO 
	tb_komite_dersleri_ogretim_uyeleri
SET
	komite_ders_id 		= ?,
	ogretim_uyesi_id 	= ?
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_komite_dersleri_ogretim_uyeleri
WHERE
	komite_ders_id = ?
SQL;

$SQL_tek_sil = <<< SQL
DELETE FROM
	tb_komite_dersleri_ogretim_uyeleri
WHERE
	komite_ders_id 		= ? AND 
	ogretim_uyesi_id 	= ? 
SQL;


$degerler = array();

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
switch( $islem ) {
	case 'ekle':
		
		$komite_ogretim_uyeleri_sil = $vt->delete( $SQL_sil, array( $komite_ders_id ) );

		foreach ($_REQUEST['ogretim_uyesi_id'] as $id) {

			$degerler[] = $komite_ders_id;
			$degerler[] = $id;

			$sonuc = $vt->insert( $SQL_komite_ders_ogretim_uyesi_ekle, $degerler );

			$degerler = array();
		}

	break;
	case 'sil':
		$sonuc = $vt->delete( $SQL_tek_sil, array( $komite_ders_id, $ogretim_uyesi_id ) );
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
	break;
}


$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
header( "Location:../../index.php?modul=komiteDersOgretimUyeleri");
?>