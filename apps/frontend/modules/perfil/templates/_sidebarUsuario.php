<?php
if (!isset($opcao))
    $opcao = "atualizacao";
?>

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
    <?php } else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::AMIGO) { ?>
                        <li>
                            <a data-toggle="modal" href="#modalAdd">Remover dos amigos</a>
                        </li>
        <?php
    } else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::SOLICITADA_AMIZADE) {
                                        ?>
                                        <li>
                                            <a href="">Aguardando solicitação</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
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
        <li <?php echo ($opcao == "atualizacao") ? "class=\"active\"" : "" ?>><a href="<?php echo url_for('perfil/exibir?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
        <li  <?php echo ($opcao == "conteudos") ? "class=\"active\"" : "" ?>><a href="<?php echo url_for('perfil/exibirConteudos?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
<?php /* <li><a href="#"><span class="icon-gray icon-comment"></span> Comunidades</a></li> */ ?>
        <?php /* <li><a href="#"><span class="icon-gray icon-folder-open"></span> Projetos</a></li> */ ?>
        <li  <?php echo ($opcao == "amigos") ? "class=\"active\"" : "" ?>><a href="<?php echo url_for('perfil/exibirAmigos?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-user"></span> Amigos</a></li>
        <li  <?php echo ($opcao == "informacao") ? "class=\"active\"" : "" ?>><a href="<?php echo url_for('perfil/informacao?u=' . $usuario->getIdUsuario()) ?>"><span class="icon-gray icon-info-sign"></span> Informações</a></li>
    </ul>
</div><!-- /sidebar -->

<div class="modal fade" id="modalIgnore">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Ignorar</h3>
    </div>
    <div class="modal-body">
        <p>Você não verá mais as atualizações de <strong><?php echo $usuario->getNome(); ?></strong>. Tem certeza de que deseja ignorar seu conteúdo?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for("perfil/ignorar?u=" . $usuario->getIdUsuario()) ?>" class="btn btn-danger">Ignorar</a> <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
    </div>
</div>

<?php if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO) { ?>
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Adicionar amigo</h3>
    </div>
    <div class="modal-body">
        <p>Tem certeza de que deseja adicionar <strong><?php echo $usuario->getNome(); ?></strong> como amigo?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for('perfil/solicitarAmizade?u='.$usuario->getIdUsuario()) ?>" class="btn btn-primary">Adicionar</a> <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 
    </div>
</div>
<?php } else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::AGUARDANDO_CONFIRMACAO) { ?>
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Responder solicitação</h3>
    </div>
    <div class="modal-body">
        <p>Deseja aceitar a solicitação de amizade de <strong><?php echo $usuario->getNome(); ?></strong>?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for('perfil/aceitarSolicitacao') . "?u=" . $usuario->getIdUsuario() ?>" class="btn btn-primary">Aceitar</a> 
        <a href="<?php echo url_for('perfil/recusarSolicitacao') . "?u=" . $usuario->getIdUsuario() ?>" class="btn btn-danger">Rejeitar</a> 
        <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
    </div>
</div>
<?php }else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::AMIGO) { ?>
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Remover Amigo</h3>
    </div>
    <div class="modal-body">
        <p>Deseja remover <strong><?php echo $usuario->getNome(); ?></strong> dos seus amigos?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for('perfil/removerAmigo') . "?u=" . $usuario->getIdUsuario() ?>" class="btn btn-danger">Remover</a> 
        <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
    </div>
</div>
<?php
}
?>