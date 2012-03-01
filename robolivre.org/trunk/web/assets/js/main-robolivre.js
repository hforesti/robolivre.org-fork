!function ($) {

//oculta topbar do safari mobile
window.top.scrollTo(0, 1);

//fade-nos links do menu quando focar a busca
$('.search-query').focus(function() {
	$('.navbar .nav li').animate({
		opacity: 0.15,
	}, 250);
});
$('.search-query').blur(function() {
	$('.navbar .nav li ').animate({
		opacity: 1,
	}, 250);
});

//auto focus input
if ( $("#login-form, #status") ) {
	$('input[tabindex=1], textarea[tabindex=1]').focus();
}

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
$('#grid-comunidades img, #grid-conteudos img, #grid-amigos img, #grid-projetos img, .visivel-para i').tooltip();
$('#form-status .nav a').tooltip({ placement: 'bottom' });

//textarea de comentarios
$('.textarea-comment').autoResize({
    maxHeight: 200,
    extraSpace: 0
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

/* multi upload */
//upload img
var uploader = new qq.FileUploader({
    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element: document.getElementById('file-uploader-img'),
    // path to server-side upload script
    action: '../assets/js/file-uploader/',
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
	showMessage: function(message){ alert(message); }
});
$("#img-preview").click(function() {
	$("#file-uploader-img input").click();
});

//upload docs
var uploader = new qq.FileUploader({
    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element: document.getElementById('file-uploader'),
    // path to server-side upload script
    action: '../assets/js/file-uploader/',
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
	showMessage: function(message){ alert(message); }


});



//input placeholder HTML5 para IE

}(window.jQuery)