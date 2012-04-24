<!--#include virtual="includes/header.html" -->

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
                        <a href="<?php echo url_for('perfil/editarPerfil') ?>">Editar perfil</a>
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
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
            <li><hr></li>
            <li><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li>
        </ul>
    </div><!-- /sidebar -->

    <hr class="only-mobile">

    <div class="span7">

        <?php include_partial('formPublicacao', array('form' => $formPublicacao, 'id_usuario_referencia' => null)) ?>

        <hr>


        <div id="stream" class="tabbable">

            <div class="tab-content">
                <ul class="nav nav-tabs pull-right" id="tabs-home">
                    <li class="no-link">
                        <h6>Atualizações recentes de:</h6>
                    </li>
                    <li class="active">
                        <a href="#1" data-toggle="tab"><h3><i class="icon-tag icon-gray"></i> Conteúdos</h3></a>
                    </li>
                    <li>
                        <a href="#2" data-toggle="tab"><h3><i class="icon-user icon-gray"></i> Perfil e Amigos</h3></a>
                    </li>
                </ul>

                <!-- ================================== -->
                <!-- ! TAB: Atualizações de "Conteúdos"   -->
                <!-- ================================== -->
                <div class="tab-pane fade in active" id="1">

<!-- <a href="#" class="btn btn-primary" id="refresh"><i class="icon-refresh icon-white"></i> 6 novas atualizações. Exibir agora.</a> -->

                    <ul id="ul-steam-conteudos">
                        <?php foreach ($publicacoesHome['conteudos'] as $publicacao) { ?>                    
                            <?php echo $publicacao->imprimir();

                            /* 'formPublicacao',array('form' => $formPublicacao,
                              'id_publicacao_original' => $publicacao->getIdPublicacao(),
                              'id_usuario_original' => $publicacao->getIdUsuario())); */
                            ?>

<?php } ?>
                    </ul>
                    <div id="pagination" class="btn-load-more"><a href="#pagination" onclick="atualizaDados(1)" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
                </div><!-- tab-pane #1 -->




                <!-- ============================================================================= -->
                <!-- ! =========================================================================   -->
                <!-- ============================================================================= -->




                <!-- ========================== -->
                <!-- ! TAB: Atualizações sociais   -->
                <!-- ========================== -->

                <div class="tab-pane fade in" id="2">
                    <ul id="ul-steam-amigos">
                        <?php foreach ($publicacoesHome['amigos'] as $publicacao) { ?>                    
                            <?php echo $publicacao->imprimir();

                            /* 'formPublicacao',array('form' => $formPublicacao,
                              'id_publicacao_original' => $publicacao->getIdPublicacao(),
                              'id_usuario_original' => $publicacao->getIdUsuario())); */
                            ?>

<?php } ?>
                    </ul>
                    <div id="pagination2" class="btn-load-more"><a href="#pagination2" onclick="atualizaDados(2)" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
                </div><!-- tab-pane #2 -->

            </div><!-- tab-content -->

        </div><!-- stream -->

        

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">
                
        <div id="grid-conteudos" class="wdgt">
            <h3><a href="<?php echo url_for('perfil/exibirConteudos?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Conteúdos seguidos <small><?php echo $quantidadeConteudoSeguido; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayConteudoSeguido as $conteudo): ?>
                    <?php $innerHTML = "<img src='".image_path($conteudo->getImagemPerfil())."' alt='". $conteudo->getNome() ."' title='".$conteudo->getNome()."'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudo->getNome(), "thumbnail") ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('perfil/exibirConteudos?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <hr>

<!--        <div id="grid-comunidades" class="wdgt">
            <h3><a href="comunidades.shtml" title="Ver tudo">Comunidades <small>15</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
            </ul>
            <a href="comunidades.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div> grid-comunidades -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Amigos <small><?php echo $quantidadeAmigos ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayAmigos as $usuario): ?>
                <li ><a href="<?php echo url_for('perfil/exibir?u='.$usuario->getIdUsuario()) ?>"><img src="<?php echo image_path($usuario->getImagemPerfilFormatada()) ?>" alt="<?php echo $usuario->getNome() ?>" title="<?php echo $usuario->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="amigos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->

<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function getUltimoIdConteudos(){
        t=document.getElementById('1').getElementsByClassName('input-id-ultima-publicacao');
        return t[t.length-1].value;
    }
    
    function getUltimoIdAmigos(){
        t=document.getElementById('2').getElementsByClassName('input-id-ultima-publicacao');
        return t[t.length-1].value;
    }
    
    function getPublicacoesAntigasAmigos() {        
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoAmigosHome") . "?ultimo_id_publicacao='+getUltimoIdAmigos()" ?>,
                success: function(resposta){
                    if(resposta!=""){
                        $("#ul-steam-amigos").append(resposta);
                    }else{
                        $("#pagination2").remove();
                    }
                }
            });
        
    }//END getPublicacoesAntigas
    
    function getPublicacoesAntigasConteudos() {      
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoConteudosHome") . "?ultimo_id_publicacao='+getUltimoIdConteudos()" ?>,
                success: function(resposta){
                    if(resposta!=""){
                        $("#ul-steam-conteudos").append(resposta);
                    }else{
                        $("#pagination").remove();
                    }
                }
            });
    }//END getPublicacoesAntigas
    
    
    function atualizaDados(tipo){
        if(tipo==1){
            getPublicacoesAntigasConteudos();
        }else if(tipo==2){
            getPublicacoesAntigasAmigos();
        }
    }
    
    //]]>   
</script>