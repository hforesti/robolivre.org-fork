// para scripts exclusivos para IE
if ( $.browser.msie ) { //if IE
    $('body').addClass('ie');
} else {
    $('body').addClass('no-ie');
}

//float do grid de thumbs
$(window).load(function(){
    var $container = $('#explore .tab-pane ul');
    $container.imagesLoaded(function(){
        $container.masonry({
            itemSelector : 'li',
            isFitWidth: true,
            gutterWidth: true,
            isAnimated: true,
            animationOptions: {
                duration: 400
            },
            cornerStampSelector: '.corner-stamp'
        });
    });
});

!function ($) {
//external links
    $('a[rel="external"], footer a[rel="co-worker"]').each(function(){
        $(this).addClass('external')
        $(this).attr( 'target', '_blank')
    })
    //auto focus input
    if ( $("#login-form, #form-criar-conteudo, #form-criar-comunidade") ) {
        $('input[tabindex=1], textarea[tabindex=1]').focus();
    }

    //links de compartilhar em redes sociais abrem em nova janela
    $(document).ready(function(){
        $('.go-twitter a, .go-fb a').click(function (event){

            var url = $(this).attr("href");
            var windowName = "shareWin";//$(this).attr("name");
            var windowSize = "width=640,height=350,scrollbars=yes";

            window.open(url, windowName, windowSize);

            event.preventDefault();

        });
    }); 

    //links externos
    $('a[rel="external"]')
    .click( function() {
        window.open( $(this).attr('href') );
        return false;
    })

    //oculta parte da descricao do conteudo
    var ch = $('#main-entry').height();
    $('#main-entry').css({
        height: '110px',
        overflow: 'hidden'
    });
    $('#shink-content .btn').click(function(){
        $('#main-entry').animate({
            height: ch
        }, 1800, function(){
            $('#main-entry').css({
                height: 'auto'
            })
        });
        $(this).parent().fadeOut(700);
        return false;
    })

    //carousel imprensa
    $('.carousel').carousel({
        interval: 4000
    })

    //oculta topbar do safari mobile
    window.top.scrollTo(0, 1);

    //input placeholder HTML5 para IE
    $('input, textarea').placeholder();

    //fade nos links do menu quando focar a busca
    $('.navbar .search-query').focus(function() {
        $('.navbar .nav li').animate({
            opacity: 0.15,
        }, 250);
    });
    $('.navbar .search-query').blur(function() {
        $('.navbar .nav li ').animate({
            opacity: 1,
        }, 250);
    });

    //fade no conteudo quando focar a busca
    $('#explore .search-query').focus(function() {
        $('#featured').animate({
            opacity: 0.3,
        }, 250);
    });
    $('#explore .search-query').blur(function() {
        $("#featured").animate({
            opacity: 1,
        }, 250);
    });
    $('#explore .form-search').submit(function() {
        return false
    });

    //foca no item na lista
    $('#stream .vcard .drop-options').children().hover(function() {
        $(this).closest('.vcard').siblings().stop().fadeTo(500,0.45);
    }, function() {
        $(this).closest('.vcard').siblings().stop().fadeTo(500,1);
    });
    $('.list-mgmt .btn-group').children().hover(function() {
        $(this).closest('.row').siblings().stop().fadeTo(500,0.45);
    }, function() {
        $(this).closest('.row').siblings().stop().fadeTo(500,1);
    });
    $('table td .btn-group').children().hover(function() {
        $(this).closest('tr').siblings().stop().fadeTo(500,0.45);
    }, function() {
        $(this).closest('tr').siblings().stop().fadeTo(500,1);
    });

    $('#inbox-pvt-intro li button').children().hover(function() {
        $(this).closest('li').siblings().stop().fadeTo(500,0.45);
    }, function() {
        $(this).closest('li').siblings().stop().fadeTo(500,1);
    });

    //pega ID do status para confirmar exclusao
    $('.action-delete a').click(function(){
        var id = $(this).closest('.vcard').attr("id");
        //quando iniciar a mostrar o modal, pega ID
        $('#modalDelete').on('show', function () {
            ref = $("#modalDelete .btn-danger").attr("href");
            $("#modalDelete .btn-danger").attr("href",url_for('publicacao/remover?u=')+id);
        })
    });


    //pega destinatario do modal de mensagem privada
    $('.send-msg').click(function(){
        var n = $(this).closest('.row').find("h3 a").text();
        var u = $(this).closest('.row').find(".photo img").attr("src");
        //quando iniciar a mostrar o modal, muda nome
        $('#modalSendMsg').on('show', function () {
            $("#fromField .uneditable-input").text(n);
            $("#fromField .add-on img").attr("src",u);
        })

    });

    //foca input from no modal de convite
    $('#modalInvite').on('show', function() {
        $('#fromInvite').focus()
    })
    $('.bt-reply a').click(function() {
        $('#reply-topic').focus();
    })

    //animacao respira Explore
    function toFade() { //reduces the opacity
        $(".no-ie #explore h2").animate({
            opacity: '.5'
        }, 1600, function() {
            resetFade();
        });
    }
    function resetFade(){ //increase opacity
        $(".no-ie #explore h2").animate({
            opacity: '1'
        }, 600, function(){
            toFade();
        });
    }
    toFade();

    //video no stream de status
    if ( $("#stream .video-embed") ) {
        $("#stream .share-content .shared-item").click(function() {
            $(this).fadeOut(function(){
                url = $(this).parent().find(".video-embed iframe").attr("src");
                $(this).parent().find(".video-embed iframe").attr({
                    src:url+"?autoplay=1"
                    });
                $(this).parent().find(".video-embed").fadeIn();
            });
            return false;
        });
    }

    //tooltips
    $('#inbox-pvt-intro .singletip').tooltip({
        placement: 'left'
    });
    $('.singletip, #grid-comunidades img, #grid-conteudos img, #grid-amigos img, #grid-projetos img, .visivel-para i, #grid-eventos img, #cont-rel img').tooltip();
    $('#form-status .nav a, #form-topico .nav a, #form-reply .nav a').tooltip({
        placement: 'bottom'
    });


    //textarea de comentarios
    $('.textarea-comment').autoResize({
        maxHeight: 200,
        extraSpace: 0
    });

    //expand textarea (Termos de uso)
    $("#terms-textarea").focus(function(){
        $("textarea").animate({
            'height'	:	'400px',
            'width'		:	'95%'
        }, 'slow')
    });

    //marcar notificacao como lida
    $('.notifications .vcard .notf').click(function(){
        $(this).parent().toggleClass('unread');
        var numItems = $('.unread').length;
        $('#side-notf-unread, .notf-num').html(numItems);
        if(numItems == 0) {
            $('.notf-txt-num').html('')
            }
        if(numItems == 1) {
            $('.notf-txt-num').html('não lida')
            }
        if(numItems > 1) {
            $('.notf-txt-num').html('não lidas')
            }
    })

    //checkbox desligar emails
    function disableCheckboxesEmail() {
        $('#notific .control-group').not('#turnEmailOff').animate(
        {
            opacity: '.2'
        }, 200);
        $('#notific input[type=checkbox]').not('#optionTurnEmailOff').attr('disabled','disabled');
    }//function
    //checkbox desligar emails
    function enableCheckboxesEmail() {
        $('#notific .control-group').not('#turnEmailOff').animate(
        {
            opacity: '1'
        }, 200);
        $('#notific input[type=checkbox]').not('#optionTurnEmailOff').removeAttr('disabled','disabled');
    }//function

    if ( $('#optionTurnEmailOff').is(':checked') ) {
        disableCheckboxesEmail();
    } else {
        enableCheckboxesEmail();
    }

    //checkbox desligar emails
    $('#optionTurnEmailOff').change(function() {
        if ( $('#optionTurnEmailOff').is(':checked') ) {
            disableCheckboxesEmail();
        } else {
            enableCheckboxesEmail();
        }

    }); 

    // WYSIWYG Editor
    $(".wysiwyg").cleditor({
        controls:     // controls to add to the toolbar
        "bold italic strikethrough | subscript superscript | " +
        "highlight removeformat | bullets numbering | outdent " +
        "indent | " +
        "link unlink | source",
        colors:       // colors in the color popup
        "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
        "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
        "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C ",
        bodyStyle:    // style to assign to document body contained within the editor
        "margin:4px; font:13px 'Helvetica Neue', Helvetica, Arial, sans-serif; cursor:text",
        width:'99%',
    });                

    //campo de localizacao pais estrageiro
    $('#location').change(function () {
        var str = "";
        $("#location option:selected").each(function () {
            str += $(this).val();
            if ( str=='ex' ) {
                $("#outropais").fadeIn().focus();
            } else {
                $("#outropais").fadeOut();
            }
        });
    })

    /* multi upload */
    //upload img

    if ( $("#file-uploader-img").length != 0 ) {
        var uploaderImg = new qq.FileUploader({
            // pass the dom node (ex. $(selector)[0] for jQuery users)
            element: document.getElementById('file-uploader-img'),
            // path to server-side upload script
            action: url_for('ajax/ajaxUlpoadImagens'),//'../uploads/',
            multiple: false,
		
            // validation    
            // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
            allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],

            messages: {
                typeError		: "'{file}' tem um formato inválido. Apenas imagens ({extensions}) são aceitas neste caso.",
                sizeError		: "'{file}' é muito grande, o tamanho máximo do arquivo é: {sizeLimit}.",
                minSizeError	: "'{file}' é muito pequeno, o tamaho mínimo do arquivo é: {minSizeLimit}.",
                emptyError		: "'{file}' está vazio, por favor tente novamente.",
                onLeave			: "O arquivo está sendo enviado, se você sair agora o envio será cancelado."            
            },
            showMessage: function(message){ 
                alert(message);
                $("#thumb").attr("src",url_for("assets/img/rl/170.gif")); 
                $("#i-medium").attr("src",url_for("assets/img/rl/60.gif")); 
                $("#i-small").attr("src",url_for("assets/img/rl/20.gif")); 
                $("#imagem_selecionada").val("");
            },
            onComplete: function(id, fileName, responseJSON){
                var arquivo = responseJSON['arquivo'];
                var arr = arquivo.split(".");
                var extensao = arr[1];
                var nome = arr[0];
	            
                $("#thumb").attr("src",url_for("uploads/"+ arquivo.replace("#", "large")));
                $("#i-medium").attr("src",url_for("uploads/"+ arquivo.replace("#", "60"))); 
                $("#i-small").attr("src",url_for("uploads/"+ arquivo.replace("#", "20"))); 
	            
                $("#imagem_selecionada").val(fileName);
            }
        });
        $("#img-preview").click(function() {
            $("#file-uploader-img input").click();
        });
    };

    //upload docs
    if ( $("#file-uploader").length != 0 ) {
        var uploader = new qq.FileUploader({
            // pass the dom node (ex. $(selector)[0] for jQuery users)
            element: document.getElementById('file-uploader'),
            // path to server-side upload script
            action: url_for('ajax/ajaxUlpoadArquivos'),//'../uploads/',
            // validation    
            // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
            allowedExtensions: ['txt', 'rtf', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'odt', 'fodt', 'odp', 'fodp', 'ods', 'fods', 'odg', 'fodg'],

            messages: {
                typeError		: "'{file}' tem um formato inválido. Apenas os formatos de documentos ({extensions}) são aceitos neste caso.",
                sizeError		: "'{file}' é muito grande, o tamanho máximo do arquivo é: {sizeLimit}.",
                minSizeError	: "'{file}' é muito pequeno, o tamaho mínimo do arquivo é: {minSizeLimit}.",
                emptyError		: "'{file}' está vazio, por favor tente novamente.",
                onLeave			: "Os arquivos estão sendo enviados, se você sair agora o envio será cancelado."            
            },
            showMessage: function(message){
                alert(message);
            },
            onComplete: function(id, fileName, responseJSON){
                var valores = $("#documentos_selecionados").val();
                $("#documentos_selecionados").val(valores+"[[*]]"+fileName);
            }

        });
    };

    //upload doc
    if ( $("#file-uploader-doc").length != 0 ) {
        var uploaderDoc = new qq.FileUploader({
            // pass the dom node (ex. $(selector)[0] for jQuery users)
            element: document.getElementById('file-uploader-doc'),
            // path to server-side upload script
            action: url_for('ajax/ajaxUlpoadArquivos'),//'../uploads/',
            multiple: false,
		
            // validation    
            // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
            allowedExtensions: ['txt', 'rtf', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'odt', 'fodt', 'odp', 'fodp', 'ods', 'fods', 'odg', 'fodg'],

            messages: {
                typeError		: "'{file}' tem um formato inválido. Apenas os formatos de documentos ({extensions}) são aceitos neste caso.",
                sizeError		: "'{file}' é muito grande, o tamanho máximo do arquivo é: {sizeLimit}.",
                minSizeError	: "'{file}' é muito pequeno, o tamaho mínimo do arquivo é: {minSizeLimit}.",
                emptyError		: "'{file}' está vazio, por favor tente novamente.",
                onLeave			: "O arquivo está sendo enviado, se você sair agora o envio será cancelado."           
            },
            showMessage: function(message){ 
                alert(message);
            },
            onComplete: function(id, fileName, responseJSON){
                var valores = $("#documentos_selecionados").val();
                $("#documentos_selecionados").val(valores+"[[*]]"+fileName);
            }
        });
    };

}(window.jQuery)

function getForcaSenha(inputPassword,spanHelp) {

    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{6,}).*", "g");
    var resposta = "";
    var erro = false;
        
    var senhasProibidas = new Array("senha");
        
    if (inputPassword.value.length==0) {
        resposta = 'Por favor preencha';
        erro = 1;
    } else if (false == enoughRegex.test(inputPassword.value)) {
        resposta = 'Senha muito curta. Precisa ter no mínimo 6 caracteres.';
        erro = 2;
    } 
        
    if(!erro){
        for(i=0;i< senhasProibidas.length;++i){
            if(inputPassword.value.toLowerCase() == senhasProibidas[i].toLowerCase()){
                erro = 4;
                resposta = 'Não coloque a senha '+inputPassword.value;
                break;
            }
        }
    }
        
    if(!erro){
        if(!isNaN(inputPassword.value)){
            erro = 3;
            var str = inputPassword.value;
            var last = str[0]-1;
            for(i=0;i<str.length;++i){
                ++last;
                if(last>=10){
                    last = last - 10;
                }
                if(str[i]!=last){
                    erro = false;
                    break;
                }
                last = str[i];
            }

            if(!erro){
                erro = 3;
                last = str[str.length-1];
                --last;
                for(i=str.length-1;i>=0;--i){
                    if(--str[i]!=last){
                        erro = false;
                        break;
                    }
                    last = str[i];
                }
            }
            if(erro){
                resposta = 'Sua senha não pode ser '+str;
            }
        }
    }
        
    if(!erro){
        if (strongRegex.test(inputPassword.value)) {
            resposta = 'Força da senha: Ótima';
            erro = false;
        } else if (mediumRegex.test(inputPassword.value)) {
            resposta = 'Força da senha: Boa';
            erro = false;
        } else {
            resposta = 'Força da senha: Fraca';
            erro = false;
        }
    }

    if(spanHelp != undefined){
        spanHelp.innerHTML = resposta;
    }

    return erro;

}

//right click logo
$('.navbar .brand, .home .brand').bind('contextmenu', function(e){
    e.preventDefault();
        $('#modalLogo').modal()
    return false;
});

//tour do início
$('#goTourNoob').click(function(){
    playTourNoob()
});
//funcao para tour do início
function playTourNoob(){
    $(this).joyride({
        'tipAnimation': 'fade',
        'cookieMonster': false
    });
}
