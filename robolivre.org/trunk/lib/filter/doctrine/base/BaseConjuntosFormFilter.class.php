<?php

/**
 * Conjuntos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConjuntosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imagem_perfil'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_usuario'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'imagem_perfil'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('conjuntos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conjuntos';
  }

  public function getFields()
  {
    return array(
      'id_conjunto'      => 'Number',
      'id_tipo_conjunto' => 'Number',
      'id_usuario'       => 'Number',
      'imagem_perfil'    => 'Text',
    );
  }
}
