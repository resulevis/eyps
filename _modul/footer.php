<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y") ?> <a href="https://syntaxyazilim.com/" target="_blank">SYNTAX YAZILIM</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0-rc
    </div>
</footer>

<!-- Control Sidebar -->

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