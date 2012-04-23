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
 //auto focus input
 if ( $("#login-form, #form-criar-conteudo, #form-criar-comunidade") ) {
   $('input[tabindex=1], textarea[tabindex=1]').focus();
 }

//sidebar border (apenas para desktop)

// if ( $("#sidebar") ) {
// 	var sh = $("#sidebar").height();
// 	var mmh = $(".container .span7").height();
// 	var mh = $(".container .span10").height();
// 	if( mmh > sh ) {
// 		$("#sidebar").height(mmh);
// 	}
// 	if( mh > sh ) {
// 		$("#sidebar").height(mh);
// 	}
// }


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

//foca no item na lista
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
	$("#explore h2").animate({opacity: '.5'}, 1600, function() {
		resetFade();
	});
}
function resetFade(){ //increase opacity
	$("#explore h2").animate({opacity: '1'}, 600, function(){
		toFade();
	});
}
toFade();

//video no stream de status
if ( $("#stream .video-embed") ) {
	$("#stream .share-content .shared-item").click(function() {
		$(this).fadeOut(function(){
			url = $(this).parent().find(".video-embed iframe").attr("src");
			$(this).parent().find(".video-embed iframe").attr({src:url+"?autoplay=1"});
			$(this).parent().find(".video-embed").fadeIn();
		});
		return false;
	});
}

//tooltips
$('#inbox-pvt-intro .singletip').tooltip({placement: 'left'});
$('.singletip, #grid-comunidades img, #grid-conteudos img, #grid-amigos img, #grid-projetos img, .visivel-para i, #grid-eventos img').tooltip();
$('#form-status .nav a, #form-topico .nav a, #form-reply .nav a').tooltip({placement: 'bottom'});


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
		if(numItems == 0) {$('.notf-txt-num').html('')}
		if(numItems == 1) {$('.notf-txt-num').html('não lida')}
		if(numItems > 1) {$('.notf-txt-num').html('não lidas')}
})

//checkbox desligar emails
function disableCheckboxesEmail() {
	$('#notific .control-group').not('#turnEmailOff').animate(
		{opacity: '.2'}, 200);
	$('#notific input[type=checkbox]').not('#optionTurnEmailOff').attr('disabled','disabled');
}//function
//checkbox desligar emails
function enableCheckboxesEmail() {
	$('#notific .control-group').not('#turnEmailOff').animate(
		{opacity: '1'}, 200);
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
                $("#imagem_selecionada").val("");
            },
        onComplete: function(id, fileName, responseJSON){
            $("#thumb").attr("src",url_for("uploads/"+ fileName));
            $("#imagem_selecionada").val(fileName);
        }
});
$("#img-preview").click(function() {
	$("#file-uploader-img input").click();
});

//upload docs
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
	showMessage: function(message){alert(message);}

});

//upload doc
var uploader = new qq.FileUploader({
    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element: document.getElementById('file-uploader-docs'),
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
            onLeave			: "Os arquivos estão sendo enviados, se você sair agora o envio será cancelado."            
	},
	showMessage: function(message){alert(message);}
});



}(window.jQuery)

function getForcaSenha(inputPassword,spanHelp) {

	var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	var enoughRegex = new RegExp("(?=.{6,}).*", "g");
	var resposta = "";
	if (inputPassword.value.length==0) {
		resposta = 'Campo obrigatório!';
	} else if (false == enoughRegex.test(inputPassword.value)) {
		resposta = 'Insuficiente';
	} else if (strongRegex.test(inputPassword.value)) {
		resposta = 'Forte';
	} else if (mediumRegex.test(inputPassword.value)) {
		resposta = 'Normal';
	} else {
		resposta = 'Fraca';
	}

	if(spanHelp != undefined){
		spanHelp.innerHTML = resposta;
	}

	return resposta;

}
