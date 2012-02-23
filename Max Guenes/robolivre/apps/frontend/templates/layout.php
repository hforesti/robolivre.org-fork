<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Robolivre</title>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <a href="<?php echo url_for('perfil/index') ?>"><?php echo image_tag("/images/logo.png") ?></a>
        <h1>Robolivre!</h1>
        <?php if (UsuarioLogado::getInstancia()->isLogado()) { ?>
            <p align="right" style="text-align: right;">
                Bem vindo <?php echo UsuarioLogado::getInstancia()->getNome(); ?>
                <a href="<?php echo url_for('perfil/logout'); ?>"> Sair</a>
            </p>
            <a href="<?php echo url_for('perfil/index') ?>">Perfil</a>
            <a href="<?php echo url_for('perfil/lista') ?>">Usuarios</a>
            <a href="<?php echo url_for('conteudo/index') ?>">Conteudos</a>
            <a href="<?php echo url_for('perfil/solicitacoes') ?>">Solicitacoes(<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes(); ?>)</a>
        <hr></hr>
        <br/>
        <br/>
        <?php } ?>
        <?php echo $sf_content ?>
    </body>
</html>
