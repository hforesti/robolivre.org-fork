<?php

/**
 * Conteudos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConteudosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_super_tipo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nome'                    => new sfWidgetFormFilterInput(),
      'descricao'               => new sfWidgetFormFilterInput(),
      'enviar_email_criador'    => new sfWidgetFormFilterInput(),
      'nome_repositorio_github' => new sfWidgetFormFilterInput(),
      'tema_aula'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_super_tipo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome'                    => new sfValidatorPass(array('required' => false)),
      'descricao'               => new sfValidatorPass(array('required' => false)),
      'enviar_email_criador'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome_repositorio_github' => new sfValidatorPass(array('required' => false)),
      'tema_aula'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('conteudos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conteudos';
  }

  public function getFields()
  {
    return array(
      'id_conteudo'             => 'Number',
      'id_tipo_conjunto'        => 'Number',
      'id_conjunto'             => 'Number',
      'id_super_tipo'           => 'Number',
      'nome'                    => 'Text',
      'descricao'               => 'Text',
      'enviar_email_criador'    => 'Number',
      'nome_repositorio_github' => 'Text',
      'tema_aula'               => 'Number',
    );
  }
}
