<?php

if(!isset($opcao))
    $opcao = "atualizacao";

?>

<div class="span2" id="sidebar">
    <div class="avatar">
        <a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome()); ?>"><img src="<?php echo image_path($conteudo->getImagemPerfil(Util::IMAGEM_GRANDE)) ?>" alt="Arduino" class="photo"></a>
        <div class="btn-group">
            <?php if ($conteudo->getPodeColaborar()) { ?>
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="settings.shtml">Atualizar imagem</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('conteudos/editar?u=' . $conteudo->getIdConjunto()) ?>">Editar conteúdo</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
        
        <h1><?php echo $conteudo->getNome(); ?></h1>

    </div><!-- /avatar -->
    <ul class="nav nav-pills nav-stacked">
        <li <?php echo ($opcao=="atualizacao")?"class=\"active\"":"" ?>><a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome()); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
        <li <?php echo ($opcao=="documentos")?"class=\"active\"":"" ?>><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirDocumentos") ; ?>"><span class="icon-gray icon-file"></span> Documentos <span class="label label-info"></span></a></li>
        <li <?php echo ($opcao=="imagem")?"class=\"active\"":"" ?>><a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome())."/imagem"; ?>"><span class="icon-gray icon-picture"></span> Imagens <span class="label label-info"></span></a></li>
        <li <?php echo ($opcao=="video")?"class=\"active\"":"" ?>><a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome())."/video"; ?>"><span class="icon-gray icon-film"></span> Vídeos <span class="label label-info"></span></a></li>
        <li <?php echo ($opcao=="link")?"class=\"active\"":"" ?>><a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome())."/link"; ?>"><span class="icon-gray icon-share-alt"></span> Links <span class="label label-info"></span></a></li>
        <li <?php echo ($opcao=="conteudos")?"class=\"active\"":"" ?>><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudosRelacionados") ; ?>"><span class="icon-gray icon-tag"></span> Conteúdos relac... <span class="label label-info"></span></a></li>
        <li <?php echo ($opcao=="seguidores")?"class=\"active\"":"" ?>><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>"><span class="icon-gray icon-user"></span> Seguidores <span class="label label-info"><?php echo $quantidadeParticipantes ?></span></a></li>
    </ul>
</div><!-- /sidebar -->