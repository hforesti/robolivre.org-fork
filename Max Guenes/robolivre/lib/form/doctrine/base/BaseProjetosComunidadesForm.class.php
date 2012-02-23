<?php

/**
 * ProjetosComunidades form base class.
 *
 * @method ProjetosComunidades getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProjetosComunidadesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conjunto_comunidade'      => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto_comunidade' => new sfWidgetFormInputHidden(),
      'id_comunidade'               => new sfWidgetFormInputHidden(),
      'id_conjunto_conteudo'        => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto_conteudo'   => new sfWidgetFormInputHidden(),
      'id_conteudo'                 => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_conjunto_comunidade'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto_comunidade')), 'empty_value' => $this->getObject()->get('id_conjunto_comunidade'), 'required' => false)),
      'id_tipo_conjunto_comunidade' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto_comunidade')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto_comunidade'), 'required' => false)),
      'id_comunidade'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_comunidade')), 'empty_value' => $this->getObject()->get('id_comunidade'), 'required' => false)),
      'id_conjunto_conteudo'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto_conteudo')), 'empty_value' => $this->getObject()->get('id_conjunto_conteudo'), 'required' => false)),
      'id_tipo_conjunto_conteudo'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto_conteudo')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto_conteudo'), 'required' => false)),
      'id_conteudo'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo')), 'empty_value' => $this->getObject()->get('id_conteudo'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('projetos_comunidades[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjetosComunidades';
  }

}
