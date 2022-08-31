<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();



$islem				= array_key_exists( 'islem', $_REQUEST )				? $_REQUEST[ 'islem' ]				: 'ekle';
$ders_yili_donem_id = array_key_exists( 'ders_yili_donem_id', $_REQUEST )	? $_REQUEST[ 'ders_yili_donem_id' ]	: 0;


/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_komiteler_ekle = <<< SQL
INSERT INTO 
	tb_komiteler
SET
	ders_yili_donem_id 	= ?,
	ders_kodu 			= ?,
	adi 				= ?,
	baslangic_tarihi 	= ?,
	bitis_tarihi 		= ?,
	sinav_tarihi 		= ?
SQL;

$SQL_komiteler_guncelle = <<< SQL
UPDATE
	tb_komiteler
SET
	ders_kodu 			= ?,
	adi 				= ?,
	baslangic_tarihi 	= ?,
	bitis_tarihi 		= ?,
	sinav_tarihi 		= ?
WHERE
	id 					= ?
SQL;

$SQL_tek_komite_oku = <<< SQL
SELECT 
	*
FROM 
	tb_komiteler AS k
LEFT JOIN 
	tb_ders_yili_donemleri as dyd ON dyd.id = k.ders_yili_donem_id
LEFT JOIN 
	tb_ders_yillari as dy ON dyd.ders_yili_id = dy.id

WHERE 
	universite_id 	= ? AND
	k.id 			= ?
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_komiteler
WHERE
	id = ?
SQL;


$ders_yili_donemi   = $vt->select( $SQL_ders_yili_donem_oku, array( $_REQUEST[ "ders_yili_donem_id" ] ) )[2][0]; 

$ders_yili_id       = array_key_exists( 'ders_yili_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_id' ] 	: $ders_yili_donemi[ "ders_yili_id" ];
$program_id         = array_key_exists( 'program_id', $_REQUEST )  	? $_REQUEST[ 'program_id' ] 	: $ders_yili_donemi[ "program_id" ];
$donem_id          	= array_key_exists( 'donem_id', $_REQUEST )  	? $_REQUEST[ 'donem_id' ] 		: $ders_yili_donemi[ "donem_id" ];


$degerler = array();

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
switch( $islem ) {
	case 'ekle':
		
		foreach ($_REQUEST['ders_kodu'] as $i => $ders_kodu) {

			$degerler[] = $ders_yili_donem_id;
			$degerler[] = $ders_kodu;
			$degerler[] = $_REQUEST["adi"][$i];
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["baslangic_tarihi"][$i] ) );
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["bitis_tarihi"][$i] ) );
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["sinav_tarihi"][$i] ) );

			$sonuc = $vt->insert( $SQL_komiteler_ekle, $degerler );

			$degerler = array();	
		}

	break;
	case 'guncelle':
		foreach ($_REQUEST['komite_id'] as $i => $komite_id) {
			$degerler[] = $_REQUEST["ders_kodu"][$i];
			$degerler[] = $_REQUEST["adi"][$i];
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["baslangic_tarihi"][$i] ) );
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["bitis_tarihi"][$i] ) );
			$degerler[] = date('Y-m-d', strtotime( $_REQUEST["sinav_tarihi"][$i] ) );
			$degerler[] = $komite_id;

			$sonuc = $vt->update( $SQL_komiteler_guncelle, $degerler );

			$degerler = array();
		}
	break;
	case 'sil':

		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_komite_oku = $vt->select( $SQL_tek_komite_oku, array( $_SESSION[ "universite_id" ], $_REQUEST[ "komite_id" ] ) ) [ 2 ];
		if (count( $tek_komite_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $_REQUEST[ "komite_id" ] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}


$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
header( "Location:../../index.php?modul=komiteler&islem=guncelle&ders_yili_id=$ders_yili_id&program_id=$program_id&donem_id=$donem_id");
?>