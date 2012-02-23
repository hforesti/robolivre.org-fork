<?php

/**
 * ProjetosComunidades filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProjetosComunidadesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('projetos_comunidades_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjetosComunidades';
  }

  public function getFields()
  {
    return array(
      'id_conjunto_comunidade'      => 'Number',
      'id_tipo_conjunto_comunidade' => 'Number',
      'id_comunidade'               => 'Number',
      'id_conjunto_conteudo'        => 'Number',
      'id_tipo_conjunto_conteudo'   => 'Number',
      'id_conteudo'                 => 'Number',
    );
  }
}
