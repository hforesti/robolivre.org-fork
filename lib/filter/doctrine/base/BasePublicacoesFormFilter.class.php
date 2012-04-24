<?php

/**
 * Publicacoes filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublicacoesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_conteudo'            => new sfWidgetFormFilterInput(),
      'id_tipo_conjunto'       => new sfWidgetFormFilterInput(),
      'id_conjunto'            => new sfWidgetFormFilterInput(),
      'id_diario_bordo'        => new sfWidgetFormFilterInput(),
      'id_pasta'               => new sfWidgetFormFilterInput(),
      'id_video'               => new sfWidgetFormFilterInput(),
      'id_imagem'              => new sfWidgetFormFilterInput(),
      'id_usuario_original'    => new sfWidgetFormFilterInput(),
      'id_publicacao_original' => new sfWidgetFormFilterInput(),
      'id_usuario_referencia'  => new sfWidgetFormFilterInput(),
      'comentario'             => new sfWidgetFormFilterInput(),
      'link'                   => new sfWidgetFormFilterInput(),
      'data_publicacao'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'visivel'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_publicacao'        => new sfWidgetFormFilterInput(),
      'privacidade_publicacao' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_conteudo'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_conjunto'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_conjunto'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_diario_bordo'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_pasta'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_video'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_imagem'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_usuario_original'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_publicacao_original' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_usuario_referencia'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comentario'             => new sfValidatorPass(array('required' => false)),
      'link'                   => new sfValidatorPass(array('required' => false)),
      'data_publicacao'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'visivel'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo_publicacao'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'privacidade_publicacao' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('publicacoes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Publicacoes';
  }

  public function getFields()
  {
    return array(
      'id_publicacao'          => 'Number',
      'id_usuario'             => 'Number',
      'id_conteudo'            => 'Number',
      'id_tipo_conjunto'       => 'Number',
      'id_conjunto'            => 'Number',
      'id_diario_bordo'        => 'Number',
      'id_pasta'               => 'Number',
      'id_video'               => 'Number',
      'id_imagem'              => 'Number',
      'id_usuario_original'    => 'Number',
      'id_publicacao_original' => 'Number',
      'id_usuario_referencia'  => 'Number',
      'comentario'             => 'Text',
      'link'                   => 'Text',
      'data_publicacao'        => 'Date',
      'visivel'                => 'Number',
      'tipo_publicacao'        => 'Number',
      'privacidade_publicacao' => 'Number',
    );
  }
}
