<?php

/**
 * Conjuntos form base class.
 *
 * @method Conjuntos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConjuntosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conjunto'      => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
      'id_usuario'       => new sfWidgetFormInputText(),
      'imagem_perfil'    => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_conjunto'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_usuario'       => new sfValidatorInteger(),
      'imagem_perfil'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('conjuntos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conjuntos';
  }

}
