<?php
include "../../_cekirdek/fonksiyonlar.php";
error_reporting( E_ALL );
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]	: 'ekle';
$anket_id	= array_key_exists( 'id', $_REQUEST )		? $_REQUEST[ 'id' ]		: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_anketler
SET
	universite_id 	= ?,
	donem_id 		= ?,
	kategori 		= ?,
	kategori_id 	= ?,
	sablon_id 		= ?,
	adi 			= ?
SQL;

$SQL_anket_ogrenci_ekle = <<< SQL
INSERT INTO 
	tb_anket_ogrencileri
SET
	anket_id	= ?,
	ogrenci_id	= ?
SQL;

$SQL_anket_soru_ekle = <<< SQL
INSERT INTO 
	tb_anket_sorulari
SET
	anket_id	= ?,
	soru_id		= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_anketler
SET
	adi 		= ?
WHERE
	id 			= ? 
SQL;

$SQL_anket_oku = <<< SQL
SELECT 
	*
FROM 
	tb_anketler 
WHERE 
	id 	= ?
SQL;

$SQL_sablon_sorulari = <<< SQL
SELECT 
	id
FROM 
	tb_anket_sablon_sorulari
WHERE 
	sablon_id 	= ?
SQL;

$SQL_sil = <<< SQL
UPDATE
	tb_anketler
SET
	aktif 		= 0
WHERE
	id 			= ? 
SQL;

$SQL_sinav_ogrencileri = <<< SQL
SELECT
	o.id AS id 
FROM
	tb_sinav_ogrencileri AS so
LEFT JOIN
	tb_ogrenciler AS o ON o.id = so.ogrenci_id
WHERE
	so.sinav_id 	= ?
SQL;

$SQL_tum_komite_ogrencileri = <<< SQL
SELECT 
	o.id
FROM 
	tb_komite_ogrencileri AS ko
LEFT JOIN tb_ogrenciler AS o ON o.id = ko.ogrenci_id
LEFT JOIN tb_komiteler AS k ON k.id = ko.komite_id
WHERE
	k.ders_yili_donem_id 	= ? AND
	k.id 					= ? AND
	o.aktif 		  		= 1 
ORDER BY k.ders_kurulu_sira ASC
SQL;

$SQL_ders_ogrencileri = <<< SQL
SELECT 
	o.id
FROM 
	tb_komite_ogrencileri AS ko
LEFT JOIN tb_ogrenciler AS o ON o.id = ko.ogrenci_id
LEFT JOIN tb_komiteler AS k ON k.id = ko.komite_id
LEFT JOIN tb_komite_dersleri AS kd ON kd.komite_id = k.id
WHERE
	kd.donem_ders_id 		= ? AND
	o.aktif 		  		= 1 
GROUP BY o.id 
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );


switch( $islem ) {
	case 'ekle':
		if ( trim($_REQUEST[ "adi" ] ) == '' OR $_REQUEST[ "kategori" ] == '' OR $_REQUEST[ "alt-kategori-id" ]  == '' OR $_REQUEST[ "sablon_id" ]  == '' ){
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Anket Adı Boş Olamaz', 'id' => 0 );
			$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
			header( "Location:../../index.php?modul=anketler");
			die;
		}

		/*Kategori => Komite, Ders, Sınav Olduğunu belirtir. Kategori İd ise Komite Seciilmiş ise hangi komiteye ait olduğu veya Kategori Sınav ise Kategori İd Hangi sınava ait olduğunu belirtir.*/
		$sonuc 			= $vt->insert( $SQL_ekle, array($_SESSION["universite_id"], $_SESSION[ "donem_id" ], $_REQUEST["kategori"], $_REQUEST["alt-kategori-id"], $_REQUEST["sablon_id"], $_REQUEST["adi"] ) );
		$son_eklenen_id	= $sonuc[ 2 ]; 

		/*Kategoriye Göre Öğrenci Listelerini Çek .. Komiteye, Derse, Veya Sınava Ait Sorumlu Öğrenci listeleri*/
		if ( $_REQUEST[ "kategori" ] == 1 ){
			$ogrenciler	=  $vt->select( $SQL_tum_komite_ogrencileri, array( $_SESSION[ "donem_id" ], $_REQUEST[ "alt-kategori-id" ] ) )[2];
		}else if( $_REQUEST[ "kategori" ] == 2 ){
			$ogrenciler	=  $vt->select( $SQL_ders_ogrencileri, array( $_SESSION[ "donem_id" ], $_REQUEST[ "alt-kategori-id" ] ) )[2];
		}else if( $_REQUEST[ "kategori" ] == 3 ){
			$ogrenciler	=  $vt->select( $SQL_sinav_ogrencileri, array( $_REQUEST[ "alt-kategori-id" ] ) )[2];
		}else{
			$ogrenciler = array();
		}

		/**Seçilen Sablona ait soruları getirip anket soruına ekledik Sablon Üzerinde soru eklemesi vey cıkarılması durumunda anketi etkilememesi için**/ 
		$sablon_sorulari = $vt->select( $SQL_sablon_sorulari, array( $_REQUEST[ "sablon_id" ] ))[2];

		foreach ($sablon_sorulari as $soru) {
			$vt->insert( $SQL_anket_soru_ekle, array( $son_eklenen_id, $soru[ "id" ] ) );
		}
		foreach ($ogrenciler as $ogrenci) {
			$vt->insert( $SQL_anket_ogrenci_ekle, array( $son_eklenen_id, $ogrenci[ "id" ] ) );
		}

		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$sablon_oku = $vt->select( $SQL_anket_oku, array( $anket_id ) ) [ 2 ];
		
		if ( $sablon_oku[0][ "sinav_baslangic_tarihi" ] > date( "Y-m-d" ) ){
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Gemiş Sınav Üzerinden İşlem Yapılamaz', 'id' => 0 );
			$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
			header( "Location:../../index.php?modul=anketler");
		}
		
		if (count( $sablon_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, array( $_REQUEST["adi"] ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$sablon_oku = $vt->select( $SQL_anket_oku, array( $anket_id ) ) [ 2 ];
		if (count( $sablon_oku ) > 0) {

			$sonuc = $vt->update( $SQL_sil, array( $anket_id ) );
		}
	break;
}
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $anket_id;
header( "Location:../../index.php?modul=anketler");
?>