<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )		? $_REQUEST[ 'islem' ]		: 'ekle';
$ogrenci_id			= array_key_exists( 'ogrenci_id', $_REQUEST )	? $_REQUEST[ 'ogrenci_id' ]	: 0;
$alanlar			= array();
$degerler			= array();

$SQL_ekle			= "INSERT INTO tb_ogrenciler SET ";
$SQL_guncelle 		= "UPDATE tb_ogrenciler SET ";

$SQL_program_oku = <<< SQL
SELECT 
	f.id AS fakulte_id,
	b.id AS bolum_id,
	p.id AS program_id
FROM tb_programlar AS p 
LEFT JOIN 
	tb_bolumler AS b ON b.id = p.bolum_id
LEFT JOIN 
	tb_fakulteler AS f ON f.id = b.fakulte_id
WHERE p.id = ?
SQL;

$idleri_cek = $vt->select( $SQL_program_oku, array( $_SESSION[ "program_id" ] ) )[2][0];

$alanlar[]		= "universite_id";
$alanlar[]		= "fakulte_id";
$alanlar[]		= "bolum_id";
$alanlar[]		= "program_id";
$degerler[]		= $_SESSION[ "universite_id" ];
$degerler[]		= $idleri_cek[ "fakulte_id" ];
$degerler[]		= $idleri_cek[ "bolum_id" ];
$degerler[]		= $idleri_cek[ "program_id" ];

foreach( $_REQUEST as $alan => $deger ) {
	if( $alan == 'islem' or  $alan == 'PHPSESSID' or  $alan == 'ogrenci_id') continue;
		$alanlar[]		= $alan;
		$degerler[]		= $deger;
}

$SQL_ekle		.= implode( ' = ?, ', $alanlar ) . ' = ?';

$SQL_guncelle 	.= implode( ' = ?, ', $alanlar ) . ' = ?';
$SQL_guncelle	.= " WHERE id = ?";

if( $islem == 'guncelle' ) $degerler[] = $ogrenci_id;


$SQL_tek_ogrenci_id_oku = <<< SQL
SELECT 
	*
FROM 
	tb_ogrenciler 
WHERE 
	id  		= ? AND
	aktif 		= 1 
SQL;

$SQL_tek_ogrenci_tc_oku = <<< SQL
SELECT 
	*
FROM 
	tb_ogrenciler 
WHERE 
	tc_kimlik_no  = ? AND
	aktif 		  = 1 
SQL;


$SQL_sil = <<< SQL
UPDATE
	tb_ogrenciler
SET
	aktif = ?
WHERE
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

switch( $islem ) {
	case 'ekle':

		$ogrenci_varmi = $vt->select( $SQL_tek_ogrenci_tc_oku, array( $_REQUEST[ "tc_kimlik_no" ] ) )[2];
		if ( count( $ogrenci_varmi ) < 1 ){
			$sonuc = $vt->insert( $SQL_ekle, $degerler );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
			else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
			$son_eklenen_id	= $sonuc[ 2 ]; 
			$ogrenci_id = $son_eklenen_id;
		}else{
			$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Öğrenci Önceden Eklenmiş', 'id' => $sonuc[ 2 ] );
		}
			
	break;
	case 'guncelle':
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_ogrenci_oku = $vt->select( $SQL_tek_ogrenci_id_oku, array( $ogrenci_id ) ) [ 2 ];
		if (count( $tek_ogrenci_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, $degerler );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_ogrenci_oku = $vt->select( $SQL_tek_ogrenci_id_oku, array( $ogrenci_id ) ) [ 2 ];
		if (count( $tek_ogrenci_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( 0, $ogrenci_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $ogrenci_id;
header( "Location:../../index.php?modul=ogrenciler&islem=guncelle&ogrenci_id=".$ogrenci_id);
?>