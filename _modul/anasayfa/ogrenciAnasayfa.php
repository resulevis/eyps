<?php 
$fn = new Fonksiyonlar();

$SQL_ogrenci_sinavlar_getir = <<< SQL
SELECT
	DISTINCT s.id AS sinav_id,
	k.adi AS komite_adi,
	k.ders_kodu AS ders_kodu,
	s.adi AS sinav_adi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati,
	s.sinav_suresi,
	s.soru_sayisi,
	(SELECT sinav_bitti_mi from tb_sinav_ogrencileri WHERE ogrenci_id = so.ogrenci_id AND sinav_id = s.id ) AS sinav_bitti_mi 
FROM
	tb_sinavlar AS s
LEFT JOIN tb_komiteler AS k ON s.komite_id = k.id 
LEFT JOIN tb_sinav_ogrencileri AS so ON so.sinav_id = s.id
WHERE
	s.universite_id 	= ? AND
	so.ogrenci_id 		= ? AND 
	s.aktif 			= 1
SQL;

$SQL_ogrenci_anketler_getir = <<< SQL
SELECT 
	a.id,
	a.adi,
	ao.anket_bitti
FROM 
	tb_anketler  AS a
LEFT JOIN tb_anket_ogrencileri AS ao ON ao.anket_id = a.id
WHERE 
	ao.ogrenci_id   = ? AND
    ao.anket_bitti  = 0
SQL;

$sinavlar 			= $vt->select( $SQL_ogrenci_sinavlar_getir, array( $_SESSION[ "universite_id" ],$_SESSION[ "kullanici_id" ] ) )[2];
$anketler 			= $vt->select( $SQL_ogrenci_anketler_getir, array( $_SESSION[ "kullanici_id" ] ) )[2];
?>


<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary " id = "card_sorular">
            <div class="card-header">
                <h3 class="card-title" id="dersAdi">Yaklaşan Sınav Listeleri</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2 h-100">

                <?php
                    if( count($sinavlar) > 0){
                        foreach ($sinavlar as $sinav) {
                            echo "<div class='sinav-kapsa rounded-lg d-flex flex-wrap justify-content-space-between align-items-center py-2'>
                                <div class='col-sm-10 m-0 float-left d-flex align-items-center'>
                                    <span  class='sinav-baslik col-sm-10 float-left'>
                                        $sinav[ders_kodu] - $sinav[komite_adi]<br>
                                        <b class='text-success'>".date("d.m.Y", strtotime($sinav['sinav_baslangic_tarihi']))." - ".date("H:i", strtotime($sinav['sinav_baslangic_saati']))."</b>
                                    </span>
                                    <div class='col-sm-1 float-left text-center'>
                                        <span class='d-block text-center'><b class='sinav-dakika d-block h4 text-danger'>$sinav[sinav_suresi]</b>Dk.</span>
                                    </div>
                                    <div class='col-sm-1 float-left text-center'>
                                        <span class='d-block text-center'><b class='sinav-dakika d-block h4 text-danger'>$sinav[soru_sayisi]</b>Soru</span>
                                    </div>
                                    
                                </div>
                                <div class='col-sm-2 float-left text-right'>
                                    <button class='btn btn-outline-info rounded-circle sinav-btn' id='javascript:sinavDetay($sinav[sinav_id]);'><i class='far fa-eye'></i></button>
                                    ".($sinav["sinav_bitti_mi"] == 0 ? "<a href='?modul=sinav&sinav_id=$sinav[sinav_id]' class='btn btn-success rounded-circle sinav-btn'><i class='fas fa-play icon-mt'></i></a>": '')."
                                </div>
                                <div class='clearfix'></div>
                            </div>";
                        }
                    }else{
                        echo "<div class='alert alert-warning'>Katılabileceğiniz Sınav Bulunmadı</div>";
                    }
                ?>
            </div>
            <!-- /.card -->
        </div>
        <!-- right column -->
    </div>
    <div class="col-md-12">
        <div class="card card-secondary " id = "card_sorular">
            <div class="card-header">
                <h3 class="card-title" id="dersAdi">Doldurmanız Gereken Anket Listeleri</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2 h-100">

                <?php
                    if( count($anketler) > 0){
                        foreach ($anketler as $anket) {
                            echo "<div class='sinav-kapsa rounded-lg d-flex flex-wrap justify-content-space-between align-items-center py-2'>
                                <div class='col-10 m-0 float-left d-flex align-items-center'>
                                    <span  class='sinav-baslik col-sm-10 float-left'>
                                        $anket[adi]
                                    </span>
                                </div>
                                <div class='col-2 float-left text-right'>
                                    ".($anket["anket_bitti"] == 0 ? "<a href='?modul=anket&id=$anket[id]' class='btn btn-success rounded-circle sinav-btn'><i class='fas fa-play icon-mt'></i></a>": '')."
                                </div>
                                <div class='clearfix'></div>
                            </div>";
                        }
                    }else{
                        echo "<div class='alert alert-warning'>Katılabileceğiniz anket bulunmadı</div>";
                    }
                ?>
            </div>
            <!-- /.card -->
        </div>
        <!-- right column -->
    </div>
</div>