<?php
$fn = new Fonksiyonlar();

$islem          		= array_key_exists( 'islem', $_REQUEST ) 	? $_REQUEST[ 'islem' ]   	: 'ekle';
$sinav_id          		= array_key_exists( 'sinav_id', $_REQUEST ) ? $_REQUEST[ 'sinav_id' ] 	: 0;

$kaydet_buton_yazi		= $islem == "guncelle"	? 'Güncelle'							: 'Kaydet';
$kaydet_buton_cls		= $islem == "guncelle"	? 'btn btn-warning btn-sm pull-right'	: 'btn btn-success btn-sm pull-right';

$SQL_sinav_varmi = <<< SQL
SELECT 
	s.id,
	s.adi,
	s.aciklama,
	s.sinav_oncesi_aciklama,
	s.sinav_sonrasi_aciklama,
	s.sinav_suresi,
	s.soru_sayisi,
	s.sinav_baslangic_tarihi,
	s.sinav_baslangic_saati,
	s.sinav_bitis_tarihi,
	s.sinav_bitis_saati
FROM 
	tb_sinavlar  AS s
LEFT JOIN 
	tb_sinav_ogrencileri AS so ON so.sinav_id = s.id
WHERE 
	s.id 						= ? AND
	so.ogrenci_id 				= ? AND
	(
		s.sinav_baslangic_tarihi 	<= ? AND
		s.sinav_baslangic_saati 	<= ?
	) AND
	s.sinav_bitis_tarihi		>= ? AND
	so.sinav_bitti_mi 			= 0
SQL;

$SQL_sinav_sorulari = <<< SQL
SELECT 
	soru_id
FROM 
	tb_sinav_sorulari
WHERE 
	sinav_id = ?
ORDER BY RAND()
LIMIT ?
SQL;

$sinav_varmi 	= $vt->select( $SQL_sinav_varmi, array( $sinav_id, $_SESSION["kullanici_id"], date("Y-m-d"), date("H:m:s"), date("H:m:s") ) )[2][0];
$sinav_sorulari = $vt->selectExam( $SQL_sinav_sorulari, $sinav_varmi["id"], $sinav_varmi["soru_sayisi"]  )[2];

if( $sinav_varmi["soru_sayisi"] != count( $sinav_sorulari ) ){
	echo "<div id='display-container' class='display-container d-flex flex-column hata-mesaj-kapsa'>
			<div class='text-center okudum-anladim'>
				<div class='text-center d-block  lead'>Sınav soruları eksik lütfen sınav gözetmeni ile iletişime geçiniz!!!</div>
				<a href='index.php?modul=sinavlarListesi' class='btn btn-outline-dark mt-5 btn-lg'><b>Sınavlar Listesi</b></a>
			</div>
		</div>";
		die;
}


if( count( $sinav_varmi ) < 1 ){
	echo "<div id='display-container' class='display-container d-flex flex-column hata-mesaj-kapsa'>
			<div class='text-center okudum-anladim'>
				<div class='text-center d-block  lead'>Sınav Süresi Bitmiş veya Size açık olmayan sınava erişme isteğiniz bulunmaktadır. Hatalı olduğunu düşünüyorsanız yönetici ile iletişime geçiniz.</div>
				<a href='index.php?modul=sinavlarListesi' class='btn btn-outline-dark mt-5 btn-lg'><b>Sınavlar Listesi</b></a>
			</div>
		</div>";
	die;
}

$key 		= 1;
$sorular 	= array();
foreach ( $sinav_sorulari as $soru ) {
	$sorular[$key] = $soru["soru_id"];
	$key++;
}

if( !array_key_exists( "sorular", $_SESSION ) ){
	$_SESSION[ "sorular" ] 	= $sorular;
	$_SESSION[ "sinav_id" ] = $sinav_varmi[ "id" ];
	$_SESSION["cevaplanan"] =array();
}
$soruGoster = 0;
if( $_SESSION["soru_id"] > 0 ){
	$soruGoster = 1;
}

$datetime_1 	= date("Y-m-d H:i:s"); 
$datetime_2 	= date( "Y-m-d H:i:s", strtotime($sinav_varmi["sinav_bitis_tarihi"]." ".$sinav_varmi["sinav_bitis_saati"] ) ); 
$start_datetime = new DateTime($datetime_1); 
$diff 			= $start_datetime->diff(new DateTime($datetime_2)); 

$total_minutes = ($diff->days * 24 * 60); 
$total_minutes += ($diff->h * 60 * 60); 
$total_minutes += ($diff->i * 60); 
$total_minutes += $diff->s; 

if( !array_key_exists( "okudum_anladim",$_SESSION ) ){
	$total_minutes = 1;
}
?>
<div>
	<div class="p-3">
		<span class="sinav-adi"><?php echo $sinav_varmi["adi"]; ?></span>
	</div>
</div>
<div id='display-container' class='display-container d-flex flex-column'>
	<?php 
	
		if( $soruGoster == 0 ){
			echo "<div class='text-center d-block okudum-anladim'>
						<div class='text-center d-block mt-5 lead'>$sinav_varmi[sinav_oncesi_aciklama]</div>
						<button id='next-button' data-id='$sinav_id'>Okudum, Anladım ve Onaylıyorum</button>
					</div>";
		}else{
			echo "<div class='soru-kapsa' id='soru-kapsa'></div>";
		}
	?>
</div>
<div class="display-container d-flex flex-column sagBilgi pt-3">
	<div id="clock"></div>
	<hr>
	<div class="soru-listesi col-12 p-0">
		
		<h5 class="d-block text-dander"><b>Soru listesi</b></h5>
		<div class="col-3 d-flex flex-column align-items-center float-left">
			<button class="btn dark ">&nbsp;&nbsp</button>
			<span>Şuanki Soru</span>
		</div>
		<div class="col-3 d-flex flex-column align-items-center float-left">
			<button class="btn btn-info ">&nbsp;&nbsp</button>
			<span>İşaretlendi </span>
		</div>
		<div class="col-3 d-flex flex-column align-items-center float-left">
			<button class="btn btn-warning ">&nbsp;&nbsp</button>
			<span>Boş Bırakıldı</span>
		</div>
		<div class="col-3 d-flex flex-column align-items-center">
			<button class="btn btn-light ">&nbsp;&nbsp</button>
			<span>Soru Açılmadı</span>
		</div>
		<hr class="w-100">

		<?php 
			foreach ($_SESSION["sorular"] as $key => $value) {
				$arkaplan = $_SESSION["soru_id"] == $key ? 'btn-dark' : 'btn-light';

				if ( in_array( $key, $_SESSION[ "bakilan" ] ) ){
					$arkaplan = "btn-warning";
				}
				if( in_array( $key, $_SESSION[ "cevaplanan" ] ) ){
					$arkaplan = "btn-info";
				}
				
				echo "<button id='soruBtn$key' class='soruBtn btn-sm col-2 btn $arkaplan px-0 my-1 mx-1' onclick='soruGetir($key)'><b>$key</b></button>";
			}
		?>
	</div>
</div>
	
<script>
	<?php 
		if( $soruGoster == 1 ){
			echo "$(document).ready(function(){
				soruGetir($_SESSION[soru_id],0);
			})";
		}
	?>
	
	$('#next-button').on("click", function(e) { 
		var sinav_id = $(this).data("id");
		$(".okudum-anladim").remove();	
		$(this).remove();
		$("#display-container").append("<div class='soru-kapsa' id='soru-kapsa'></div>");
		var data_url 	= './_modul/ajax/ajax_data.php';
		$.post(data_url, { islem : "sinavBaslat",sinav_id: sinav_id}, function (response) {
			location.reload();	
		});	
		soruGetir(1,0);
		
		
	});
	/*
		islem	: soruIsaretle
		id		: 71
		modul	: sinav
		soru_id	: 14
		tur		: checkbox
	*/
	/*SECİLEN CEVABA BOX SHADOW EKELENİYOR*/
	function secenekIsaretle(secenek,tur,soru_id){
		var soru_tur = tur;
		if(soru_tur == "radio"){
			$(".secenek").each(function() {
				$(this).removeClass("isaretli-secenek");
			})
		}
		$("#secenek"+secenek).addClass("isaretli-secenek");

		var data_islem 	= 'soruIsaretle';
		var	data_modul 	= 'sinav'; 
		var data_url 	= './_modul/ajax/ajax_data.php';

		/*Checkbox olan secenekler için issaretleme olup olmadığı kontrolü*/
		if( soru_tur == "checkbox" ){
			var checkboxDurum = document.getElementById("soruSecenek"+secenek).checked;
			if( checkboxDurum == false ){
				$("#secenek"+secenek).removeClass("isaretli-secenek");
			}
		}
		$.post(data_url, { islem : data_islem, id : secenek, modul : data_modul,soru_id : soru_id,tur : tur,checkboxDurum : checkboxDurum }, function (response) {
			var response = JSON.parse(response);
			if( response.btn_id > 0 ){
				$("#soruBtn"+response.btn_id).removeClass("btn-dark");
				$("#soruBtn"+response.btn_id).addClass("btn-info");
				if( $( "#soruBtn"+response.btn_id ).hasClass( "btn-info" ) ){
					$("#soruBtn"+response.btn_id).addClass("btn-info");	
					$("#soruBtn"+response.btn_id).removeClass("btn-warning");
				}
				
			}
		});	
	}
	
	function soruGetir(id,durum = 1){
		var id          = id;
		var data_islem  = "soruGetir";
		var data_url    = "./_modul/ajax/ajax_data.php";
		var data_modul  = "sinav";
		$.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
			var response = JSON.parse(response);
			$("#soru-kapsa").empty();
			$("#soru-kapsa").append( response.mesaj );
			if( response.durum == 1 ){
				$(".btn-light, .btn-dark").each(function() {
					$(this).removeClass("btn-dark");
					if( $( this ).hasClass( "btn-info" ) || $( this ).hasClass( "btn-warning" )){
							
					}else{
						$(this).addClass("btn-light");
					}
				})
				
				if(response.btn_id > 0){
					if( $( "#soruBtn"+response.btn_id ).hasClass( "btn-info" ) ){
						
					}else{
						$("#soruBtn"+response.btn_id).addClass("btn-warning");
					}
				}
				$("#soruBtn"+response.soru_id).addClass("btn-dark");
				$("#soruBtn"+response.soru_id).removeClass("btn-light");
				
			}
		});	
	}
	function sinavBitir(){
		if (confirm("Sinavı Bitirmeniz Halinde Sınavda düzeltme yapılamaz\nSınavı Bitirmek İstiyor musunuz?")) {
			var data_url 	= './_modul/ajax/ajax_data.php';
			$.post(data_url, { islem : "sinavBitir" }, function (response) {
				var sonuc = JSON.parse(response);
				if(sonuc.durum == 1){
					location.reload();	
				}
			});
		}
	}
// Credit: Mateusz Rybczonec

const FULL_DASH_ARRAY = <?php echo $total_minutes; ?>;;
const WARNING_THRESHOLD = 2400;
const ALERT_THRESHOLD = 15;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT = <?php echo $total_minutes; ?>;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;
document.getElementById("clock").innerHTML = '<div class="base-timer">'+
    '<svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">'+
        '<g class="base-timer__circle">'+
        '<circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>'+
            '<path id="base-timer-path-remaining" stroke-dasharray="283" class="base-timer__path-remaining '+remainingPathColor+'" d="M 50, 50 m -45, 0 a 45,45 0 1,0 90,0 a 45,45 0 1,0 -90,0"></path>'+
        '</g>'+
    '</svg>'+
    '<span id="base-timer-label" class="base-timer__label">'+ formatTime(timeLeft)+'</span>'+
'</div>';

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(timeLeft);
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      	onTimesUp();
	  	var data_url 	= './_modul/ajax/ajax_data.php';
		<?php
			if( array_key_exists( "okudum_anladim",$_SESSION ) ){
				echo "$.post(data_url, { islem : 'sinavBitir' }, function (response) {
					var sonuc = JSON.parse(response);
					if(sonuc.durum == 1){
						location.reload();	
					}
				});";
			}
		?>
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document.getElementById("base-timer-path-remaining").classList.remove(warning.color);
    document.getElementById("base-timer-path-remaining").classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document.getElementById("base-timer-path-remaining").classList.remove(info.color);
    document.getElementById("base-timer-path-remaining").classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = (calculateTimeFraction() * FULL_DASH_ARRAY).toFixed(0);
  document.getElementById("base-timer-path-remaining").setAttribute("stroke-dasharray", circleDasharray);
}

//Sınav Bitirene Kadar Son Gorulme saati deiştirilecek
<?php
	if( array_key_exists( "okudum_anladim",$_SESSION ) ){
		echo "
		setInterval(function() {
			var data_url 	= './_modul/ajax/ajax_data.php';
			if (navigator.onLine) {
				$.post(data_url, { islem : 'sonGorulme',sinav_id: $sinav_id }, function (response) {
					
				});
			} else {
				alert('İnternet Bağlantınız Kesildi Yonetici İle İletişime Geçiniz!!!');
			}
			}, 10000);
		";
	}
?>


</script>