<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('conteudo/publicar'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Publicar" />
          <?php if(isset($id_publicacao_original) && isset ($id_usuario_original)){ ?>
          <input type="hidden" name="id_publicacao_original" value="<?php echo $id_publicacao_original ?>" />
          <input type="hidden" name="id_usuario_original" value="<?php echo $id_usuario_original ?>" />
          <?php } ?>
          <?php if(isset ($id_conjunto)){ ?>
            <input type="hidden" name="id_conjunto" value="<?php echo $id_conjunto ?>" />
          <?php } ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
