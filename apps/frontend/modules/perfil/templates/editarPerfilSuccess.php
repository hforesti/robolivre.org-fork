<div class="row">

    <?php include_partial('sidebarUsuarioLogado') ?>

    <hr class="only-mobile">

    <div class="span10">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for('perfil/index') ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('perfil/exibir?u=' . UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><?php echo UsuarioLogado::getInstancia()->getNome(); ?></a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('perfil/informacao?u=' . UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Informações sobre <?php echo Util::getNomeSimplificado(UsuarioLogado::getInstancia()->getNome()); ?></a> <span class="divider">/</span>
            </li>
            <li class="active">
                Editar perfil
            </li>
        </ul>

        <fieldset>
            <legend>Configurações e imagem</legend>
            <div class="control-group">
                <a href="<?php echo url_for('perfil/configuracoes') ?>" class="btn btn-mini"><i class="icon-cog icon-gray"></i> Alterar senha, nome e configurações</a> 
                <a href="<?php echo url_for('perfil/atualizarFoto') ?>" class="btn btn-mini"><i class="icon-picture icon-gray"></i> Alterar minha imagem</a>
            </div>
        </fieldset>
        
        <?php include_partial('formEditarUsuario', array('form' => $formUsuario)) ?>



    </div><!-- /miolo -->


</div><!-- /row -->