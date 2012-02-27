<?php

/**
 * TagsConteudos form base class.
 *
 * @method TagsConteudos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTagsConteudosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conteudo_referencia'        => new sfWidgetFormInputHidden(),
      'id_conteudo_referenciado'      => new sfWidgetFormInputHidden(),
      'id_conjunto_referencia'        => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto_referencia'   => new sfWidgetFormInputHidden(),
      'id_conjunto_referenciado'      => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto_referenciado' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_conteudo_referencia'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo_referencia')), 'empty_value' => $this->getObject()->get('id_conteudo_referencia'), 'required' => false)),
      'id_conteudo_referenciado'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo_referenciado')), 'empty_value' => $this->getObject()->get('id_conteudo_referenciado'), 'required' => false)),
      'id_conjunto_referencia'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto_referencia')), 'empty_value' => $this->getObject()->get('id_conjunto_referencia'), 'required' => false)),
      'id_tipo_conjunto_referencia'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto_referencia')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto_referencia'), 'required' => false)),
      'id_conjunto_referenciado'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto_referenciado')), 'empty_value' => $this->getObject()->get('id_conjunto_referenciado'), 'required' => false)),
      'id_tipo_conjunto_referenciado' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto_referenciado')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto_referenciado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags_conteudos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagsConteudos';
  }

}
