<?php

/**
 * ArquivosAnexos filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArquivosAnexosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_video'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_imagem'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_documento'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_video'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_imagem'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_documento'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('arquivos_anexos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArquivosAnexos';
  }

  public function getFields()
  {
    return array(
      'id_pasta'         => 'Number',
      'id_usuario'       => 'Number',
      'id_tipo_conjunto' => 'Number',
      'id_conjunto'      => 'Number',
      'id_video'         => 'Number',
      'id_imagem'        => 'Number',
      'id_documento'     => 'Number',
    );
  }
}
