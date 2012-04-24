<?php

/**
 * Pastas filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePastasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo_conjunto' => new sfWidgetFormFilterInput(),
      'id_conjunto'      => new sfWidgetFormFilterInput(),
      'nome'             => new sfWidgetFormFilterInput(),
      'descricao'        => new sfWidgetFormFilterInput(),
      'tipo_pasta'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_tipo_conjunto' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_conjunto'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome'             => new sfValidatorPass(array('required' => false)),
      'descricao'        => new sfValidatorPass(array('required' => false)),
      'tipo_pasta'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('pastas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pastas';
  }

  public function getFields()
  {
    return array(
      'id_pasta'         => 'Number',
      'id_usuario'       => 'Number',
      'id_tipo_conjunto' => 'Number',
      'id_conjunto'      => 'Number',
      'nome'             => 'Text',
      'descricao'        => 'Text',
      'tipo_pasta'       => 'Number',
    );
  }
}
