<?php
$fn	= new Fonksiyonlar();
$vt = new VeriTabani();


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj								= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu							= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' 	: 'yesil';
	$_REQUEST[ 'ogrenci_id' ]				= $_SESSION[ 'sonuclar' ][ 'id' ];
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}


$islem					= array_key_exists( 'islem'		         ,$_REQUEST ) ? $_REQUEST[ 'islem' ]				: 'ekle';
$ogrenci_id				= array_key_exists( 'ogrenci_id' ,$_REQUEST ) ? $_REQUEST[ 'ogrenci_id' ]	: 0;


$satir_renk				= $ogrenci_id > 0	? 'table-warning'						: '';
$kaydet_buton_yazi		= $ogrenci_id > 0	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $ogrenci_id > 0	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';



$SQL_tum_ogrenciler = <<< SQL
SELECT 
	o.id,
	o.tc_kimlik_no,
	o.ogrenci_no,
	o.kayit_yili,
	CONCAT( o.adi, ' ', o.soyadi ) AS o_adi
FROM 
	tb_ogrenciler AS o
LEFT JOIN tb_fakulteler AS f ON f.id = o.fakulte_id
LEFT JOIN tb_bolumler AS b ON b.id = o.bolum_id
LEFT JOIN tb_programlar AS p ON p.id = o.program_id
WHERE
	o.universite_id 	= ? AND
	o.program_id 		= ? AND
	o.aktif 		  	= 1 
ORDER BY o.adi ASC
SQL;


$SQL_tek_ogrenci_oku = <<< SQL
SELECT 
	*
FROM 
	tb_ogrenciler
WHERE 
	id 				= ? AND
	aktif 			= 1 
SQL;

/*Üniversiteye Ait Anabilim Dalını Listele*/
$SQL_fakulteler = <<< SQL
SELECT
	*
FROM
	tb_fakulteler
WHERE
	universite_id   = ? AND
	aktif 			= 1
SQL;


/*Üniversiteye Ait Anabilim Dalını Listele*/
$SQL_unvanlar = <<< SQL
SELECT
	*
FROM
	tb_unvanlar
SQL;



/*Üniversiteye Ait Anabilim Dalını Listele*/
$SQL_anabilim_dallari = <<< SQL
SELECT
	abd.id,
	abd.adi
FROM
	tb_anabilim_dallari AS abd
LEFT JOIN tb_fakulteler AS f  ON f.id = abd.fakulte_id
WHERE
	f.universite_id   = ? AND
	abd.aktif 		  = 1
SQL;


$unvanlar							= $vt->select( $SQL_unvanlar, array( $_SESSION[ 'universite_id'] ) )[ 2 ];
$anabilim_dallari					= $vt->select( $SQL_anabilim_dallari, array( $_SESSION[ 'universite_id'] ) )[ 2 ];
$fakulteler							= $vt->select( $SQL_fakulteler, array( $_SESSION[ 'universite_id'] ) )[ 2 ];
$ogrenciler							= $vt->select( $SQL_tum_ogrenciler, array( $_SESSION[ 'universite_id'], $_SESSION[ 'program_id'] ) )[ 2 ];
@$tek_ogrenci				= $vt->select( $SQL_tek_ogrenci_oku, array( $ogrenci_id ) )[ 2 ][ 0 ];		

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
			<div class="col-md-8">
				<div class="card card-secondary" id = "card_ogrenciler">
					<div class="card-header">
						<h3 class="card-title">Öğrenciler</h3>
						<div class = "card-tools">
							<button type="button" data-toggle = "tooltip" title = "Tam sayfa göster" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand fa-lg"></i></button>
							<a id = "yeni_ogretim_elemanlari" data-toggle = "tooltip" title = "Yeni Öğrenci Ekle" href = "?modul=ogrenciler&islem=ekle" class="btn btn-tool" ><i class="fas fa-plus fa-lg"></i></a>
						</div>
					</div>
					<div class="card-body">
						<table id="tbl_ogrenciler" class="table table-bordered table-hover table-sm" width = "100%" >
							<thead>
								<tr>
									<th style="width: 15px">#</th>
									<th>TC</th>
									<th>Öğrenci No</th>
									<th>Adı Soyadı</th>
									<th>Kayıt Yılı</th>
									<th data-priority="1" style="width: 20px">Düzenle</th>
									<th data-priority="1" style="width: 20px">Sil</th>
								</tr>
							</thead>
							<tbody>
								<?php $sayi = 1; foreach( $ogrenciler AS $ogrenci ) { ?>
								<tr oncontextmenu="fun();" class ="ogretim_elemanlari-Tr <?php if( $ogrenci[ 'id' ] == $ogrenci_id ) echo $satir_renk; ?>" data-id="<?php echo $ogrenci[ 'id' ]; ?>">
									<td><?php echo $sayi++; ?></td>
									<td><?php echo $ogrenci[ 'tc_kimlik_no' ]; ?></td>
									<td><?php echo $ogrenci[ 'ogrenci_no' ]; ?></td>
									<td><?php echo $ogrenci[ 'o_adi' ]; ?></td>
									<td><?php echo $ogrenci[ 'kayit_yili' ]; ?></td>
									<td align = "center">
										<a modul = 'ogrenciler' yetki_islem="duzenle" class = "btn btn-sm btn-warning btn-xs" href = "?modul=ogrenciler&islem=guncelle&ogrenci_id=<?php echo $ogrenci[ 'id' ]; ?>" >
											Düzenle
										</a>
									</td>
									<td align = "center">
										<button modul= 'ogrenciler' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/ogrenciler/ogrencilerSEG.php?islem=sil&ogrenci_id=<?php echo $ogrenci[ 'id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card <?php if( $ogrenci_id == 0 ) echo 'card-secondary' ?>">
					<div class="card-header p-2">
						<ul class="nav nav-pills tab-container">
							<?php if( $ogrenci_id > 0 ) { ?>
								<h6 style = 'font-size: 1rem;'> &nbsp;&nbsp;&nbsp; Öğrenci Düzenle</h6>
							<?php } else {
								echo "<h6 style = 'font-size: 1rem;'> &nbsp;&nbsp;&nbsp; Öğrenci Ekle</h6>";
								}
							?>
							
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<!-- GENEL BİLGİLER -->
							<div class="tab-pane active" id="_genel">
								<form class="form-horizontal" action = "_modul/ogrenciler/ogrencilerSEG.php" method = "POST" enctype="multipart/form-data">
									<input type = "hidden" name = "islem" value = "<?php echo $islem; ?>" >
									<input type = "hidden" name = "ogrenci_id" value = "<?php echo $ogrenci_id; ?>">
									<h3 class="profile-username text-center"><b> </b></h3>
									<div class="alert alert-warning text-center"><b>Seçilmiş Olan Programa Kayıt Ekleniyor</b></div>
									<div class="form-group">
										<label class="control-label">TC Kimlik No</label>
										<input required type="text" class="form-control" name ="tc_kimlik_no" value = "<?php echo $tek_ogrenci[ "tc_kimlik_no" ]; ?>"  autocomplete="off">
									</div>

									<div class="form-group">
										<label class="control-label">Öğrenci No</label>
										<input required type="text" class="form-control" name ="ogrenci_no" value = "<?php echo $tek_ogrenci[ "ogrenci_no" ]; ?>"  autocomplete="off">
									</div>

									<div class="form-group">
										<label class="control-label">Adı</label>
										<input required type="text" class="form-control" name ="adi" value = "<?php echo $tek_ogrenci[ "adi" ]; ?>"  autocomplete="off">
									</div>
									

									<div class="form-group">
										<label class="control-label">Soyadı</label>
										<input required type="text" class="form-control" name ="soyadi" value = "<?php echo $tek_ogrenci[ "soyadi" ]; ?>"  autocomplete="off">
									</div>

									<div class="form-group">
										<label class="control-label">Sınıf</label>
										<input required type="text" class="form-control" name ="sinif" value = "<?php echo $tek_ogrenci[ "sinif" ]; ?>"  autocomplete="off">
									</div>
									<div class="form-group">
										<label class="control-label">Kayıt Yılı</label>
										<input required type="text" class="form-control" name ="kayit_yili" value = "<?php echo $tek_ogrenci[ "kayit_yili" ]; ?>"  autocomplete="off">
									</div>

									<div class="form-group">
										<label class="control-label">E Mail</label>
										<input required type="email" class="form-control" name ="email" value = "<?php echo $tek_ogrenci[ "email" ]; ?>"  autocomplete="off">
									</div>
									
									<div class="form-group">
										<label class="control-label">Cep Telefonu</label>
										<input required type="tel" class="form-control" name ="cep_tel" value = "<?php echo $tek_ogrenci[ "cep_tel" ]; ?>" pattern="[0-9]{10}" placeholder="5555555555" autocomplete="off">
									</div>

									<div class="form-group">
										<label class="control-label">Adres</label>
										<textarea name="adres" class="form-control" ><?php echo $tek_ogrenci[ "adres" ]; ?></textarea>
									</div>
									
									
									
									<div class="card-footer">
										<button modul= 'ogrenciler' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls; ?>"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi; ?></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

// ESC tuşuna basınca formu temizle
document.addEventListener( 'keydown', function( event ) {
	if( event.key === "Escape" ) {
		document.getElementById( 'yeni_ogretim_elemanlari' ).click();
	}
});

var tbl_ogrenciler = $( "#tbl_ogrenciler" ).DataTable( {
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
				return "Fakülte Listesi";
			}
		},
		{
			extend	: 'print',
			text	: 'Yazdır',
			exportOptions : {
				columns : ':visible'
			},
			title: function(){
				return "Fakülte Listesi";
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
} ).buttons().container().appendTo('#tbl_ogrenciler_wrapper .col-md-6:eq(0)');



$('#card_ogrenciler').on('maximized.lte.cardwidget', function() {
	var tbl_ogrenciler = $( "#tbl_ogrenciler" ).DataTable();
	var column = tbl_ogrenciler.column(  tbl_ogrenciler.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_ogrenciler.column(  tbl_ogrenciler.column.length - 2 );
	column.visible( ! column.visible() );
});

$('#card_ogrenciler').on('minimized.lte.cardwidget', function() {
	var tbl_ogrenciler = $( "#tbl_ogrenciler" ).DataTable();
	var column = tbl_ogrenciler.column(  tbl_ogrenciler.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_ogrenciler.column(  tbl_ogrenciler.column.length - 2 );
	column.visible( ! column.visible() );
} );


</script>