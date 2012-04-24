<?php

/**
 * TagsConteudos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTagsConteudosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conteudo_referenciado'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_conjunto_referenciado'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_conjunto_referenciado' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nome_conteudo_inexistente'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_conteudo_referenciado'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_conjunto_referenciado'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_conjunto_referenciado' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome_conteudo_inexistente'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags_conteudos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagsConteudos';
  }

  public function getFields()
  {
    return array(
      'id_conteudo_referencia'        => 'Number',
      'id_conjunto_referencia'        => 'Number',
      'id_tipo_conjunto_referencia'   => 'Number',
      'id_tag_conteudo'               => 'Number',
      'id_conteudo_referenciado'      => 'Number',
      'id_conjunto_referenciado'      => 'Number',
      'id_tipo_conjunto_referenciado' => 'Number',
      'nome_conteudo_inexistente'     => 'Text',
    );
  }
}
