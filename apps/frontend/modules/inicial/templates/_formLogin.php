<form id="login-form-standalone" class="form-horizontal" action="<?php echo url_for('inicial/login'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <fieldset>
    <div class="control-group">
        <label class="control-label" for="login">E-mail ou usuário</label>
        <div class="controls">
            <?php echo $form->getWidget('login')->render($form->getName() . "[login]", null, array('class'=>'input-xlarge','id' => 'login', 'placeholder' => "Seu e-mail ou usuário", 'tabindex' => "1")); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="login-pass">Senha</label>
        <div class="controls">
            <?php echo $form->getWidget('senha')->render($form->getName() . "[senha]", null, array('class'=>'input-xlarge','type'=>"password",'id' => 'login-pass', 'placeholder' => "Sua senha", 'tabindex' => "2")); ?>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox" name="lembrar" value="1" tabindex="3">
                lembrar-me
                <div class="help-block">Não estou em um computador público</div>
            </label>
        </div>
    </div>
    <input type="hidden" name="tp_frm" value="<?php  echo $form->getTipoFormulario(); ?>" />
    <input type="hidden" name="ultima_pagina" value="<?php echo $ultimaPagina ?>" />

    <div class="form-actions">
        <input value="entrar" type="submit" class="btn btn-primary btn-large" tabindex="4" />
    </div>
        <?php echo $form->renderHiddenFields() ?>
    </fieldset>
</form>
