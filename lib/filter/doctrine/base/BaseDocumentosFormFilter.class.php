<?php

/**
 * Documentos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome_arquivo'       => new sfWidgetFormFilterInput(),
      'is_codigo_fonte'    => new sfWidgetFormFilterInput(),
      'repositorio_github' => new sfWidgetFormFilterInput(),
      'ordenacao'          => new sfWidgetFormFilterInput(),
      'nome_documento'     => new sfWidgetFormFilterInput(),
      'hits'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nome_arquivo'       => new sfValidatorPass(array('required' => false)),
      'is_codigo_fonte'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'repositorio_github' => new sfValidatorPass(array('required' => false)),
      'ordenacao'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome_documento'     => new sfValidatorPass(array('required' => false)),
      'hits'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('documentos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentos';
  }

  public function getFields()
  {
    return array(
      'id_documento'       => 'Number',
      'id_usuario'         => 'Number',
      'id_pasta'           => 'Number',
      'nome_arquivo'       => 'Text',
      'is_codigo_fonte'    => 'Number',
      'repositorio_github' => 'Text',
      'ordenacao'          => 'Number',
      'nome_documento'     => 'Text',
      'hits'               => 'Number',
    );
  }
}
