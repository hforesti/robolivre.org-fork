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
      'id_conjunto_referencia'        => new sfWidgetFormInputHidden(),
      'id_tipo_conjunto_referencia'   => new sfWidgetFormInputHidden(),
      'id_tag_conteudo'               => new sfWidgetFormInputHidden(),
      'id_conteudo_referenciado'      => new sfWidgetFormInputText(),
      'id_conjunto_referenciado'      => new sfWidgetFormInputText(),
      'id_tipo_conjunto_referenciado' => new sfWidgetFormInputText(),
      'nome_conteudo_inexistente'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_conteudo_referencia'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo_referencia')), 'empty_value' => $this->getObject()->get('id_conteudo_referencia'), 'required' => false)),
      'id_conjunto_referencia'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto_referencia')), 'empty_value' => $this->getObject()->get('id_conjunto_referencia'), 'required' => false)),
      'id_tipo_conjunto_referencia'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto_referencia')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto_referencia'), 'required' => false)),
      'id_tag_conteudo'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tag_conteudo')), 'empty_value' => $this->getObject()->get('id_tag_conteudo'), 'required' => false)),
      'id_conteudo_referenciado'      => new sfValidatorInteger(),
      'id_conjunto_referenciado'      => new sfValidatorInteger(),
      'id_tipo_conjunto_referenciado' => new sfValidatorInteger(),
      'nome_conteudo_inexistente'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
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
