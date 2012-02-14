<?php

/**
 * DiariosBordo filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDiariosBordoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nome'             => new sfWidgetFormFilterInput(),
      'descricao'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_usuario'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome'             => new sfValidatorPass(array('required' => false)),
      'descricao'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('diarios_bordo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DiariosBordo';
  }

  public function getFields()
  {
    return array(
      'id_diario_bordo'  => 'Number',
      'id_conteudo'      => 'Number',
      'id_conjunto'      => 'Number',
      'id_tipo_conjunto' => 'Number',
      'id_usuario'       => 'Number',
      'nome'             => 'Text',
      'descricao'        => 'Text',
    );
  }
}
