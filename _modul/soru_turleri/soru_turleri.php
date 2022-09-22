<?php
$fn	= new Fonksiyonlar();
$vt = new VeriTabani();


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj								= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu							= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	$_REQUEST[ 'soru_turu_id' ]		= $_SESSION[ 'sonuclar' ][ 'id' ];
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}


$islem			= array_key_exists( 'islem'			,$_REQUEST ) ? $_REQUEST[ 'islem' ]			: 'ekle';
$soru_turu_id	= array_key_exists( 'soru_turu_id'	,$_REQUEST ) ? $_REQUEST[ 'soru_turu_id' ]	: 0;


$satir_renk				= $soru_turu_id > 0	? 'table-warning'						: '';
$kaydet_buton_yazi		= $soru_turu_id > 0	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $soru_turu_id > 0	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';



$SQL_soru_turleri = <<< SQL
SELECT 
	*
FROM 
	tb_soru_turleri
SQL;


$SQL_tek_soru_turu_oku = <<< SQL
SELECT 
	*
FROM 
	tb_soru_turleri
WHERE 
	id 			= ?
SQL;

$soru_turleri			= $vt->select( $SQL_soru_turleri, array( $_SESSION[ "universite_id" ] ) )[ 2 ];
@$tek_soru_turu			= $vt->select( $SQL_tek_soru_turu_oku, array( $soru_turu_id ) )[ 2 ][ 0 ];

?>

<div class="modal fade" id="sil_onay">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Lütfen Dikkat</h4>
			</div>
			<div class="modal-body">
				<p>Bu kaydı silmek istediğinize emin misiniz?</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
				<a class="btn btn-danger btn-evet">Evet</a>
			</div>
		</div>
	</div>
</div>


<script>
	/* Kayıt silme onay modal açar. */
	$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
		$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
	} );
</script>


<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="card card-olive" id = "card_soru_turleri">
					<div class="card-header">
						<h3 class="card-title">Soru Türleri</h3>
						<div class = "card-tools">
							<button type="button" data-toggle = "tooltip" title = "Tam sayfa göster" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand fa-lg"></i></button>
							<a id = "yeni_soru_turu" data-toggle = "tooltip" title = "Yeni Soru Türü Ekle" href = "?modul=soru_turleri&islem=ekle" class="btn btn-tool" ><i class="fas fa-plus fa-lg"></i></a>
						</div>
					</div>
					<div class="card-body">
						<table id="tbl_soru_turleri" class="table table-bordered table-hover table-sm" width = "100%" >
							<thead>
								<tr>
									<th style="width: 15px">#</th>
									<th>Adı</th>
									<th data-priority="1" style="width: 20px">Düzenle</th>
								</tr>
							</thead>
							<tbody>
								<?php $sayi = 1; foreach( $soru_turleri AS $soru_turu ) { ?>
								<tr oncontextmenu="fun();" class ="soru_turu-Tr <?php if( $soru_turu[ 'id' ] == $soru_turu_id ) echo $satir_renk; ?>" data-id="<?php echo $soru_turu[ 'id' ]; ?>">
									<td><?php echo $sayi++; ?></td>
									<td><?php echo $soru_turu[ 'adi' ]; ?></td>
									<td align = "center">
										<a modul = 'soru_turleri' yetki_islem="duzenle" class = "btn btn-sm btn-warning btn-xs" href = "?modul=soru_turleri&islem=guncelle&soru_turu_id=<?php echo $soru_turu[ 'id' ]; ?>" >
											Düzenle
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<form class="form-horizontal" action = "_modul/soru_turleri/soru_turleriSEG.php" method = "POST" enctype="multipart/form-data">
					<div class="card <?php if( $soru_turu_id == 0 ) echo 'card-secondary' ?>">
						<div class="card-header bg-orange">
								<?php if( $soru_turu_id > 0 ) { ?>
									<h3 class="card-title text-white"> Soru Türü Düzenle</h3>
								<?php } else { ?>
									<h3 class="card-title text-white"> Soru Türü Ekle</h3>
								<?php } ?>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<!-- GENEL BİLGİLER -->
								<div class="tab-pane active" id="_genel">
									<input type = "hidden" name = "islem" value = "<?php echo $islem; ?>" >
									<input type = "hidden" name = "soru_turu_id" value = "<?php echo $soru_turu_id; ?>">
									<h3 class="profile-username text-center"><b> </b></h3>
									<div class="form-group">
										<label class="control-label">Soru Türü Adı</label>
										<input required type="text" class="form-control form-control-sm" name ="adi" value = "<?php echo $tek_soru_turu[ "adi" ]; ?>"  autocomplete="off">
									</div>
									<div class="form-group">
										<label  class="control-label">Çoklu Şeçenek Mi? </label>
										<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
											<div class="bootstrap-switch-container" >
												<input type="checkbox" name="coklu_secenek" data-bootstrap-switch="" data-off-color="danger" data-on-text="Evet" data-off-text="Hayır" data-on-color="success" <?php echo $tek_soru_turu[ "coklu_secenek" ] == 1 ? "checked" : null; ?>>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label  class="control-label">Metin Mi? </label>
										<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
											<div class="bootstrap-switch-container" >
												<input type="checkbox" name="metin" data-bootstrap-switch="" data-off-color="danger" data-on-text="Evet" data-off-text="Hayır" data-on-color="success" <?php echo $tek_soru_turu[ "metin" ] == 1 ? "checked" : null; ?>>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button modul= 'soru_turu' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls; ?>"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi; ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<style type="text/css">
	.custom-menu {
	    z-index:1000;
	    position: absolute;
	    background-color:#fff;
	    border: 1px solid #000;
	    padding: 2px;
	    border-radius: 5px;
	}
	.custom-menu a{
		display: block;
		padding: 10px 30px 10px 10px;
		border-bottom: 1px solid #ddd;
		color: #000;
	}
	.custom-menu a:hover{
		background-color: #ddd;
		transition: initial;
	}
	
</style>
<script type="text/javascript">
//Adı sıyadını büyük harf yap
String.prototype.turkishToUpper = function(){
	var string = this;
	var letters = { "i": "İ", "ş": "Ş", "ğ": "Ğ", "ü": "Ü", "ö": "Ö", "ç": "Ç", "ı": "I" };
	string = string.replace(/(([iışğüçö]))/g, function(letter){ return letters[letter]; })
	return string.toUpperCase();
}

// ESC tuşuna basınca formu temizle
document.addEventListener( 'keydown', function( event ) {
	if( event.key === "Escape" ) {
		document.getElementById( 'yeni_soru_turu' ).click();
	}
});

var tbl_soru_turleri = $( "#tbl_soru_turleri" ).DataTable( {
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
				return "Soru Türü Listesi";
			}
		},
		{
			extend	: 'print',
			text	: 'Yazdır',
			exportOptions : {
				columns : ':visible'
			},
			title: function(){
				return "Soru Türü Listesi";
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
} ).buttons().container().appendTo('#tbl_soru_turleri_wrapper .col-md-6:eq(0)');



$('#card_soru_turleri').on('maximized.lte.cardwidget', function() {
	var tbl_soru_turleri = $( "#tbl_soru_turleri" ).DataTable();
	var column = tbl_soru_turleri.column(  tbl_soru_turleri.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_soru_turleri.column(  tbl_soru_turleri.column.length - 2 );
	column.visible( ! column.visible() );
});

$('#card_soru_turleri').on('minimized.lte.cardwidget', function() {
	var tbl_soru_turleri = $( "#tbl_soru_turleri" ).DataTable();
	var column = tbl_soru_turleri.column(  tbl_soru_turleri.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_soru_turleri.column(  tbl_soru_turleri.column.length - 2 );
	column.visible( ! column.visible() );
} );


</script>