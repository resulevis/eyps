<?php 

    /* SEG dosyalarından gelen mesaj */
    if( array_key_exists( 'sonuclar', $_SESSION ) ) {
        $mesaj                 			= $_SESSION[ 'sonuclar' ][ 'mesaj' ];
        $mesaj_turu            			= $_SESSION[ 'sonuclar' ][ 'hata' ] ? 'kirmizi' : 'yesil';
        unset( $_SESSION[ 'sonuclar' ] );
        echo "<script>mesajVer('$mesaj', '$mesaj_turu')</script>";
    }

    if( $_SESSION[ "kullanici_turu" ] == "ogrenci" ){
        include "_modul/anasayfa/ogrenciAnasayfa.php";
    }else if($_SESSION[ "kullanici_turu" ] == "ogretmen"){
        include "_modul/anasayfa/ogretmenAnasayfa.php";
    }else if($_SESSION[ "kullanici_turu" ] == "admin"){
        include "_modul/anasayfa/adminAnasayfa.php";
    }

?>