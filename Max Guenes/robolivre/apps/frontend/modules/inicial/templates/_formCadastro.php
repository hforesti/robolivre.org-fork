<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('inicial/create'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="hidden" name="tp_frm" value="<?php $form->getTipoFormulario(); ?>" />
          <input type="submit" value="Cadastrar" />
          <input type="button" value="Voltar" onclick="window.location = <?php echo url_for("inicial/index") ?>">
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
