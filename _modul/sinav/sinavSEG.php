<?php
include "../../_cekirdek/fonksiyonlar.php";
error_reporting( E_ALL );
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]	: 'ekle';
$sinav_id	= array_key_exists( 'id', $_REQUEST )		? $_REQUEST[ 'id' ]		: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_sinavlar
SET
	universite_id 			= ?,
	donem_id 				= ?,
	komite_id 				= ?,
	adi 					= ?,
	aciklama 				= ?,
	sinav_oncesi_aciklama 	= ?,
	sinav_sonrasi_aciklama 	= ?,
	sinav_suresi 			= ?,
	sinav_baslangic_tarihi 	= ?,
	sinav_baslangic_saati 	= ?,
	sinav_bitis_tarihi 		= ?,
	sinav_bitis_saati 		= ?,
	sorulari_karistir		= ?,
	secenekleri_karistir 	= ?,
	ip_adresi 				= ?,
	soru_sayisi 			= ?
SQL;

$SQL_sinav_ogrenci_ekle = <<< SQL
INSERT INTO 
	tb_sinav_ogrencileri
SET
	sinav_id 	= ?,
	ogrenci_id 	= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_sinavlar
SET
	adi 					= ?,
	aciklama 				= ?,
	sinav_oncesi_aciklama 	= ?,
	sinav_sonrasi_aciklama 	= ?,
	sinav_suresi 			= ?,
	sinav_baslangic_tarihi 	= ?,
	sinav_baslangic_saati 	= ?,
	sinav_bitis_tarihi 		= ?,
	sinav_bitis_saati 		= ?,
	sorulari_karistir		= ?,
	secenekleri_karistir 	= ?,
	ip_adresi 				= ?
WHERE
	id 	= ? 
SQL;

$SQL_sinav_oku = <<< SQL
SELECT 
	*
FROM 
	tb_sinavlar 
WHERE 
	id 	= ?
SQL;

$SQL_komite_ogrencileri = <<< SQL
SELECT 
	*
FROM 
	tb_komite_ogrencileri 
WHERE 
	komite_id 	= ?
SQL;

$SQL_soru_sayisi = <<< SQL
SELECT 
	SUM(soru_sayisi) AS soru_sayisi
FROM 
	tb_komite_dersleri
WHERE 
	komite_id = ? 
SQL;

$SQL_sinav_sil = <<< SQL
DELETE FROM
	tb_sinavlar
WHERE
	id = ?
SQL;

$SQL_sinav_ogrenci_sil = <<< SQL
DELETE FROM
	tb_sinav_ogrencileri
WHERE
	sinav_id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':

		$sorulari_karistir 		= array_key_exists( "sorulari_karistir" 	, $_REQUEST) ? 1 : 0;
		$secenekleri_karistir 	= array_key_exists( "secenekleri_karistir" 	, $_REQUEST) ? 1 : 0;
		$soru_sayisi 			= $vt->selectSingle( $SQL_soru_sayisi, array( $_REQUEST[ "komite_id" ] ) ) [ 2 ]; 
		$degerler      			= array( 
			$_SESSION[ "universite_id" ],
			$_SESSION[ "donem_id" ],
			$_REQUEST[ "komite_id" ],
			$_REQUEST[ "adi" ],
			$_REQUEST[ "aciklama" ],
			$_REQUEST[ "sinav_oncesi_aciklama" ],
			$_REQUEST[ "sinav_sonrasi_aciklama" ],
			$_REQUEST[ "sinav_suresi" ],
			date( "Y-m-d", strtotime( $_REQUEST[ "baslangic_tarihi" ] ) ),
			$_REQUEST[ "baslangic_saati" ],
			date( "Y-m-d", strtotime( $_REQUEST[ "bitis_tarihi" ] ) ),
			$_REQUEST[ "bitis_saati" ],
			$sorulari_karistir,
			$secenekleri_karistir,
			$_REQUEST[ "ip_adresi" ],
			$soru_sayisi[ "soru_sayisi" ]
		);

		$sonuc 			= $vt->insert( $SQL_ekle, $degerler );
		$son_eklenen_id	= $sonuc[ 2 ]; 

		/*Komite Öğrencileri Sınava Ekleniyor*/
		$komite_ogrencileri = $vt->select( $SQL_komite_ogrencileri, array( $_REQUEST[ "komite_id" ] ) ) [ 2 ];
		foreach ($komite_ogrencileri as $ogrenci ) {
			$vt->insert( $SQL_sinav_ogrenci_ekle, array( $son_eklenen_id, $ogrenci["ogrenci_id"] )  );
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
			header( "Location:../../index.php?modul=sinavlar");
		}

		$sorulari_karistir 		= array_key_exists( "sorulari_karistir" 	, $_REQUEST) ? 1 : 0;
		$secenekleri_karistir 	= array_key_exists( "secenekleri_karistir" 	, $_REQUEST) ? 1 : 0;

		$degerler      = array( 
			$_REQUEST[ "adi" ],
			$_REQUEST[ "aciklama" ],
			$_REQUEST[ "sinav_oncesi_aciklama" ],
			$_REQUEST[ "sinav_sonrasi_aciklama" ],
			$_REQUEST[ "sinav_suresi" ],
			date( "Y-m-d", strtotime($_REQUEST[ "baslangic_tarihi" ]) ),
			$_REQUEST[ "baslangic_saati" ],
			date( "Y-m-d", strtotime($_REQUEST[ "bitis_tarihi" ]) ),
			$_REQUEST[ "bitis_saati" ],
			$sorulari_karistir,
			$secenekleri_karistir,
			$_REQUEST[ "ip_adresi" ],
			$sinav_id
		);
		
		if (count( $tek_sinav_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, $degerler );
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
header( "Location:../../index.php?modul=sinavlar");
?>