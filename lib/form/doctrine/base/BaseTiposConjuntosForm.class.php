<?php

/**
 * TiposConjuntos form base class.
 *
 * @method TiposConjuntos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTiposConjuntosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
      'nome'             => new sfWidgetFormInputText(),
      'descricao'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'nome'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descricao'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipos_conjuntos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TiposConjuntos';
  }

}
