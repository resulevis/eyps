<?php
$fn = new Fonksiyonlar();

$islem          					= array_key_exists( 'islem', $_REQUEST )  		? $_REQUEST[ 'islem' ] 	    : 'ekle';
$ders_yili_donem_id          		= array_key_exists( 'ders_yili_donem_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_donem_id' ] 	: 0;
$ders_id          					= array_key_exists( 'ders_id', $_REQUEST ) 		? $_REQUEST[ 'ders_id' ] 	: 0;

if ( $ders_id > 0 ) $_SESSION[ "ders_id" ] = $ders_id;

$kaydet_buton_yazi		= $islem == "guncelle"	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $islem == "guncelle"	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}


$SQL_donemler_getir = <<< SQL
SELECT 
	dyd.id as id, 
	d.id AS donem_id,
	d.adi AS adi 
FROM 
	tb_ders_yili_donemleri AS dyd
LEFT JOIN 
	tb_donemler AS d ON d.id = dyd.donem_id
WHERE 
	dyd.ders_yili_id = ? AND
	dyd.program_id 	 = ?
SQL;

/**/
$SQL_komiteler_getir = <<< SQL
SELECT
	k.adi,
	k.id,
	k.ders_kodu 
FROM 
	tb_komiteler AS k
LEFT JOIN tb_ders_yili_donemleri AS dyd ON dyd.id = k.ders_yili_donem_id
WHERE 
	dyd.ders_yili_id 	= ? AND 
	dyd.donem_id 		= ? AND
	dyd.program_id 		= ?
SQL;


$SQL_donemler_getir = <<< SQL
SELECT
	dyd.id AS id,
	d.adi AS adi
FROM
	tb_ders_yili_donemleri AS dyd
LEFT JOIN tb_donemler AS d ON d.id = dyd.donem_id 
WHERE
	d.universite_id 	= ? AND
	dyd.ders_yili_id 	= ? AND
	dyd.program_id 		= ? AND
	d.aktif 			= 1
SQL;

$SQL_sinavlar_getir = <<< SQL
SELECT
	s.id AS sinav_id,
	k.adi AS komite_adi,
	k.ders_kodu AS ders_kodu,
	s.adi AS sinav_adi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati,
	s.sinav_suresi
FROM
	tb_sinavlar AS s
LEFT JOIN tb_komiteler AS k ON s.komite_id = k.id 
WHERE
	s.universite_id 	= ? AND
	s.donem_id 			= ? AND
	s.aktif 			= 1
SQL;

$SQL_ogretim_elemani_sinavlar_getir = <<< SQL
SELECT 
	DISTINCT s.id AS sinav_id,
	k.adi AS komite_adi,
	k.ders_kodu AS ders_kodu,
	s.adi AS sinav_adi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati,
	s.sinav_suresi 
FROM 
	tb_sinavlar AS s
LEFT JOIN 
	tb_komiteler 		AS k  ON k.id 			= s.komite_id
LEFT JOIN 
	tb_komite_dersleri 	AS kd ON kd.komite_id 	= k.id
LEFT JOIN 
	tb_donem_dersleri 	AS dd ON dd.id 			= kd.donem_ders_id
LEFT JOIN 
	tb_dersler 			AS d  ON d.id 			= dd.ders_id
LEFT JOIN 
	tb_komite_dersleri_ogretim_uyeleri AS kdou ON kdou.komite_ders_id = kd.id
WHERE 
	kdou.ogretim_uyesi_id 	= ? AND
	s.universite_id 	 	= ? AND
	s.donem_id				= ? AND
	s.aktif 				= 1
SQL;
$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ]= $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
$komiteler 				= $vt->select( $SQL_komiteler_getir, array( $_SESSION[ "aktif_yil" ], $_SESSION[ "donem_id" ], $_SESSION[ "program_id" ] ) )[2];

if ( $_SESSION[ "kullanici_turu" ] == 'ogretmen' AND $_SESSION[ "super" ] == 0 ){
	$sinavlar 			= $vt->select( $SQL_ogretim_elemani_sinavlar_getir, array(  $_SESSION[ "kullanici_id" ],$_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
}else{
	$sinavlar 			= $vt->select( $SQL_sinavlar_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
}
?>

<div class="row">
	<div class="col-sm-12 mb-2 d-flex">
		<?php 
			foreach( $donemler AS $donem ){ ?>
				<label for="donemCard<?php echo $donem[ "id" ] ?>" class="col-sm m-1 pt-3 pb-3 bg-<?php echo $_SESSION[ 'donem_id' ] == $donem[ 'id' ] ? 'olive' : 'navy' ?> btn text-left">
					<div class="icheck-success d-inline">
						<input type="radio" name="aktifDonem" id="donemCard<?php echo $donem[ "id" ] ?>" data-url="./_modul/ajax/ajax_data.php" data-islem="aktifDonem" data-modul="<?php echo $_REQUEST['modul'] ?>" value="<?php echo $donem[ "id" ] ?>" class="aktifYilSec" <?php echo $_SESSION[ 'donem_id' ] == $donem[ 'id' ] ? 'checked' : null; ?>  >
						<label for="donemCard<?php echo $donem[ "id" ] ?>"><?php echo $donem[ 'adi' ]; ?></label>
					</div>
				</label>
		<?php } ?>
		
	</div>
	<div class="col-md-12">
		<div class="card card-dark" id = "card_sorular">
			<div class="card-header">
				<h3 class="card-title" id="dersAdi">Komite Sınavları</h3>	
				<div class="float-right">
					<span class="btn btn-outline-light btn-sm sagSidebar" id="sagSidebar"  href="#" role="button">Sınav Ekle</span>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-2">
				<table id="tbl_sorular" class="table table-bordered table-hover table-sm" width = "100%" >
					<thead>
						<tr>
							<th style="width: 15px">#</th>
							<th>Komite</th>
							<th>Sınav Adı</th>
							<th>Başlangıç Tarihi</th>
							<th>Bitiş Tarihi</th>
							<th data-priority="1" style="width: 30px">Sınav Süresi</th>
							<th data-priority="1" style="width: 100px">Detay</th>
							<th data-priority="1" style="width: 20px">Sil</th>
						</tr>
					</thead>
					<tbody>
						<?php $sayi = 1; foreach( $sinavlar AS $sinav ) { ?>
						<tr class ="soru-Tr <?php if( $sinav[ 'sinav_id' ] == $id ) echo $satir_renk; ?>" >
							<td><?php echo $sayi++; ?></td>
							<td><?php echo $sinav[ 'ders_kodu' ].' - '.$sinav[ 'komite_adi' ]; ?></td>
							<td><?php echo $sinav[ 'sinav_adi' ]; ?></td>
							<td>
								<?php 
									echo date("d.m.Y", strtotime( $sinav[ 'sinav_baslangic_tarihi' ] ) ).' - '.date("H:i",strtotime( $sinav[ 'sinav_baslangic_saati' ] ));
								?>
							</td>
							<td>
								<?php 
									echo date("d.m.Y", strtotime( $sinav[ 'sinav_bitis_tarihi' ] ) ).' - '.date("H:i",strtotime( $sinav[ 'sinav_bitis_saati' ] )); 
								?>
							</td>
							<td><?php echo $sinav[ 'sinav_suresi' ]; ?></td>
							<td align = "center">
								<button modul= 'sinavlar' yetki_islem="detaylar" class="btn btn-xs btn-dark sinavGetir" data-modal="sinavDetay" data-islem="sinavGetir" data-modul="<?php echo $_REQUEST[ 'modul' ] ?>" data-url="./_modul/ajax/ajax_data.php" data-id="<?php echo $sinav[ 'sinav_id' ]; ?>"  >Sınav Detayı</button>
							</td>
							<td align = "center">
								<button modul= 'sinavlar' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/sinavlar/sinavlarSEG.php?islem=sil&id=<?php echo $sinav[ 'sinav_id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!-- /.card -->
		</div>
		<!-- right column -->
	</div>

	<!-- UYARI MESAJI VE BUTONU-->
	<div class="modal fade" id="sil_onay">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Lütfen Dikkat!</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><b>Bu Kaydı silmeniz durumunda tekrar geri alınmayacak</b></p>
					<p>Bu kaydı <b>Silmek</b> istediğinize emin misiniz?</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
					<a type="button" class="btn btn-danger btn-evet">Evet</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
	<div class="sinavDuzenleSidebar d-none overflow-hidden" id="sinavEkleId">
        <div class="card card-olive">
			<div class='card-header'>
				<h3 class="card-title">Yeni Sınav Ekle</h3>
				<button type="button" class="close" id="kapat2" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="card-body scroll" style="padding: 20px;margin-top: 10px;">
			<!--span class="py-3 mb-5 d-block fixed-top btn btn-sm btn-danger position-sticky" id="kapatdad2" data-widget="control-sidebar" data-slide="true" href="#" role="button">Kapat</span-->
                <form id = "kayit_formu" action = "_modul/sinavlar/sinavlarSEG.php" method = "POST">
                    <div class="form-group">
                        <label  class="control-label">Komite</label>
                        <select class="form-control" name="komite_id" required>
                            <option value="">Seçiniz...</option>
                            <?php 
                                foreach( $komiteler AS $komite ){
                                    echo '<option value="'.$komite[ "id" ].'" >'.$komite[ "ders_kodu" ].' -'.$komite[ "adi" ].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label  class="control-label">Sınav Adı</label>
                        <input type="text" name="adi" class="form-control">
                    </div>

                    <div class="form-group">
                        <label  class="control-label">Açıklama</label>
                        <textarea class="form-control summernote" rows="3" name="aciklama"></textarea>
                    </div>
                    <div class="form-group">
                        <label  class="control-label">Sınav Öncesi Açıklama</label>
                        <textarea class="form-control summernote" rows="3" name="sinav_oncesi_aciklama"></textarea>
                    </div>
                    <div class="form-group">
                        <label  class="control-label">Sınav Sonrası Açıklama</label>
                        <textarea class="form-control summernote" rows="3" name="sinav_sonrasi_aciklama"></textarea>
                    </div>

                    <div class="form-group">
                        <label  class="control-label">Sınav Süresi</label>
                        <input type="text" name="sinav_suresi" class="form-control">
                    </div>

                    <div class="form-group">
                        <label  class="control-label">İp Sınırlandırması</label>
                        <input type="text" name="ip_adresi" class="form-control" placeholder="192.168........">
                    </div>
                    
                    <div class="col-sm-6 float-left ">
	                    <div class="form-group">
							<label class="control-label">Sınav Başlangıç Tarihi</label>
							<div class="input-group date" id="baslangicTarihi" data-target-input="nearest">
								<div class="input-group-append" data-target="#baslangicTarihi" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input autocomplete="off" type="text" name="baslangic_tarihi" class="form-control form-control-sm datetimepicker-input" data-target="#baslangicTarihi" data-toggle="datetimepicker"/>
							</div>
						</div>
	                </div>
	                <div class="col-sm-6 float-left">
	                    <div class="form-group">
							<label class="control-label">Sınav Başlangıç Tarihi</label>
							<div class="input-group date" id="baslangicSaati" data-target-input="nearest">
								<div class="input-group-append" data-target="#baslangicSaati" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-clock"></i></div>
								</div>
								<input autocomplete="off" type="text" name="baslangic_saati" class="form-control form-control-sm datetimepicker-input" data-target="#baslangicSaati" data-toggle="datetimepicker"/>
							</div>
						</div>
	                </div>

	                <div class="col-sm-6 float-left ">
	                    <div class="form-group">
							<label class="control-label">Sınav Bitiş Tarihi</label>
							<div class="input-group date" id="bitisTarihi" data-target-input="nearest">
								<div class="input-group-append" data-target="#bitisTarihi" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input autocomplete="off" type="text" name="bitis_tarihi" class="form-control form-control-sm datetimepicker-input" data-target="#bitisTarihi" data-toggle="datetimepicker"/>
							</div>
						</div>
	                </div>
	                <div class="col-sm-6 float-left">
	                    <div class="form-group">
							<label class="control-label">Sınav Bitiş Tarihi</label>
							<div class="input-group date" id="bitisSaati" data-target-input="nearest">
								<div class="input-group-append" data-target="#bitisSaati" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-clock"></i></div>
								</div>
								<input autocomplete="off" type="text" name="bitis_saati" class="form-control form-control-sm datetimepicker-input" data-target="#bitisSaati" data-toggle="datetimepicker"/>
							</div>
						</div>
	                </div>
	                <div class="form-group">
						<label  class="control-label">Soruları Karıştır</label>
						<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
							<div class="bootstrap-switch-container" >
								<input type="checkbox" name="sorulari_karistir" checked data-bootstrap-switch="" data-off-color="danger" data-on-text="Evet" data-off-text="Hayır" data-on-color="success" >
							</div>
						</div>
					</div>

					<div class="form-group">
						<label  class="control-label">Seçenekleri Karıştır</label>
						<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
							<div class="bootstrap-switch-container" >
								<input type="checkbox" name="secenekleri_karistir" checked data-bootstrap-switch="" data-off-color="danger" data-on-text="Evet" data-off-text="Hayır" data-on-color="success">
							</div>
						</div>
					</div>
					<hr class='w-100'>
					<div>
						<div class="container">
							<button type="reset" class="btn btn-danger" >İptal</button>
							<button type="submit" class="btn btn-success float-right" >Kaydet</button>
						</div>
					</div>
                </form>
            </div>
        </div>
	</div>
	<div class="golgelik d-none" id="golgelik2">Kapat</div>						
	<div class="sinavDuzenleSidebar d-none overflow-hidden" id="sinavDetay"></div>
	<div class="golgelik d-none" id="golgelik">Kapat</div>
	<div id="sinavCevapDetayKapsa" style="z-index:99999;"></div>
	<script>
		$(function () {
			$('#baslangicTarihi').datetimepicker({
				//defaultDate: simdi,
				format: 'DD.MM.yyyy',
				icons: {
				time: "far fa-clock",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
				}
			});
		});

		$(function () {
			$('#baslangicSaati').datetimepicker({
				//defaultDate: simdi,
				format: 'HH:mm',
				icons: {
				time: "far fa-clock",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
				}
			});
		});

		$(function () {
			$('#bitisTarihi').datetimepicker({
				//defaultDate: simdi,
				format: 'DD.MM.yyyy',
				icons: {
				time: "far fa-clock",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
				}
			});
		});

		$(function () {
			$('#bitisSaati').datetimepicker({
				//defaultDate: simdi,
				format: 'HH:mm',
				icons: {
				time: "far fa-clock",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
				}
			});
		});
		

		$(".summernote").summernote();

		$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
			$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
		} );
		function dersSecimi(ders_id){
			var  url 		= window.location;
			var origin		= url.origin;
			var path		= url.pathname;
			var search		= (new URL(document.location)).searchParams;
			var modul   	= search.get('modul');
			var ders_id  	= "&ders_id="+ders_id;
			
			window.location.replace(origin + path+'?modul='+modul+''+ders_id);
		}

		var tbl_sorular = $( "#tbl_sorular" ).DataTable( {
			"responsive": true, "lengthChange": true, "autoWidth": true,
			"stateSave": true,
			"pageLength" : 25,
			//"buttons": ["excel", "pdf", "print","colvis"],

			buttons : [
				{
					extend	: 'colvis',
					text	: "Alan Seçiniz"
					
				},
				{
					extend	: 'excel',
					text 	: 'Excel',
					exportOptions: {
						columns: ':visible'
					},
					title: function(){
						return "Soru Listesi";
					}
				},
				{
					extend	: 'print',
					text	: 'Yazdır',
					exportOptions : {
						columns : ':visible'
					},
					title: function(){
						return "Soru Listesi";
					}
				}
			],
			"language": {
				"decimal"			: "",
				"emptyTable"		: "Gösterilecek kayıt yok!",
				"info"				: "Toplam _TOTAL_ kayıttan _START_ ve _END_ arası gösteriliyor",
				"infoEmpty"			: "Toplam 0 kayıttan 0 ve 0 arası gösteriliyor",
				"infoFiltered"		: "",
				"infoPostFix"		: "",
				"thousands"			: ",",
				"lengthMenu"		: "Show _MENU_ entries",
				"loadingRecords"	: "Yükleniyor...",
				"processing"		: "İşleniyor...",
				"search"			: "Ara:",
				"zeroRecords"		: "Eşleşen kayıt bulunamadı!",
				"paginate"			: {
					"first"		: "İlk",
					"last"		: "Son",
					"next"		: "Sonraki",
					"previous"	: "Önceki"
				}
			}
		} ).buttons().container().appendTo('#tbl_sorular_wrapper .col-md-6:eq(0)');

		$('.sinavGetir').on("click", function(e) { 
			var id          = $(this).data("id");;
	        var data_islem  = $(this).data("islem");
	        var data_url    = $(this).data("url");
	        var data_modul  = $(this).data("modul");
	        var modal       = $(this).data("modal");
	        $("#" + modal).empty();
	        $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
	            $("#" + modal).append(response);
	        });
	        var height = window.innerHeight;
	        document.getElementById("sinavDetay").classList.toggle("d-none");
			document.getElementById("golgelik").classList.toggle("d-none");
		    document.getElementById('sinavDetay').style.height = height+'px';
		    document.getElementById('sinavDetay').style.overflowY = 'scroll';
	    });

		$('.sagSidebar').on("click", function(e) { 
			var height = window.innerHeight;
	        document.getElementById("sinavEkleId").classList.toggle("d-none");
			document.getElementById("golgelik2").classList.toggle("d-none");
			document.getElementById('sinavEkleId').style.height = height+'px';
		    document.getElementById('sinavEkleId').style.overflowY = 'scroll';
	    });
	    $('#kapat , #golgelik').on("click", function(e) { 
			document.getElementById("golgelik").classList.toggle("d-none");
			document.getElementById("sinavDetay").classList.toggle("d-none");
	    });
	    $('#kapat2 , #golgelik2').on("click", function(e) { 
			document.getElementById("golgelik2").classList.toggle("d-none");
			document.getElementById("sinavEkleId").classList.toggle("d-none");
	    });
	    function seciliOgrenciCikar(id){
	    	var sinav_id = id;
	    	// Formdan gelen degerleri degerler değişkenine atıyoruz
            var degerler = $("#seciliOgrenciler").serialize();
            // Ajax Methodunu Başlatıyoru<
            $.ajax({          
                type: "post", // gönderme tipi
                url: "./_modul/ajax/ajax_data.php", // gönderdiğimiz dosya
                data : degerler+'&modul=sinavlar&islem=ogrenciCikar&id='+sinav_id, // gönderilcek veriler
                dataType: "json",
                success : function(cevap){ // eğer başarılı ise
                    /*Ajax tarfından gelen mesaj verilecek*/
                    mesajVer( cevap.mesaj, cevap.renk );
                    
                    /*Veri tabanından öğrenci silinmiş ise */
                    if( cevap.durum == 1 ){
                    	cevap.idler.forEach(satirSil);
						function satirSil(item, index, arr) {
						  	document.getElementById("sinavOgrenciNo"+item).closest(".sinav-ogrencileri").remove();
						}
                    }
                }
            });
	    }
	    function seciliOgrenciEkle(id){
	    	var sinav_id = id;
	    	// Formdan gelen degerleri degerler değişkenine atıyoruz
            var degerler = $("#ekleSeciliOgrenciler").serialize();
            // Ajax Methodunu Başlatıyoru<
            $.ajax({          
                type: "post", // gönderme tipi
                url: "./_modul/ajax/ajax_data.php", // gönderdiğimiz dosya
                data : degerler+'&modul=sinavlar&islem=ogrenciEkle&id='+sinav_id, // gönderilcek veriler
                dataType: "json",
                success : function(cevap){ // eğer başarılı ise
                    /*Ajax tarfından gelen mesaj verilecek*/
                    mesajVer( cevap.mesaj, cevap.renk );
                    
                    /*Veri tabanından öğrenci silinmiş ise */
                    if( cevap.durum == 1 ){
                    	cevap.idler.forEach(satirSil);
						function satirSil(item, index, arr) {
						  	document.getElementById("ekleSinavOgrenciNo"+item).closest(".sinav-ogrencileri").remove();
						}
                    }
                }
            });
	    }
	    function load_data(kelime){
			if ( kelime.length > 2 ){
				var form_data = new FormData();
				form_data.append('kelime', kelime);
				form_data.append('modul', 'donemOgrencileri');
				form_data.append('islem', 'ogrenciAra');

				var ajax_request = new XMLHttpRequest();

				ajax_request.open('POST', './_modul/ajax/ajax_data.php');

				ajax_request.send(form_data);

				ajax_request.onreadystatechange = function()
				{
					if(ajax_request.readyState == 4 && ajax_request.status == 200)
					{
						var response = JSON.parse(ajax_request.responseText);

						var html = "<div class='list-group gelenOgrenci'>";

						if(response.length > 0)
						{
							for(var count = 0; count < response.length; count++)
							{
								
								html += '<div class="list-group-item list-group-item-action p-0 d-flex justify-content-between rounded-0 border-bottom" onclick="javascript:ogrenciSec(this);" data-ogrenci_id="'+response[count].id+'" data-ogrenci_adi="'+response[count].adi+'" data-ogrenci_no="'+response[count].ogrenci_no+'">'+
											'<a href="#" class="p-2 text-dark"  >'+response[count].adi+' - '+response[count].ogrenci_no+'</a>'+
										'</div>';
							}
						}
						else
						{
							html += '<a href="#" class="list-group-item list-group-item-action disabled">Öğrenci Bulunamadı.</a>';
						}

						html += '</div>';
						document.getElementById('aramaSonuclari').innerHTML = html;
					}
				}
			}else{
				document.getElementById('aramaSonuclari').innerHTML = '';
			}
		}
		function ogrenciSec(a){
			var ogrenci_id 	= $(a).data("ogrenci_id");
			var ogrenci_adi = $(a).data("ogrenci_adi");
			var ogrenci_no 	= $(a).data("ogrenci_no");
			
			if ( $("#eklenecekOgrenci"+ogrenci_id).length == 0 ) {
				var html = "<div class=' w-100 sinav-ogrencileri' id='eklenecekOgrenci"+ogrenci_id+"'>"+
		            		"<div class='col-sm-1 float-left'>"+
		            			"<div class='card-tools'>"+
									"<div class='icheck-primary'>"+
										"<input type='checkbox' name='ekleSinavOgrenciNo[]' onchange='javascript:ekleSeciliOgrenciSay();' id='ekleSinavOgrenciNo"+ogrenci_id+"' value='"+ogrenci_id+"' class='ekleSecilenOgrenci'>"+
										"<label for='ekleSinavOgrenciNo"+ogrenci_id+"' ></label>"+
									"</div>"+
								"</div>"+
		            		"</div>"+
		            		"<div class='col-sm-7 float-left'>"+
		            			"<span id='ogrenciAdi'>"+ogrenci_adi+"</span>"+
		            		"</div>"+
		            		"<div class='col-sm-3 float-left'>"+
		            			"<span>"+ogrenci_no+"</span>"+
		            		"</div>"+
		            	"</div>"; 

		        $("#ekleSeciliOgrenciler").append(html);
		    }
		}

		function soru_load_data(kelime,sinav_id){
			if ( kelime.length > 2 ){
				var ogretim_elemani_id 	= document.getElementById('selectOgretimElemaniId').value;
				var ders_id 			= document.getElementById('selectDersId').value;
				var form_data = new FormData();
				form_data.append('kelime', kelime);
				form_data.append('ogretim_elemani_id', ogretim_elemani_id);
				form_data.append('ders_id', ders_id);
				form_data.append('modul', 'sinavlar');
				form_data.append('islem', 'soruAra');

				var ajax_request = new XMLHttpRequest();

				ajax_request.open('POST', './_modul/ajax/ajax_data.php');

				ajax_request.send(form_data);

				ajax_request.onreadystatechange = function()
				{
					if(ajax_request.readyState == 4 && ajax_request.status == 200)
					{
						var response = JSON.parse(ajax_request.responseText);

						var html = "<div class='list-group gelenSoru'>";

						if(response.length > 0)
						{
							for(var count = 0; count < response.length; count++)
							{
								
								html += '<div class="list-group-item list-group-item-action p-0 d-flex justify-content-between rounded-0 border-bottom" onclick="javascript:soruSec('+response[count].id+','+sinav_id+');" data-soru_id="'+response[count].id+'" data-soru_adi="'+response[count].adi+'" >'+
											'<a href="#" class="p-2 text-dark"  >'+response[count].adi+'</a>'+
										'</div>';
							}
						}
						else
						{
							html += '<a href="#" class="list-group-item list-group-item-action disabled">Soru Bulunamadı.</a>';
						}

						html += '</div>';
						document.getElementById('soruAramaSonuclari').innerHTML = html;
					}
				}
			}else{
				document.getElementById('soruAramaSonuclari').innerHTML = '';
			}
		}
		function soruSec(soru_id, sinav_id){
	    	var sinav_id 			= sinav_id;
	    	var soru_id  			= soru_id;
			var ogretim_elemani_id 	= document.getElementById('selectOgretimElemaniId').value;
			var ders_id 			= document.getElementById('selectDersId').value;
            // Ajax Methodunu Başlatıyoruz
            $.ajax({          
                type: "post", // gönderme tipi
                url: "./_modul/ajax/ajax_data.php", // gönderdiğimiz dosya
                data : 'modul=sinavlar&islem=soruEkle&sinav_id='+sinav_id+'&soru_id='+soru_id+'&ogretim_elemani_id='+ogretim_elemani_id+'&ders_id='+ders_id, // gönderilcek veriler
                dataType: "json",
                success : function(cevap){ // eğer başarılı ise
                    /*Ajax tarfından gelen mesaj verilecek*/
                    mesajVer( cevap.mesaj, cevap.renk );
                    
                    /*Veri tabanından öğrenci silinmiş ise */
                    if( cevap.durum == 1 ){
                    	cevap.idler.forEach(satirSil);
						function satirSil(item, index, arr) {
						  	document.getElementById("ekleSinavOgrenciNo"+item).closest(".sinav-ogrencileri").remove();
						}
                    }
                }
            });
	    }

	    function ogretimElemaniSinavDersGetir(id,sinav_id){
			if ( id != '' || sinav_id != '') {
	            $.ajax({          
	                type: "post", // gönderme tipi
	                url: "./_modul/ajax/ajax_data.php", // gönderdiğimiz dosya
	                data : 'modul=sinavlar&islem=dersler&ogretim_elemani_id='+id+'&sinav_id='+sinav_id, // gönderilcek veriler
	                dataType: "json",
	                success : function(cevap){ // eğer başarılı ise
	                    /*Ajax tarfından gelen mesaj verilecek*/
	                    $("#ogretimElemaniSinavDersGetir1").empty();
						document.getElementById('ogretimElemaniSinavDersGetir1').innerHTML = cevap.cevap;
	                }
	            });
	        }
	    }

		function ekleSeciliOgrenciSay(){
			var ogrenciSayisi = $('.ekleSecilenOgrenci:checked').length;
	      	$('#ogrenciSayisi').empty();
	      	$('#ogrenciSayisi').append(ogrenciSayisi);
	      	if( ogrenciSayisi > 0 ){
	      		$('#ekleBtnSeciliOgrenci').prop('disabled', false);
			}else{
				$('#ekleBtnSeciliOgrenci').prop('disabled', true);
			}
	    }
		function soruPuanGuncelle(id, sinavId, puan){
			var data_url 	= './_modul/ajax/ajax_data.php';
			puan = puan.value;
			
			$.post(data_url, { islem : "sinavSoruPuanGuncelle", soruId : id, modul:"sinavlar",sinavId:sinavId,puan:puan }, function (response) {
				var sonuc = JSON.parse(response);
				if(sonuc.durum == 0){
					mesajVer( sonuc.mesaj , 'kirmizi');
				}
			});
			
	    }
		
		function soruSil(id, sinavId){
			var data_url 	= './_modul/ajax/ajax_data.php';
			$.post(data_url, { islem : "sinavSoruSil", soruId : id, modul:"sinavlar",sinavId:sinavId }, function (response) {
				var sonuc = JSON.parse(response);
				if(sonuc.durum == 1){
					mesajVer( sonuc.mesaj , 'yesil');
					document.getElementById("soruSil"+id).closest(".sinav-sorulari").remove();
				}else{
					mesajVer( sonuc.mesaj , 'kirmizi');
				}
			});
			
	    }

		function ogrenciSinavDetay(sinav_id,ogrenci_id){
			var data_url 	= './_modul/ajax/ajax_data.php';
			$.post(data_url, { islem : "ogrenciSinavDetay", sinav_id : sinav_id, modul:"sinavlar", ogrenci_id:ogrenci_id }, function (response) {
				var sonuc = JSON.parse(response);
				if(sonuc.durum == 1){
					$("#sinavCevapDetayKapsa").empty();
					$("#sinavCevapDetayKapsa").append(sonuc.mesaj);
					$('#sinavCevapModal').modal('show');
				}
			});
		}
		function puanVer(sinav_id,ogrenci_id,soru_id){
			var puan = document.getElementById("soru-"+soru_id).value;
			var data_url 	= './_modul/ajax/ajax_data.php';
			$.post(data_url, { islem : "puanVer", sinav_id : sinav_id, modul: "sinavlar", ogrenci_id: ogrenci_id, soru_id: soru_id, puan: puan }, function (response) {
				var sonuc = JSON.parse(response);
				if(sonuc.durum == 1){
					$("#puan-"+ogrenci_id).empty();
					$("#puan-"+ogrenci_id).append(sonuc.puan);
				}
			});

		}
	</script>
