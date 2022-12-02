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

$SQL_anketleri_getir = <<< SQL
SELECT
	* 
FROM
	tb_anketler
WHERE
	universite_id 	= ? AND 
	donem_id 		= ? AND
	aktif 			= 1
SQL;
$SQL_sablonlar_getir = <<< SQL
SELECT
	* 
FROM
	tb_anket_sablon
WHERE
	universite_id 	= ? AND 
	aktif 			= 1
SQL;

$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ]= $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
$anketler 				= $vt->select( $SQL_anketleri_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "donem_id" ] ) )[2];
$sablonlar 				= $vt->select( $SQL_sablonlar_getir, array( $_SESSION[ "universite_id" ] ) )[2];
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
				<h3 class="card-title" id="dersAdi">Anketler</h3>	
				<div class="float-right">
					<span class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#sablon_ekle">Anket Ekle</span>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-2">
				<table id="tbl_sorular" class="table table-bordered table-hover table-sm" width = "100%" >
					<thead>
						<tr>
							<th style="width: 15px">#</th>
							<th>Anket Adı</th>
							<th data-priority="1" style="width: 100px">Detay</th>
							<th data-priority="1" style="width: 20px">Sil</th>
						</tr>
					</thead>
					<tbody>
						<?php $sayi = 1; foreach( $anketler AS $anket ) { ?>
						<tr class ="soru-Tr <?php if( $anket[ 'id' ] == $id ) echo $satir_renk; ?>" >
							<td><?php echo $sayi++; ?></td>
							<td><?php echo $anket[ 'adi' ]; ?></td>
							<td align = "center">
								<button modul= 'anketler' yetki_islem="detaylar" class="btn btn-xs btn-warning sablonGetir" data-modal="cevapDetay" data-islem="anketDetay" data-modul="<?php echo $_REQUEST[ 'modul' ] ?>" data-url="./_modul/ajax/ajax_data.php" data-id="<?php echo $anket[ 'id' ]; ?>"  >Detaylar</button>
							</td>
							<td align = "center">
								<button modul= 'anketler' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/anketler/anketlerSEG.php?islem=sil&id=<?php echo $anket[ 'id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
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
		</div>
	</div>	
	<!-- Sablon Ekleme modal-->
	<div class="modal fade" id="sablon_ekle">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="./_modul/anketler/anketlerSEG.php" method="POST">
					<div class="modal-header">
						<h4 class="modal-title">Anket Ekleme</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="islem" value="ekle">
						<input type="hidden" name="id" value="">
						<div class="alert alert-warning text-center">Seçeceğiniz kategoriye ait öğrenciler eklenecektir.<br>Lütfen Önce Seceçeğiniz kategoriye öğrenci listesini kontrol ediniz.</div>
						<div class="form-group">
							<label>Anket Adı</label>
							<input type="text" class="form-control" name="adi" required>
						</div>
						<div class="form-group">
							<label>Anket Kategori</label>
							<select required id="kategori" name="kategori" class="form-control ajaxGetir" data-islem="anketKategoriGetir" data-url="./_modul/ajax/ajax_data.php" data-modul="anketler" data-div="kategoriGetir">
								<option value="0">Seçiniz</option>
								<option value="1">Komite</option>
								<option value="2">Ders</option>
								<option value="3">Sınav</option>
							</select>
						</div>
						<div class="form-group" id="kategoriGetir">
						</div>
						<div class="form-group d-none" id="sablon-kapsa">
							<label for="sablon">Anket Şablonu Seçiniz</label>
							<select class="form-control" name="sablon_id" id="sablon">
								<?php 
									foreach ($sablonlar as $sablon) {
										echo "<option value='$sablon[id]'>$sablon[adi]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
						<button type="submit" class="btn btn-danger btn-evet">Evet</button>
					</div>
				</form>
			</div>
		</div>
	</div>			
	<div class="sinavDuzenleSidebar d-none overflow-hidden" id="cevapDetay"></div>
	<div class="golgelik d-none" id="golgelik">Kapat</div>
	<script>

		$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
			$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
		} );
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

		$('.sablonGetir').on("click", function(e) { 
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
	        document.getElementById("cevapDetay").classList.toggle("d-none");
			document.getElementById("golgelik").classList.toggle("d-none");
		    document.getElementById('cevapDetay').style.height = height+'px';
		    document.getElementById('cevapDetay').style.overflowY = 'scroll';
	    });

	    $('#kapat , #golgelik').on("click", function(e) { 
			document.getElementById("golgelik").classList.toggle("d-none");
			document.getElementById("cevapDetay").classList.toggle("d-none");
	    });

		$('.soruEkle').on("click", function(e) {
			var id 		= $(this).data("id");
			var baslik 	= $(this).data("baslik");
			
			$("#soruEklemeBaslik").text(baslik);
			document.getElementById("sablonId").value = id;
	    });
		
		function soruEkleTextarea(){
			$("#soru-kapsa").append("<div class='col-12 mb-2 soru'> <hr class='w-100 border-secondary' >"+
										"<div class='d-flex justify-content-between align-items-center pt-2 pb-2'>"+
											"<h5>Soru</h5>"+
											"<a class='btn btn-danger' id ='eklenecekSoruSil' ><i class='fa fa-close'></i> Sil</a>"+
										"</div>"+
										"<textarea name='soru[]' class='form-control' autocomplete='off'></textarea>"+
									"</div>");
		}
		$('#soru-kapsa').on("click", "#eklenecekSoruSil", function (e) {
			e.preventDefault();
			$(this).closest(".soru").remove();
		});
		function anketSoruSil(id){
			var id          = id;
	        var data_islem  = "anketSoruSil";
	        var data_url    = "./_modul/ajax/ajax_data.php";
	        var data_modul  = "sablonlar";
	        $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
	            var sonuc = JSON.parse(response);
				mesajVer(sonuc.mesaj,sonuc.renk);
				if( sonuc.durum == 1  ){
					$("#soru-"+sonuc.id).remove();
				}
	        });
		}
		$('.ajaxGetir').on("change", function(e) { 
			$("#sablon-kapsa").removeClass("d-none");
		}); 
		
	</script>
