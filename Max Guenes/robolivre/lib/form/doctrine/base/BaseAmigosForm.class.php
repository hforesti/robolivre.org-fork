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
abstract class BaseAmigosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario_a' => new sfWidgetFormInputHidden(),
      'id_usuario_b' => new sfWidgetFormInputHidden(),
      'aceito'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_usuario_a' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario_a')), 'empty_value' => $this->getObject()->get('id_usuario_a'), 'required' => false)),
      'id_usuario_b' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario_b')), 'empty_value' => $this->getObject()->get('id_usuario_b'), 'required' => false)),
      'aceito'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('amigos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Amigos';
  }

}
