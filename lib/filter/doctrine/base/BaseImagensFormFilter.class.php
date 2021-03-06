<?php

/**
 * Imagens filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImagensFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome_arquivo' => new sfWidgetFormFilterInput(),
      'ordenacao'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nome_arquivo' => new sfValidatorPass(array('required' => false)),
      'ordenacao'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('imagens_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Imagens';
  }

  public function getFields()
  {
    return array(
      'id_imagem'    => 'Number',
      'id_usuario'   => 'Number',
      'id_pasta'     => 'Number',
      'nome_arquivo' => 'Text',
      'ordenacao'    => 'Number',
    );
  }
}
