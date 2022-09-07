<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )				? $_REQUEST[ 'islem' ]				: 'ekle';
$ders_yili_donem_id = array_key_exists( 'ders_yili_donem_id', $_REQUEST )	? $_REQUEST[ 'ders_yili_donem_id' ]	: 0;


/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_komite_ders_ogretim_uyesi_ekle = <<< SQL
INSERT INTO 
	tb_komite_dersleri
SET
	komite_id 			= ?,
	donem_ders_id 		= ?,
	teorik_ders_saati 	= ?,
	uygulama_ders_saati = ?,
	soru_sayisi 		= ?
SQL;

/**/
$SQL_ogretim_uyesi_oku = <<< SQL
SELECT 
	d.id, 
	d.adi 
FROM 
	tb_komite_dersleri AS kd
LEFT JOIN 
	tb_donem_dersleri AS dd  ON dd.id = kd.donem_ders_id
LEFT JOIN 
	tb_dersler AS d ON d.id = dd.ders_id
LEFT JOIN 
	tb_ders_yili_donemleri AS dyd ON dyd.id = dd.ders_yili_donem_id
WHERE 
	dyd.ders_yili_id = ? AND 
	dyd.program_id 	 = ? AND
	dyd.donem_id 	 = ? AND 
	kd.komite_id 	 = ? AND 
	kd.id 			 = ? 
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_komite_dersleri
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
		
		foreach ($_REQUEST['ders_id'] as $ders_id) {

			if ( count( $ders_varmi ) < 1 ){

				$degerler[] = $_REQUEST['komite_id'];
				$degerler[] = $ders_id;
				$degerler[] = $_REQUEST['teorik_ders_saati-'.$ders_id];
				$degerler[] = $_REQUEST['uygulama_ders_saati-'.$ders_id];
				$degerler[] = $_REQUEST['soru_sayisi-'.$ders_id];

				$sonuc = $vt->insert( $SQL_komite_ders_ogretim_uyesi_ekle, $degerler );

				$degerler = array();
			}
		}

	break;
	case 'sil':

		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$ogretim_uyesi_oku = $vt->select( $SQL_ogretim_uyesi_oku, array( $ders_yili_id, $program_id, $donem_id, $komite_id, $ders_id ) ) [ 2 ];
		if (count( $ogretim_uyesi_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $ders_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}


$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
header( "Location:../../index.php?modul=komiteDersleri&islem=guncelle&ders_yili_id=$ders_yili_id&program_id=$program_id&donem_id=$donem_id&komite_id=$komite_id");
?>