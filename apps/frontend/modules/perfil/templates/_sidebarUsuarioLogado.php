<?php

if(!isset($opcao))
    $opcao = "atualizacao";

?>

<div class="span2" id="sidebar">
    <div class="avatar">
        <a href="<?php echo url_for('perfil/index'); ?>"><img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)); ?>" alt="<?php echo UsuarioLogado::getInstancia()->getNome(); ?>" class="photo"></a>
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
        <li <?php echo ($opcao=="atualizacao")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
        <li <?php echo ($opcao=="conteudos")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/exibirConteudosHome') ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
        <?php /*<li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li> */?>
        <li <?php echo ($opcao=="solicitacoes")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/exibirAmigosHome') ?>"><?php if (UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() > 0) { ?><span class="label label-warning" title="<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?> nova(s) solicitações de amizade"><?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
        <?php /* <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li> */ ?>
        <li <?php echo ($opcao=="informacao")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/informacaoHome') ?>"><span class="icon-gray icon-info-sign"></span> Informações</a></li>
        <li><hr></li>
        <?php /* <li <?php echo ($opcao=="mensagem")?"class=\"active\"":"" ?>><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li> */ ?>
    </ul>
</div><!-- /sidebar -->