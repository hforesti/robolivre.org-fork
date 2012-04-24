<?php

/**
 * LogsSistema filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLogsSistemaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descricao'       => new sfWidgetFormFilterInput(),
      'parametros'      => new sfWidgetFormFilterInput(),
      'tipo_log'        => new sfWidgetFormFilterInput(),
      'data_publicacao' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'descricao'       => new sfValidatorPass(array('required' => false)),
      'parametros'      => new sfValidatorPass(array('required' => false)),
      'tipo_log'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'data_publicacao' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('logs_sistema_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogsSistema';
  }

  public function getFields()
  {
    return array(
      'id_log_sistema'  => 'Number',
      'id_usuario'      => 'Number',
      'descricao'       => 'Text',
      'parametros'      => 'Text',
      'tipo_log'        => 'Number',
      'data_publicacao' => 'Date',
    );
  }
}
