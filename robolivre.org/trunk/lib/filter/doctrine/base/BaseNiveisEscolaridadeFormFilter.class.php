<?php

/**
 * NiveisEscolaridade filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNiveisEscolaridadeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome'                  => new sfWidgetFormFilterInput(),
      'descricao'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nome'                  => new sfValidatorPass(array('required' => false)),
      'descricao'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('niveis_escolaridade_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NiveisEscolaridade';
  }

  public function getFields()
  {
    return array(
      'id_nivel_escolaridade' => 'Number',
      'nome'                  => 'Text',
      'descricao'             => 'Text',
    );
  }
}
