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

$SQL_soru_tipi_getir = <<< SQL
SELECT
	*
FROM
	tb_soru_turleri
WHERE
	universite_id 	= ?
SQL;


$donemler 	 			= $vt->select( $SQL_donemler_getir, array( $_SESSION[ "universite_id" ], $_SESSION[ "aktif_yil" ], $_SESSION[ "program_id" ] ) )[2];
@$_SESSION[ "donem_id" ] = $_SESSION[ "donem_id" ] ? $_SESSION[ "donem_id" ]  : $donemler[ 0 ][ "id" ];
@$mufredatlar 			= $vt->select($SQL_mufredat_getir, array( $_SESSION[ "donem_id" ], $_SESSION[ "ders_id"] ) )[ 2 ];
$dersler 	 			= $vt->select($SQL_dersler_getir, array( $_SESSION[ "donem_id" ] ) )[ 2 ];
$soruTurleri 	 		= $vt->select($SQL_soru_tipi_getir, array( $_SESSION[ "universite_id" ] ) )[ 2 ];

?>

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
	<div class="col-md-12">
		<div class="card card-dark">
			<div class="card-header">
				<h3 class="card-title">Müfredat</h3>
				<div class="form-group float-right mb-0">
					<select class="form-control select2" name="ders_id" required  onchange="dersSecimi(this.value);">
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
			<div class="card-body p-0">
				<ul class="tree mr-5">
					<li> <div class='ders-kapsa bg-renk5'> Ana Kategori 
							<a href='#' class='btn btn-dark float-right btn-xs KategoriEkle' id='0' data-id='0' data-kategori_ad ='Ana Kategori' data-modal='yeni_ana_kategori_ekle'>Kategori Ekle</a>
						</div>

					<?php
					//var_dump($mufredatlar);
						function kategoriListele2( $kategoriler, $parent = 0, $class ="tree", $renk = 0){
							$html = '<ul class="ders-ul">';

							foreach ($kategoriler as $kategori){
								if( $kategori['ust_id'] == $parent ){
									if( $parent == 0 ) {
										$renk = 1;
									} 

									if( $kategori['kategori'] == 0){
										//$html .= '<li><div class="ders-kapsa bg-renk'.$renk.'"> '.$kategori[ "adi" ].$kategori[ "id" ].'</div></li>';
										$html .= "<li>
													<div class='ders-kapsa bg-renk$renk '> $kategori[adi]
														<span class='m-0 p-0'>
															<button modul= 'mufredat' yetki_islem='sil' class='btn btn-xs ml-1 btn-danger float-right' data-href='_modul/mufredat/mufredatSEG.php?islem=sil&id=$kategori[id]' data-toggle='modal' data-target='#sil_onay'>Sil</button>

															<a href='#' id='$kategori[id]' class='btn btn-light float-right btn-xs ml-1 modalAc' data-mufredat_id='$kategori[id]'  data-kategori_ad='$kategori[adi]' data-modal='soru_ekle' data-ders_id='$kategori[ders_id]' >Soru Ekle</a>

															<a href='#' id='$kategori[id]' data-id='$kategori[id]' class='btn btn-warning float-right btn-xs modalAc' data-kategori_ad_duzenle='$kategori[adi]' data-modal='kategori_duzenle' data-islem='guncelle' data-kategori='$kategori[kategori]'>Düzenle</a>
														</span>
													</div>
												</li>";

									}
									if( $kategori['kategori'] == 1 ){
										$html .= "<li><div class='ders-kapsa bg-renk$renk'> $kategori[adi]
										<span>
											<button modul= 'mufredat' yetki_islem='sil' class='btn btn-xs ml-1 btn-danger float-right' data-href='_modul/mufredat/mufredatSEG.php?islem=sil&id=$kategori[id]' data-toggle='modal' data-target='#sil_onay'>Sil</button>
											<a href='#' id='$kategori[id]' class='btn btn-light float-right btn-xs ml-1 modalAc' data-mufredat_id='$kategori[id]'  data-kategori_ad='$kategori[adi]' data-modal='soru_ekle' data-ders_id='$kategori[ders_id]' >Soru Ekle</a>

											<a href='#' id='$kategori[id]' data-id='$kategori[id]' data-ders_id='$kategori[ders_id]' class='btn btn-warning float-right btn-xs ml-1 modalAc'data-kategori_ad_duzenle='$kategori[adi]' data-modal='kategori_duzenle' data-islem='guncelle' data-kategori ='$kategori[kategori]' >Düzenle</a>

											<a href='#' class='btn btn-dark float-right btn-xs KategoriEkle' id='$kategori[id]' data-id='$kategori[id]' data-kategori_ad ='$kategori[adi]' data-ders_id='$kategori[ders_id]' data-modal='kategori_ekle'>Kategori Ekle</a>
										</span>
										</div>";
										$renk++;
										$html .= kategoriListele2($kategoriler, $kategori['id'],"ders-ul",$renk);
										$html .= '</li>';
										$renk--;
									}
								}

							}
							$html .='</ul>';
							return $html;
						}
						if( count( $mufredatlar ) ) 
							echo kategoriListele2($mufredatlar);
						

					?>
					</li>
				</ul>
				<?php if ( count( $mufredatlar ) < 1) echo '<div class="alert alert-warning m-5">Ders için müfredat eklenmemiş</div>'; ?>

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
					<p><b>Bu Kaydı silmeniz durumunda kategori Altında bulunan diğer kategoriler silinecektir.</b></p>
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

	<!--MUFREDAT EKLEME MODALI-->
	<div class="modal fade" id="yeni_ana_kategori_ekle">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Yeni Ana Kategori Ekleme</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" action = "_modul/mufredat/mufredatSEG.php" method = "POST">
					<div class="modal-body">
						<input type="hidden" id="ust_id"  name="ust_id" >
						<div class="form-group">
							<label  class="control-label">Ders</label>
							<select class="form-control select2" name="ders_id" required>
								<option value="">Seçiniz...</option>
								<?php foreach( $dersler AS $ders ){ ?>
									<option value="<?php echo $ders[ "id" ];?>" <?php echo $ders[ "id" ] == $ders_id ? 'selected' : null; ?>>
										( <?php echo $ders[ "ders_kodu" ];?> )&nbsp;&nbsp;&nbsp; 
										<b><?php echo $ders[ "adi" ];?></b>
									</option>
								<?php } ?>
							</select>
						</div>	

						<div class="form-group">
							<label class="control-label">Kategori Adı</label>
							<input required type="text" class="form-control" name ="adi"  autocomplete="off">
						</div>
						<div class="form-group">
							<label  class="control-label">Kategori Mi? </label>
							<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
								<div class="bootstrap-switch-container" >
									<input type="checkbox" name="kategori" checked data-bootstrap-switch="" data-off-color="danger" data-on-text="Default" data-off-text="Değil" data-on-color="success">
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
						<button type="submit" class="btn btn-danger ">Kaydet</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<!--MUFREDAT EKLEME MODALI-->
	<div class="modal fade" id="kategori_ekle">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Yeni Kategori Ekle</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" action = "_modul/mufredat/mufredatSEG.php" method = "POST">
					<div class="modal-body">
						<input type="hidden" id="yeni_kategori_ust_id"  name="ust_id">
						<input type="hidden" id="ders_id" name="ders_id">
						<div class="form-group">
							<label class="control-label">Ust Kategori</label>
							<input required type="text" class="form-control" id="kategori_ad"  autocomplete="off" disabled>
						</div>

						<div class="form-group">
							<label class="control-label">Kategori Adı</label>
							<input required type="text" class="form-control" name ="adi"  autocomplete="off">
						</div>
						<div class="form-group">
							<label  class="control-label">Kategori Mi? </label>
							<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" >
								<div class="bootstrap-switch-container" >
									<input type="checkbox" name="kategori" checked data-bootstrap-switch="" data-off-color="danger" data-on-text="Kategori" data-off-text="Değil" data-on-color="success">
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
						<button type="submit" class="btn btn-danger">Kaydet</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<!--MUFREDAT -->
	<div class="modal fade" id="kategori_duzenle">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Kategori Düzenle</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" action = "_modul/mufredat/mufredatSEG.php" method = "POST">
					<div class="modal-body">
						<input type="hidden" id="islem" name="islem">
						<input type="hidden" id="mufredat_id" name="mufredat_id">

						<div class="form-group">
							<label class="control-label">Kategori Adı</label>
							<input required type="text" class="form-control" name ="adi"  autocomplete="off" id="kategori_ad_duzenle">
						</div>

					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
						<button type="submit" class="btn btn-success">Kaydet</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<!--MUFREDAT -->
	<div class="modal fade" id="soru_ekle" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Soru Ekleme</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" action = "_modul/soruBankasi/soruBankasiSEG.php" method = "POST" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" id="soru_mufredat_id" name="mufredat_id">
						<input type="hidden" id="soru_ders_id" name="ders_id">

						<div class="form-group">
							<label class="control-label">Seçilen Müfredat</label>
							<input required type="text" class="form-control"  autocomplete="off" id="mufredat_adi" disabled>
						</div>
						<div class="form-group">
							<label class="control-label">Soru</label>
							<textarea name="soru" class="form-control" rows="2"></textarea>
						</div>

						<div class="form-group">
							<div class="col-sm-6 float-left">
								<label class="control-label">Soru Puanı</label>
								<input type="text" name="puan" class="form-control" required>
							</div>
							<div class="col-sm-6 float-left">
								<label class="control-label">Zorluk Derecesi</label>
								<select class="form-control" name="zorluk_derecesi" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group mt-2">
							<label for="exampleInputFile">Soru Dosyası</label>
							<div class="input-group">
								<div class="custom-file">
									<label class="custom-file-label" for="exampleInputFile">Dosya Seç</label>
									<input type="file" class="custom-file-input file " name = "file"  >
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Soru Türü</label>
							<select class="form-control select2" name="soru_turu_id" required onchange="secenekOku(this);">
								<option value="">Soru Türü Seçiniz...</option>
								<?php foreach( $soruTurleri AS $tur ){ ?>
									<option value="<?php echo $tur[ "id" ]; ?>" data-coklu_secenek = "<?php echo $tur[ "coklu_secenek" ]; ?>" data-metin = "<?php echo $tur[ "metin" ]; ?>">
										<?php echo $tur[ "adi" ]; ?>
									</option>
								<?php } ?>
							</select>
						</div>	
						<div id ="secenekler"></div>
						<div id="secenekEkleBtn">
							<span class="btn float-right " id="secenekEkle"  ></span>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
						<button type="submit" class="btn btn-success">Kaydet</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
	<script>

		var soruSecenekleri = ["","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","R","S"];
		$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
			$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
		} );
		
	    $('.KategoriEkle').on("click", function(e) { 
	        var ust_id      = $(this).data("id");
	        var kategori_ad = $(this).data("kategori_ad");
	        var ders_id 	= $(this).data("ders_id");
	        var modal 		= $(this).data("modal");

	        document.getElementById("yeni_kategori_ust_id").value 	 = ust_id;
	        document.getElementById("kategori_ad").value = kategori_ad;
	        document.getElementById("ders_id").value 	 = ders_id;
	        $('#'+ modal).modal( "show" );
	    });
		
		$('.modalAc').on("click", function(e) { 
			var modal 		= $(this).data("modal");
	        if ( modal == "soru_ekle" ){
	        	$("#secenekler").empty();
	        	var kategori_ad = $(this).data("kategori_ad");
		        var mufredat_id = $(this).data("mufredat_id");
		        var ders_id 	= $(this).data("ders_id");
		        
	        	document.getElementById("soru_mufredat_id").value 		= mufredat_id;
	        	document.getElementById("soru_ders_id").value 			= ders_id;
		        document.getElementById("mufredat_adi").value 			= kategori_ad;
		        document.getElementById("islem").value 					= islem;
	        }else{
	        	var kategori_ad = $(this).data("kategori_ad_duzenle");
		        var modal 		= $(this).data("modal");
		        var kategori 	= $(this).data("kategori");
		        var islem 		= $(this).data("islem");
		        var mufredat_id = $(this).data("id");

	        	if ( kategori == 1 ) {
		        	$( "[name='kategori_duzenle']" ).bootstrapSwitch( 'state', true, true);
		        }else{
		        	$( "[name='kategori_duzenle']" ).bootstrapSwitch( 'state', false, false);
		        }

		        document.getElementById("mufredat_id").value 		 	= mufredat_id;
		        document.getElementById("kategori_ad_duzenle").value 	= kategori_ad;
		        document.getElementById("islem").value 					= islem;
	        }	
		        
		    $('#'+ modal).modal( "show" );
	    });

		$('.gorevli').on("click", function(e) { 
	        var id 	        = $(this).data("id");
	        var data_islem  = $(this).data("islem");
	        var data_url    = $(this).data("url");
	        var data_modul  = $(this).data("modul");
	        var div         = $(this).data("div");
	        $("#"+div).empty();
	        $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
	            $("#"+div).append(response);
	            $('#gorevliEkleModal').modal( "show" )
	        });
	    });
	    function dersSecimi(ders_id){
			var  url 		= window.location;
			var origin		= url.origin;
			var path		= url.pathname;
			var search		= (new URL(document.location)).searchParams;
			var modul   	= search.get('modul');
			var ders_id  	= "&ders_id="+ders_id;
			
			window.location.replace(origin + path+'?modul='+modul+''+ders_id);
		}

		function secenekOku(e){
			var metin 		 	= $('option:selected',e).data("metin");
			var coklu_secenek 	= $('option:selected',e).data("coklu_secenek");
			$("#secenekler").empty();
			if ( coklu_secenek == 0 && metin == 0 ){
				$("#secenekEkleBtn").empty();
				$("#secenekEkleBtn").append('<span class="btn btn-secondary float-right " id="secenekEkle" data-secenek_tipi="radio" onclick="secenekEkle(this);">Seçenek Ekle</span><div class="clearfix"></div>');
				
			}else if( coklu_secenek == 1 && metin == 0 ){
				$("#secenekEkleBtn").empty();
				$("#secenekEkleBtn").append('<span class="btn btn-secondary float-right " id="secenekEkle" data-secenek_tipi="checkbox" onclick="secenekEkle(this);">Seçenek Ekle</span><div class="clearfix"></div>');
			}else if(coklu_secenek == 0 && metin == 1){
				$("#secenekEkleBtn").empty();
				$("#secenekEkleBtn").append('<div class="alert alert-warning">Açık Uçlu Soru Tipi Secilmiştir!</div>');

			}
		}

		function harflendir(){
			/*Şıkları isimlerini güncelleme */
			var secenekSayisi = 1;
			$(".soruSecenek").each(function( index, element ) {
	            $(this).empty();
	            $(this).append(soruSecenekleri[secenekSayisi] + ' ) &nbsp;');
	            secenekSayisi = secenekSayisi+1;
	        })	 

			/*Secilen input radi ve checkbxların isimlerini ve idlerini değiştirme*/
	        var inputSayisi = 1;
	        $(".inputSecenek").each(function( index, element ) {
	           	this.value 	= soruSecenekleri[inputSayisi];
	           	this.id 	= soruSecenekleri[inputSayisi];
	           	inputSayisi +=1;
	        })

	        /*Textarea isimlerini değitirme*/
	        var cevapSayisi = 1;
	        $(".textareaSecenek").each(function( index, element ) {
	           	this.name = 'cevap-'+soruSecenekleri[cevapSayisi];
	           	cevapSayisi +=1;
	        })

	        //input Labellerine ait for degerlerini değiştirme
	        var labelSayisi1 = 1;
	        $(".inputLabel1").each(function( index, element ) {
	           	this.setAttribute("for",soruSecenekleri[labelSayisi1]);
	           	labelSayisi1 +=1;
	        })
	        var labelSayisi2 = 1;
	        $(".inputLabel2").each(function( index, element ) {
	           	this.setAttribute("for",soruSecenekleri[labelSayisi2]);
	           	labelSayisi2 +=1;
	        })
	        

	        return secenekSayisi;
		}
		
		function secenekEkle(e) {
			var tip 			= $(e).data("secenek_tipi"); 
			var secenekSayisi 	= 1;
			secenekSayisi 		=  harflendir();
			var required 		= "";

			if( tip == "radio" ){
				required = "required";
			}
	        var data = '<div class="secenek">'+
							'<label for="'+ soruSecenekleri[ secenekSayisi ] +'" class="col-sm m-1 btn text-left bg-light inputLabel2">'+
								'<label class="float-left soruSecenek">' + soruSecenekleri[secenekSayisi] + ' ) &nbsp;</label>'+
								'<div class="icheck-success d-inline">'+
									'<input type="'+ tip +'" name="dogruSecenek[]" class="inputSecenek" id="'+ soruSecenekleri[ secenekSayisi ] +'" value="'+ soruSecenekleri[ secenekSayisi ] +'" '+ required +'>'+
									'<label for ="'+ soruSecenekleri[ secenekSayisi ] +'" class="d-flex inputLabel1">'+
										'<textarea name="cevap-'+ soruSecenekleri[ secenekSayisi ]  +'"  class="textareaSecenek form-control col-sm-12" rows="1" required></textarea>'+
										'<span  class="secenekSil position-absolute r-2 t-1" ><i class="fas fa-trash-alt" ></i></span>'+
									'</label>'+	
								'</div>'+
							'</label>'+
						'</div>';
	        $("#secenekler").append(data);
	    };

		$('#secenekler').on("click", ".secenekSil", function (e) {
		    $(this).closest(".secenek").remove();
		    harflendir();
		});


	</script>
