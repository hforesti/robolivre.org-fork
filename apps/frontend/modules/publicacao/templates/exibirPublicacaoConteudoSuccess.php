<div class="row">

        <?php include_partial('conteudo/sidebarConteudo',array('conteudo'=>$conteudo,'quantidadeParticipantes'=>$quantidadeParticipantes)) ?>


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

        <div id="stream">

            <ul>
                <?php echo $publicacao->getImpressaoEmConteudo(); ?>
            </ul>

        </div><!-- stream -->


    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudos") ; ?>">Conteúdos relacionados <small><?php echo $quantidadeConteudosRelacionados; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach ($arrayConteudosRelacionados as $conteudoRelacionado) { ?>
                    <?php $innerHTML = "<img src='" . image_path($conteudoRelacionado->getImagemPerfil()) . "' alt='" . $conteudoRelacionado->getNome() . "' title='" . $conteudoRelacionado->getNome() . "'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudoRelacionado->getNome(), "thumbnail") ?></li>
                <?php } ?>
            </ul>
            <a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudos") ; ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
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