<?php

/**
 * MensagensDestinatarios form base class.
 *
 * @method MensagensDestinatarios getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMensagensDestinatariosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_mensagem'             => new sfWidgetFormInputHidden(),
      'id_usuario_destinatario' => new sfWidgetFormInputHidden(),
      'id_usuario_remetente'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_mensagem'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_mensagem')), 'empty_value' => $this->getObject()->get('id_mensagem'), 'required' => false)),
      'id_usuario_destinatario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario_destinatario')), 'empty_value' => $this->getObject()->get('id_usuario_destinatario'), 'required' => false)),
      'id_usuario_remetente'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario_remetente')), 'empty_value' => $this->getObject()->get('id_usuario_remetente'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mensagens_destinatarios[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MensagensDestinatarios';
  }

}
