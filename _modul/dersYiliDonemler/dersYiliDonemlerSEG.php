<?php
include "../../_cekirdek/fonksiyonlar.php";

$vt			= new VeriTabani();
$fn			= new Fonksiyonlar();
$id			= array_key_exists( 'id' , $_REQUEST ) ? $_REQUEST[ 'id' ] : 0;


$SQL_ekle = <<< SQL
INSERT INTO
	tb_ders_yili_donemleri
SET
	 program_id 	= ?
	,ders_yili_id 	= ?
	,donem_id	 	= ?
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_ders_yili_donemleri
SET
	 program_id 	= ?
	,ders_yili_id 	= ?
	,donem_id	 	= ?
WHERE
	id = ?
SQL;

$SQL_sil = <<< SQL
DELETE FROM 
	tb_ders_yili_donemleri
WHERE 
	id = ?
SQL;

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti' );
$vt->islemBaslat();
if( array_key_exists( 'islem', $_REQUEST ) ) {
	switch( $_REQUEST[ 'islem' ] ) {
		case 'ekle':
			$sorgu_sonuc = $vt->insert( $SQL_ekle, array(
				 $_REQUEST[ 'program_id' ]
				,$_REQUEST[ 'ders_yili_id' ]
				,$_REQUEST[ 'donem_id' ]
			) );
			if( $sorgu_sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sorgu_sonuc[ 0 ], 'mesaj' => 'Kayıt eklenirken bir hata oluştu ' . $sorgu_sonuc[ 1 ] );
		break;
		case 'guncelle':
				$sorgu_sonuc = $vt->update( $SQL_guncelle, array(
					 $_REQUEST[ 'program_id' ]
					,$_REQUEST[ 'ders_yili_id' ]
					,$_REQUEST[ 'donem_id' ]
					,$id
				) );
				if( $sorgu_sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sorgu_sonuc[ 0 ], 'mesaj' => 'Kayıt güncellenirken bir hata oluştu ' . $sorgu_sonuc[ 1 ] );
		break;
		case 'sil':
				$sorgu_sonuc = $vt->delete( $SQL_sil, array( $id ) );
				if( $sorgu_sonuc[ 0 ] ) $___islem_sonuc = array( 'hata' => $sorgu_sonuc[ 0 ], 'mesaj' => 'Kayıt silinirken bir hata oluştu ' . $sorgu_sonuc[ 1 ] );
		break;
	}
} else {
	$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'İşlem türü gönderilmediğinden dolayı işleminiz iptal edildi' );
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] = $___islem_sonuc;
header( 'Location: ../../index.php?modul=dersYiliDonemler' );


?>