<?php

/**
 * Mensagens form base class.
 *
 * @method Mensagens getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMensagensForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_mensagem' => new sfWidgetFormInputHidden(),
      'id_usuario'  => new sfWidgetFormInputHidden(),
      'conteudo'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_mensagem' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_mensagem')), 'empty_value' => $this->getObject()->get('id_mensagem'), 'required' => false)),
      'id_usuario'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'conteudo'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mensagens[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensagens';
  }

}
