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

}(window.jQuery)