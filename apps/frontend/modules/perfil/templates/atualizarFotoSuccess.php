<div class="row">
    
    <?php include_partial('sidebarUsuarioLogado') ?>

    <hr class="only-mobile">

    <div class="span7">

        <div id="stream" class="tabbable">

            <div class="tab-content">
                <ul class="nav nav-tabs pull-right" id="tabs-home">
                    <li class="no-link">
                        <h6>Atualizar foto: </h6>
                    </li>
                </ul>
                <?php if(isset($imagem)){ ?>
                    <img src="<?php echo image_path($imagem); ?>" class="photo">
                    <a href="<?php echo url_for('perfil/confirmarFotoPerfil?arq='.$nome_arquivo) ?>">CONFIRMAR</a>
                <?php } ?>
                <form action="<?php echo url_for('perfil/previaFoto'); ?>" method="post" enctype="multipart/form-data">
                    <div id="div-nome" class="control-group">
                        <label class="control-label" for="nome">Nome e Sobrenome</label>
                        <div class="controls">
                            <?php echo $formUpload ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-large">Concluir Cadastro</button>

                </form>
            </div>
        </div>
    </div>
    <div class="span3" id="sidebar-wdgt">

    </div><!-- /aside -->
</div>