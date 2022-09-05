<?php
error_reporting(E_ALL);
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )				? $_REQUEST[ 'islem' ]				: 'ekle';
$ders_yili_donem_id = array_key_exists( 'ders_yili_donem_id', $_REQUEST )	? $_REQUEST[ 'ders_yili_donem_id' ]	: 0;

/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_donem_gorevlisi_ekle = <<< SQL
INSERT INTO 
	tb_donem_gorevlileri
SET
	ders_yili_donem_id	= ?,
	gorev_kategori_id	= ?,
	ogretim_elemani_id  = ?
SQL;

/**/
$SQL_tek_donem_gorevlisi_oku = <<< SQL
SELECT 
	*
FROM 
	tb_donem_gorevlileri AS dg
LEFT JOIN 
	tb_ogretim_elemanlari AS oe ON oe.id = dg.ogretim_elemani_id
LEFT JOIN 
	tb_ders_yili_donemleri AS dyd ON dyd.id = dg.ders_yili_donem_id
WHERE 
	oe.universite_id 		= ? AND 
	dg.ders_yili_donem_id 	= ? AND
	dg.gorev_kategori_id 	= ? AND
	dg.ogretim_elemani_id 	= ?  
SQL;

/*Yeni eklenecek dersin önceden  eklenip eklenmediğini kontrol etme*/
$SQL_donem_gorevlisi_oku = <<< SQL
SELECT 
	*
FROM 
	tb_donem_gorevlileri
WHERE 
	ders_yili_donem_id	= ? AND 
	gorev_kategori_id 	= ? AND
	ogretim_elemani_id 	= ?
SQL;

$SQL_donem_gorevlisi_guncelle = <<< SQL
UPDATE
	tb_donem_gorevlileri AS dg
LEFT JOIN 
	tb_ders_yili_donemleri AS dyd ON dyd.id = dg.ders_yili_donem_id
SET
	dg.teorik_ders_saati 	= ?,
	dg.uygulama_ders_saati  = ?,
	dg.soru_sayisi  		= ?
WHERE
	dyd.ders_yili_id  	= ? AND
	dyd.program_id 		= ? AND 
	dyd.donem_id 		= ? AND
	kd.id 				= ?
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_donem_gorevlileri
WHERE
	ders_yili_donem_id 	= ? AND
	gorev_kategori_id 	= ? AND
	ogretim_elemani_id 	= ?
SQL;

$SQL_ders_yili_donem_oku = <<< SQL
SELECT 
	*
FROM  
	tb_ders_yili_donemleri
WHERE 
	id 		= ?
SQL;

@$ders_yili_donemi 	= $vt->select( $SQL_ders_yili_donem_oku, array( $_REQUEST[ "ders_yili_donem_id" ] ) )[2][0]; 

$ders_yili_id       = array_key_exists( 'ders_yili_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_id' ] 	: $ders_yili_donemi[ "ders_yili_id" ];
$program_id         = array_key_exists( 'program_id', $_REQUEST )  	? $_REQUEST[ 'program_id' ] 	: $ders_yili_donemi[ "program_id" ];
$donem_id          	= array_key_exists( 'donem_id', $_REQUEST )  	? $_REQUEST[ 'donem_id' ] 		: $ders_yili_donemi[ "donem_id" ];
$komite_id          = array_key_exists( 'komite_id', $_REQUEST ) 	? $_REQUEST[ 'komite_id' ] 		: 0;
$ders_id     		= array_key_exists( 'komite_ders_id', $_REQUEST ) ? $_REQUEST[ 'komite_ders_id' ] : 0;


$degerler = array();


$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
switch( $islem ) {
	case 'ekle':
		
		foreach ($_REQUEST['gorevli_id'] as $gorevli_id) {

			/*Döneme Ait ders Önceden eklenmis ise eklenmesine izin verilmeyecek*/

			$ders_varmi = $vt->select( $SQL_donem_gorevlisi_oku, array( $_SESSION[ 'dyd_id' ], $_REQUEST['gorev_kategori_id'], $gorevli_id ))[2];

			if ( count( $ders_varmi ) < 1 ){

				$degerler[] = $_SESSION[ 'dyd_id' ];
				$degerler[] = $_REQUEST['gorev_kategori_id'];
				$degerler[] = $gorevli_id;

				$sonuc = $vt->insert( $SQL_donem_gorevlisi_ekle, $degerler );

				$degerler = array();
			}
		}

	break;
	case 'guncelle':
		
		foreach ($_REQUEST['gorevli_id'] as $gorevli_id) {

			$degerler[] = $_REQUEST['teorik_ders_saati-'.$ders_id];
			$degerler[] = $_REQUEST['uygulama_ders_saati-'.$ders_id];
			$degerler[] = $_REQUEST['soru_sayisi-'.$ders_id];
			$degerler[] = $ders_yili_id;
			$degerler[] = $program_id;
			$degerler[] = $donem_id;
			$degerler[] = $ders_id;

			$sonuc = $vt->update( $SQL_donem_gorevlisi_guncelle, $degerler );

			$degerler = array();
		}

	break;
	case 'sil':

		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_donem_gorevlisi_oku = $vt->select( $SQL_tek_donem_gorevlisi_oku, array( $_SESSION[ 'universite_id' ], $_SESSION[ 'dyd_id' ], $_REQUEST['gorev_kategori_id'], $_REQUEST['donem_gorevli_id'] ) ) [ 2 ];
		print_r($tek_donem_gorevlisi_oku);
		echo $_SESSION['universite_id'].'<br>';
		echo $_SESSION[ 'dyd_id' ];

		if (count( $tek_donem_gorevlisi_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $_SESSION[ 'dyd_id' ], $_REQUEST['gorev_kategori_id'], $_REQUEST['donem_gorevli_id'] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}

$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
header( "Location:../../index.php?modul=donemGorevlileri&islem=guncelle&ders_yili_donem_id=".$_SESSION['aktif_yil']."&gorev_kategori_id=".$_REQUEST['gorev_kategori_id']);
?>