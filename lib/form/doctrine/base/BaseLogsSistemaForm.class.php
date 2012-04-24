<?php

/**
 * LogsSistema form base class.
 *
 * @method LogsSistema getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLogsSistemaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_log_sistema'  => new sfWidgetFormInputHidden(),
      'id_usuario'      => new sfWidgetFormInputHidden(),
      'descricao'       => new sfWidgetFormInputText(),
      'parametros'      => new sfWidgetFormInputText(),
      'tipo_log'        => new sfWidgetFormInputText(),
      'data_publicacao' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_log_sistema'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_log_sistema')), 'empty_value' => $this->getObject()->get('id_log_sistema'), 'required' => false)),
      'id_usuario'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'descricao'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parametros'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tipo_log'        => new sfValidatorInteger(array('required' => false)),
      'data_publicacao' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('logs_sistema[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogsSistema';
  }

}
