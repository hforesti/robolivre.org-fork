<?php

/**
 * SuperTipos form base class.
 *
 * @method SuperTipos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSuperTiposForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_super_tipo' => new sfWidgetFormInputHidden(),
      'nome'          => new sfWidgetFormInputText(),
      'descricao'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_super_tipo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_super_tipo')), 'empty_value' => $this->getObject()->get('id_super_tipo'), 'required' => false)),
      'nome'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'descricao'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('super_tipos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuperTipos';
  }

}
