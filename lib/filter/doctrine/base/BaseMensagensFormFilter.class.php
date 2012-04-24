<?php

/**
 * Mensagens filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMensagensFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'conteudo'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'conteudo'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mensagens_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensagens';
  }

  public function getFields()
  {
    return array(
      'id_mensagem' => 'Number',
      'id_usuario'  => 'Number',
      'conteudo'    => 'Text',
    );
  }
}
