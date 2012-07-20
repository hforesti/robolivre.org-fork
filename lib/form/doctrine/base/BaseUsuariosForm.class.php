<?php

/**
 * Usuarios form base class.
 *
 * @method Usuarios getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuariosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'             => new sfWidgetFormInputHidden(),
      'nivel_escolaridade'     => new sfWidgetFormInputText(),
      'nome'                   => new sfWidgetFormInputText(),
      'login'                  => new sfWidgetFormInputText(),
      'senha'                  => new sfWidgetFormInputText(),
      'email'                  => new sfWidgetFormInputText(),
      'endereco'               => new sfWidgetFormInputText(),
      'habilidades'            => new sfWidgetFormTextarea(),
      'curso'                  => new sfWidgetFormInputText(),
      'site'                   => new sfWidgetFormInputText(),
      'site_empresa'           => new sfWidgetFormInputText(),
      'data_nascimento'        => new sfWidgetFormDate(),
      'sexo'                   => new sfWidgetFormInputText(),
      'administrador'          => new sfWidgetFormInputText(),
      'sobre_mim'              => new sfWidgetFormTextarea(),
      'ativo'                  => new sfWidgetFormInputText(),
      'imagem_perfil'          => new sfWidgetFormInputText(),
      'twitter'                => new sfWidgetFormInputText(),
      'parametros_privacidade' => new sfWidgetFormInputText(),
      'aula_robolivre'         => new sfWidgetFormInputText(),
      'profissao'              => new sfWidgetFormInputText(),
      'escola'                 => new sfWidgetFormInputText(),
      'empresa'                => new sfWidgetFormInputText(),
      'data_criacao_perfil'    => new sfWidgetFormDateTime(),
      'parametros_email'       => new sfWidgetFormInputText(),
      'token'                  => new sfWidgetFormInputText(),
      'email_novo'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_usuario'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'nivel_escolaridade'     => new sfValidatorInteger(array('required' => false)),
      'nome'                   => new sfValidatorString(array('max_length' => 255)),
      'login'                  => new sfValidatorString(array('max_length' => 45)),
      'senha'                  => new sfValidatorString(array('max_length' => 45)),
      'email'                  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'endereco'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'habilidades'            => new sfValidatorString(array('required' => false)),
      'curso'                  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'site'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'site_empresa'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'data_nascimento'        => new sfValidatorDate(array('required' => false)),
      'sexo'                   => new sfValidatorInteger(array('required' => false)),
      'administrador'          => new sfValidatorInteger(array('required' => false)),
      'sobre_mim'              => new sfValidatorString(array('required' => false)),
      'ativo'                  => new sfValidatorInteger(array('required' => false)),
      'imagem_perfil'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'twitter'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'parametros_privacidade' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'aula_robolivre'         => new sfValidatorInteger(array('required' => false)),
      'profissao'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'escola'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'empresa'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'data_criacao_perfil'    => new sfValidatorDateTime(),
      'parametros_email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'token'                  => new sfValidatorString(array('max_length' => 255)),
      'email_novo'             => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuarios';
  }

}
