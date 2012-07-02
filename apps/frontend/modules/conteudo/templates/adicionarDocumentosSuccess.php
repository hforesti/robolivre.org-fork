<?php
$slug = Util::criaSlug($conteudo->getNome());
?>
<div class="row">

    <?php include_partial('sidebarConteudo', array('conteudo' => $conteudo, 'quantidadeParticipantes' => $quantidadeParticipantes, 'opcao' => "documentos")) ?>


    <hr class="only-mobile">

    <div class="span10">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for("perfil/index") ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for("conteudos/index") ?>">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('conteudo/') . $slug; ?>"><?php echo $conteudo->getNome() ?></a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('conteudo/') . $slug . "/exibirDocumentos"; ?>">Documentos</a> <span class="divider">/</span>
            </li>
            <li class="active">
                Adicionar documento
            </li>
        </ul>

<?php include_partial('formDocumento', array('form' => $formDocumento, 'conteudo'=>$conteudo)); ?>
        

    </div><!-- /miolo -->


</div><!-- /row -->
