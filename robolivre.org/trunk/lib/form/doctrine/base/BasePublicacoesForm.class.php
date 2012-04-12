<?php

/**
 * Publicacoes form base class.
 *
 * @method Publicacoes getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublicacoesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_publicacao'          => new sfWidgetFormInputHidden(),
      'id_usuario'             => new sfWidgetFormInputHidden(),
      'id_conteudo'            => new sfWidgetFormInputText(),
      'id_tipo_conjunto'       => new sfWidgetFormInputText(),
      'id_conjunto'            => new sfWidgetFormInputText(),
      'id_diario_bordo'        => new sfWidgetFormInputText(),
      'id_pasta'               => new sfWidgetFormInputText(),
      'id_video'               => new sfWidgetFormInputText(),
      'id_imagem'              => new sfWidgetFormInputText(),
      'id_usuario_original'    => new sfWidgetFormInputText(),
      'id_publicacao_original' => new sfWidgetFormInputText(),
      'id_usuario_referencia'  => new sfWidgetFormInputText(),
      'comentario'             => new sfWidgetFormTextarea(),
      'link'                   => new sfWidgetFormTextarea(),
      'data_publicacao'        => new sfWidgetFormDateTime(),
      'visivel'                => new sfWidgetFormInputText(),
      'tipo_publicacao'        => new sfWidgetFormInputText(),
      'privacidade_publicacao' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_publicacao'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_publicacao')), 'empty_value' => $this->getObject()->get('id_publicacao'), 'required' => false)),
      'id_usuario'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_conteudo'            => new sfValidatorInteger(array('required' => false)),
      'id_tipo_conjunto'       => new sfValidatorInteger(array('required' => false)),
      'id_conjunto'            => new sfValidatorInteger(array('required' => false)),
      'id_diario_bordo'        => new sfValidatorInteger(array('required' => false)),
      'id_pasta'               => new sfValidatorInteger(array('required' => false)),
      'id_video'               => new sfValidatorInteger(array('required' => false)),
      'id_imagem'              => new sfValidatorInteger(array('required' => false)),
      'id_usuario_original'    => new sfValidatorInteger(array('required' => false)),
      'id_publicacao_original' => new sfValidatorInteger(array('required' => false)),
      'id_usuario_referencia'  => new sfValidatorInteger(array('required' => false)),
      'comentario'             => new sfValidatorString(array('required' => false)),
      'link'                   => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'data_publicacao'        => new sfValidatorDateTime(),
      'visivel'                => new sfValidatorInteger(array('required' => false)),
      'tipo_publicacao'        => new sfValidatorInteger(array('required' => false)),
      'privacidade_publicacao' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('publicacoes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Publicacoes';
  }

}
