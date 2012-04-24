<?php

/**
 * Videos form base class.
 *
 * @method Videos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_video'     => new sfWidgetFormInputHidden(),
      'id_usuario'   => new sfWidgetFormInputHidden(),
      'id_pasta'     => new sfWidgetFormInputHidden(),
      'nome_arquivo' => new sfWidgetFormInputText(),
      'ordenacao'    => new sfWidgetFormInputText(),
      'link_video'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_video'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_video')), 'empty_value' => $this->getObject()->get('id_video'), 'required' => false)),
      'id_usuario'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_pasta'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_pasta')), 'empty_value' => $this->getObject()->get('id_pasta'), 'required' => false)),
      'nome_arquivo' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ordenacao'    => new sfValidatorInteger(array('required' => false)),
      'link_video'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('videos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Videos';
  }

}
