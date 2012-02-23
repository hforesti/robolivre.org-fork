<?php

/**
 * Conteudos form base class.
 *
 * @method Conteudos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConteudosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conteudo'             => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto'        => new sfWidgetFormInputHidden(),
      'id_conjunto'             => new sfWidgetFormInputHidden(),
      'id_super_tipo'           => new sfWidgetFormInputText(),
      'nome'                    => new sfWidgetFormInputText(),
      'descricao'               => new sfWidgetFormTextarea(),
      'enviar_email_criador'    => new sfWidgetFormInputText(),
      'nome_repositorio_github' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_conteudo'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo')), 'empty_value' => $this->getObject()->get('id_conteudo'), 'required' => false)),
      'id_tipo_conjunto'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
      'id_conjunto'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
      'id_super_tipo'           => new sfValidatorInteger(),
      'nome'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'descricao'               => new sfValidatorString(array('required' => false)),
      'enviar_email_criador'    => new sfValidatorInteger(array('required' => false)),
      'nome_repositorio_github' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('conteudos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conteudos';
  }

}
