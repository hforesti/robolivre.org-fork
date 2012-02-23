<br/>
<br/>
<br/>
<br/>
<br/>

<?php echo image_tag("/images/usuarioSemFoto.png"); ?>
<h2><?php echo $usuario->getNome(); ?></h2>
<a href="<?php echo url_for('perfil/informacao')."?u=".$usuario->getIdUsuario()?>">Informações</a>
<?php if($usuario->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO){?>
    <a href="<?php echo url_for('perfil/solicitarAmizade')."?u=".$usuario->getIdUsuario()?>">Solicitar amizade</a>
<?php }else if($usuario->getTipoSolicitacaoAmizade() == Usuarios::AMIGO){ ?>
    <a>é amigo já!</a>
<?php }else if($usuario->getTipoSolicitacaoAmizade() == Usuarios::SOLICITADA_AMIZADE){ ?>
    <a>Seu pedido de amizade já foi enviado!</a>
<?php }else if($usuario->getTipoSolicitacaoAmizade() == Usuarios::AGUARDANDO_CONFIRMACAO){ ?>
    <a>Aguardando confirmação! Deseja confirmar?</a>
    <a href="<?php echo url_for('perfil/aceitarSolicitacao')."?u=".$usuario->getIdUsuario() ?>"> Aceitar</a>- 
    <a href="<?php echo url_for('perfil/recusarSolicitacao')."?u=".$usuario->getIdUsuario() ?>">Recusar</a>
<?php } ?>

    
    
    
    <div id="qualquercoisa" style="border-style:solid;border-color:black;">
        
        <?php include_partial('formPublicacao', array('form' => $formPublicacao,'id_usuario_referencia' => ($usuario->getTipoSolicitacaoAmizade() != Usuarios::PROPRIO_USUARIO)?$usuario->getIdUsuario(): null)) ?>
        <?php foreach($publicacoesPerfil as $publicacao){ ?>
        <div id="qualquercoisa" style="border-style:solid;border-color:#66f;">
            <a href="<?php echo url_for('perfil/index?u='.$publicacao->getIdUsuario()); ?>"><?php echo $publicacao->getNomeUsuario(); ?></a> - <?php echo $publicacao->getComentario(); ?> (<?php echo $publicacao->getDataPublicacao(); ?>)
            <br/>
            <?php foreach($publicacao->getComentarios() as  $comentario){ ?>
            &Tab;&Rightarrow; <a href="<?php echo url_for('perfil/index?u='.$comentario->getIdUsuario()); ?>"><?php echo $comentario->getNomeUsuario(); ?></a> - <?php echo $comentario->getComentario(); ?>
                <br/>
            <?php }?>
        <?php   include_partial('formPublicacao', array('form' => $formPublicacao, 
                        'id_publicacao_original' => $publicacao->getIdPublicacao(),
                        'id_usuario_original' => $publicacao->getIdUsuario()));
               ?>
        </div>
        <br/>
        <?php }?>
    </div>

