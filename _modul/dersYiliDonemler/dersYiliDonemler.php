<?php
$fn	= new Fonksiyonlar();
$vt = new VeriTabani();


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj								= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu							= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
	$_REQUEST[ 'id' ]					= $_SESSION[ 'sonuclar' ][ 'id' ];
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}


$islem			= array_key_exists( 'islem'		,$_REQUEST )  ? $_REQUEST[ 'islem' ]	: 'ekle';
$id    			= array_key_exists( 'id'		,$_REQUEST )  ? $_REQUEST[ 'id' ]	 	: 0;


$satir_renk				= $id > 0	? 'table-warning'						: '';
$kaydet_buton_yazi		= $id > 0	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $id > 0	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


/*Tüm Ders Yılını Okuma*/
$SQL_tum_ders_yili_donemler = <<< SQL
SELECT 
	 dyd.id
	,p.adi AS program_adi
	,dy.adi AS ders_yili_adi
	,d.adi AS donem_adi
FROM 
	tb_ders_yili_donemleri AS dyd
LEFT JOIN tb_programlar AS p ON dyd.program_id = p.id 
LEFT JOIN tb_ders_yillari AS dy ON dyd.ders_yili_id = dy.id 
LEFT JOIN tb_donemler AS d ON dyd.donem_id = d.id
WHERE 
	dyd.ders_yili_id 	= ? AND
	dyd.program_id 		= ? 
SQL;

/*Tek Ders Yılı Okuma*/
$SQL_tek_ders_yili_donem_oku = <<< SQL
SELECT 
	*
FROM 
	tb_ders_yili_donemleri
WHERE 
	id 				= ?
SQL;

/*Tüm Programları Getirme*/
$SQL_programlar = <<< SQL
SELECT
	*
FROM
	tb_programlar
WHERE 
	universite_id  	= ? AND
	aktif 			= 1
SQL;

$SQL_donemler = <<< SQL
SELECT
	*
FROM
	tb_donemler
WHERE 
	universite_id  	= ? AND
	program_id  	= ? AND
	aktif 			= 1
SQL;

$SQL_tum_donemler = <<< SQL
SELECT
	*
FROM
	tb_donemler
WHERE 
	universite_id  	= ? AND
	aktif 			= 1
SQL;

/*Tüm Programları Getirme*/
$SQL_ders_yillari_getir = <<< SQL
SELECT
	*
FROM
	tb_ders_yillari
WHERE
	universite_id = ? AND
	aktif 		  = 1
SQL;

$programlar				= $vt->select( $SQL_programlar, 	array( $_SESSION[ 'universite_id'] ) )[ 2 ];
$donemler				= $vt->select( $SQL_tum_donemler, 	array( $_SESSION[ 'universite_id'] ) )[ 2 ];
$ders_yillari			= $vt->select( $SQL_ders_yillari_getir, array($_SESSION[ 'universite_id' ] ) )[ 2 ];
$ders_yili_donemler		= $vt->select( $SQL_tum_ders_yili_donemler, 	array( $_SESSION[ 'aktif_yil'], $_SESSION[ 'program_id'] ) )[ 2 ];
@$tek_ders_yili_donem 	= $vt->select( $SQL_tek_ders_yili_donem_oku, array( $id ) )[ 2 ][ 0 ];

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
				<div class="card card-olive " id = "card_donemler">
					<div class="card-header">
						<h3 class="card-title">Ders Yılı Açık Dönemler( Sınıflar )</h3>
						<div class = "card-tools">
							<button type="button" data-toggle = "tooltip" title = "Tam sayfa göster" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand fa-lg"></i></button>
							<a id = "yeni_fakulte" data-toggle = "tooltip" title = "Yeni Üviversite Ekle" href = "?modul=dersYiliDonemler&islem=ekle" class="btn btn-tool" ><i class="fas fa-plus fa-lg"></i></a>
						</div>
					</div>
					<div class="card-body">
						<table id="tbl_donemler" class="table table-bordered table-hover table-sm" width = "100%" >
							<thead>
								<tr>
									<th style="width: 15px">#</th>
									<th>Program</th>
									<th>Ders Yılı</th>
									<th>Dönem</th>
									<th data-priority="1" style="width: 20px">Düzenle</th>
									<th data-priority="1" style="width: 20px">Sil</th>
								</tr>
							</thead>
							<tbody>
								<?php $sayi = 1; foreach( $ders_yili_donemler AS $ders_yili_donem ) { ?>
								<tr oncontextmenu="fun();" class =" <?php if( $ders_yili_donem[ 'id' ] == $id ) echo $satir_renk; ?>" data-id="<?php echo $ders_yili_donem[ 'id' ]; ?>">
									<td><?php echo $sayi++; ?></td>
									<td><?php echo $ders_yili_donem[ 'program_adi' ]; ?></td>
									<td><?php echo $ders_yili_donem[ 'ders_yili_adi' ]; ?></td>
									<td><?php echo $ders_yili_donem[ 'donem_adi' ]; ?></td>
									<td align = "center">
										<a modul = 'dersYiliDonemler' yetki_islem="duzenle" class = "btn btn-sm btn-warning btn-xs" href = "?modul=dersYiliDonemler&islem=guncelle&id=<?php echo $ders_yili_donem[ 'id' ]; ?>" >
											Düzenle
										</a>
									</td>
									<td align = "center">
										<button modul= 'dersYiliDonemler' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/dersYiliDonemler/dersYiliDonemlerSEG.php?islem=sil&id=<?php echo $ders_yili_donem[ 'id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-orange">
					<div class="card-header">
						<h3 class="card-title text-white">Ders Yılı Açık Dönem( Sınıf ) Ekle / Güncelle</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id = "kayit_formu" action = "_modul/dersYiliDonemler/dersYiliDonemlerSEG.php" method = "POST">
						<div class="card-body">
							<input type = "hidden" name = "islem" value = "<?php echo $islem; ?>">
							<input type = "hidden" name = "program_id" value = "<?php echo $_SESSION['program_id']; ?>">
							<input type = "hidden" name = "ders_yili_id" value = "<?php echo  $_SESSION['ders_yili_id']; ?>">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
							<div class="form-group">
								<label  class="control-label">Dönemler</label>
								<select class="form-control select2" name = "donem_id"  required>
									<option>Seçiniz...</option>
									<?php 
										foreach( $donemler AS $donem ){
											echo '<option value="'.$donem[ "id" ].'" '.($tek_ders_yili_donem[ "donem_id" ] == $donem[ "id" ] ? "selected" : null) .'>'.$donem[ "adi" ].'</option>';
										}

									?>
								</select>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button modul= 'dersYiliDonemler' yetki_islem="kaydet" type="submit" class="btn btn-success btn-sm pull-right"><span class="fa fa-save"></span> Kaydet</button>
							<button onclick="window.location.href = '?modul=dersYiliDonemler&islem=ekle'" type="reset" class="btn btn-primary btn-sm pull-right" ><span class="fa fa-plus"></span> Temizle / Yeni Kayıt</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">


var tbl_donemler = $( "#tbl_donemler" ).DataTable( {
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
} ).buttons().container().appendTo('#tbl_donemler_wrapper .col-md-6:eq(0)');



$('#card_donemler').on('maximized.lte.cardwidget', function() {
	var tbl_donemler = $( "#tbl_donemler" ).DataTable();
	var column = tbl_donemler.column(  tbl_donemler.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_donemler.column(  tbl_donemler.column.length - 2 );
	column.visible( ! column.visible() );
});

$('#card_donemler').on('minimized.lte.cardwidget', function() {
	var tbl_donemler = $( "#tbl_donemler" ).DataTable();
	var column = tbl_donemler.column(  tbl_donemler.column.length - 1 );
	column.visible( ! column.visible() );
	var column = tbl_donemler.column(  tbl_donemler.column.length - 2 );
	column.visible( ! column.visible() );
} );



</script>
<script type="text/javascript">
	
	$('#program-sec').on("change", function(e) { 
	    var $program_id 		= $(this).val();
	    var $data_islem = $(this).data("islem");
	    var $data_url 	= $(this).data("url");
	    $("#dersYillari").empty();
	    $.post($data_url, { islem : $data_islem,program_id : $program_id}, function (response) {
	        $("#dersYillari").append(response);
	    });
	});	

</script>