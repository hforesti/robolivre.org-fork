<div class="row">
    
    <?php include_partial('sidebarConteudo',array('conteudo'=>$conteudo,'quantidadeParticipantes'=>$quantidadeParticipantes)) ?>

    <hr class="only-mobile">

    <div class="span7">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for('perfil/index'); ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('conteudos/index'); ?>">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li class="active">
                <a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome()); ?>"><?php echo $conteudo->getNome(); ?></a>
            </li>
        </ul>

        <p><small>Adicionado por <?php echo Util::getTagUsuario($conteudo->getNomeProprietario(), $conteudo->getConjunto()->getIdUsuario()) ?>: <?php echo $dataCriacao ?>. Última modificação <?php echo $ultimaAtulizacao; ?></small></p>

        <div class="page-header">

            <?php if (!UsuarioLogado::getInstancia()->isUsuarioPublico()) { ?>
                <?php if($conteudo->getTipoSolicitacao()!=Conteudos::PARTICIPANTE){ ?>
                    <a href="<?php echo url_for('conteudos/solicitarParticipacao?u='.$conteudo->getIdConjunto()) ?>" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Seguir conteúdo</a>
                <?php }else if($conteudo->getTipoSolicitacao()==Conteudos::PARTICIPANTE && $conteudo->getTipoUsuario()!= Conteudos::PROPRIETARIO){ ?>
                    <a href="<?php echo url_for('conteudos/removerParticipacao?u='.$conteudo->getIdConjunto()) ?>" class="btn pull-right"><i class="icon-remove"></i> Parar de seguir</a>
                <?php }?>
            <?php } ?>
            <h1><?php echo $conteudo->getNome(); ?></h1>

        </div>

        <?php if ($conteudo->getDescricao() != "") { ?>
            <p><?php echo $conteudo->getDescricao(); ?></p>
            <hr>
        <?php } ?>
        <?php if (!UsuarioLogado::getInstancia()->isUsuarioPublico()) { ?>
            <?php include_partial('formPublicacao', array('form' => $formPublicacao, 'nome_conteudo' => $conteudo->getNome(), 'id_conjunto' => $conteudo->getIdConjunto())) ?>
            <hr>
        <?php } ?>



        <div id="stream">
            <h3>Atualizações recentes</h3>
            <ul id="ul-steam">
                <?php foreach ($publicacoesConjunto['publicacoes'] as $publicacao) { ?>
                    <?php echo $publicacao->getImpressaoEmConteudo(); ?>
                <?php } ?>
            </ul>


        </div><!-- stream -->
        <?php if($publicacoesConjunto['quantidade']>=10){?>
        <div class="btn-load-more" id="pagination"><a href="#pagination" onclick="getPublicacoesAntigasConteudos()" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
        <?php } ?>
    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>">Conteúdos relacionados <small><?php echo $quantidadeConteudosRelacionados; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach ($arrayConteudosRelacionados as $conteudoRelacionado) { ?>
                    <?php $innerHTML = "<img src='" . image_path($conteudoRelacionado->getImagemPerfil()) . "' alt='" . $conteudoRelacionado->getNome() . "' title='" . $conteudoRelacionado->getNome() . "'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudoRelacionado->getNome(), "thumbnail") ?></li>
                <?php } ?>
            </ul>
            <a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>" title="Ver tudo">Seguidores <small><?php echo $quantidadeParticipantes ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach ($arrayParticipantes as $usuario): ?>
                    <li ><a href="<?php echo url_for('perfil/exibir?u=' . $usuario->getIdUsuario()) ?>"><img src="<?php echo image_path($usuario->getImagemPerfilFormatada()) ?>" alt="<?php echo $usuario->getNome() ?>" title="<?php echo $usuario->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
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
                url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoConteudo") . "?id_conjunto=" . $conteudo->getIdConjunto() . "&ultimo_id_publicacao='+getUltimoId()" ?>,
                success: function(resposta){
                    if(resposta!=""){
                        $("#ul-steam").append(resposta);
                        $('.visivel-para i').tooltip();
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