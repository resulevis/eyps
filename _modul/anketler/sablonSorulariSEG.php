<?php
include "../../_cekirdek/fonksiyonlar.php";
error_reporting( E_ALL );
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]	: 'ekle';
$sinav_id	= array_key_exists( 'id', $_REQUEST )		? $_REQUEST[ 'id' ]		: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_anket_sablon_sorulari
SET
	sablon_id 	= ?,
	adi 		= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_anket_sablon_sorulari
SET
	adi 		= ?
WHERE
	id 			= ? 
SQL;

$SQL_sablon_oku = <<< SQL
SELECT 
	*
FROM 
	tb_anket_sablon_sorulari 
WHERE 
	id 	= ?
SQL;

$SQL_sil = <<< SQL
UPDATE
	tb_anket_sablon_sorulari
SET
	aktif 		= 0
WHERE
	id 			= ? 
SQL;


$sorular = array_filter($_REQUEST["soru"]);

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

if ( count( $sorular ) < 1 OR  $_REQUEST["id"] == ""){
	$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Sorular Boş Geçilemez', 'id' => 0 );
	$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
	header( "Location:../../index.php?modul=sablonlar");
	die;
}

$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':
		foreach ($sorular as $soru) {
			$sonuc = $vt->insert( $SQL_ekle, array($_REQUEST["id"], $soru ) );
		}
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_sinav_oku = $vt->select( $SQL_sinav_oku, array( $sinav_id ) ) [ 2 ];
		
		if ( $tek_sinav_oku[0][ "sinav_baslangic_tarihi" ] > date( "Y-m-d" ) ){
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Gemiş Sınav Üzerinden İşlem Yapılamaz', 'id' => 0 );
			$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
			header( "Location:../../index.php?modul=sablonlar");
		}
		
		if (count( $tek_sinav_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, array( $_REQUEST["adi"] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_sinav_oku = $vt->select( $SQL_sinav_oku, array( $sinav_id ) ) [ 2 ];
		if (count( $tek_sinav_oku ) > 0) {

			$ogrenci_sil = $vt->delete( $SQL_sinav_ogrenci_sil, array( $sinav_id ) );
			$sonuc = $vt->delete( $SQL_sinav_sil, array( $sinav_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $sinav_id;
header( "Location:../../index.php?modul=sablonlar");
?>