<?php

/**
 * ArquivosAnexos form base class.
 *
 * @method ArquivosAnexos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArquivosAnexosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pasta'         => new sfWidgetFormInputHidden(),
      'id_usuario'       => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
      'id_conjunto'      => new sfWidgetFormInputHidden(),
      'id_video'         => new sfWidgetFormInputText(),
      'id_imagem'        => new sfWidgetFormInputText(),
      'id_documento'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_pasta'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_pasta')), 'empty_value' => $this->getObject()->get('id_pasta'), 'required' => false)),
      'id_usuario'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_conjunto'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'id_video'         => new sfValidatorInteger(),
      'id_imagem'        => new sfValidatorInteger(),
      'id_documento'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('arquivos_anexos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArquivosAnexos';
  }

}
