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

$donem_desleri_id	= array_key_exists( 'donem_desleri_id'	,$_REQUEST ) ? $_REQUEST[ 'donem_desleri_id' ]	: 0;

$SQL_mufredat_getir = <<< SQL
SELECT
	*
FROM 
	tb_mufredat
WHERE 
	ders_yili_donem_id  = ? AND
	ders_id 			= ?
SQL;

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

$SQL_dersler_getir = <<< SQL
SELECT 
	d.* 
FROM 
	tb_donem_dersleri AS dd
LEFT JOIN 
	tb_dersler AS d ON d.id = dd.ders_id
WHERE 
	dd.ders_yili_donem_id = ?
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

$SQL_sorular = <<< SQL
SELECT
	sb.*,
	m.adi AS mufredat_adi,
	CONCAT(u.adi," ", oe.adi, " ", oe.soyadi ) AS ogretim_elemani,
	st.adi AS soru_turu
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
	sb.ders_id 				= ?
SQL;

$SQL_ogretim_elemani_sorular = <<< SQL
SELECT
	sb.*,
	m.adi AS mufredat_adi,
	CONCAT(u.adi," ", oe.adi, " ", oe.soyadi ) AS ogretim_elemani,
	st.adi AS soru_turu
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
	sb.ders_id 				= ? AND
	sb.ogretim_elemani_id   = ? 
SQL;

$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ] = $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
@$mufredatlar 			= $vt->select($SQL_mufredat_getir, array( $_SESSION[ "donem_id" ], $_SESSION[ "ders_id"] ) )[ 2 ];
$dersler 	 			= $vt->select($SQL_dersler_getir, array( $_SESSION[ "donem_id" ] ) )[ 2 ];
if ( $_SESSION[ "kullanici_turu" ] == 'ogretmen' AND $_SESSION[ "super" ] == 0 ){
	$sorular 	 			= $vt->select($SQL_ogretim_elemani_sorular, array( $_SESSION[ "program_id" ],$_SESSION[ "donem_id" ], $_SESSION[ "ders_id"], $_SESSION[ "kullanici_id" ] ) )[ 2 ];
}else{
	$sorular 	 			= $vt->select($SQL_sorular, array( $_SESSION[ "program_id" ],$_SESSION[ "donem_id" ], $_SESSION[ "ders_id"] ) )[ 2 ];
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
				<h3 class="card-title" id="dersAdi"></h3>
				<div class="form-group float-right mb-0">
					<select class="form-control select2" name="ders_id" id="dersListesi" required  onchange="dersSecimi(this.value);">
						<option value="">Ders Seçiniz...</option>
						<?php foreach( $dersler AS $ders ){ ?>
							<option value="<?php echo $ders[ "id" ];?>" <?php echo $ders[ "id" ] == @$_SESSION[ "ders_id" ] ? 'selected' : null; ?>>
								( <?php echo $ders[ "ders_kodu" ];?> )&nbsp;&nbsp;&nbsp; 
								<b><?php echo $ders[ "adi" ];?></b>
							</option>
						<?php } ?>
					</select>
				</div>	
			</div>
			<!-- /.card-header -->
			<div class="card-body p-2">
				<table id="tbl_sorular" class="table table-bordered table-hover table-sm" width = "100%" >
					<thead>
						<tr>
							<th style="width: 15px">#</th>
							<th>Soru Türü</th>
							<th>Soru</th>
							<th>Mufredat</th>
							<th>Öğretim Elemani</th>
							<th data-priority="1" style="width: 20px">Seçenekler</th>
							<th data-priority="1" style="width: 20px">Sil</th>
						</tr>
					</thead>
					<tbody>
						<?php $sayi = 1; foreach( $sorular AS $soru ) { ?>
						<tr class ="soru-Tr <?php if( $soru[ 'id' ] == $id ) echo $satir_renk; ?>" data-id="<?php echo $soru[ 'id' ]; ?>">
							<td><?php echo $sayi++; ?></td>
							<td><?php echo $soru[ 'soru_turu' ]; ?></td>
							<td><?php echo $soru[ 'soru' ]; ?></td>
							<td><?php echo $soru[ 'mufredat_adi' ]; ?></td>
							<td><?php echo $soru[ 'ogretim_elemani' ]; ?></td>
							<td align = "center">
								<button modul= 'soruBankasi' yetki_islem="detaylar" class="btn btn-xs btn-dark soruGetir" data-modal="soruDetay" data-islem="soruSecenekGetir" data-modul="<?php echo $_REQUEST[ 'modul' ] ?>" data-url="./_modul/ajax/ajax_data.php" data-id="<?php echo $soru[ 'id' ]; ?>"  >Detaylar</button>
							</td>
							<td align = "center">
								<button modul= 'soruBankasi' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/soruBankasi/soruBankasiSEG.php?islem=sil&id=<?php echo $soru[ 'id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
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

	<div id="gorevli"></div>

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
	
	<!-- UYARI MESAJI VE BUTONU-->
	<div class="modal fade" id="soruDetay">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" id="soruDetayKapsa">
				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
	<script>

		var sel 	= document.getElementById("dersListesi");
		var text 	= sel.options[sel.selectedIndex].text;
		document.getElementById("dersAdi").append(text);

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


		$('.soruGetir').on("click", function(e) { 
			var id          = $(this).data("id");;
	        var data_islem  = $(this).data("islem");
	        var data_url    = $(this).data("url");
	        var data_modul  = $(this).data("modul");
	        var modal       = $(this).data("modal");
	        $("#soruDetayKapsa").empty();
	        $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
	            $("#soruDetayKapsa").append(response);
	        });
	        $('#'+ modal).modal( "show" );

	    });
		function resimSil($soruId){
			
		}
	   
	</script>
