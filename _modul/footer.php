<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y") ?> <a href="https://syntaxyazilim.com/" target="_blank">SYNTAX YAZILIM</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0-rc
    </div>
</footer>

<?php 

    if ( $_REQUEST['modul'] == "puantaj" OR $_REQUEST['modul'] == "kapatilmisDonem"  ) { 

        /*Personel Beyaz Yakalı Personel İse Maaş hesaplaması yapılmayıp aldığı ucret yazılacaktır.*/

        if ( $tek_personel[ 'grup_id' ] == $beyaz_yakali_personel ) {
            $aylikTutar = $personel_maas;
        }else{

            /*Personelin Kazandığı toplam tutar Maas Hesaplaması*/
            foreach ( $genelCalismaSuresiToplami as $carpan => $dakika ) {
                /* -- Maaş Hesaplasması == ( personelin aylık ucreti / 225 / 60 ) * carpan --*/
                $aylikTutar  += ( $personel_maas / $aylik_calisma_saati / 60 ) * $carpan * $dakika;
            }
            /*Ücreti odenen tatil günlerinin maaşa ekledik.*/
            $aylikTutar +=  ( $personel_maas / $aylik_calisma_saati / 60 ) * 1 * $tatilGunleriToplamDakika;

            /*Alınan ücretli izinleri maasa eklendi. */
            $aylikTutar +=  ( $personel_maas / $aylik_calisma_saati / 60 ) * 1 * $ucretliIzinGenelToplam;

        }

        /*Kazanılan ödemleri ücret üzerine eklemelerini yapıyyoruz*/
        $aylikTutar +=  $kazanilan[ "toplamTutar" ];

        /*Yapılan kesintileri ücret ücretten çıkarıyoruz*/
        $aylikTutar -=  $kesinti[ "toplamTutar" ];

?>
<!-- Control Sidebar -->
<aside class="control-sidebar personel-bilgileri-kapsa" >
        <div class="card card-outline">
            <h2 class="text-danger" style="margin-top: 10px;"><center>Net Ücret</center></h2>
            <h3 class=""><center><?php echo $fn->parabirimi($aylikTutar); ?>TL</center></h3>
            <center>Kazanç ve kesintiler dahildir.</center>
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="personel_resimler/<?php echo $tek_personel[ 'resim' ] . '?_dc = ' . time(); ?>" id = "personel_resim" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $tek_personel[ "adi" ].' '.$tek_personel[ "soyadi" ] ; ?></h3>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Kart No</b> <a class="float-right"><?php echo $tek_personel[ "kayit_no" ]; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Sicili</b> <a class="float-right"><?php echo $tek_personel[ "sicil_no" ]; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Şubesi</b> <a class="float-right"><?php echo $tek_personel[ "sube_adi" ]; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Bölümü</b> <a class="float-right"><?php echo $tek_personel[ "bolum_adi" ]; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Grubu</b> <a class="float-right"><?php echo $tek_personel[ "grup_adi" ]; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>İşe Giriş Tarihi</b> <a class="float-right"><?php echo $fn->tarihFormatiDuzelt($tek_personel[ "ise_giris_tarihi" ]); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>İşten Çıkış Tarihi</b> <a class="float-right"><?php  echo $fn->tarihFormatiDuzelt($tek_personel[ "isten_cikis_tarihi" ]); ?></a>
                    </li>
                </ul>
            </div>
        </div>
</aside>
<!-- /.control-sidebar -->
<script type="text/javascript">
    // ESC tuşuna basınca formu temizle
    document.addEventListener( 'keydown', function( event ) {
        
        if( event.ctrlKey ) {
            if ( event.shiftKey ) {
                document.getElementById( 'sagSidebar' ).click();
            }
        }
    });
</script>

 <?php } ?>
<script type="text/javascript">

    $('.soru').summernote();

    $('.aktifYilSec').on("change", function(e) { 
        var $id         = $(this).val();
        var $data_islem = $(this).data("islem");
        var $data_url   = $(this).data("url");
        $.post($data_url, { islem : $data_islem, id : $id }, function (response) {
           window.location.reload();
        });

    });

    $('.ajaxGetir').on("change", function(e) { 
        var id          = $(this).val();
        var data_islem  = $(this).data("islem");
        var data_url    = $(this).data("url");
        var data_modul  = $(this).data("modul");
        var div         = $(this).data("div");
        $("#"+div).empty();
        $.post(data_url, { islem : data_islem, id : id, modul : data_modul }, function (response) {
            $("#"+div).append(response);
        });
    }); 

    $(".kapat").click(function(){
        var id = $(this).data("id");
        $("#"+id).slideToggle(500);
    });
    
    var soruSecenekleri = ["","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","R","S"];
        
        function secenekOku(e){
            var metin           = $('option:selected',e).data("metin");
            var coklu_secenek   = $('option:selected',e).data("coklu_secenek");
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
                this.setAttribute("for",soruSecenekleri[secenekSayisi]);
                secenekSayisi = secenekSayisi+1;
            })   
            

            /*Secilen input radi ve checkbxların isimlerini ve idlerini değiştirme*/
            var inputSayisi = 1;
            $(".inputSecenek").each(function( index, element ) {
                this.value  = soruSecenekleri[inputSayisi];
                this.id     = soruSecenekleri[inputSayisi];
                inputSayisi +=1;
            })

            /*Textarea isimlerini değitirme*/
            var cevapSayisi = 1;
            $(".textareaSecenek").each(function( index, element ) {
                this.name = 'cevap-'+soruSecenekleri[cevapSayisi];
                cevapSayisi +=1;
            })
            

            return secenekSayisi;
        }
        
        function secenekEkle(e) {
            var tip             = $(e).data("secenek_tipi"); 
            var secenekSayisi   = 1;
            secenekSayisi       =  harflendir();
            var required        = "";

            if( tip == "radio" ){
                required = "required";
            }
            var data = '<div class="secenek">'+
                            '<div  class="col-sm m-1 btn text-left bg-light">'+
                                '<label for="'+ soruSecenekleri[ secenekSayisi ] +'" class="float-left soruSecenek">' + soruSecenekleri[secenekSayisi] + ' ) &nbsp;</label>'+
                                '<div class="icheck-success d-inline">'+
                                    '<input type="'+ tip +'" name="dogruSecenek[]" class="inputSecenek" id="'+ soruSecenekleri[ secenekSayisi ] +'" value="'+ soruSecenekleri[ secenekSayisi ] +'" '+ required +'>'+
                                    '<label  class="d-flex inputLabel1">'+
                                        '<textarea name="cevap-'+ soruSecenekleri[ secenekSayisi ]  +'"  class="textareaSecenek form-control col-sm-12" rows="1" required></textarea>'+
                                        '<span  class="secenekSil position-absolute r-2 t-1" ><i class="fas fa-trash-alt" ></i></span>'+
                                    '</label>'+ 
                                '</div>'+
                            '</div>'+
                        '</div>';
            $("#secenekler").append(data);
        };

        $('#secenekler').on("click", ".secenekSil", function (e) {
            $(this).closest(".secenek").remove();
            harflendir();
        });

        $('input[name="editor"]').on('switchChange.bootstrapSwitch', function(event, state) {
            if (state == true ){
                $('.textareaSecenek').summernote({focus: true})
                $(".note-editor").each(function() {
                    $(this).addClass("col-sm");
                })
            }else{
                $(".textareaSecenek").each(function( index, element ) {
                    $(this).summernote('code');
                    $(this).summernote('destroy'); 
                })
            }

        });
        
        

</script>