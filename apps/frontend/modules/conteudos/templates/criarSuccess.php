<div class="row">

    <hr class="only-mobile">

    <div class="span7 offset1">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for("perfil/index") ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for("conteudos/index") ?>">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li class="active">
                Criar conteúdo
            </li>
        </ul>


        <div class="page-header">
            <h1>Criar conteúdo</h1>
            <!-- <h1>Editar conteúdo</h1> -->
        </div>

        <?php if(isset($nomeConteudoErro)){ ?>
        <div class="alert">
            <?php echo Util::getTagConteudo($nomeConteudoErro) ?> é um conteúdo que já existe na nossa rede. <br>Deseja colaborar com ele? <?php echo Util::getTagConteudoSlug("<strong>Acesse agora</strong>",$nomeConteudoErro) ?>.
        </div>
        <?php } ?>

        <?php include_partial('formConteudo', array('form' => $formConteudo,'nomeConteudo' => $nomeConteudo,'tags'=>$tags)); ?>

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div class="alert">
            <h6>Notas:</h6>
            <ol>
                <li>Seus amigos poderão editar este conteúdo para colaborar e agregar conhecimento.</li>

                <li>O conteúdo aqui postado estará sob a licença: <a href="http://creativecommons.org/licenses/by-sa/3.0/deed.pt">Atribuição-Partilha nos Mesmos Termos 3.0 não Adaptada (CC BY-SA 3.0)</a>.</li>
            </ol>
        </div>

    </div><!-- /aside -->

</div><!-- /row -->
