<?php

/**
 * MensagensDestinatarios filter form base class.
 *
 * @package    robolivre
 * @subpackage filter
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMensagensDestinatariosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('mensagens_destinatarios_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MensagensDestinatarios';
  }

  public function getFields()
  {
    return array(
      'id_mensagem'             => 'Number',
      'id_usuario_destinatario' => 'Number',
      'id_usuario_remetente'    => 'Number',
    );
  }
}
