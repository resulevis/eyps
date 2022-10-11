<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]		: 'ekle';
$sinav_id	= array_key_exists( 'sinav_id', $_REQUEST )	? $_REQUEST[ 'sinav_id' ]	: 0;

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
	ip_adresi 				= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_sinavlar
SET
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


$SQL_sil = <<< SQL
DELETE FROM
	tb_sinavlar
WHERE
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':

		$sorulari_karistir 		= array_key_exists( "sorulari_karistir" 	, $_REQUEST) ? 1 : 0;
		$secenekleri_karistir 	= array_key_exists( "secenekleri_karistir" 	, $_REQUEST) ? 1 : 0;

		$degerler      = array( 
			$_SESSION[ "universite_id" ],
			$_SESSION[ "donem_id" ],
			$_REQUEST[ "komite_id" ],
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
			$_REQUEST[ "ip_adresi" ]
		);

		$sonuc = $vt->insert( $SQL_ekle, $degerler );
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 

	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_sinav_oku = $vt->select( $SQL_sinav_oku, array( $sinav_id ) ) [ 2 ];
		
		$sorulari_karistir 		= array_key_exists( "sorulari_karistir" 	, $_REQUEST) ? 1 : 0;
		$secenekleri_karistir 	= array_key_exists( "secenekleri_karistir" 	, $_REQUEST) ? 1 : 0;

		$degerler      = array( 
			$_REQUEST[ "komite_id" ],
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
			$sonuc = $vt->delete( $SQL_sil, array( $sinav_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $sinav_id;
header( "Location:../../index.php?modul=sinavlar");
?>