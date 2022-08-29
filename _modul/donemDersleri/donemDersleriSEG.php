<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();



$islem				= array_key_exists( 'islem', $_REQUEST )				? $_REQUEST[ 'islem' ]				: 'ekle';
$ders_yili_donem_id = array_key_exists( 'ders_yili_donem_id', $_REQUEST )	? $_REQUEST[ 'ders_yili_donem_id' ]	: 0;


/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_donem_dersleri = <<< SQL
INSERT INTO 
	tb_donem_dersleri
SET
	ders_yili_donem_id 	= ?,
	ders_id 			= ?,
	teorik_ders_saati 	= ?,
	uygulama_ders_saati = ?
SQL;

/**/
$SQL_tek_donem_ders_oku = <<< SQL
SELECT 
	*
FROM 
	tb_donem_dersleri as dd
LEFT JOIN 
	tb_ders_yili_donemleri as dyd ON dyd.id = dd.ders_yili_donem_id
LEFT JOIN 
	tb_ders_yillari as dy ON dyd.ders_yili_id = dy.id

WHERE 
	universite_id 	= ? AND
	dd.id 			= ?
SQL;

/*Yeni eklenecek dersin önceden  eklenip eklenmediğini kontrol etme*/
$SQL_donem_ders_oku = <<< SQL
SELECT 
	*
FROM 
	tb_donem_dersleri as dd
WHERE 
	dd.id 			= ? AND 
	dd.ders_yili_donem_id = ?
SQL;

$SQL_donem_dersleri_guncelle = <<< SQL
UPDATE
	tb_donem_dersleri AS dd
LEFT JOIN tb_dersler  as d ON d.id = dd.ders_id
LEFT JOIN tb_ders_yili_donemleri as dyd ON dyd.id = dd.ders_yili_donem_id
SET
	dd.teorik_ders_saati 	= ?,
	dd.uygulama_ders_saati  = ?
WHERE
	dyd.ders_yili_id  	= ? AND
	dyd.program_id 		= ? AND 
	dyd.donem_id 		= ? AND
	dd.id 				= ?
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_donem_dersleri
WHERE
	id = ?
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
$donem_id          	= array_key_exists( 'donem_id', $_REQUEST )  	? $_REQUEST[ 'donem_id' ] 		: $ders_yili_donemi[ "donem_id" ];


$ders_degerler = array();

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
switch( $islem ) {
	case 'ekle':
		
		foreach ($_REQUEST['ders_id'] as $ders_id) {

			/*Döneme Ait ders Önceden eklenmis ise eklenmesine izin verilmeyecek*/

			$ders_varmi = $vt->select( $SQL_donem_ders_oku, array( $ders_id, $ders_yili_donem_id ))[2];

			if ( count( $ders_varmi ) < 1 ){

				$ders_degerler[] = $ders_yili_donem_id;
				$ders_degerler[] = $ders_id;
				$ders_degerler[] = $_REQUEST['teorik_ders_saati-'.$ders_id];
				$ders_degerler[] = $_REQUEST['uygulama_ders_saati-'.$ders_id];

				$sonuc = $vt->insert( $SQL_donem_dersleri, $ders_degerler );

				$ders_degerler = array();
			}
				
		}

	break;
	case 'guncelle':
		
		foreach ($_REQUEST['ders_id'] as $ders_id) {
			$ders_degerler[] = $_REQUEST['teorik_ders_saati-'.$ders_id];
			$ders_degerler[] = $_REQUEST['uygulama_ders_saati-'.$ders_id];
			$ders_degerler[] = $ders_yili_id;
			$ders_degerler[] = $program_id;
			$ders_degerler[] = $donem_id;
			$ders_degerler[] = $ders_id;

			$sonuc = $vt->update( $SQL_donem_dersleri_guncelle, $ders_degerler );

			$ders_degerler = array();
		}


	break;
	case 'sil':

		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_donem_ders_oku = $vt->select( $SQL_tek_donem_ders_oku, array( $_SESSION[ "universite_id" ], $_REQUEST[ "donem_ders_id" ] ) ) [ 2 ];
		if (count( $tek_donem_ders_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $_REQUEST[ "donem_ders_id" ] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}


$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
header( "Location:../../index.php?modul=donemDersleri&islem=guncelle&ders_yili_id=$ders_yili_id&program_id=$program_id&donem_id=$donem_id");
?>