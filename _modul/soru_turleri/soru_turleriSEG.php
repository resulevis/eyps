<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )		? $_REQUEST[ 'islem' ]			: 'ekle';
$soru_turu_id		= array_key_exists( 'soru_turu_id', $_REQUEST )	? $_REQUEST[ 'soru_turu_id' ]	: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_soru_turleri
SET
	universite_id 	= ?,
	adi  			= ?,
	coklu_secenek 	= ?,
	metin 		 	= ? 

SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_soru_turleri
SET
	adi  			= ?,
	coklu_secenek 	= ?,
	metin 		 	= ? 
WHERE
	id 				= ? 
SQL;

$SQL_soru_turu_oku = <<< SQL
SELECT 
	*
FROM 
	tb_soru_turleri 
WHERE 
	id 			= ?
SQL;


$SQL_sil = <<< SQL
DELETE FROM
	tb_soru_turleri
WHERE
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

switch( $islem ) {
	case 'ekle':

		$coklu_secenek = array_key_exists( "coklu_secenek", $_REQUEST ) ? 1 : 0; 
		$metin 		   = array_key_exists( "metin", 		$_REQUEST ) ? 1 : 0; 
		$degerler      = array( $_SESSION[ "universite_id" ],$_REQUEST[ "adi" ], $coklu_secenek, $metin );

		$sonuc = $vt->insert( $SQL_ekle, $degerler );
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
		$son_eklenen_id	= $sonuc[ 2 ]; 
		$soru_turu_id = $son_eklenen_id;
	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_soru_turu_oku = $vt->select( $SQL_soru_turu_oku, array( $soru_turu_id ) ) [ 2 ];
		$coklu_secenek = array_key_exists( "coklu_secenek", $_REQUEST ) ? 1 : 0; 
		$metin 		   = array_key_exists( "metin", 		$_REQUEST ) ? 1 : 0; 
		$degerler = array( $_REQUEST[ "adi" ], $coklu_secenek, $metin, $soru_turu_id );
		if (count( $tek_soru_turu_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, $degerler );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_soru_turu_oku = $vt->select( $SQL_soru_turu_oku, array( $soru_turu_id ) ) [ 2 ];
		if (count( $tek_soru_turu_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $soru_turu_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $soru_turu_id;
header( "Location:../../index.php?modul=soru_turleri");
?>