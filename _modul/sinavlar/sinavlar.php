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

$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ]= $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
$komiteler 				= $vt->select( $SQL_komiteler_getir, array( $_SESSION[ "aktif_yil" ], $_SESSION[ "donem_id" ], $_SESSION[ "program_id" ] ) )[2];
$sinavlar 				= $vt->select( $SQL_sinavlar_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
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
					<span class="btn btn-outline-light btn-sm" id="sagSidebar" data-widget="control-sidebar" data-slide="true" href="#" role="button">Sınav Ekle</span>
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
									echo date("d.m.Y", strtotime( $sinav[ 'sinav_baslangic_tarihi' ] ) ).' - '.date("H:m",strtotime( $sinav[ 'sinav_baslangic_saati' ] ));
								?>
							</td>
							<td>
								<?php 
									echo date("d.m.Y", strtotime( $sinav[ 'sinav_bitis_tarihi' ] ) ).' - '.date("H:m",strtotime( $sinav[ 'sinav_bitis_saati' ] )); 
								?>
							</td>
							<td><?php echo $sinav[ 'sinav_suresi' ]; ?></td>
							<td align = "center">
								<button modul= 'sinavlar' yetki_islem="sinavDetay" class="btn btn-xs btn-dark sinavGetir" data-modal="sinavDetay" data-islem="sinavGetir" data-modul="<?php echo $_REQUEST[ 'modul' ] ?>" data-url="./_modul/ajax/ajax_data.php" data-id="<?php echo $sinav[ 'sinav_id' ]; ?>"  >Sınav Detayı</button>
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
	
	<aside class="control-sidebar sinavEklemeBar" >
        <div class="card card-outline">
        	<span class="btn btn-sm btn-danger position-sticky" id="sagSidebar" data-widget="control-sidebar" data-slide="true" href="#" role="button">Kapat</span>
            <div class="container" style="padding: 20px;margin-top: 10px;">

                <form id = "kayit_formu" action = "_modul/sinavlar/sinavlarSEG.php" method = "POST">
                    <div class="form-group">
                        <label  class="control-label">Komite</label>
                        <select class="form-control select2" name="komite_id" required>
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
					<hr>
					<div class="">
						<button type="reset" class="btn btn-danger" >İptal</button>
						<button type="submit" class="btn btn-success float-right" >Kaydet</button>
					</div>
                </form>
            </div>
        </div>
	</aside>

	<div class="sinavDuzenleSidebar d-none h-100" id="sinavDetay"></div>
	<div class="golgelik d-none" id="golgelik">Kapat</div>
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

	    $('#kapat , #golgelik').on("click", function(e) { 
			document.getElementById("golgelik").classList.toggle("d-none");
			document.getElementById("sinavDetay").classList.toggle("d-none");
	    });
	</script>
