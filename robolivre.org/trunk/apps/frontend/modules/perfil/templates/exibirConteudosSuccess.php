<div class="row">
    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('perfil/index'); ?>"><img src="<?php echo image_path($usuario->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)); ?>" alt="Rodrigo Medeiros" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="settings.shtml">Atualizar foto</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('perfil/editarPerfil?u=' . $usuario->getIdUsuario()) ?>">Editar perfil</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo $usuario->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li><a href="<?php url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li class="active"><a href="<?php echo url_for('perfil/exibirConteudos?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
            <li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li>
            <li><a href="<?php echo url_for('perfil/solicitacoes') ?>"><?php if (UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() > 0) { ?><span class="label label-warning" title="<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?> nova(s) solicitações de amizade"><?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
            <li><a href="eventos.shtml"><span class="icon-gray icon-calendar"></span> Eventos</a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
            <li><hr></li>
            <li><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li>
        </ul>
    </div><!-- /sidebar -->
    <div id="grid-conteudos" class="wdgt">
        <h3><a href="<?php echo url_for('perfil/exibirConteudos?u='.$usuario->getIdUsuario()) ?>">Conteúdos seguidos <small><?php echo $quantidadeConteudoSeguido; ?></small></a></h3>
        <ul class="thumbnails">
            <?php foreach ($arrayConteudoSeguido as $conteudo): ?>
                <li class="span1"><a href="<?php echo url_for('conteudo/exibir?u=' . $conteudo->getIdConjunto()) ?>" class="thumbnail"><img src="<?php echo image_path($conteudo->getImagemPerfil()) ?>" alt="<?php echo $conteudo->getNome(); ?>" title="<?php echo $conteudo->getNome(); ?>"></a></li>
            <?php endforeach; ?>
        </ul>
    </div><!-- grid-conteudos -->
</div>