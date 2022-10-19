<?php
session_start();
include "../../_cekirdek/fonksiyonlar.php";
$fn = new Fonksiyonlar();
/* Tüm yetki işlem türlerini oku */
// $SQL_yetki_islem_turu_listesi_tumu = <<< SQL
// SELECT
	// *
// FROM
	// tb_yetki_islem_turleri
// SQL;

$SQL_module_atanan_tum_yetki_islem_turleri = <<< SQL
SELECT
	 yit.id
	,yit.gorunen_adi
	,yit.adi
FROM
	tb_modul_yetki_islemler AS myi
JOIN
	tb_yetki_islem_turleri AS yit ON myi.yetki_islem_id = yit.id
WHERE
	myi.modul_id = ?
SQL;

/* Bir rol ve modüle ait yetki işlem türleri */
$SQL_rol_modul_yetki_islem_turleri = <<< SQL
SELECT
	*
FROM
	tb_rol_yetkiler
WHERE
	modul_id = ? AND rol_id = ?
SQL;

/* Bir rol ve modüle ait yetki işlemlerini kaydet */
$SQL_rol_modul_yetki_islem_turleri_kaydet = <<< SQL
INSERT INTO
	tb_rol_yetkiler
SET
	 rol_id			= ?
	,modul_id		= ?
	,islem_turu_id	= ?
SQL;

/* Rol yetkilerde bir rolün modülüne ait yetkileri temizle ve yeni gelen yetki işlmemlerini rol e ait modüle ekle.  */
$SQL_rol_yetkileri_temizle = <<< SQL
DELETE FROM tb_rol_yetkiler WHERE rol_id = ? AND modul_id = ?
SQL;

/* Sevkiyat modülünde seçilen sipariş koduna ait güzergahları getir */
$SQL_siparis_guzergahlar = <<< SQL
SELECT 
	sg.*
	,concat(cd.adi,'->',vd.adi) AS guzergah
FROM
	tb_siparis_guzergah AS sg
LEFT JOIN
	tb_siparisler AS sip ON sg.siparis_id=sip.id
LEFT JOIN
	tb_depolar AS cd ON sg.cikis_depo_id=cd.id
LEFT JOIN
	tb_depolar AS vd ON sg.varis_depo_id=vd.id
WHERE 
	sip.id=?
ORDER BY 
	sip.id,sg.id
SQL;

/* Rapor Sevkiyat modülünde seçilen sipariş koduna ait güzergahları getir */
$SQL_rapor_sevkiyata_ait_siparis_guzergahlar = <<< SQL
SELECT 
	 sg.*
	,concat(cd.adi,'->',vd.adi) AS adi
FROM
	tb_siparis_guzergah AS sg
LEFT JOIN
	tb_siparisler AS sip ON sg.siparis_id=sip.id
LEFT JOIN
	tb_depolar AS cd ON sg.cikis_depo_id=cd.id
LEFT JOIN
	tb_depolar AS vd ON sg.varis_depo_id=vd.id
WHERE
	sip.aktif = 1
SQL;


/* Rapor üretim modülünde seçilen firma idlere göre firmaların lotlarını getir. */
$SQL_rapor_uretim_firmaya_gore_latlari_ver = <<< SQL
SELECT
	 l.id
	,CONCAT( f.on_ek, on_ek_sira, ' ( ', f.adi, ' ) ' ) AS adi
FROM
	tb_lot_tanimlari AS l
JOIN
	tb_firmalar AS f ON l.firma_id = f.id
WHERE
	l.aktif = 1 
SQL;

/* Bildirim Deneme. */
$SQL_bildirim_getir = <<< SQL
SELECT
	 bil.*
	,concat( f.on_ek, l.on_ek_sira ) as lot_adi
	,concat( f.on_ek, l.on_ek_sira, '-', af.on_ek, '-', sip.sira ) as siparis_kodu
	,concat( k.adi,' ',k.soyadi ) as kullanici_adi
	,k.resim as kullanici_resim
FROM tb_bildirimler as bil
LEFT JOIN
	tb_lot_tanimlari AS l ON bil.lot_id = l.id
LEFT JOIN
	tb_siparisler AS sip ON bil.siparis_id = sip.id
LEFT JOIN
	tb_sozlesmeler AS soz ON sip.sozlesme_id = soz.id
LEFT JOIN
	tb_firmalar AS f ON l.firma_id = f.id
LEFT JOIN
	tb_firmalar AS af ON soz.alici_firma_id = af.id
LEFT JOIN
	tb_sistem_kullanici AS k ON bil.kullanici_id = k.id
WHERE
	bil.aktif = 1 and iletilen_kullanici_id = ?
ORDER BY bil.ekleme_tarihi DESC
SQL;

$SQL_ilceler_getir = <<< SQL
SELECT
	*
FROM
	tb_ilceler
WHERE 
	il_id = ?
SQL;

$SQL_ders_yillari_getir = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari
WHERE 
	universite_id = ? AND
 	aktif = 1
SQL;

$SQL_ders_yili_donemler_getir = <<< SQL
SELECT
	 dyd.id
	,d.adi
FROM
	tb_ders_yili_donemleri AS dyd
LEFT JOIN tb_donemler AS d ON d.id = dyd.donem_id
WHERE 
	dyd.program_id			= ? AND
	dyd.ders_yili_id		= ? 
SQL;

$SQL_komiteler_getir = <<< SQL
SELECT
	*
FROM
	tb_komiteler
WHERE 
	ders_yili_donem_id	= ? 
SQL;

/*Programa ait dersler*/
$SQL_dersler_getir = <<< SQL
SELECT
	id,
	adi,
	ders_kodu
FROM
	tb_dersler
WHERE 
	program_id 	  = ? AND
 	aktif = 1
SQL;

/*Donem yılına ait dersler listesi*/
$SQL_donem_dersleri_getir = <<< SQL
select
	dd.id as id,
	d.adi,
	d.ders_kodu 
from 
	tb_donem_dersleri AS dd
LEFT JOIN 
	tb_dersler AS d ON dd.ders_id = d.id
WHERE 
	dd.ders_yili_donem_id = ?
SQL;

$SQL_tum_ogretimElemanlari = <<< SQL
SELECT 
	oe.id AS id,
	CONCAT( u.adi, ' ', oe.adi, ' ', oe.soyadi ) AS adi
FROM 
	tb_ogretim_elemanlari AS oe
LEFT JOIN tb_fakulteler AS f ON f.id = oe.fakulte_id
LEFT JOIN tb_anabilim_dallari AS abd ON abd.id = oe.anabilim_dali_id
LEFT JOIN tb_unvanlar AS u ON u.id = oe.unvan_id
WHERE
	oe.universite_id 	= ? AND
	oe.aktif 		  	= 1 
ORDER BY u.sira ASC, oe.adi ASC
SQL;

$SQL_ders_yili_ilk_goruntulenecek_guncelle = <<< SQL
UPDATE
	tb_ders_yillari
SET
	ilk_goruntulenecek 	= 0
WHERE
	universite_id  		= ?
SQL;

$SQL_ders_yili_ilk_goruntulenecek_guncelle2 = <<< SQL
UPDATE
	tb_ders_yillari
SET
	ilk_goruntulenecek 	= 1
WHERE
	universite_id  		= ? AND
	id 					= ? 
SQL;

$SQL_komite_dersler_getir = <<< SQL
select 
	kd.id,
	kd.teorik_ders_saati,
	kd.uygulama_ders_saati,
	kd.soru_sayisi,
	d.adi,
	d.ders_kodu
from 
	tb_komite_dersleri AS kd
LEFT JOIN tb_donem_dersleri AS dd ON kd.donem_ders_id = dd.id
LEFT JOIN tb_dersler AS d ON d.id = dd.ders_id
LEFT JOIN tb_ders_yili_donemleri AS dyd ON dyd.id = dd.ders_yili_donem_id
WHERE 
	dyd.ders_yili_id 	= ? AND
	dyd.program_id 		= ? AND
	dyd.id 				= ? AND
	kd.komite_id 		= ? 
SQL;

$SQL_ogretim_uyeleri_getir = <<< SQL
SELECT
	oe.id AS id,
	CONCAT( u.adi, ' ', oe.adi, ' ', oe.soyadi ) AS adi
FROM 
	tb_ogretim_elemanlari AS oe
LEFT JOIN 
	tb_unvanlar AS u ON u.id = oe.unvan_id
LEFT JOIN 
	tb_anabilim_dallari AS abd ON abd.id = oe.anabilim_dali_id
LEFT JOIN 
	tb_dersler AS d ON d.anabilim_dali_id = abd.id
WHERE 
	oe.aktif  = 1
ORDER BY 
	u.sira ASC
SQL;

$SQL_komite_ders_getir = <<< SQL
select 
	kd.id AS id,
	kd.teorik_ders_saati,
	kd.uygulama_ders_saati,
	kd.soru_sayisi,
	kd.donem_ders_id,
	d.adi,
	d.ders_kodu
from 
	tb_komite_dersleri AS kd
LEFT JOIN tb_donem_dersleri AS dd ON kd.donem_ders_id = dd.id
LEFT JOIN tb_dersler AS d ON d.id = dd.ders_id
LEFT JOIN tb_ders_yili_donemleri AS dyd ON dyd.id = dd.ders_yili_donem_id
WHERE 
	kd.id = ? 
SQL;

$SQL_secili_ogretmenler_getir = <<< SQL
SELECT 
	oe.id,
	CONCAT( u.adi, ' ', oe.adi, ' ', oe.soyadi ) AS adi
FROM
	tb_komite_dersleri_ogretim_uyeleri AS kdou 
LEFT JOIN
	tb_ogretim_elemanlari as oe ON oe.id = kdou.ogretim_uyesi_id
LEFT JOIN
	tb_unvanlar as u ON u.id = oe.unvan_id
WHERE
	kdou.komite_ders_id = ?
ORDER BY u.sira ASC
SQL;

$SQL_ogrenci_ara = <<< SQL
SELECT 
	id,
	tc_kimlik_no,
	ogrenci_no,
	CONCAT( adi, ' ', soyadi ) AS adi
FROM 
	tb_ogrenciler 
WHERE 
	adi LIKE ? OR 
	soyadi LIKE ? OR
	ogrenci_no LIKE ? OR
	tc_kimlik_no LIKE ?
ORDER BY adi ASC
SQL;

/*DERSSLERİ EKLEME İŞLEMİ*/
$SQL_donem_ogrencisi_ekle = <<< SQL
INSERT INTO 
	tb_donem_ogrencileri
SET
	ders_yili_donem_id  = ?,
	ogrenci_id   		= ?
SQL;

$SQL_donem_ogrencisi_oku = <<< SQL
SELECT 
	*
FROM 
	tb_donem_ogrencileri 
WHERE 
	ders_yili_donem_id  = ? AND 
	ogrenci_id  		= ?
SQL;

$SQL_sorular = <<< SQL
SELECT
	sb.*,
	m.adi AS mufredat_adi,
	CONCAT(u.adi," ", oe.adi, " ", oe.soyadi ) AS ogretim_elemani,
	st.adi AS soru_turu,
	st.coklu_secenek,
	st.metin,
	st.id AS soru_turu_id	
FROM 
	tb_soru_bankasi AS sb
LEFT JOIN 
	tb_mufredat AS m ON m.id = sb.mufredat_id
LEFT JOIN 
	tb_ogretim_elemanlari AS oe ON oe.id = sb.ogretim_elemani_id
LEFT JOIN 
	tb_unvanlar AS u ON u.id = oe.unvan_id
LEFT JOIN 
	tb_soru_turleri AS st ON st.id = sb.soru_turu_id
WHERE
	sb.program_id 			= ? AND
	sb.ders_yili_donem_id 	= ? AND
	sb.id 					= ? 
SQL;

$SQL_soru_turleri = <<< SQL
SELECT
	*
FROM 
	tb_soru_turleri
WHERE 
	universite_id = ? 
SQL;

$SQL_soru_secenekleri = <<< SQL
SELECT
	*
FROM 
	tb_soru_secenekleri
WHERE 
	soru_id = ? 
SQL;

$SQL_sinav_oku = <<< SQL
SELECT
	*
FROM
	tb_sinavlar
WHERE
	id 			= ?
SQL;

$SQL_sinav_ogrencileri = <<< SQL
SELECT
	so.id,
	o.adi,
	o.soyadi,
	o.ogrenci_no
FROM
	tb_sinav_ogrencileri AS so
LEFT JOIN
	tb_ogrenciler AS o ON o.id = so.ogrenci_id
WHERE
	so.sinav_id 	= ?
SQL;

$vt = new VeriTabani();

switch( $_POST[ 'islem' ] ) {
	case 'dersYillariListe':
		$ders_yillari = $vt->select( $SQL_ders_yillari_getir, array( $_SESSION['universite_id'] ) )[ 2 ];
		$option = '';
		foreach( $ders_yillari AS $yil ) {
			$option .="
				<option value='$yil[id]'>$yil[adi]</option>
			";
		}
		$select = '<label  class="control-label">Ders Yılı</label>
					<select class="form-control select2" name = "ders_yili_id" id="ders-yili-sec" data-url="./_modul/ajax/ajax_data.php" data-islem="donemListesi" required>
						<option>Seçiniz...</option>
						'.$option.'
					</select>
					<script>
						$(".select2").select2();
						$("#ders-yili-sec").on("change", function(e) { 
					    var program_id 		= $("#program-sec").val();
					    var ders_yili_id 	= $(this).val();
					    var data_islem 		= $(this).data("islem");
					    var data_url 		= $(this).data("url");
					    var modul	 		= $("#program-sec").data("modul");
					    $("#donemListesi").empty();
					    $("#dersler").empty();
					    $("#komiteler").empty();
					    $.post(data_url, { islem : data_islem,ders_yili_id : ders_yili_id,program_id : program_id,modul : modul}, function (response) {
					        $("#donemListesi").append(response);
					    });
					});
					</script>';
		echo $select;
	break;

	case 'donemListesi': 
		if( $_REQUEST[ 'modul' ] == "donemDersleri" OR $_REQUEST[ 'modul' ] == "komiteler" OR $_REQUEST[ 'modul' ] == "komiteDersleri" ){
			$ders_yili_donemler = $vt->select( $SQL_ders_yili_donemler_getir, array( $_REQUEST[ "program_id" ], $_REQUEST[ "ders_yili_id" ] ) )[ 2 ];
			$option = '';
			$append = $_REQUEST['modul'] == "komiteDersleri" ? "komiteler" :  "dersler";
			foreach( $ders_yili_donemler AS $ders_yili_donem ) {
				$option .="
					<option value='$ders_yili_donem[id]'>$ders_yili_donem[adi]</option>
				";
			}
			$select = '<label  class="control-label">Dönem</label>
						<select class="form-control select2" name = "ders_yili_donem_id" id="ders_yili_donemler" data-url="./_modul/ajax/ajax_data.php" data-islem="'.$append.'" required>
							<option>Seçiniz...</option>
							'.$option.'
						</select>
						<script>
						$(".select2").select2();
							$("#ders_yili_donemler").on("change", function(e) {
								var program_id 		   = $("#program-sec").val();
								var data_islem 		   = $(this).data("islem");
							    var data_url 		   = $(this).data("url");
							    var ders_yili_donem_id = $("#ders_yili_donemler").val();
							    var modul	 		   = $("#program-sec").data("modul");
								if ( modul == "komiteler" ) {
									document.getElementById("komiteEkleBtn").style.display = "inline";
									komiteEkle();
								}else{
									$("#'.$append.'").empty();
									$("#dersler").empty();
									$.post(data_url, { islem : data_islem,program_id : program_id,modul : modul,ders_yili_donem_id : ders_yili_donem_id}, function (response) {
										$("#'.$append.'").append(response);
									});
								}	
							});
						</script>';
		}
		if( $_REQUEST[ 'modul' ] == "dersYiliDonemler" ){
			$donemler = $vt->select( $SQL_ders_yili_donemler_getir, array( $_SESSION['universite_id'], $_REQUEST[ "program_id" ]) )[ 2 ];
			$option = '';
			foreach( $donemler AS $donem ) {
				$option .="
					<option value='$donem[id]'>$donem[adi]</option>
				";
			}

			$select = '<label  class="control-label">Dönem</label>
						<select class="form-control select2" name = "donem_id" id="donemler" required>
							<option>Seçiniz...</option>
							'.$option.'
						</select>
						<script>
						$(".select2").select2();
						</script>';
		}
		echo $select;
	break;

	case 'komiteler': 
		$id = array_key_exists( 'ders_yili_donem_id', $_REQUEST ) 	? $_REQUEST[ 'ders_yili_donem_id' ] 	: $_REQUEST[ 'id' ];
		if( $_REQUEST[ 'modul' ] == "komiteDersleri" OR $_REQUEST[ 'modul' ] == "komiteGorevlileri" OR $_REQUEST[ 'modul' ] == "komiteDersOgretimUyeleri"  ){

			$komiteler = $vt->select( $SQL_komiteler_getir, array( $id ) )[ 2 ];
			$option = '';
			foreach( $komiteler AS $komite ) {
				$option .="
					<option value='$komite[id]'>$komite[adi]</option>
				";
			}
			$select = '<label  class="control-label">Komite</label>
						<select class="form-control select2" name = "komite_id" id="komitelerIslemler" data-url="./_modul/ajax/ajax_data.php" data-islem="dersler" data-modul = "'.$_REQUEST[ "modul" ].'" required>
							<option>Seçiniz...</option>
							'.$option.'
						</select>
						<script>
						$(".select2").select2();
							$("#komitelerIslemler").on("change", function(e) {
								var program_id 		= $("#program-sec").val();
								var data_islem 		= $(this).data("islem");
							    var data_url 		= $(this).data("url");
							    var ders_yili_donem_id = $("#ders_yili_donemler").val();
							    var modul	 		= $(this).data("modul");
							    var komite_id	 	= $(this).val();
								$("#dersler").empty();
								$.post(data_url, { islem : data_islem,program_id : program_id,modul : modul,ders_yili_donem_id : ders_yili_donem_id, komite_id : komite_id}, function (response) {
									$("#dersler").append(response);
								});	
							});
						</script>';
		}
		$hata  = '<div class="alert alert-danger text-center">Dönem İçin Komite Eklenmemiş !!!</div>';
		
		echo count( $komiteler) > 0 ? $select : $hata;
	break;

	case 'dersler':
		$dersSonuc 		= "";
		if ( $_REQUEST['modul'] == "donemDersleri" ) {
			$dersler 	= $vt->select( $SQL_dersler_getir, array( $_SESSION[ "program_id" ] ) )[ 2 ];
			foreach ($dersler as $ders) {
				$dersSonuc .= '
					<div class="form-group " style="display: flex; align-items: center;">
						<div class="custom-control custom-checkbox col-sm-8 float-left dersler" >
							<input class="custom-control-input derslerCheck" data-id="'.$ders[ "id" ].'" name="ders_id[]" type="checkbox" id="'.$ders[ "id" ].'" value="'.$ders[ "id" ].'">
							<label for="'.$ders[ "id" ].'" class="custom-control-label">'.$ders[ "ders_kodu" ].' - '.$ders[ "adi" ].'</label>
						</div>
						<input  type="number" class="form-control col-sm-2 float-left m-1" disabled name ="teorik_ders_saati-'.$ders[ "id" ].'" id ="teorik_ders_saati-'.$ders[ "id" ].'"  autocomplete="off">
						<input  type="number" class="form-control col-sm-2 float-left m-1" disabled name ="uygulama_ders_saati-'.$ders[ "id" ].'"
						id ="uygulama_ders_saati-'.$ders[ "id" ].'"  autocomplete="off">
					</div><hr>';
			}
		}else if( $_REQUEST['modul'] == "komiteDersleri" ){
			$dersler  	= $vt->select( $SQL_donem_dersleri_getir, array( $_REQUEST[ "ders_yili_donem_id" ]  ) )[2];

			foreach ($dersler as $ders) {
				$dersSonuc .= '
					<div class="form-group " style="display: flex; align-items: center;">
						<div class="custom-control custom-checkbox col-sm-7 float-left">
							<input class="custom-control-input derslerCheck " data-id="'.$ders[ "id" ].'" name="ders_id[]" type="checkbox" id="'.$ders[ "id" ].'" value="'.$ders[ "id" ].'" >
							<label for="'.$ders[ "id" ].'" class="custom-control-label">'.$ders[ "ders_kodu" ].' - '.$ders[ "adi" ].'</label>
						</div>
						<input  type="number" min="0" class="form-control col-sm-2 float-left m-1" disabled  name ="teorik_ders_saati-'.$ders[ "id" ].'" id ="teorik_ders_saati-'.$ders[ "id" ].'"  autocomplete="off">
						<input  type="number" min="0" class="form-control col-sm-2 float-left m-1" disabled name ="uygulama_ders_saati-'.$ders[ "id" ].'"
						id ="uygulama_ders_saati-'.$ders[ "id" ].'"  autocomplete="off">
						<input  type="number" min="0" class="form-control col-sm-1 float-left m-1" disabled name ="soru_sayisi-'.$ders[ "id" ].'" id ="soru_sayisi-'.$ders[ "id" ].'"  autocomplete="off">
					</div><hr>';
			}

		}	
		$sonuc =  '
				<hr>
				<div class="col-sm-12">
					<div class="form-group " style="display: flex; align-items: center;">
						<div class="custom-control custom-checkbox col-sm-'.($_REQUEST['modul'] == "komiteDersleri" ? '7': '8').' float-left">
							<b>Ders</b>
						</div>
						<div class="col-sm-2 float-left m1"><b>Teaorik D.S.</b></div>
						<div class="col-sm-2 float-left m1"><b>Uygulama D.S.</b></div>
						'.($_REQUEST['modul'] == "komiteDersleri" ? '<div class="col-sm-1 float-left m1"><b>Soru</b></div>': null).'
					</div>
				</div>

				<div class="col-sm-12">
					'.$dersSonuc.'
				</div>
				<script>
					$(".derslerCheck").on("click", function() {
						var ders_id = $(this).data("id");
						var sonuc = document.getElementById(ders_id).checked;
						if( sonuc == true ){
							document.getElementById("teorik_ders_saati-" + ders_id).removeAttribute("disabled"); 
							document.getElementById("uygulama_ders_saati-" + ders_id).removeAttribute("disabled"); 
							document.getElementById("soru_sayisi-" + ders_id).removeAttribute("disabled"); 

							document.getElementById("teorik_ders_saati-" + ders_id).setAttribute("required","required"); 
							document.getElementById("uygulama_ders_saati-" + ders_id).setAttribute("required","required"); 
							document.getElementById("soru_sayisi-" + ders_id).setAttribute("required","required");
						}else{
							document.getElementById("teorik_ders_saati-" + ders_id).setAttribute("disabled","disabled"); 
							document.getElementById("uygulama_ders_saati-" + ders_id).setAttribute("disabled","disabled"); 
							document.getElementById("soru_sayisi-" + ders_id).setAttribute("disabled","disabled"); 
						}

					});
				</script>';
			$hata  = '<div class="alert alert-danger text-center">Dönem İçin Ders Eklenmemiş !!!</div>';
		echo count( $dersler) > 0 ? $sonuc : $hata;
	break;

	case 'ogretimUyesiEkle':
		$komite_ders_id  		= array_key_exists( 'id', $_REQUEST ) 	? $_REQUEST[ 'id' ] : 0 ;
		$secili_ders 	 		= $vt->select( $SQL_komite_ders_getir, array( $komite_ders_id ) )[2][0];
		$ogretim_uyeleri 		= $vt->select( $SQL_ogretim_uyeleri_getir )[ 2 ]; 

		$secili_ogretim_uyeleri = $vt->select( $SQL_secili_ogretmenler_getir, array( $komite_ders_id )  )[2];
		$secili_idler 			= array();
		foreach ($secili_ogretim_uyeleri as $ogretim_elemani) {
			$secili_idler[] 	= $ogretim_elemani[ "id" ];
		}

		$ogretim_uyeleri_option = "";

		foreach ($ogretim_uyeleri as $ogretim_uyesi) {
			$select = in_array( $ogretim_uyesi[ "id" ], $secili_idler ) ? "selected" : null;
			$ogretim_uyeleri_option .= '<option value="'.$ogretim_uyesi[ "id" ].'" '.$select.'>'.$ogretim_uyesi[ "adi" ].'</option>'; 	  	
		}

		echo '
			<div class="modal fade" id="gorevliEkleModal">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<form action = "_modul/komiteDersOgretimUyeleri/komiteDersOgretimUyeleriSEG.php" method = "POST">
							<input type="hidden" value="'.$komite_ders_id.'" name="komite_ders_id">
							<div class="modal-header">
								<h4 class="modal-title">'.$secili_ders[ "ders_kodu" ].' - '.$secili_ders[ "adi" ].' Dersi İçin Öğretmen Şeçimi Yapmaktasınız</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label  class="control-label">Öğretim Üyeleri</label>
									<select   class="form-control select2"  multiple="multiple" name = "ogretim_uyesi_id[]" required>
											<option>Seçiniz</option>
											'.$ogretim_uyeleri_option.'
									</select>
									<script>
										$(".select2").select2();
									</script>
								</div>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
								<button type="submit" class="btn btn-success btn-evet">Kaydet</a>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>';

	break;

	case 'ogretimUyeleri':
		$komite_ders_id  		= array_key_exists( 'id', $_REQUEST ) 	? $_REQUEST[ 'id' ] : 0 ;
		$secili_ders 	 		= $vt->select( $SQL_komite_ders_getir, array( $komite_ders_id ) )[2][0];
		$ogretim_uyeleri 		= $vt->select( $SQL_ogretim_uyeleri_getir )[ 2 ]; 

		$secili_ogretim_uyeleri = $vt->select( $SQL_secili_ogretmenler_getir, array( $komite_ders_id )  )[2];
		$ogretim_uyeleri 		= '';
		$say = 1;
 		foreach ($secili_ogretim_uyeleri as $ogretim_elemani) {
			$ogretim_uyeleri   .= '	
			<div class="row align-items-center pr-3 pl-2">
				<div class="col-sm-11 float-left">
					<span><b>'.$say.'</b> - '.$ogretim_elemani[ "adi" ].'</span>
				</div>
				<div class="col-sm-1 float-left">
					<a href="" class="btn btn-sm btn-danger m-1" modul= "'.$_REQUEST[ "modul" ].'" yetki_islem="sil" data-href="_modul/'.$_REQUEST[ "modul" ].'/'.$_REQUEST[ "modul" ].'SEG.php?islem=sil&komite_ders_id='.$komite_ders_id.'&ogretim_uyesi_id='.$ogretim_elemani[ "id" ].'" data-toggle="modal" data-target="#sil_onay"> Sil</a>
				</div>
			</div>
			<hr class="m-1">';
			$say++;
		}

		$hata  = '<div class="alert alert-danger text-center">Öğretim Görevlisi Eklenmemiş !!!</div>';

		$sonuc =  '
			<div class="modal fade" id="gorevliEkleModal">
				<div class="modal-dialog ">
					<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">'.$secili_ders[ "ders_kodu" ].' - '.$secili_ders[ "adi" ].' Öğretim Üyeleri</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								'.(count( $secili_ogretim_uyeleri) > 0 ? $ogretim_uyeleri : $hata).'
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
							</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>';
		
		echo  $sonuc;
	break;
	
	case 'gorevliListesi':
		$gorevlilerSonuc = "";
		
		$gorevliler  	 = $vt->select( $SQL_tum_ogretimElemanlari, array( $_SESSION[ 'universite_id' ]  ) )[2];
		foreach ($gorevliler as $gorevli) {
			$gorevlilerSonuc  .= '
				<div class="form-group " style="display: flex; align-items: center;">
					<div class="custom-control custom-checkbox col-sm-12 float-left">
						<input class="custom-control-input derslerCheck " data-id="'.$gorevli[ "id" ].'" name="gorevli_id[]" type="checkbox" id="'.$gorevli[ "id" ].'" value="'.$gorevli[ "id" ].'" >
						<label for="'.$gorevli[ "id" ].'" class="custom-control-label">'.$gorevli[ "adi" ].'</label>
					</div>
					
				</div><hr>';
		}
		$sonuc =  '
				<hr>
				<h5 class="text-center alert alert-info p-1">Öğretim Görevlileri</h5>
				<div class="col-sm-12">
					'.$gorevlilerSonuc.'
				</div>
				';
			$hata  = '<div class="alert alert-danger text-center"></div>';
		echo count( $gorevliler) > 0 ? $sonuc : $hata;
	break;

	case 'ogrenciAra':
		$aranacak_kelime = $_REQUEST[ "kelime" ];
		$data = array();
		if ( isset( $aranacak_kelime ) ) {
				
			$kelime = '%'.$aranacak_kelime.'%';

			$ara = $vt->select( $SQL_ogrenci_ara, array( $kelime, $kelime, $kelime, $kelime ) )[2];
			foreach ($ara as $sonuc) {
				$data[] = array( 'id' => $sonuc[ "id" ],'tc_kimlik_no' => $sonuc[ "tc_kimlik_no" ],'ogrenci_no' => $sonuc[ "ogrenci_no" ], 'adi' => $sonuc[ "adi" ] );
			}

			echo json_encode($data);
		}	

	break;

	case 'donemOgrenciEkle':
		$sonuc = array();
		$ogrenci_varmi = $vt->select( $SQL_donem_ogrencisi_oku, array( $_SESSION[ "donem_id" ], $_REQUEST[ "id" ] ) )[2];

		if ( count( $ogrenci_varmi ) > 0 ){
			$sonuc["mesaj"] = "Öğrenci Önceden Eklenmiş durumda";
			$sonuc["mesaj_turu"] = "kirmizi";
			
		}else{
			$ogrenci_ekle = $vt->insert( $SQL_donem_ogrencisi_ekle, array( $_SESSION[ "donem_id" ], $_REQUEST[ "id" ] ) );
			if( $ogrenci_ekle[ 0 ] ) {
				$sonuc["mesaj"] = "Öğrenci Eklenmedi";
				$sonuc["mesaj_turu"] = "kirmizi";
			}else{
				$sonuc["mesaj"] = "Öğrenci Eklendi";
				$sonuc["mesaj_turu"] = "yesil";
			}
		}

		echo json_encode($sonuc);
	break;

	case 'aktifIlkGoruntulenecek':

		$ilk_goruntulenecek_sifirla	= $vt->update( $SQL_ders_yili_ilk_goruntulenecek_guncelle, array( $_SESSION['universite_id'] ) );
		$deger_ata					= $vt->update( $SQL_ders_yili_ilk_goruntulenecek_guncelle2, array( $_SESSION['universite_id'], $_REQUEST['id'] ) );
	break;

	case 'aktifYil':
		$_SESSION[ 'aktif_yil' ] 	= $_REQUEST['id'];
		unset($_SESSION['donem_id']);
	break;
	case 'aktifFakulte':
		$_SESSION[ 'program_id' ]	= $_REQUEST['id'];
		unset($_SESSION['donem_id']);
	break;
	case 'aktifDonem':
		$_SESSION[ 'donem_id' ]		= $_REQUEST['id'];
	break;
	case 'soruSecenekGetir':

		$soruGetir 		 = $vt->select( $SQL_sorular, array( $_SESSION[ "program_id" ], $_SESSION[ "donem_id" ], $_REQUEST[ "id" ] ) )[2][0];
		$soruTurleri 	 = $vt->select( $SQL_soru_turleri, array( $_SESSION[ "universite_id" ] ) )[2]; 

		$soruOption     = '';

		foreach( $soruTurleri AS $tur ){
			$soruOption .= "<option value='$tur[id]'  data-coklu_secenek ='$tur[coklu_secenek]' data-metin ='$tur[metin]'".( $soruGetir[ 'soru_turu_id' ] == $tur[ 'id' ] ? 'selected' : null  ).">$tur[adi]</option>";
		}

		if ( $soruGetir[ 'coklu_secenek' ] == 0 AND $soruGetir[ 'metin' ] == 0 ){
			$tur = 'radio';
			$secenekEkleBtn = '<span class="btn btn-secondary float-right " id="secenekEkle" data-secenek_tipi="radio" onclick="secenekEkle(this);">Seçenek Ekle</span><div class="clearfix"></div>';
		}else if( $soruGetir[ 'coklu_secenek' ] == 1 AND $soruGetir[ 'metin' ] == 0 ){
			$tur = 'checkbox';
			$secenekEkleBtn = '<span class="btn btn-secondary float-right " id="secenekEkle" data-secenek_tipi="checkbox" onclick="secenekEkle(this);">Seçenek Ekle</span><div class="clearfix"></div>';
		}else if( $soruGetir[ 'coklu_secenek' ] == 0 AND $soruGetir[ 'metin' ] == 1 ){
			$tur = 'metin';
		}	

		$soruSecenekleri = $vt->select( $SQL_soru_secenekleri, array( $soruGetir[ "id" ] ) )[2];
		/*Onceden soruyu alan öğrenci var ise soru üzerinde değişikliğe izin verilmeyecek ama öğrenciye atanan soru yok ise degişişkliğe izin verilecek*/
		$secenekler ='';
		$soruCevaplari = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","R","S");
		$say 		= 1;
		$editor 	= $soruGetir[ "editor" ] == 1 ? 'summernote' : '';
		$checked 	= $soruGetir[ "editor" ] == 1 ? 'checked' : '';
		$script  	= $soruGetir[ "editor" ] == 1 ? "$('.summernote').summernote({focus: true})" : '';
 		foreach ( $soruSecenekleri as $secenek ) {
			$secenekler .= "<div class='secenek'>
							<div  class='col-sm m-1 btn text-left bg-light inputLabel2'>
								<label for='$soruCevaplari[$say]' class='float-left soruSecenek'>$soruCevaplari[$say] ) &nbsp;</label>
								<div class='icheck-success d-inline'>
									<input type='$tur' name='dogruSecenek[]' class='inputSecenek' id='$soruCevaplari[$say]' value='$soruCevaplari[$say]' required ".($secenek["dogru_secenek"] == 1 ? 'checked': '').">
									<label  class='d-flex inputLabel1'>
										<textarea name='cevap-$soruCevaplari[$say]' class='textareaSecenek $editor  form-control col-sm-12' rows='1' required>$secenek[secenek]</textarea>
										<span class='secenekSil position-absolute r-2 t-1'><i class='fas fa-trash-alt'></i></span>
									</label>
								</div>
							</div>
						</div>";
			$say++;
		}


		$sonuc = "
				<form class='form-horizontal' action = '_modul/soruBankasi/soruBankasiSEG.php' method = 'POST' enctype='multipart/form-data'>
					<div class='modal-header'>
						<h4 class='modal-title'>Soru Güncelleme</h4>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
				
					<div class='modal-body'>
						<input type='hidden' id='soru_id' name='soru_id' value='$soruGetir[id]'>
						<input type='hidden' id='islem' name = 'islem' value='guncelle'>

						<div class='form-group'>
							<label class='control-label'>Seçilen Müfredat</label>
							<input required type='text' class='form-control'  autocomplete='off' id='mufredat_adi' disabled value='$soruGetir[mufredat_adi]'>
						</div>
						<div class='form-group'>
							<label class='control-label'>Soru</label>
							<textarea name='soru' class='form-control soru' rows='2'>$soruGetir[soru]</textarea>
						</div>

						<div class='form-group'>
							<div class='col-sm-6 float-left'>
								<label class='control-label'>Soru Puanı</label>
								<input type='text' name='puan' class='form-control' required value='$soruGetir[puan]'>
							</div>
							<div class='col-sm-6 float-left'>
								<label class='control-label'>Zorluk Derecesi</label>
								<select class='form-control' name='zorluk_derecesi' required>
									<option value='1' ".($soruGetir['zorluk_derecesi'] == 1 ? 'selected' : null).">Çok Kolay</option>
									<option value='2' ".($soruGetir['zorluk_derecesi'] == 2 ? 'selected' : null).">Kolay</option>
									<option value='3' ".($soruGetir['zorluk_derecesi'] == 3 ? 'selected' : null).">Orta</option>
									<option value='4' ".($soruGetir['zorluk_derecesi'] == 4 ? 'selected' : null).">Zor</option>
									<option value='5' ".($soruGetir['zorluk_derecesi'] == 5 ? 'selected' : null).">Çok Zor</option>
								</select>
							</div>
						</div>
						<div class='clearfix'></div>
						<div class='form-group mt-2'>
							<label for='exampleInputFile'>Soru Dosyası</label>
							".(

								$soruGetir[ 'soru_dosyasi' ] != '' ? '<a href="" class=\'btn btn-success form-control\'>Dosyayı Gör</a>' : "<div class='input-group'>
								<div class='custom-file'>
									<label class='custom-file-label' for='exampleInputFile'>Dosya Seç</label>
									<input type='file' class='custom-file-input file ' name = 'file'  >
								</div>
							</div>"

							)."
							
						</div>

						<div class='form-group'>
							<label class='control-label'>Soru Türü</label>
							<select class='form-control select2' name='soru_turu_id' required onchange='secenekOku(this);'>
								<option value=''>Soru Türü Seçiniz...</option>
								$soruOption
							</select>
						</div>	
						<div class='float-right'>
							<label  class='control-label'>Editör </label>
							<div class='bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off' >
								<div class='bootstrap-switch-container' >
									<input type='checkbox'  name='editor' $checked data-bootstrap-switch='' data-off-color='danger' data-on-text='Açık' data-off-text='Kapalı' data-on-color='success' >
								</div>
							</div>
						</div>
						<div id ='secenekler'>$secenekler</div>
						<div id='secenekEkleBtn'>
							$secenekEkleBtn
						</div>
						<div class='clearfix'></div>
						<div class='form-group'>
							<label class='control-label'>Etiket</label>
							<input type='text' class='form-control' name='etiket' placeholder='Soru Etiketlerini , ile ayırabilirsiniz.' value='$soruGetir[etiket]' >
						</div>
					</div>

					<div class='modal-footer justify-content-between'>
						<button type='button' class='btn btn-danger' data-dismiss='modal'>İptal</button>
						<button type='submit' class='btn btn-success'>Kaydet</button>
					</div>
				</form>
				<script>
					$('.soru').summernote();
					$script
					$('.note-editor').each(function() {
	                    $(this).addClass('col-sm');
	                })
	                $(\"input[name='editor']\").bootstrapSwitch();

	                $('input[name=\"editor\"]').on('switchChange.bootstrapSwitch', function(event, state) {
			            if (state == true ){
			                $('.textareaSecenek').summernote({focus: true})
			                $(\".note-editor\").each(function() {
			                    $(this).addClass(\"col-sm\");
			                })
			            }else{
			                $(\".textareaSecenek\").each(function( index, element ) {
			                    $(this).summernote('code');
			                    $(this).summernote('destroy'); 
			                })
			            }
			        });

					$('#secenekler').on('click', '.secenekSil', function (e) {
			            $(this).closest('.secenek').remove();
			            harflendir();
			        });
		        </script>";
		echo $sonuc;

	break;

	case 'sinavGetir':
		$sinavGetir = $vt->select( $SQL_sinav_oku, array( $_REQUEST[ "id" ] ) )[2][0];
		$komiteler 	= $vt->select( $SQL_komiteler_getir, array( $_SESSION[ "donem_id" ] ) )[ 2 ];
		$komiteOption =  '';
		foreach( $komiteler AS $komite ) {
			$komiteOption .=" <option value='$komite[id]' ".($sinavGetir['komite_id'] == $komite['id'] ? 'selected' : null)."> $komite[ders_kodu] - $komite[adi]</option>";
		}

		/*Sınava Ait detaylar yer alıyor*/
		$sinavDetay = "
		<div class='card card-outline p-2'>
        	<span class='btn btn-sm btn-danger position-sticky' id='kapat'>Kapat</span>
            <div class='container' style='padding: 20px 20px 0 20px;margin-top: 10px;'>

                <form id = 'kayit_formu' action = '_modul/sinavlar/sinavlarSEG.php' method = 'POST'>
                	<input type='hidden' value='guncelle' name='islem'>
                	<input type='hidden' value='$_REQUEST[id]' name='sinav_id'>
                    <div class='form-group'>
                        <label  class='control-label'>Komite</label>
                        <select class='form-control select2' name='komite_id' required disabled>
                            <option value=''>Seçiniz...</option>
                            $komiteOption
                        </select>
                    </div>
                    <div class='form-group'>
                        <label  class='control-label'>Sınav Adı</label>
                        <input type='text' name='adi' class='form-control' value='$sinavGetir[adi]'>
                    </div>

                    <div class='form-group'>
                        <label  class='control-label'>Açıklama</label>
                        <textarea class='form-control summernote' rows='3' name='aciklama'>$sinavGetir[aciklama]</textarea>
                    </div>
                    <div class='form-group'>
                        <label  class='control-label'>Sınav Öncesi Açıklama</label>
                        <textarea class='form-control summernote' rows='3' name='sinav_oncesi_aciklama'>$sinavGetir[sinav_oncesi_aciklama]</textarea>
                    </div>
                    <div class='form-group'>
                        <label  class='control-label'>Sınav Sonrası Açıklama</label>
                        <textarea class='form-control summernote' rows='3' name='sinav_sonrasi_aciklama'>$sinavGetir[sinav_sonrasi_aciklama]</textarea>
                    </div>

                    <div class='form-group'>
                        <label  class='control-label'>Sınav Süresi</label>
                        <input type='text' name='sinav_suresi' class='form-control' value='$sinavGetir[sinav_suresi]'>
                    </div>

                    <div class='form-group'>
                        <label  class='control-label'>İp Sınırlandırması</label>
                        <input type='text' name='ip_adresi' class='form-control' placeholder='192.168........' value='$sinavGetir[ip_adresi]'>
                    </div>
                    
                    <div class='col-sm-6 float-left '>
	                    <div class='form-group'>
							<label class='control-label'>Sınav Başlangıç Tarihi</label>
							<div class='input-group date' id='baslangicTarihi' data-target-input='nearest'>
								<div class='input-group-append' data-target='#baslangicTarihi' data-toggle='datetimepicker'>
									<div class='input-group-text'><i class='fa fa-calendar'></i></div>
								</div>
								<input autocomplete='off' type='text' name='baslangic_tarihi' class='form-control form-control-sm datetimepicker-input' data-target='#baslangicTarihi' data-toggle='datetimepicker' value='".date('d.m.Y', strtotime($sinavGetir['sinav_baslangic_tarihi']))."'/>
							</div>
						</div>
	                </div>
	                <div class='col-sm-6 float-left'>
	                    <div class='form-group'>
							<label class='control-label'>Sınav Başlangıç Tarihi</label>
							<div class='input-group date' id='baslangicSaati' data-target-input='nearest'>
								<div class='input-group-append' data-target='#baslangicSaati' data-toggle='datetimepicker'>
									<div class='input-group-text'><i class='fa fa-clock'></i></div>
								</div>
								<input autocomplete='off' type='text' name='baslangic_saati' class='form-control form-control-sm datetimepicker-input' data-target='#baslangicSaati' data-toggle='datetimepicker' value='".date('H:m', strtotime($sinavGetir['sinav_baslangic_saati']))."'/>
							</div>
						</div>
	                </div>

	                <div class='col-sm-6 float-left '>
	                    <div class='form-group'>
							<label class='control-label'>Sınav Bitiş Tarihi</label>
							<div class='input-group date' id='bitisTarihi' data-target-input='nearest'>
								<div class='input-group-append' data-target='#bitisTarihi' data-toggle='datetimepicker'>
									<div class='input-group-text'><i class='fa fa-calendar'></i></div>
								</div>
								<input autocomplete='off' type='text' name='bitis_tarihi' class='form-control form-control-sm datetimepicker-input' data-target='#bitisTarihi' data-toggle='datetimepicker' value='".date('d.m.Y', strtotime($sinavGetir['sinav_bitis_tarihi']))."'/>
							</div>
						</div>
	                </div>
	                <div class='col-sm-6 float-left'>
	                    <div class='form-group'>
							<label class='control-label'>Sınav Bitiş Tarihi</label>
							<div class='input-group date' id='bitisSaati' data-target-input='nearest'>
								<div class='input-group-append' data-target='#bitisSaati' data-toggle='datetimepicker'>
									<div class='input-group-text'><i class='fa fa-clock'></i></div>
								</div>
								<input autocomplete='off' type='text' name='bitis_saati' class='form-control form-control-sm datetimepicker-input' data-target='#bitisSaati' data-toggle='datetimepicker' value='".date('H:m', strtotime($sinavGetir['sinav_bitis_saati']))."'/>
							</div>
						</div>
	                </div>
	                <div class='form-group'>
						<label  class='control-label'>Soruları Karıştır</label>
						<div class='bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off' >
							<div class='bootstrap-switch-container' >
								<input type='checkbox' name='sorulari_karistir'  data-bootstrap-switch='' data-off-color='danger' data-on-text='Evet' data-off-text='Hayır' data-on-color='success' ".($sinavGetir['sorulari_karistir'] == 1 ? 'checked':null)." >
							</div>
						</div>
					</div>

					<div class='form-group'>
						<label  class='control-label'>Seçenekleri Karıştır</label>
						<div class='bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off' >
							<div class='bootstrap-switch-container' >
								<input type='checkbox' name='secenekleri_karistir' data-bootstrap-switch='' data-off-color='danger' data-on-text='Evet' data-off-text='Hayır' data-on-color='success' ".($sinavGetir['secenekleri_karistir'] == 1 ? 'checked':null).">
							</div>
						</div>
					</div>
					<hr>
					<div class=''>
						<button type='reset' class='btn btn-danger kapat' >İptal</button>
						<button type='submit' class='btn btn-success float-right' >Kaydet</button>
					</div>
                </form>
            </div>
        </div>
        <script>
        	$('.summernote').summernote();
        	$(\"input[name='sorulari_karistir']\").bootstrapSwitch();
        	$(\"input[name='secenekleri_karistir']\").bootstrapSwitch();
        	$('#kapat, .kapat').on('click', function(e) { 
				document.getElementById('sinavDetay').classList.toggle('d-none');
				document.getElementById('golgelik').classList.toggle('d-none');
		    });
        </script>";

        $ogrenciler 		 = $vt->select($SQL_sinav_ogrencileri, array($_REQUEST[ "id" ]))[2];
        $ogrenciListesi 	 = '';
        foreach ( $ogrenciler as $ogrenci ) {	
        	$ogrenciListesi .= "<div class=' w-100 sinav-ogrencileri'>
				            		<div class='col-sm-1 float-left'>
				            			<div class='card-tools'>
											<div class='icheck-primary'>
												<input type='checkbox' name='sinavOgrenciNo[]' id='sinavOgrenciNo$ogrenci[id]' value='$ogrenci[id]'>
												<label for='sinavOgrenciNo$ogrenci[id]'></label>
											</div>
										</div>
				            		</div>
				            		<div class='col-sm-4 float-left'>
				            			<span>$ogrenci[adi]</span>
				            		</div>
				            		<div class='col-sm-3 float-left'>
				            			<span>$ogrenci[soyadi]</span>
				            		</div>
				            		<div class='col-sm-3 float-left'>
				            			<span>$ogrenci[ogrenci_no]</span>
				            		</div>
				            	</div>";
        }




        $sonuc = "
        <div class='card card-primary card-tabs h-100 mb-0'>
          	<div class='card-header p-0 pt-1'>
	            <ul class='nav nav-tabs' id='custom-tabs-one-tab' role='tablist'>
		            <li class='nav-item'>
		                <a class='nav-link active' id='sinavDetayTab-tab' data-toggle='pill' href='#sinavDetayTab' role='tab' aria-controls='sinavDetayTab' aria-selected='true'>Sınav Detayı</a>
		            </li>
		            <li class='nav-item'>
		                <a class='nav-link' id='ogrenciler-tab' data-toggle='pill' href='#ogrenciler' role='tab' aria-controls='ogrenciler' aria-selected='false'>Öğrenciler</a>
		            </li>
		            <li class='nav-item'>
		                <a class='nav-link' id='ogrenciEkle-tab' data-toggle='pill' href='#ogrenciEkle' role='tab' aria-controls='ogrenciEkle' aria-selected='false'>Öğrenci Ata</a>
		            </li>
		            <li class='nav-item'>
		                <a class='nav-link' id='sorular-tab' data-toggle='pill' href='#sorular' role='tab' aria-controls='sorular' aria-selected='false'>Sorular</a>
		            </li>
		            <li class='nav-item'>
		              	<a class='nav-link' id='soruEkle-tab' data-toggle='pill' href='#soruEkle' role='tab' aria-controls='soruEkle' aria-selected='false'>Soru Ekle</a>
		            </li>
	            </ul>
          	</div>
          	<div class='card-body'>
	            <div class='tab-content' id='custom-tabs-one-tabContent'>
		            <div class='tab-pane fade show active' id='sinavDetayTab' role='tabpanel' aria-labelledby='sinavDetayTab-tab'>
		                $sinavDetay
		            </div>
		            <div class='tab-pane fade' id='ogrenciler' role='tabpanel' aria-labelledby='ogrenciler-tab'>
		                <div class='row'>
		                	<div class='col-sm-12 m-0'>
		                		<div class='col-sm-6 m-0 p-0 float-left'>
		                			<input type='text' onkeypress='alert();' class='form-control ogrenci-ara' placeholder='Öğrenci Ara'>
		                			<code>Sınava Eklemek İstediğiniz Öğrenciyi Arayıp Çıkan sonuca tıklayınız. </code>
		                		</div>
		                		
		                		<div class='col-sm-3 float-left'>
		                			<a href='' class='btn btn-danger w-100 '><i class='fas fa-trash-alt'></i> Seçilen Öğrencileri Çıkar</a>
		                		</div>
		                		<div class='col-sm-3 float-left m-0'>
		                			<a href='' class='btn btn-danger w-100'><i class='fas fa-upload'></i> Tümünü Çıkar</a>
		                		</div>
		                	</div>
		                </div>
		                <div class='row d-flex justify-content-between w-100 mt-5'>
		                	<div class='col'>
		                		<div class='title '>
		                			<span class='oturum-title'>Oturum Kullanıcı Listesi</span>
		                		</div>
		                	</div>
			                <div class='col'>
			                	<div class='title float-right'>
			                		<span class='d-flex align-items-center'>Seçili öğrenci : 0</span>
			                	</div>
			                </div>
			            </div>
			            <div class='row mt-5'>
			            	<div class='w-100 mb-1 d-flex align-items-center sinav-ogrencileri-baslik'>
			            		<div class='col-sm-1 float-left'>
			            			<div class='card-tools'>
										<div class='icheck-primary'>
											<input type='checkbox' id='tumunuSec'  >
											<label for='tumunuSec'></label>
										</div>
									</div>
			            		</div>
			            		<div class='col-sm-4 float-left font-weight-bold'>
			            			<span>Ad</span>
			            		</div>
			            		<div class='col-sm-3 float-left font-weight-bold'>
			            			<span>Soyad</span>
			            		</div>
			            		<div class='col-sm-3 float-left font-weight-bold'>
			            			<span>Kullanıcı adı</span>
			            		</div>
			            	</div>
			            	<div class='clearfix w-100'></div>
			            	<hr>
			            	$ogrenciListesi
			            </div>
		            </div>
		            <div class='tab-pane fade' id='ogrenciEkle' role='tabpanel' aria-labelledby='ogrenciEkle-tab'>
		                öğrenci Ekle
		            </div>
		            <div class='tab-pane fade' id='sorular' role='tabpanel' aria-labelledby='sorular-tab'>
		                Sorukar
		            </div>
		            <div class='tab-pane fade' id='soruEkle' role='tabpanel' aria-labelledby='soruEkle-tab'>
		                 Soru
		            </div>
		            <div class='tab-pane'><span class='btn btn-danger'>Kapat</span></div>
	            </div>
          	</div>
          <!-- /.card -->
        </div>
        <script type='text/javascript'>
		    $('#tumunuSec').on('change', function(e) {
			  	checkboxes = document.getElementsByName('sinavOgrenciNo[]');
	      		for(var i=0, n=checkboxes.length;i<n;i++) {
	        		checkboxes[i].checked = this.checked;
		      	}
			});
        </script>";
        echo $sonuc;
	break;
	
	
	case 'cevap_turune_gore_secenek_ver':
		$sonuc = "";
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 1 ){ $deger1 = "Evet"; $deger2 = "Hayır"; }
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 2 ){ $deger1 = "Doğru"; $deger2 = "Yanlış"; }
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 3 ){ $deger1 = "Var"; $deger2 = "Yok"; }
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 1 OR $_REQUEST[ 'soru_cevap_turu_id' ] == 2 OR $_REQUEST[ 'soru_cevap_turu_id' ] == 3 ){ 
			$sonuc = "
				<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'><input type='radio' name='radiosecenek'></span>
				</div>
				<input type='text' class='form-control' name='' value='$deger1' disabled>
				<input type='hidden' class='form-control' name='secenekler[]' value='$deger1'>
				<div class='input-group-append'>
					<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
				</div>			  
				</div>						
				<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'><input type='radio' name='radiosecenek'></span>
				</div> 
				<input type='text' class='form-control' name='' value='$deger2' disabled>
				<input type='hidden' class='form-control' name='secenekler[]' value='$deger2' >
				<div class='input-group-append'>
					<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
				</div>
				</div>
				<input type='hidden' id='secenek_sayisi' value='2'>
			";
		}
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 4 ){
			$sonuc = "
			<div class='form-group'>
				<button type='button' class='btn btn-xs btn-info' onclick='secenek_ekle()'><i class='fas fa-plus'></i> Seçenek Ekle</button>
			</div>
			<div class='input-group mb-3'>
			  <div class='input-group-prepend'>
				<span class='input-group-text'><input type='radio' name='radiosecenek'></span>
			  </div>
			  <input type='text' class='form-control' name='secenekler[]' value='' required>
			  <div class='input-group-append'>
				<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
			  </div>			  
			</div>						
			<div class='input-group mb-3'>
			  <div class='input-group-prepend'>
				<span class='input-group-text'><input type='radio' name='radiosecenek'></span>
			  </div> 
			  <input type='text' class='form-control' name='secenekler[]' value='' required>
			  <div class='input-group-append'>
				<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
			  </div>
			</div>
			<input type='hidden' id='secenek_sayisi' value='2'>			
			";
		}
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 5 ){
			$sonuc = "
			<div class='form-group'>
				<button type='button' class='btn btn-xs btn-info' onclick='secenek_ekle()'><i class='fas fa-plus'></i> Seçenek Ekle</button>
			</div>
			<div class='input-group mb-3'>
			  <div class='input-group-prepend'>
				<span class='input-group-text'><input type='checkbox' ></span>
			  </div>
			  <input type='text' class='form-control' name='secenekler[]' value='' required>
			  <div class='input-group-append'>
				<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
			  </div>			  
			</div>						
			<div class='input-group mb-3'>
			  <div class='input-group-prepend'>
				<span class='input-group-text'><input type='checkbox' ></span>
			  </div> 
			  <input type='text' class='form-control' name='secenekler[]' value='' required>
			  <div class='input-group-append'>
				<button type='button' class='btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>
			  </div>
			</div>
			<input type='hidden' id='secenek_sayisi' value='2'>			
			";
		}
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 6 ){
			$sonuc = "
			<div class='input-group mb-3'>
			  <div class='input-group-prepend'>
				<span class='input-group-text'>Cevabınız</span>
			  </div>
			  <input type='text' class='form-control' placeholder='Cevap bu şekilde text alanına girilecektir.'>			  
			</div>						
			";
		}
		if( $_REQUEST[ 'soru_cevap_turu_id' ] == 7 ){
			$sonuc = "
			<div class='form-group'>
			<div class='input-group'>
			  <div class='custom-file'>
				<input type='file' class='custom-file-input' id='exampleInputFile'>
				<label class='custom-file-label' for='exampleInputFile'>Dosya Seçiniz...</label>
			  </div>
			</div>
			<small  class='form-text text-muted'>Kullanıcılar dosya yükleme alanını bu şekilde göreceklerdir.</small>
		  </div>
		  ";
		}
		
		
		
		echo $sonuc;
	break;
	case 'rapor_sevkiyat_guzergahlari_ver':
		$siparis_idler = array_key_exists( 'siparis_idler', $_REQUEST ) ? join( "','", array_map( 'intval', $_REQUEST[ 'siparis_idler' ] ) ) : array();
		$SQL_rapor_sevkiyata_ait_siparis_guzergahlar  = $SQL_rapor_sevkiyata_ait_siparis_guzergahlar . "  AND sip.id IN( '$siparis_idler' ) ORDER BY sip.id,sg.id";
		$sonuc = "<option value = '' >Seçiniz</option>";
		$siparis_guzergahlar	= $vt->select( $SQL_rapor_sevkiyata_ait_siparis_guzergahlar, array() );
		echo $SQL_rapor_sevkiyata_ait_siparis_guzergahlar;
		foreach( $siparis_guzergahlar[ 2 ] AS $satir ) {
			$secili = '';
			$guzergah		= $satir[ 'adi' ];
			$guzergah_id	= $satir[ 'id' ];
			$sonuc .= "<option value = '$guzergah_id' >$guzergah</option>";
		}
		echo $sonuc;
	break;
	case 'rapor_uretim_firmalara_ait_lotlar_ver':
		$firma_idler = array_key_exists( 'firma_idler', $_REQUEST ) ? join( "','", array_map( 'intval', $_REQUEST[ 'firma_idler' ] ) ) : array();
		if( count( $_REQUEST[ 'firma_idler' ] ) > 0 ) $SQL_rapor_uretim_firmaya_gore_latlari_ver .= " AND l.firma_id IN( '$firma_idler' ) ORDER BY l.firma_id, l.on_ek_sira";
		else $SQL_rapor_uretim_firmaya_gore_latlari_ver .= " ORDER BY l.firma_id, l.on_ek_sira";
		echo $SQL_rapor_uretim_firmaya_gore_latlari_ver;
		$sonuc = "<option value = '0' >Seçiniz</option>";
		$firmaya_ait_lotlar	= $vt->select( $SQL_rapor_uretim_firmaya_gore_latlari_ver, array() );
		foreach( $firmaya_ait_lotlar[ 2 ] AS $lot ) {
			$lot_adi		= $lot[ 'adi' ];
			$lot_id			= $lot[ 'id' ];
			$sonuc .= "<option value = '$lot_id' >$lot_adi</option>";
		}
		echo $sonuc;
	break;
	case 'bildirim_deneme':
		/*
		$sonuc1 = $_REQUEST[ 'b_sayisi' ]+1;
		if($sonuc1 > 99)
			$sonuc1 = $_REQUEST[ 'b_sayisi' ];
		*/
		$bildirimler	= $vt->select( $SQL_bildirim_getir, array( $_SESSION[ 'kullanici_id' ] ) );
		//$sonuc1 = $bildirimler[ 3 ];
		$bildirim_sayisi = 0;
		$bildirim_renk  = "";
		foreach( $bildirimler[ 2 ] AS $satir ) {
			if( $satir[ 'okundu' ] == 0 ){
				$bildirim_sayisi +=1;
				$bildirim_renk = "list-group-item-warning";
			}
			$sonuc2.='
				<li  class="'.$bildirim_renk.'">
					<a href="?modul='.$satir[ 'yonlendirilecek_modul' ].'&bil='.$satir[ 'id' ].'">
						<table>
							<tr>
								<td>
									<img src="resimler/'.$satir[ 'kullanici_resim' ].'" height="40" class="img-circle" > &nbsp;&nbsp;
								</td> 
								<td>
									<span id="bildirimler"><b>'.$satir[ 'kullanici_adi' ].'</b>, <font color="gray"><b>'.$satir[ 'siparis_kodu' ].'</b></font><br>kodlu yeni bir sipariş girdi.</span>
								</td>
							</tr>
						</table>
					</a>
				</li>		
			';
		}
		$sonuc = $bildirim_sayisi."~".$sonuc2;
		echo $sonuc;
	break;
	case 'siparis_guzergahlari_ver':
		$sonuc = "<option value = '' >Seçiniz</option>";
		$siparis_guzergahlar	= $vt->select( $SQL_siparis_guzergahlar, array( $_REQUEST[ 'siparis_id' ] ) );
		foreach( $siparis_guzergahlar[ 2 ] AS $satir ) {
			if( ( !in_array( $satir[ 'cikis_depo_id' ], $fn->superKontrolluRolYetkiliDepoVer( $_SESSION[ 'rol_id' ], true ) ) ) or $satir[ 'sevkiyat_tamamlandi' ] == 1 )
				continue;
			$secili = '';
			//foreach( $rol_modul_yetki_islem_turleri[ 2 ] AS $satir2 ) if( $satir[ 'id' ] == $satir2[ 'islem_turu_id' ] ) $secili = 'checked';
			$guzergah		= $satir[ 'guzergah' ];
			$guzergah_id	= $satir[ 'id' ];

			$sonuc .= "<option value = '$guzergah_id' >$guzergah</option>";
		}
		//$sonuc .= "</select>";
		echo $sonuc;
	break;

	case 'rol_modul_yetki_islem_oku':
		$sonuc = '';
		$yetki_islem_turleri_tumu		= $vt->select( $SQL_module_atanan_tum_yetki_islem_turleri, array( $_REQUEST[ 'modul_id' ] ) );
		$rol_modul_yetki_islem_turleri	= $vt->select( $SQL_rol_modul_yetki_islem_turleri, array( $_REQUEST[ 'modul_id' ],  $_REQUEST[ 'rol_id' ] ) );

		foreach( $yetki_islem_turleri_tumu[ 2 ] AS $satir ) {
			$secili = '';
			foreach( $rol_modul_yetki_islem_turleri[ 2 ] AS $satir2 ) if( $satir[ 'id' ] == $satir2[ 'islem_turu_id' ] ) $secili = 'checked';
			$adi		= $satir[ 'gorunen_adi' ];
			$id			= $satir[ 'id' ];
			$name		= $satir[ 'adi' ];

			$sonuc .= "
			<li class='list-group-item'>			
				<input id='$id' name='$id' type='checkbox'  $secili data-bootstrap-switch data-off-color='danger' data-on-color='success'/> $adi
				<script>$('input[data-bootstrap-switch]').each(function(){
				  $(this).bootstrapSwitch('state', $(this).prop('checked'));
				  });
				</script>
			</li>
			";
		}
		echo $sonuc;
	break;
	case 'rol_modul_yetki_islem_kaydet':
		$sonuc 					= array( 'hata'=> false, 'mesaj' => 'İşlem başarı ile bitti' );
		$islem_idler			= array();
		$modul_id				= array_key_exists( 'modul_id', $_REQUEST ) 		? $_REQUEST[ 'modul_id' ]		: 0;  
		$rol_id					= array_key_exists( 'rol_id', $_REQUEST ) 			? $_REQUEST[ 'rol_id' ]			: 0;  
		$yetki_islemler			= array_key_exists( 'yetki_islemler', $_REQUEST ) 	? $_REQUEST[ 'yetki_islemler' ]	: false;  
		/* Yetki Ataması yapıldıktan sonra combolar seçili kalsın */
		$_SESSION[ 'rol_id' ]			= $rol_id;
		$_SESSION[ 'modul_id' ]			= $modul_id;
		$_SESSION[ 'aktif_tab_id' ]		= 'rol_yetkileri';

		if( !$modul_id * $rol_id ) {
			$sonuc = array( 'hata'=> true, 'mesaj' => 'Parametreler eksik gönderildiğinden işlem iptal edildi' );
		} else {
			/* 1=on&2=on&3=on stringi'ni parçalayalım ve 1,2,3 gibi id değerlerini $islem_idler dizisinde saklayalım*/
			$vt->islemBaslat();
			$islemler = explode( '&', $yetki_islemler );
			for( $i = 1; $i < count( $islemler ); $i++ ) {
				$id = explode( '=', $islemler[ $i ] );
				$islem_idler[] = $id[ 0 ];
			}

			/* Önce varolan yetki işlemlerini sil */
			$sorgu_sonuc = $vt->delete( $SQL_rol_yetkileri_temizle, array( $rol_id, $modul_id ) );

			if( $sorgu_sonuc[ 0 ] ) {
				$sonuc = array( 'hata'=> true, 'mesaj' => $sorgu_sonuc[ 1 ] );
				break;
			} else {
				if( $yetki_islemler )
					for( $i = 0; $i < count( $islem_idler ); $i++ ) {
						$sorgu_sonuc = $vt->insert( $SQL_rol_modul_yetki_islem_turleri_kaydet, array( $rol_id, $modul_id, $islem_idler[ $i ] ) );
						if( $sorgu_sonuc[ 0 ] ) {
							$sonuc = array( 'hata'=> true, 'mesaj' => $sorgu_sonuc[ 1 ] );
							break;
						}
					}
			}
			$vt->islemBitir();
		}
		echo json_encode( $sonuc );
	break;
}
?>