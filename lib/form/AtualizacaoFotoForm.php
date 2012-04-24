<?php

/**
 * Amigos form base class.
 *
 * @method Amigos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class AtualizacaoFotoForm extends BaseForm
{
  public function setup()
  {
    $this->setWidgets(array(
      'arquivo'    => new sfWidgetFormInputFile(),
    ));

    $this->setValidators(array(
      'arquivo'    => new sfValidatorFile(),
    ));

    $this->widgetSchema->setNameFormat('upload_foto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
