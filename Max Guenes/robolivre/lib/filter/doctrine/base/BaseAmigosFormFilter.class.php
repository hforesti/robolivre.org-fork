<?php

/**
 * Amigos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAmigosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aceito'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'aceito'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('amigos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Amigos';
  }

  public function getFields()
  {
    return array(
      'id_usuario_a' => 'Number',
      'id_usuario_b' => 'Number',
      'aceito'       => 'Number',
    );
  }
}
