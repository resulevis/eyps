<?php
include "../../_cekirdek/fonksiyonlar.php";
error_reporting( E_ALL );
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]	: 'ekle';
$sablon_id	= array_key_exists( 'id', $_REQUEST )		? $_REQUEST[ 'id' ]		: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_anket_sablon
SET
	universite_id 	= ?,
	adi 			= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_anket_sablon
SET
	adi 		= ?
WHERE
	id 			= ? 
SQL;

$SQL_sablon_oku = <<< SQL
SELECT 
	*
FROM 
	tb_anket_sablon 
WHERE 
	id 	= ?
SQL;

$SQL_sil = <<< SQL
UPDATE
	tb_anket_sablon
SET
	aktif 		= 0
WHERE
	id 			= ? 
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':
		if ( trim($_REQUEST[ "adi" ] ) == '' ){
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Şablon Adı Boş Olamaz', 'id' => 0 );
			$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
			header( "Location:../../index.php?modul=sablonlar");
			die;
		}
		
		$sonuc 			= $vt->insert( $SQL_ekle, array($_SESSION["universite_id"],$_REQUEST["adi"]) );
		$son_eklenen_id	= $sonuc[ 2 ]; 

		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$sablon_oku = $vt->select( $SQL_sablon_oku, array( $sablon_id ) ) [ 2 ];
		
		if ( $sablon_oku[0][ "sinav_baslangic_tarihi" ] > date( "Y-m-d" ) ){
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Gemiş Sınav Üzerinden İşlem Yapılamaz', 'id' => 0 );
			$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
			header( "Location:../../index.php?modul=sablonlar");
		}
		
		if (count( $sablon_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, array( $_REQUEST["adi"] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$sablon_oku = $vt->select( $SQL_sablon_oku, array( $sablon_id ) ) [ 2 ];
		if (count( $sablon_oku ) > 0) {

			$sonuc = $vt->update( $SQL_sil, array( $sablon_id ) );
		}
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $sablon_id;
header( "Location:../../index.php?modul=sablonlar");
?>