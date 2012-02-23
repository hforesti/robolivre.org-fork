<?php

/**
 * Usuarios filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuariosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nivel_escolaridade'     => new sfWidgetFormFilterInput(),
      'nome'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'login'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'senha'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'                  => new sfWidgetFormFilterInput(),
      'endereco'               => new sfWidgetFormFilterInput(),
      'habilidades'            => new sfWidgetFormFilterInput(),
      'curso'                  => new sfWidgetFormFilterInput(),
      'site'                   => new sfWidgetFormFilterInput(),
      'site_empresa'           => new sfWidgetFormFilterInput(),
      'data_nascimento'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sexo'                   => new sfWidgetFormFilterInput(),
      'administrador'          => new sfWidgetFormFilterInput(),
      'sobre_mim'              => new sfWidgetFormFilterInput(),
      'ativo'                  => new sfWidgetFormFilterInput(),
      'imagem_perfil'          => new sfWidgetFormFilterInput(),
      'twitter'                => new sfWidgetFormFilterInput(),
      'parametros_privacidade' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nivel_escolaridade'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nome'                   => new sfValidatorPass(array('required' => false)),
      'login'                  => new sfValidatorPass(array('required' => false)),
      'senha'                  => new sfValidatorPass(array('required' => false)),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'endereco'               => new sfValidatorPass(array('required' => false)),
      'habilidades'            => new sfValidatorPass(array('required' => false)),
      'curso'                  => new sfValidatorPass(array('required' => false)),
      'site'                   => new sfValidatorPass(array('required' => false)),
      'site_empresa'           => new sfValidatorPass(array('required' => false)),
      'data_nascimento'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sexo'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'administrador'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sobre_mim'              => new sfValidatorPass(array('required' => false)),
      'ativo'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'imagem_perfil'          => new sfValidatorPass(array('required' => false)),
      'twitter'                => new sfValidatorPass(array('required' => false)),
      'parametros_privacidade' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuarios';
  }

  public function getFields()
  {
    return array(
      'id_usuario'             => 'Number',
      'nivel_escolaridade'     => 'Number',
      'nome'                   => 'Text',
      'login'                  => 'Text',
      'senha'                  => 'Text',
      'email'                  => 'Text',
      'endereco'               => 'Text',
      'habilidades'            => 'Text',
      'curso'                  => 'Text',
      'site'                   => 'Text',
      'site_empresa'           => 'Text',
      'data_nascimento'        => 'Date',
      'sexo'                   => 'Number',
      'administrador'          => 'Number',
      'sobre_mim'              => 'Text',
      'ativo'                  => 'Number',
      'imagem_perfil'          => 'Text',
      'twitter'                => 'Text',
      'parametros_privacidade' => 'Text',
    );
  }
}
