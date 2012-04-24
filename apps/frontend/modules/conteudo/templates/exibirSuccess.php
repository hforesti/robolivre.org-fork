<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php echo url_for('conteudo/').Util::criaSlug($conteudo->getNome()); ?>"><img src="<?php echo image_path($conteudo->getImagemPerfil(Util::IMAGEM_GRANDE)) ?>" alt="Arduino" class="photo"></a>
            <div class="btn-group">
                <?php if($conteudo->getConjunto()->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()){ ?>
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="settings.shtml">Atualizar imagem</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('conteudos/editar?u='.$conteudo->getIdConjunto()) ?>">Editar conteúdo</a>
                    </li>
                </ul>
                <?php } ?>
            </div>

        </div><!-- /avatar -->
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="amigos.shtml"><span class="icon-gray icon-user"></span> Seguidores <span class="label label-info"><?php echo $quantidadeParticipantes ?></span></a></li>
            <li><a href="imagens.shtml"><span class="icon-gray icon-picture"></span> Imagens <span class="label label-info"></span></a></li>
            <li><a href="videos.shtml"><span class="icon-gray icon-film"></span> Vídeos <span class="label label-info"></span></a></li>
            <li><a href="links.shtml"><span class="icon-gray icon-share-alt"></span> Links <span class="label label-info"></span></a></li>
            <li><a href="docs.shtml"><span class="icon-gray icon-file"></span> Documentos <span class="label label-info"></span></a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos relacionados <span class="label label-info"></span></a></li>
        </ul>
    </div><!-- /sidebar -->

    <hr class="only-mobile">

    <div class="span7">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for('perfil/index');?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('conteudos/index');?>">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li class="active">
                <a href="<?php echo url_for('conteudo/').Util::criaSlug($conteudo->getNome()); ?>"><?php echo $conteudo->getNome(); ?></a>
            </li>
        </ul>

        <p><small>Adicionado por <?php echo Util::getTagUsuario($conteudo->getNomeProprietario(), $conteudo->getConjunto()->getIdUsuario()) ?>. Última atualização <?php echo $ultimaAtulizacao; ?></small></p>

        <div class="page-header">
            <a href="#" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Seguir conteúdo</a>
            <!-- <a href="#" class="btn pull-right"><i class="icon-remove"></i> Parar de seguir</a> -->

            <h1><?php echo $conteudo->getNome(); ?></h1>

        </div>

        <p><?php echo $conteudo->getDescricao(); ?></p>

        <hr>

        <?php include_partial('formPublicacao', array('form' => $formPublicacao,'nome_conteudo' => $conteudo->getNome() ,'id_conjunto' => $conteudo->getIdConjunto())) ?>

        <hr>


        <div id="stream">
            <h3>Atualizações recentes</h3>
            <ul id="ul-steam">
                <?php foreach ($publicacoesConjunto as $publicacao) { ?>
                    <?php print_r($publicacao->imprimir()); ?>
                <?php } ?>
            </ul>


        </div><!-- stream -->

        <div class="btn-load-more" id="pagination"><a href="#pagination" onclick="getPublicacoesAntigasConteudos()" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="conteudos.shtml">Conteúdos relacionados <small><?php echo $quantidadeConteudosRelacionados; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayConteudosRelacionados as $conteudoRelacionado){ ?>
                <?php $innerHTML = "<img src='".image_path($conteudoRelacionado->getImagemPerfil())."' alt='". $conteudoRelacionado->getNome() ."' title='".$conteudoRelacionado->getNome()."'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudoRelacionado->getNome(), "thumbnail") ?></li>
                <?php } ?>
            </ul>
            <a href="conteudos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <hr>

<!--  <div id="grid-projetos" class="wdgt">
            <h3><a href="projetos.shtml" title="Ver tudo">Projetos relacionados <small>15</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="/assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
            </ul>
            <a href="projetos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div> grid-comunidades -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Seguidores <small><?php echo $quantidadeParticipantes ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayParticipantes as $usuario): ?>
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
    
    function getUltimoId(){
        t=document.getElementsByName('id_ultima_publicacao');
        return t[t.length-1].value;
    }
    
    function getPublicacoesAntigasConteudos() {      
    try{        
        $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoConteudo") . "?id_conjunto=".$conteudo->getIdConjunto()."&ultimo_id_publicacao='+getUltimoId()" ?>,
                success: function(resposta){
                    if(resposta!=""){
                        $("#ul-steam").append(resposta);
                    }else{
                        $("#pagination").remove();
                    }
                }
            });
            }catch(e){alert(e);}
    }//END getPublicacoesAntigas
    
    
    
    document.title = "<?php echo $conteudo->getNome(); ?> - Conteudo - Robolivre";
    
    //]]>
</script>