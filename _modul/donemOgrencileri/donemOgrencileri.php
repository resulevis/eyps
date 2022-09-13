<?php
$fn	= new Fonksiyonlar();
$vt = new VeriTabani();


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj								= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu							= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' 	: 'yesil';
	$_REQUEST[ 'ogrenci_id' ]			= $_SESSION[ 'sonuclar' ][ 'id' ];
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

$donemler 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
$ogrenciler			= $vt->select( $SQL_tum_ogrenciler, array( $_SESSION[ 'universite_id'], $_SESSION[ 'program_id'] ) )[ 2 ];
@$tek_ogrenci		= $vt->select( $SQL_tek_ogrenci_oku, array( $ogrenci_id ) )[ 2 ][ 0 ];

		

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
			<div class="col-12 alert alert-light">
				<div class="form-group">
					<label  class="control-label">Dönem Seçiniz</label>
					<select class="form-control select2 " name = "ders_yili_donem_id" >
						<option>Seçiniz...</option>
						<?php 
							foreach( $donemler AS $donem ){
								echo '<option value="'.$donem[ "id" ].'" '.($donem[ "donem_id" ] == $donem[ "id" ] ? "selected" : null) .'>'.$donem[ "adi" ].'</option>';
							}

						?>
					</select>
				</div>
			</div>
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
							<h6 style = 'font-size: 1rem;'> &nbsp;&nbsp;&nbsp; Tek Öğrenci Ekle</h6>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<!-- GENEL BİLGİLER -->
							<div class="tab-pane active" id="_genel">
								<form class="form-horizontal" action = "_modul/ogrenciler/ogrencilerSEG.php" method = "POST" enctype="multipart/form-data">
									
									<div class="form-group">
										<label class="control-label">Adı</label>
										<input type="text" class="form-control" name ="arama" placeholder="TC, Ad, Soyad, Numara" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="javascript:load_data(this.value)" >
										<span id="aramaSonuclari"></span>
									</div>
									
									<div class="card-footer">
										<button modul= 'donemOgrencileri' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls; ?>"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi; ?></button>
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

function load_data(kelime){
	if ( kelime.length > 2 ){
		var form_data = new FormData();
		form_data.append("kelime", kelime);
		form_data.append("modul", "donemOgrencileri");
		form_data.append("islem", "ogrenciAra");

		var ajax_request = new XMLHttpRequest();

		ajax_request.open('POST', './_modul/ajax/ajax_data.php');

		ajax_request.send(form_data);

		ajax_request.onreadystatechange = function()
		{
			if(ajax_request.readyState == 4 && ajax_request.status == 200)
			{
				var response = JSON.parse(ajax_request.responseText);

				var html = '<div class="list-group">';

				if(response.length > 0)
				{
					for(var count = 0; count < response.length; count++)
					{
						html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">'+response[count].post_title+'</a>';
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
		
	}

}

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