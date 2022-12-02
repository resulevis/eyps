<?php
include "../../_cekirdek/fonksiyonlar.php";
error_reporting( E_ALL );
$vt		= new VeriTabani();
$fn		= new Fonksiyonlar();

$islem		= array_key_exists( 'islem', $_REQUEST )	? $_REQUEST[ 'islem' ]	: 'ekle';
$id			= array_key_exists( 'id', $_REQUEST )		? $_REQUEST[ 'id' ]		: 0;

$SQL_ekle = <<< SQL
INSERT INTO 
	tb_anket_cevaplari
SET
	anket_id 		= ?,
	soru_id 		= ?,
	ogrenci_id 		= ?,
	cevap 			= ?
SQL;


$SQL_anket_oku = <<< SQL
SELECT 
	a.*
FROM 
	tb_anketler  AS a
LEFT JOIN tb_anket_ogrencileri AS ao ON ao.anket_id = a.id
WHERE 
	a.id 		    = ? AND
	ao.ogrenci_id   = ? AND
	ao.anket_bitti  = 0
SQL;

$SQL_anket_sorulari = <<< SQL
SELECT 
	id
FROM 
	tb_anket_sablon_sorulari
WHERE 
	sablon_id 	= ?
SQL;

$SQL_anket_sorulari = <<< SQL
SELECT 
	ans.soru_id AS id,
	ass.adi ,
    ans.id AS ans_id
FROM 
	tb_anket_sorulari AS ans
LEFT JOIN 
	tb_anket_sablon_sorulari AS ass ON ass.id = ans.soru_id
WHERE 
	ans.anket_id    = ? AND
    ass.aktif       = 1
SQL;

$SQL_guncelle = <<< SQL
UPDATE
	tb_anket_ogrencileri
SET
	anket_bitti 	= 1
WHERE
	anket_id 		= ? AND
	ogrenci_id 		= ?
SQL;

$anket 			= $vt->select( $SQL_anket_oku, array( $id, $_SESSION["kullanici_id"] ) );
$sorular 		= $vt->select( $SQL_anket_sorulari, array( $id ) );
$soru_idler 	= array();

foreach ($sorular[2] as $soru) {
    array_push($soru_idler,$soru["id"]);
}

/*Anket id bış ise veya gelen id ye göre anket yok ise veya cevap sayısı ile soru sayısı eşit değilse işlem gerçekleşmiyor*/
if ( trim($_REQUEST[ "id" ] ) == '' OR $anket[3] < 1 OR count( $soru_idler ) != count( $_REQUEST["cevap"] ) ){
	$___islem_sonuc = array( 'hata' => true, 'mesaj' => 'Hatalı İşlem Yaptınız', 'id' => 0 );
	$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
	header( "Location:../../index.php?modul=anasayfa");
	die("Başlangıç hatası");
}

$___islem_sonuc = array( 'hata' => false, 'mesaj' => 'İşlem başarı ile gerçekleşti', 'id' => 0 );
$vt->islemBaslat();
switch( $islem ) {
	case 'ekle':

		/*Gelen cevapları soru idlerine göre kaydediyoruz*/
		foreach ($_REQUEST["cevap"] as $soru_id => $cevap) {
			if( in_array( $soru_id, $soru_idler) ){
				$vt->insert( $SQL_ekle, array($id, $soru_id, $_SESSION["kullanici_id"], $cevap) );
			}
		}
		/*Öğrencinin anketi bitirdiğini belitiyoruz.*/ 
		$sonuc = $vt->update( $SQL_guncelle, array( $id, $_SESSION[ "kullanici_id" ] ));
		
	break;
}
$vt->islemBitir();
$_SESSION[ 'sonuclar' ] 		= $___islem_sonuc;
$_SESSION[ 'sonuclar' ][ 'id' ] = $id;
header( "Location:../../index.php?modul=anasayfa");
?>