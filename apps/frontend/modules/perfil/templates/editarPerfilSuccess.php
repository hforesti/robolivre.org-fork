<div class="row">

    <?php include_partial('sidebarUsuarioLogado') ?>

    <hr class="only-mobile">

    <div class="span10">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for('perfil/index') ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('perfil/exibir?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><?php echo UsuarioLogado::getInstancia()->getNome(); ?></a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('perfil/informacao?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Informações sobre <?php echo Util::getNomeSimplificado(UsuarioLogado::getInstancia()->getNome()); ?></a> <span class="divider">/</span>
            </li>
            <li class="active">
                Editar perfil
            </li>
        </ul>


        <?php include_partial('formUsuario', array('form' => $formUsuario)) ?>



    </div><!-- /miolo -->


</div><!-- /row -->