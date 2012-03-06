<form id="cadastro-form" action="<?php echo url_for('inicial/cadastro'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <h3>Novo na Robô Livre? <small>Inscreva-se hoje!</small></h3>
        
    <?php echo $form->getWidget('nome')->render($form->getName()."[nome]", null, array('id' => 'nome', 'placeholder' => "Nome e Sobrenome", 'tabindex' => "5",'class' => 'span4')); ?>
    <?php echo $form->getWidget('login')->render($form->getName()."[login]", null, array('id' => 'user-name', 'placeholder' => "Nome de usuário", 'tabindex' => "6",'class'=>'span3')); ?>
    <?php echo $form->getWidget('email')->render($form->getName()."[email]", null, array('type' => 'email','id' => 'email', 'placeholder' => "E-mail", 'tabindex' => "7",'class'=>'span3')); ?>
    
    <?php echo $form->renderHiddenFields() ?>
    
    <?php //echo $form ?>

    <input type="hidden" name="tp_frm" value="<?php $form->getTipoFormulario(); ?>" />
    <input type="submit" value="Cadastrar" class="btn btn-primary" tabindex="8"  />

</form>