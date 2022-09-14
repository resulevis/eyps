<?php
$fn	= new Fonksiyonlar();
$vt = new VeriTabani();


/* SEG dosyalarından gelen mesaj */
if( array_key_exists( 'sonuclar', $_SESSION ) ) {
	$mesaj								= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
	$mesaj_turu							= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' 	: 'yesil';
	//$_REQUEST[ 'ogrenci_id' ]			= $_SESSION[ 'sonuclar' ][ 'id' ];
	unset( $_SESSION[ 'sonuclar' ] );
	echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
}

$islem					= array_key_exists( 'islem'		 	,$_REQUEST ) ? $_REQUEST[ 'islem' ] 		:'ekle';
$ogrenci_id				= array_key_exists( 'ogrenci_id' 	,$_REQUEST ) ? $_REQUEST[ 'ogrenci_id' ]	: 0;

$satir_renk				= $ogrenci_id > 0	? 'table-warning'						: '';
$kaydet_buton_yazi		= $ogrenci_id > 0	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $ogrenci_id > 0	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';


$SQL_tum_donem_ogrencileri = <<< SQL
SELECT 
	o.id,
	o.tc_kimlik_no,
	o.ogrenci_no,
	o.kayit_yili,
	CONCAT( o.adi, ' ', o.soyadi ) AS adi
FROM 
	tb_donem_ogrencileri AS do
LEFT JOIN tb_ogrenciler AS o ON o.id = do.ogrenci_id
WHERE
	do.ders_yili_donem_id 	= ? AND
	o.aktif 		  		= 1 
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

$SQL_ogrenciler = <<< SQL
SELECT 
	*
	,concat(adi,' ',soyadi) AS adi_soyadi
FROM 
	tb_ogrenciler
WHERE 	 
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

$donemler 				= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
$_SESSION[ "donem_id" ] = $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];

$ogrenciler				= $vt->select( $SQL_tum_donem_ogrencileri, array( $_SESSION[ 'donem_id'] ) )[ 2 ];
$ogrenciler2			= $vt->select( $SQL_ogrenciler, array(  ) )[ 2 ];
@$tek_ogrenci			= $vt->select( $SQL_tek_ogrenci_oku, array( $ogrenci_id ) )[ 2 ][ 0 ];

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
			<div class="col-sm-12 mb-2 d-flex">

				<?php foreach( $donemler AS $donem ){ ?>
						<label for="donemCard<?php echo $donem[ "id" ] ?>" class="col-sm m-1 pt-3 pb-3 bg-<?php echo $_SESSION[ 'donem_id' ] == $donem[ 'id' ] ? 'olive' : 'navy' ?> btn text-left">
							<div class="icheck-success d-inline">
								<input type="radio" name="aktifDonem" id="donemCard<?php echo $donem[ "id" ] ?>" data-url="./_modul/ajax/ajax_data.php" data-islem="aktifDonem" data-modul="<?php echo $_REQUEST['modul'] ?>" value="<?php echo $donem[ "id" ] ?>" class="aktifYilSec" <?php echo $_SESSION[ 'donem_id' ] == $donem[ 'id' ] ? 'checked' : null; ?>  >
								<label for="donemCard<?php echo $donem[ "id" ] ?>"><?php echo $donem[ 'adi' ]; ?></label>
							</div>
						</label>
				<?php } ?>
				
			</div>
			
			<div class="col-md-8">
				<div class="card card-olive" id = "card_ogrenciler">
					<div class="card-header">
						<h3 class="card-title">Öğrenciler</h3>
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
									<td><?php echo $ogrenci[ 'adi' ]; ?></td>
									<td><?php echo $ogrenci[ 'kayit_yili' ]; ?></td>
									<td align = "center">
										<button modul= 'donemOgrencileri' yetki_islem="sil" class="btn btn-xs btn-danger" data-href="_modul/donemOgrencileri/donemOgrencileriSEG.php?islem=sil&ogrenci_id=<?php echo $ogrenci[ 'id' ]; ?>" data-toggle="modal" data-target="#sil_onay">Sil</button>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-dark">
					<div class="card-header">
						<h3 class="card-title">Tek Öğrenci Ekle</h3>
					</div>
					<form class="form-horizontal" action = "_modul/donemOgrencileri/donemOgrencileriSEG.php" method = "POST" enctype="multipart/form-data">
					<div class="card-body">
						<!-- GENEL BİLGİLER -->
						<!--div class="form-group">
							<label class="control-label">Adı</label>
							<input type="text" class="form-control" name ="arama" placeholder="TC, Ad, Soyad, Numara" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="javascript:load_data(this.value)" >
							<span id="aramaSonuclari">
							</span>
						</div-->
						<input type="hidden" name="islem" value="<?php echo $islem;?>">
						<div class="form-group">
							<label  class="control-label">Eklenecek Öğrenci</label>
							<select class="form-control select2" name="ogrenci_id" required>
								<option value="">Seçiniz...</option>
								<?php 
									foreach( $ogrenciler2 AS $ogrenci ){
								?>
									<option value="<?php echo $ogrenci[ "id" ];?>">
										( <?php echo $ogrenci[ "ogrenci_no" ];?> )&nbsp;&nbsp;&nbsp; 
										<b><?php echo $ogrenci[ "adi_soyadi" ];?></b>
									</option>
								<?php
									}

								?>
							</select>
						</div>								
					</div>
					<div class="card-footer">
						<button modul= 'donemOgrencileri' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls; ?>"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi; ?></button>
					</div>
					</form>
				</div>
				<div class="card <?php if( $ogrenci_id == 0 ) echo 'card-secondary' ?>">
					<div class="card-header">
						<h3 class="card-title">Toplu Öğrenci Ekle</h3>
					</div>
					<form class="form-horizontal" action = "_modul/donemOgrencileri/donemOgrencileriSEG.php" method = "POST" enctype="multipart/form-data">
						<input type="hidden" name="islem" value="toplu_ekle">
						<div class="card-body">
						<!-- GENEL BİLGİLER -->
							<div class="form-group">
								<label class="control-label">Öğrenci Numaralarını Alt alta Giriniz</label>
								<textarea class="form-control" rows="10" name="ogrenci_numaralari"></textarea>
							</div>
						</div>
						<div class="card-footer">
							<button modul= 'donemOgrencileri' yetki_islem="kaydet" type="submit" class="<?php echo $kaydet_buton_cls; ?>"><span class="fa fa-save"></span> <?php echo $kaydet_buton_yazi; ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

function yenile(){
	window.location.reload()
}
function ogrenciEkle(e){
	var id 		= $(e).data("id");
	var btn 	= document.getElementById("btn-"+id);
	var islem 	= "donemOgrenciEkle";
	var modul 	= "donemOgrencileri";
	var data_url = "./_modul/ajax/ajax_data.php";
	$.post(data_url, { islem : islem, id : id,ekleme_türü : 'tek' }, function (response) {
        var sonuc = JSON.parse(response);
    	mesajVer(sonuc.mesaj, sonuc.mesaj_turu);
    	setTimeout(yenile, 2000);
    	
    });

	btn.textContent="Eklendi";
	btn.classList.add("btn-danger");
	btn.classList.remove("btn-success");
	btn.setAttribute("disabled","disabled");
}

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
						html += '<div class="list-group-item list-group-item-action p-0 d-flex justify-content-between">'+
									'<a href="#" class="p-2 text-dark" >'+response[count].tc_kimlik_no+' - '+response[count].ogrenci_no+' - '+response[count].adi+'</a>'+
									'<button class="p-2 btn btn-success ogrenciEkle" data-id="'+response[count].id+'" id="btn-'+response[count].id+'" onclick="ogrenciEkle(this);" >Ekle</button>'+
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