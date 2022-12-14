<?php
include "../../_cekirdek/fonksiyonlar.php";
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem				= array_key_exists( 'islem', $_REQUEST )		? $_REQUEST[ 'islem' ]		: 'ekle';
$ogretim_elamani_id			= array_key_exists( 'ogretim_elemani_id', $_REQUEST )		? $_REQUEST[ 'ogretim_elemani_id' ]	: 0;
$alanlar			= array();
$degerler			= array();

$SQL_ekle			= "INSERT INTO tb_ogretim_elemanlari SET ";
$SQL_guncelle 		= "UPDATE tb_ogretim_elemanlari SET ";

$alanlar[]		= "universite_id";
$degerler[]		= $_SESSION['universite_id'];


foreach( $_REQUEST as $alan => $deger ) {
	if( $alan == 'islem' or  $alan == 'PHPSESSID' or  $alan == 'ogretim_elemani_id') continue;
		if( $alan == 'sifre'){
			$sifre = md5($deger);
			if( $deger != ''  ){
				$alanlar[]		= $alan;
				$degerler[]		= $sifre;
			}
		}else{
			$alanlar[]		= $alan;
			$degerler[]		= $deger;
		}
}

$SQL_ekle		.= implode( ' = ?, ', $alanlar ) . ' = ?';

$SQL_guncelle 	.= implode( ' = ?, ', $alanlar ) . ' = ?';
$SQL_guncelle	.= " WHERE id = ?";

if( $islem == 'guncelle' ) $degerler[] = $ogretim_elamani_id;


$SQL_tek_ogretim_elemani_oku = <<< SQL
SELECT 
	*
FROM 
	tb_ogretim_elemanlari 
WHERE 
	id 			= ? AND
	aktif 		= 1 
SQL;


$SQL_sil = <<< SQL
UPDATE
	tb_ogretim_elemanlari
SET
	aktif = 0
WHERE
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );

switch( $islem ) {
	case 'ekle':
		$sonuc = $vt->insert( $SQL_ekle, $degerler );
		if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sonuc[ 1 ] );
		else $___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => $sonuc[ 2 ] ); 
		$son_eklenen_id	= $sonuc[ 2 ]; 
		$ogretim_elamani_id = $son_eklenen_id;
	break;
	case 'guncelle':
		if( $_SESSION[ "kullanici_turu" ] == 'ogretmen' AND $_SESSION[ "super" ] == 0 ){
			if ( $_REQUEST[ "ogretim_elemani_id" ] != $_SESSION[ "kullanici_id" ] ){
				die("Hata İşlem Yapmaktasınız.");
			}
		}
		
		//Güncellenecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise Güncellenecektir.
		$tek_ogretim_elemani_oku = $vt->select( $SQL_tek_ogretim_elemani_oku, array( $ogretim_elamani_id ) ) [ 2 ];
		if (count( $tek_ogretim_elemani_oku ) > 0) {
			$sonuc = $vt->update( $SQL_guncelle, $degerler );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
	case 'sil':
		//Silinecek olan tarife giriş yapılan firmaya mı ait oldugu kontrol ediliyor Eger firmaya ait ise silinecektir.
		$tek_ogretim_elemani_oku = $vt->select( $SQL_tek_ogretim_elemani_oku, array( $ogretim_elamani_id ) ) [ 2 ];
		if (count( $tek_ogretim_elemani_oku ) > 0) {
			$sonuc = $vt->delete( $SQL_sil, array( $ogretim_elamani_id ) );
			if( $sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sonuc[ 0 ], 'mesaj' => 'Kayıt silinrken bir hata oluştu ' . $sonuc[ 1 ] );
		}
	break;
}
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $ogretim_elamani_id;
header( "Location:../../index.php?modul=ogretimElemanlari&islem=guncelle&ogretim_elemani_id=".$ogretim_elamani_id );
?>