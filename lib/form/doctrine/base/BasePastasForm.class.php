<?php

/**
 * Pastas form base class.
 *
 * @method Pastas getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePastasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pasta'         => new sfWidgetFormInputHidden(),
      'id_usuario'       => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto' => new sfWidgetFormInputText(),
      'id_conjunto'      => new sfWidgetFormInputText(),
      'nome'             => new sfWidgetFormInputText(),
      'descricao'        => new sfWidgetFormInputText(),
      'tipo_pasta'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_pasta'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_pasta')), 'empty_value' => $this->getObject()->get('id_pasta'), 'required' => false)),
      'id_usuario'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_tipo_conjunto' => new sfValidatorInteger(array('required' => false)),
      'id_conjunto'      => new sfValidatorInteger(array('required' => false)),
      'nome'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'descricao'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tipo_pasta'       => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('pastas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pastas';
  }

}
