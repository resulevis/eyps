<?php
include "../_cekirdek/fonksiyonlar.php";
session_start();
$_SESSION[ 'firma_turu' ] = $_POST[ 'firma' ];

$vt = new VeriTabani();

$k	= trim( $_POST[ 'kulad' ] );
$s	= trim( $_POST[ 'sifre' ] );

$SQL_kontrol = <<< SQL
SELECT
	 k.*
	,CASE k.super WHEN 1 THEN "Süper" ELSE r.adi END AS rol_adi
FROM
	tb_sistem_kullanici AS k
JOIN
	tb_roller AS r ON k.rol_id = r.id
WHERE
	k.email = ? AND
	k.sifre = ?
LIMIT 1
SQL;

$SQL_aktif_yil = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari
WHERE
	universite_id 	   	= ? AND
	ilk_goruntulenecek 	= 1 AND 
	aktif 			   	= 1
LIMIT 1
SQL;

$SQL_aktif_program = <<< SQL
SELECT
	*
FROM
	tb_programlar
WHERE
	universite_id 	   	= ? AND
	varsayilan		 	= 1 AND 
	aktif 			   	= 1
LIMIT 1
SQL;

$SQL_ders_yillari = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari  
WHERE
	universite_id 	   	= ? AND
	aktif 			   	= 1
SQL;


$SQL_programlar = <<< SQL
SELECT 
	f.id AS fakulte_id, 
	f.adi AS fakulte_adi,
	b.id AS bolum_id,
	b.adi AS bolum_adi,
	p.id AS program_id, 
	p.adi AS program_adi
FROM 
	tb_programlar AS p
LEFT JOIN 
	tb_bolumler AS b ON p.bolum_id = b.id
LEFT JOIN 
	tb_fakulteler AS f On b.fakulte_id = f.id
WHERE 
	f.universite_id 	= ? AND 
	f.aktif 			= 1
SQL;


$sorguSonuc = $vt->selectSingle( $SQL_kontrol, array( $k, md5( $s ) ) );
if( !$sorguSonuc[ 0 ] ) {
	$kullaniciBilgileri	= $sorguSonuc[ 2 ];
	if( $kullaniciBilgileri[ 'id' ] * 1 > 0 ) {
		$_SESSION[ 'kullanici_id' ]		= $kullaniciBilgileri[ 'id' ];
		$_SESSION[ 'adi' ]				= $kullaniciBilgileri[ 'adi' ];
		$_SESSION[ 'soyadi' ]			= $kullaniciBilgileri[ 'soyadi' ];
		$_SESSION[ 'ad_soyad' ]			= $kullaniciBilgileri[ 'adi' ] . ' ' . $kullaniciBilgileri[ 'soyadi' ];
		$_SESSION[ 'kullanici_resim' ]	= $kullaniciBilgileri[ 'resim' ];
		$_SESSION[ 'rol_id' ]			= $kullaniciBilgileri[ 'rol_id' ];
		$_SESSION[ 'rol_adi' ]			= $kullaniciBilgileri[ 'rol_adi' ];
		$_SESSION[ 'sube_id' ]			= $kullaniciBilgileri[ 'sube_id' ];
		$_SESSION[ 'subeler' ]			= $kullaniciBilgileri[ 'subeler' ];
		$_SESSION[ 'giris' ]			= true;
		$_SESSION[ 'giris_var' ]		= 'evet';
		$_SESSION[ 'yil' ]				= date('Y');
		$_SESSION[ 'super' ]			= $kullaniciBilgileri[ 'super' ];
		$_SESSION[ 'universite_id' ]	= $kullaniciBilgileri[ 'universiteler' ];

		$aktif_yil 						= $vt->selectSingle( $SQL_aktif_yil, array( $kullaniciBilgileri[ 'universiteler' ] ) )[ 2 ];
		$ders_yillari 					= $vt->select( $SQL_ders_yillari, array( $kullaniciBilgileri[ 'universiteler' ] ) )[ 2 ];
		$_SESSION[ 'aktif_yil' ]		= $aktif_yil[ "id" ];
		$_SESSION[ 'ders_yillari' ]		= $ders_yillari;

		$aktif_program_id				= $vt->selectSingle( $SQL_aktif_program, array( $kullaniciBilgileri[ 'universiteler' ] ) )[ 2 ];
		$_SESSION[ 'program_id' ]		= $aktif_program_id[ "id" ];

		$programlar 					= $vt->select( $SQL_programlar, array( $kullaniciBilgileri[ 'universiteler' ] ) )[ 2 ];
		$_SESSION[ 'programlar' ]		= $programlar;


	} else {
		$_SESSION[ 'giris_var' ] = 'hayir';
	}
} else {
	$_SESSION[ 'giris_var' ] = 'hayir';
}
header( "Location: ../index.php" );
?>