<?php

/**
 * Comunidades form base class.
 *
 * @method Comunidades getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComunidadesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_comunidade'    => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
      'id_conjunto'      => new sfWidgetFormInputHidden(),
      'nome'             => new sfWidgetFormInputText(),
      'descricao'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_comunidade'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_comunidade')), 'empty_value' => $this->getObject()->get('id_comunidade'), 'required' => false)),
      'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_conjunto'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'nome'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descricao'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comunidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comunidades';
  }

}
