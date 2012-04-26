<div class="span2" id="sidebar">
    <div class="avatar">
        <a href="<?php echo url_for('perfil/exibir?u=' . $usuario->getIdUsuario()) ?>"><img src="<?php echo image_path($usuario->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)) ?>" alt="<?php echo $usuario->getNome(); ?>" class="photo"></a>

        <?php if ($usuario->getIdUsuario() != UsuarioLogado::getInstancia()->getIdUsuario()) { ?>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO) { ?>
                        <li>
                            <a data-toggle="modal" href="#modalAdd">Adicionar como amigo</a>
                        </li>
                    <?php } else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::AGUARDANDO_CONFIRMACAO) { ?>
                        <li>
                            <a data-toggle="modal" href="#modalAdd">Responder solicitação</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="enviar-msg.shtml">Enviar mensagem privada</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a data-toggle="modal" href="#modalIgnore"><i class="icon-ban-circle icon-gray"></i> Ignorar usuário</a>
                    </li>
                </ul>
            </div>
        <?php } ?>
        <h1><?php echo $usuario->getNome(); ?></h1>

    </div><!-- /avatar -->

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="<?php echo url_for('perfil/exibir?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
        <li><a href="<?php echo url_for('perfil/exibirConteudos?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
        <?php /*<li><a href="#"><span class="icon-gray icon-comment"></span> Comunidades</a></li> */ ?>
        <?php /*<li><a href="#"><span class="icon-gray icon-folder-open"></span> Projetos</a></li> */ ?>
        <li><a href="#"><span class="icon-gray icon-user"></span> Amigos</a></li>
        <li><a href="<?php echo url_for('perfil/informacao?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-info-sign"></span> Informações</a></li>
    </ul>
</div><!-- /sidebar -->