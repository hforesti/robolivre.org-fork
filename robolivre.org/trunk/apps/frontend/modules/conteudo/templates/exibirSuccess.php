<?php echo image_tag("/images/usuarioSemFoto.png"); ?>
<h2><?php echo $conteudo->getNome(); ?></h2>
<br/>
<?php echo "Criada por " ?><a href="<?php echo url_for('perfil/index?u='.$conteudo->getConjunto()->getIdUsuario()); ?>"><?php echo $conteudo->getNomeProprietario(); ?></a>
<br />
<?php
if ($conteudo->getTipoUsuario() != Conteudos::PROPRIETARIO) {
    if ($conteudo->getTipoSolicitacao() == Conteudos::SEM_SOLICITACAO) {
        ?>
        <a href="<?php echo url_for('conteudo/solicitarParticipacao') . "?u=" . $conteudo->getIdConjunto() ?>">Seguir Conteudo</a>
    <?php } else if ($conteudo->getTipoSolicitacao() == Conteudos::PARTICIPANTE) { ?>
        <a>Participante!</a>
    <?php } else if ($conteudo->getTipoSolicitacao() == Conteudos::SOLICITADA_PARTICIPACAO) { ?>
        <a>Seu pedido de participação já foi enviado!</a>
    <?php }
}
?>

<div id="qualquercoisa" style="border-style:solid;border-color:black;">
<?php echo $conteudo->getDescricao(); ?>
</div>

        <br/>
        <br/>
         <div id="qualquercoisa" style="border-style:solid;border-color:black;">
        
        <?php include_partial('formPublicacao', array('form' => $formPublicacao,'id_conjunto' => $conteudo->getIdConjunto())) ?>
        <?php foreach($publicacoesConjunto as $publicacao){ ?>
        <div id="qualquercoisa" style="border-style:solid;border-color:#66f;">
            <a href="<?php echo url_for('perfil/index?u='.$publicacao->getIdUsuario()); ?>"><?php echo $publicacao->getNomeUsuario(); ?></a> - <?php echo $publicacao->getComentario(); ?> (<?php echo $publicacao->getDataPublicacao(); ?>)
            <br/>
            <?php foreach($publicacao->getGrupoComentarios() as  $comentario){ ?>
            &Tab;&Rightarrow; <a href="<?php echo url_for('perfil/index?u='.$comentario->getIdUsuario()); ?>"><?php echo $comentario->getNomeUsuario(); ?></a> - <?php echo $comentario->getComentario(); ?>
                <br/>
            <?php }?>
        <?php   include_partial('formPublicacao', array('form' => $formPublicacao, 
                        'id_publicacao_original' => $publicacao->getIdPublicacao(),
                        'id_usuario_original' => $publicacao->getIdUsuario(),
                        'id_conjunto' => $conteudo->getIdConjunto()));
               ?>
        </div>
        <br/>
        <?php }?>
    </div>