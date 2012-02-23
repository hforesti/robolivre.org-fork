<?php

/**
 * DiariosBordo form base class.
 *
 * @method DiariosBordo getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDiariosBordoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_diario_bordo'  => new sfWidgetFormInputHidden(),
      'id_conteudo'      => new sfWidgetFormInputHidden(),
      'id_conjunto'      => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
      'id_usuario'       => new sfWidgetFormInputText(),
      'nome'             => new sfWidgetFormInputText(),
      'descricao'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_diario_bordo'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_diario_bordo')), 'empty_value' => $this->getObject()->get('id_diario_bordo'), 'required' => false)),
      'id_conteudo'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo')), 'empty_value' => $this->getObject()->get('id_conteudo'), 'required' => false)),
      'id_conjunto'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_usuario'       => new sfValidatorInteger(),
      'nome'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descricao'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('diarios_bordo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DiariosBordo';
  }

}
