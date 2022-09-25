<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )		? $_REQUEST[ 'islem' ]			: 'ekle';
$soru_id	= array_key_exists( 'soru_id', $_REQUEST )	? $_REQUEST[ 'soru_id' ]	: 0;

$secenekler = array();
$secenekSay = 1;
foreach( $_REQUEST as $alan => $deger ) {
	if( $alan == 'islem' or  $alan == 'PHPSESSID' or  $alan == 'soru' or  $alan == 'soru_turu_id' or  $alan == 'mufredat_id' or  $alan == 'ders_id' or  $alan == 'zorluk_derecesi' or  $alan == 'puan' or  $alan == 'dogruSecenek') continue;
		$alanBol = explode( "-", $alan );

		if($alanBol[0] == "cevap"){
			$secenekler[$secenekSay][] =$deger;
			$secenekler[$secenekSay][] = in_array($alanBol[1], $_REQUEST[ "dogruSecenek" ] ) ? 1 : 0 ;
		}
		$secenekSay++;
}

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_soru_bankasi
SET
	soru 				= ?,
	soru_turu_id 		= ?,
	soru_dosyasi 		= ?,
	mufredat_id 		= ?, 
	ders_yili_donem_id 	= ?, 
	program_id 		 	= ?, 
	ders_id 		 	= ?, 
	zorluk_derecesi 	= ?, 
	puan 		 		= ? 
SQL;

$SQL_secenek_ekle = <<< SQL
INSERT INTO 
	tb_soru_secenekleri
SET
	soru_id			= ?,
	secenek 		= ?, 
	dogru_secenek 	= ? 
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_soru_bankasi
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
	tb_soru_bankasi 
WHERE 
	id 			= ?
SQL;


$SQL_sil = <<< SQL
DELETE FROM
	tb_soru_bankasi
WHERE
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
echo '<pre>';
print_r($_FILES);
$dizin =  "../../soruDosyalari";


$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':

		$soru_dosyasi = "";
		if( isset( $_FILES[ "file"]["tmp_name"] ) and $_FILES[ "file"][ 'size' ] > 0 ) {
			$soru_dosyasi	= uniqid() ."." . pathinfo( $_FILES[ "file"][ 'name' ], PATHINFO_EXTENSION );
			$hedef_yol		= $dizin.'/'.$soru_dosyasi;
			move_uploaded_file( $_FILES[ "file"][ 'tmp_name' ], $hedef_yol );
		}
		$degerler      = array( 
			$_REQUEST[ "soru" ],
			$_REQUEST[ "soru_turu_id" ], 
			$soru_dosyasi,
			$_REQUEST[ "mufredat_id" ], 
			$_SESSION[ "donem_id" ], 
			$_SESSION[ "program_id" ], 
			$_REQUEST[ "ders_id" ],
			$_REQUEST[ "zorluk_derecesi" ],
			$_REQUEST[ "puan" ]
		);

		$sonuc = $vt->insert( $SQL_ekle, $degerler );
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
		$son_eklenen_id	= $sonuc[ 2 ]; 
		$soru_id = $son_eklenen_id;

		if( $soru_id > 0 ){
			foreach ($secenekler as $secenek) {
				$sonuc = $vt->insert( $SQL_secenek_ekle, array( $soru_id, $secenek[0], $secenek[1] ) );
			}
		}

	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_soru_turu_oku = $vt->select( $SQL_soru_turu_oku, array( $soru_id ) ) [ 2 ];
		$coklu_secenek = array_key_exists( "coklu_secenek", $_REQUEST ) ? 1 : 0; 
		$metin 		   = array_key_exists( "metin", 		$_REQUEST ) ? 1 : 0; 
		$degerler = array( $_REQUEST[ "adi" ], $coklu_secenek, $metin, $soru_id );
		if (count( $tek_soru_turu_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, $degerler );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_soru_turu_oku = $vt->select( $SQL_soru_turu_oku, array( $soru_id ) ) [ 2 ];
		if (count( $tek_soru_turu_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $soru_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $soru_id;
header( "Location:../../index.php?modul=mufredat");
?>