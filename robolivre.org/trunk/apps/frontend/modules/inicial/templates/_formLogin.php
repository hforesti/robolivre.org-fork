<form id="login-form" class="form-inline"  action="<?php echo url_for('inicial/login'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    
    <?php echo $form->getWidget('login')->render($form->getName() . "[login]", null, array('id' => 'login', 'placeholder' => "e-mail ou usuário", 'tabindex' => "1")); ?>
    <?php echo $form->getWidget('senha')->render($form->getName() . "[senha]", null, array('id' => 'login-pass', 'placeholder' => "senha", 'tabindex' => "2")); ?>
    <?php echo $form->renderHiddenFields() ?>


    <input type="hidden" name="tp_frm" value="<?php $form->getTipoFormulario(); ?>" />
    <input type="submit" value="Entrar" />
    <ul class="extras">
        <li id="lembrar"><label class="checkbox">
                <input type="checkbox" name="lembrar" value="1" tabindex="3">
                lembrar-me
            </label></li>
        <li id="esqueci"><a href="esqueci.shtml">Esqueceu sua senha?</a></li>
    </ul>
</form>
