<?php

/**
 * ParticipantesConjuntos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParticipantesConjuntosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aceito'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'aceito'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('participantes_conjuntos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ParticipantesConjuntos';
  }

  public function getFields()
  {
    return array(
      'id_usuario'                 => 'Number',
      'id_conjunto'                => 'Number',
      'id_tipo_conjunto'           => 'Number',
      'id_tipo_permissao_conjunto' => 'Number',
      'aceito'                     => 'Number',
    );
  }
}
