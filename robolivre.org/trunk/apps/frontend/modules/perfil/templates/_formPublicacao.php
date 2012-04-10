<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if (!isset($id_publicacao_original) || !isset($id_usuario_original)) { ?>
<form id="form-status" action="<?php echo url_for('perfil/publicar'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab-status" data-toggle="tab">Atualizar status</a></li>
  <li><a href="#tab-foto" data-toggle="tab" title="Adicionar Foto"><i class="icon-picture"></i></a></li>
  <li><a href="#tab-video" data-toggle="tab" title="Adicionar Vídeo"><i class="icon-film"></i></a></li>
  <li><a href="#tab-link" data-toggle="tab" title="Adicionar Link"><i class="icon-share-alt icon-gray-alt"></i></a></li>
</ul>

<fieldset class="tab-content ">
	<div class="tab-pane active fade in" id="tab-status">
	</div>
	
	<div class="tab-pane fade in" id="tab-foto">
		<input class="input-file" id="fileInput" type="file">
	</div>
	
	<div class="tab-pane fade in" id="tab-video">
	<div class="alert alert-error fade in">
	<a class="close" data-dismiss="alert" href="#">×</a>
		Nossos robôs não identificaram o link como sendo do YouTube. Por favor tente novamente.
	</div>

		<input type="text" class="span7" id="input02" placeholder="Endereço do vídeo do YouTube. Ex.: http://youtube.com/watch?v=Nem-KvCsODw">
	</div>
	
	<div class="tab-pane fade in" id="tab-link">
		<input type="text" class="span7" id="input03" placeholder="Endereço do link. Ex.: http://robolivre.org">
	</div>

</fieldset>

<fieldset>
        
        <?php echo $form->renderHiddenFields() ?>
        <?php if (isset($id_usuario_referencia)) { ?>
            <input type="hidden" name="id_usuario_referencia" value="<?php echo $id_usuario_referencia ?>" />
        <?php } ?>
        <?php echo $form->getWidget('comentario')->render($form->getName() . "[comentario]", null, array('class'=>"input-xlarge span7",'id' => 'status','rows'=>"3", 'placeholder' => "O que você tem pesquisado sobre os robôs?",'tabindex'=>"1")); ?>
	
</fieldset>

	<button type="submit" class="btn btn-primary" id="send" tabindex="2">Publicar</button>

		<select name="privacidade_publicacao" id="privacidade-status">
                    <option value="<?php echo Publicacoes::PRIVACIDADE_PUBLICA ?>">Público</option>
                    <option value="<?php echo Publicacoes::PRIVACIDADE_SOMENTE_AMIGOS ?>">Só para amigos</option>
                </select>

</form>


<?php }else{ ?>
<form action="<?php echo url_for('perfil/publicar'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php echo $form->renderHiddenFields() ?>
    <?php if (isset($id_publicacao_original) && isset($id_usuario_original)) { ?>
        <input type="hidden" name="id_publicacao_original" value="<?php echo $id_publicacao_original ?>" />
        <input type="hidden" name="id_usuario_original" value="<?php echo $id_usuario_original ?>" />
    <?php } ?>
    <?php if (isset($id_usuario_referencia)) { ?>
        <input type="hidden" name="id_usuario_referencia" value="<?php echo $id_usuario_referencia ?>" />
    <?php } ?>
    <img src="/assets/img/rl/avatar-20.jpg" alt="Rodrigo Medeiros" class="photo">
    <?php echo $form->getWidget('comentario')->render($form->getName() . "[comentario]", null, array('class'=>"textarea-comment",'id' => 'comentario','rows'=>"1", 'placeholder' => "Escreva um comentário")); ?>
    <input type="submit" class="btn btn-mini" value="Publicar" />
</form>

<?php }?>