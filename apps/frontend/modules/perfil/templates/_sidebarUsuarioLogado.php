<?php

if(!isset($opcao))
    $opcao = "atualizacao";

$quantidadeSolicitacoes = UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes();
$quantidadeNotificacoes = $quantidadeSolicitacoes;// + NOTIFICACOES
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

        <h1><?php echo UsuarioLogado::getInstancia()->getNome(); echo " " .$opcao ?></h1>

    </div><!-- /avatar -->

    <ul class="nav nav-pills nav-stacked">
        <li <?php echo ($opcao=="atualizacao")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
        <li <?php echo ($opcao=="conteudos")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/exibirConteudosHome') ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
        <?php /*<li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li> */?>
        <li <?php echo ($opcao=="solicitacoes")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/exibirAmigosHome') ?>"><?php if ($quantidadeSolicitacoes > 0) { ?><span class="label label-warning" title="<?php echo $quantidadeSolicitacoes ?> nova(s) solicitações de amizade"><?php echo $quantidadeSolicitacoes ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
        <?php /* <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li> */ ?>
        <li <?php echo ($opcao=="informacao")?"class=\"active\"":"" ?>><a href="<?php echo url_for('perfil/informacaoHome') ?>"><span class="icon-gray icon-info-sign"></span> Informações</a></li>
        <li><hr></li>
        <li <?php echo ($opcao=="notificacoes")?"class='active'":"" ?>><a href="<?php echo url_for('perfil/notificacoes') ?>"> <?php if ($quantidadeNotificacoes){ ?><span class="label label-warning" id="side-notf-unread" title="<?php echo $quantidadeNotificacoes ?> solicitações de amizade"><?php echo $quantidadeNotificacoes ?></span><?php } ?> <span class="icon-asterisk icon-gray"></span> Solic. de amizade</a></li>
        <?php /* <li <?php echo ($opcao=="mensagem")?"class=\"active\"":"" ?>><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li> */ ?>
    </ul>
</div><!-- /sidebar -->