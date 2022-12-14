<?php
$fn = new Fonksiyonlar();

$islem          		= array_key_exists( 'islem', $_REQUEST )  	? $_REQUEST[ 'islem' ]  : 'ekle';
$id          			= array_key_exists( 'id', $_REQUEST ) 		? $_REQUEST[ 'id' ] 	: 0;

if ( $id > 0 ) $_SESSION[ "id" ] = $id;

$kaydet_buton_yazi		= $islem == "guncelle"	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $islem == "guncelle"	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}

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


$anket		= $vt->select( $SQL_anket_oku, array( $id, $_SESSION[ "kullanici_id" ] ) );

$sorular    = $vt->select( $SQL_anket_sorulari, array( $id ) );    

if( $anket[3] < 1 OR  $sorular[3] < 1 ) {
    echo 'Ulaşmak istediğiniz anket bulunamadı.';
    die;
}
?>

<div class="row">
	<div class="col-md-12">
		<div class="card card-dark" id = "card_sorular">
			<div class="card-header">
				<h3 class="card-title"><?php echo $anket[2][0]["adi"];  ?></h3>
			</div>
			<form action="./_modul/anketler/anketSEG.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="islem" value="ekle" >
                <div class="card-body p-2">
					<div class="table-responsive">
						<table  class="table table-bordered table-hover table-head-fixed " width = "100%" >
							<thead>
								<tr>
									<th style="width: 15px">#</th>
									<th class="mw-50">Soru</th>
									<th class="text-center" data-priority="1" style="width: 100px">Hiç Katılmıyorum</th>
									<th class="text-center" data-priority="1" style="width: 100px">Biraz Katılıyorum</th>
									<th class="text-center" data-priority="1" style="width: 100px">Katılıyorum	</th>
									<th class="text-center" data-priority="1" style="width: 100px">Oldukça Katılıyorum</th>
									<th class="text-center" data-priority="1" style="width: 100px">Tamamen Katılıyorum</th>
								</tr>
							</thead>
							<tbody>
								<?php $sayi = 1; foreach( $sorular[2] AS $soru ) { ?>
									<tr class ="soru-Tr py-1 <?php if( $soru[ 'id' ] == $id ) echo $satir_renk; ?>" >
										<td ><?php echo $sayi++; ?></td>
										<td><b><?php echo $soru[ 'adi' ]; ?></b></td>
										<td class="text-center">
											<div class="icheck-success d-inline">
												<input type="radio" required name="cevap[<?php echo $soru['id'] ?>]" id="<?php echo $soru[ 'id' ]; ?>1"  class="Sec" value="1">
												<label for="<?php echo $soru[ 'id' ]; ?>1"></label>
											</div>
										</td>
										<td class="text-center">
											<div class="icheck-success d-inline">
												<input type="radio" required name="cevap[<?php echo $soru['id'] ?>]" id="<?php echo $soru[ 'id' ]; ?>2"  class="Sec" value="2">
												<label for="<?php echo $soru[ 'id' ]; ?>2"></label>
											</div>
										</td>
										<td class="text-center">
											<div class="icheck-success d-inline">
												<input type="radio" required name="cevap[<?php echo $soru['id'] ?>]" id="<?php echo $soru[ 'id' ]; ?>3"  class="Sec" value="3">
												<label for="<?php echo $soru[ 'id' ]; ?>3"></label>
											</div>
										</td>
										<td class="text-center">
											<div class="icheck-success d-inline">
												<input type="radio" required name="cevap[<?php echo $soru['id'] ?>]" id="<?php echo $soru[ 'id' ]; ?>4"  class="Sec" value="4">
												<label for="<?php echo $soru[ 'id' ]; ?>4"></label>
											</div>
										</td>
										<td class="text-center">
											<div class="icheck-success d-inline">
												<input type="radio" required name="cevap[<?php echo $soru['id'] ?>]" id="<?php echo $soru[ 'id' ]; ?>5"  class="Sec" value="5">
												<label for="<?php echo $soru[ 'id' ]; ?>5"></label>
											</div>
										</td>
										
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
                </div>
                <div class="card-footer">
                    <button type="submit" class=" float-right <?php echo $kaydet_buton_cls; ?>">Anketi Gönder</button>
                </div>
            <form>
			<!-- /.card -->
		</div>
		<!-- right column -->
	</div>
	
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
