<?php

/**
 * TiposPermissoesConjuntos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTiposPermissoesConjuntosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome'                       => new sfWidgetFormFilterInput(),
      'descricao'                  => new sfWidgetFormFilterInput(),
      'prioridade'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nome'                       => new sfValidatorPass(array('required' => false)),
      'descricao'                  => new sfValidatorPass(array('required' => false)),
      'prioridade'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tipos_permissoes_conjuntos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TiposPermissoesConjuntos';
  }

  public function getFields()
  {
    return array(
      'id_tipo_permissao_conjunto' => 'Number',
      'id_tipo_conjunto'           => 'Number',
      'nome'                       => 'Text',
      'descricao'                  => 'Text',
      'prioridade'                 => 'Number',
    );
  }
}
