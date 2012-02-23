<?php

/**
 * ParticipantesConjuntos form base class.
 *
 * @method ParticipantesConjuntos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParticipantesConjuntosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'                 => new sfWidgetFormInputHidden(),
      'id_conjunto'                => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto'           => new sfWidgetFormInputHidden(),
      'id_tipo_permissao_conjunto' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_usuario'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_conjunto'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'id_tipo_conjunto'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_tipo_permissao_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_permissao_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_permissao_conjunto'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('participantes_conjuntos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ParticipantesConjuntos';
  }

}
