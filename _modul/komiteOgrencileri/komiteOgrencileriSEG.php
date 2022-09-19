<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )		? $_REQUEST[ 'islem' ]		: 'ekle';
$ogrenci_id			= array_key_exists( 'ogrenci_id', $_REQUEST )	? $_REQUEST[ 'ogrenci_id' ]	: 0;
$alanlar			= array();
$degerler			= array();

$SQL_donem_ogrenci_ekle = <<< SQL
INSERT INTO 
	tb_komite_ogrencileri
SET 
	komite_id 	= ?, 
	ogrenci_id 	= ?
SQL;

$SQL_tek_ogrenci_id_oku = <<< SQL
SELECT 
	*
FROM 
	tb_komite_ogrencileri
WHERE 
	komite_id  = ? AND
	ogrenci_id = ? 
SQL;

$SQL_sil = <<< SQL
DELETE FROM
	tb_komite_ogrencileri
WHERE
	komite_id  = ? AND
	ogrenci_id = ? 
SQL;

if ( $islem == "toplu_ekle" ){
	$ogrenci_nolari = explode( "\n" , $_REQUEST[ "ogrenci_numaralari" ] );
	$ogrenci_nolari = implode(",", $ogrenci_nolari);
	$ogrenci_nolari = preg_replace( "/\r|\n/", "", $ogrenci_nolari );
	$ogrenci_nolari = explode( ",", $ogrenci_nolari);
	$in  = str_repeat('?,', count($ogrenci_nolari) - 1) . '?';

	$SQL_eklenmeyen_ogrenci_cek ="
	SELECT 
		o.*
	FROM 
		tb_ogrenciler AS o
	LEFT JOIN tb_komite_ogrencileri AS ko ON ko.ogrenci_id = o.id
	WHERE
		(ko.komite_id IS NULL) AND
		o.ogrenci_no IN ( $in )";
}

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
$vt->islemBaslat();
switch( $islem ) {
	case 'toplu_ekle':
		/*Eklemek istedikleri öğrencilerin hangisi döneme eklenmemiş ise listesini getiriyoruz */
		$ogrenciler = $vt->select($SQL_eklenmeyen_ogrenci_cek,$ogrenci_nolari)[2];
		foreach ($ogrenciler as $ogrenci ) {
			$sonuc = $vt->insert( $SQL_donem_ogrenci_ekle, array( $_REQUEST[ 'komite_id' ], $ogrenci[ "id" ] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
			else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
		}	
	break;
	case 'ekle':
		$tek_ogrenci_oku = $vt->select( $SQL_tek_ogrenci_id_oku, array( $_REQUEST[ 'komite_id' ], $ogrenci_id ) ) [ 2 ];
		if (count( $tek_ogrenci_oku ) > 0) {
			$___islem_sonuc = array( 'hata' => 1, 'mesaj' => 'Öğrenci bu döneme daha önce eklenmiştir. ' );
		}else{
			$sorgu_sonuc = $vt->insert( $SQL_donem_ogrenci_ekle, array(
				 $_REQUEST[ 'komite_id' ]
				,$ogrenci_id	
			) );
		if( $sorgu_sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sorgu_sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sorgu_sonuc[ 1 ] );
		}
			
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_ogrenci_oku = $vt->select( $SQL_tek_ogrenci_id_oku, array( $_REQUEST[ 'komite_id' ], $ogrenci_id ) ) [ 2 ];
		print_r($tek_ogrenci_oku);
		if (count( $tek_ogrenci_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $_REQUEST[ 'komite_id' ], $ogrenci_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $ogrenci_id;
header( "Location:../../index.php?modul=komiteOgrencileri");
?>