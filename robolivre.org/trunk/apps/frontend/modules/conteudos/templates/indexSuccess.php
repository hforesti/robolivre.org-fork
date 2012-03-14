<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('perfil/index'); ?>"><img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)); ?>" alt="<?php echo UsuarioLogado::getInstancia()->getNome(); ?>" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo url_for('perfil/atualizarFoto') ?>">Atualizar foto</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('perfil/editarPerfil?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Editar perfil</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo UsuarioLogado::getInstancia()->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="<?php url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="<?php echo url_for('perfil/exibirConteudos?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
            <li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li>
            <li><a href="<?php echo url_for('perfil/solicitacoes') ?>"><?php if (UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() > 0) { ?><span class="label label-warning" title="<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?> nova(s) solicitações de amizade"><?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
            <li><a href="eventos.shtml"><span class="icon-gray icon-calendar"></span> Eventos</a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
            <li><hr></li>
            <li><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li>
        </ul>
    </div><!-- /sidebar -->

    <hr class="only-mobile">

    <div class="span10">


        <div class="page-header">

            <a href="#modalNovoConteudo" data-toggle="modal" class="btn btn-success pull-right"><i class="icon-plus icon-white"></i> Criar novo conteúdo</a>

            <h1>Conteúdos</h1>

            <!-- modal -->
            <div class="modal fade" id="modalNovoConteudo">
                <form name="formNovoConteudo" action="<?php echo url_for('conteudos/criar') ?>" method="post" id="form-criar">

                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Criar novo conteúdo</h3>
                    </div>

                    <div id="div-modal" class="modal-body">

                        <div class="control-group">
                            <div class="controls">
                                <input id="nome" type="text" name="nome" class="span5" id="input-nome-conteudo" placeholder="Nome do conteúdo" value="">
                            </div>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <div class="pull-right" id="div-botao-criar">
                        <button type="button" onclick="validaForm()" class="btn btn-primary">Criar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /modal -->


        </div>


        <div id="explore" class="clearfix">
            <h2>Explore nosso mundo de conteúdos</h2>
            <form class="form-search" action="#">
                <input type="text" class="span4 search-query" placeholder="Procurar conteúdo…">
            </form>

            <div id="tagcloud">
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
                <a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">Apresentações</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
                <a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Programação</a>
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">C++</a>
                <a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">New Highs New Lows</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
                <a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Projeto</a>
                <a href="conteudo.shtml" title="4 itens" style="font-size: 11.7006369427px;">Animação</a>
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">Bípede</a>
                <a href="conteudo.shtml" title="4 itens" style="font-size: 11.7006369427px;">cattec</a>
                <a href="conteudo.shtml" title="96 itens" style="font-size: 20.7388535032px;">Circuitos</a>
                <a href="conteudo.shtml" title="42 itens" style="font-size: 18.2165605096px;">Código Fonte</a>
                <a href="conteudo.shtml" title="6 itens" style="font-size: 12.7515923567px;">Com rodas</a>
                <a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Documento</a>
                <a href="conteudo.shtml" title="7 itens" style="font-size: 13.101910828px;">GGBR4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">GVTT3</a>
                <a href="conteudo.shtml" title="147 itens" style="font-size: 22px;">Ibov</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">ITAU4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 32px;" class="nofade">Arduino</a>
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">ITUB4</a>
                <a href="conteudo.shtml" title="18 itens" style="font-size: 15.7643312102px;">Evento</a>
                <a href="conteudo.shtml" title="36 itens" style="font-size: 17.7961783439px;">LAD</a>
                <a href="conteudo.shtml" title="36 itens" style="font-size: 22px;" class="nofade">Open source</a>
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
                <a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">New Highs New Lows</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
                <a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Programação</a>
                <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
                <a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">New Highs New Lows</a>
                <a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
                <a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Projeto</a>
            </div>
        </div><!-- #explore -->

        <hr>

        <div class="row">

            <div class="span10 list-conteudos">
                <h3>Apresentações</h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Conteúdo</a></li>
                    <li><a href="conteudo.shtml"><img src="assets/img/rl/20.gif" alt="Nome do conteúdo"> Nome do conteúdo</a></li>
                </ul>
            </div><!-- list-conteudos -->

        </div>

    </div><!-- /miolo -->



</div><!-- /row -->

<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getSlug(nome){
        arraySlug = nome.toLowerCase().split(" ");
        retorno = "";
        for(i=0;i< arraySlug.length;++i ){
            if(retorno == ""){
                retorno = arraySlug[i];
            }else{
                retorno += "-"+arraySlug[i];
            }
        }
        
        return retorno;
    }
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function validaForm() {        
        $("#alert-modalNovoConteudo").remove();
        
        
        if(getValue('nome') != ""){
            
            $("#div-botao-criar").prepend("<img src='<?php echo image_path('/assets/img/rl/loading.gif');?>' id='imagem-load' alt='Carregando'>");
            
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxValidaNomeConteudo") . "?nome='+getValue('nome')" ?>,
                success: function(resposta){
                    $("#imagem-load").remove();
                    if(resposta == "ok"){
                        document.forms["formNovoConteudo"].submit();
                    }else{
                        var erros = resposta.split(SEPARADOR_PARAMETRO);
                        idConjunto = erros[0].split('=')[1];
                        nomeConteudo = erros[1].split('=')[1];
                        
                        url_conteudo = "<?php echo url_for('conteudo/'); ?>"+getSlug(nomeConteudo);
                                                
                        $("#div-modal").append("<div id='alert-modalNovoConteudo' class='alert'><a href='"+url_conteudo+"'>"+nomeConteudo+"</a> é um conteúdo que já existe na nossa rede. <br>Deseja colaborar com ele? <a href='"+url_conteudo+"'><strong>Acesse agora</strong></a></div>");
                        
                    }
                }
            });
        }else{ //END if getValue
            $("#div-modal").append("<div id='alert-modalNovoConteudo' class='alert-error'>Digite um nome</div>");
        }
        
    }//END validaForm
    
    
    $('#form-criar').submit(function(){
        validaForm();
        return false;
    });
    
    
    
    //]]>   
</script>