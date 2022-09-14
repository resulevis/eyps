<?php
$fn = new Fonksiyonlar();

$islem          					= array_key_exists( 'islem', $_REQUEST )  		? $_REQUEST[ 'islem' ] 	    	: 'ekle';
$ders_yili_donem_id          		= array_key_exists( 'ders_yili_donem_id', $_REQUEST ) ? $_REQUEST[ 'ders_yili_donem_id' ] 	: 0;


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
	ders_yili_donem_id = ?
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



$SQL_alt_mufredat_getir = <<< SQL
SELECT
	*
FROM 
	tb_mufredat
WHERE 
	ust_id = ?
SQL;




$mufredatlar = $vt->select($SQL_mufredat_getir, array( $_SESSION[ "donem_id" ] ) )[ 2 ];

?>

<div class="row">
	<div class="col-md-12">
		<div class="card card-dark">
			<div class="card-header">
				<h3 class="card-title">Müfredat</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-0">
					<?php
					//var_dump($mufredatlar);
						function kategoriListele2( $kategoriler, $parent = 0, $class ="tree", $renk = 0){
							$html = '<ul class="'.$class.'">';

							foreach ($kategoriler as $kategori){
								if( $kategori['ust_id'] == $parent ){
									if( $parent == 0 ) {
										$renk = 1;
									} 

									if( $kategori['kategori'] == 0 ){
										//$html .= '<li><div class="ders-kapsa bg-renk'.$renk.'"> '.$kategori[ "adi" ].$kategori[ "id" ].'</div></li>';
										$html .= "<li><div class='ders-kapsa bg-renk$renk'> $kategori[adi]$kategori[id]
										<a href='#' class='btn btn-dark float-right btn-xs'>Düzenle</a>
										</div></li>";

									}
									if( $kategori['kategori'] == 1 ){
										$html .= "<li><div class='ders-kapsa bg-renk$renk'> $kategori[adi]$kategori[id]
										<a href='#' class='btn btn-dark float-right btn-xs'>Düzenle</a>
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

						echo kategoriListele2($mufredatlar);
					?>

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
	<script>
		$( '#sil_onay' ).on( 'show.bs.modal', function( e ) {
			$( this ).find( '.btn-evet' ).attr( 'href', $( e.relatedTarget ).data( 'href' ) );
		} );

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
	</script>
