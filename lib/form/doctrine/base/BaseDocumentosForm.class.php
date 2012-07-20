<?php

/**
 * Documentos form base class.
 *
 * @method Documentos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_documento'       => new sfWidgetFormInputHidden(),
      'id_usuario'         => new sfWidgetFormInputHidden(),
      'id_pasta'           => new sfWidgetFormInputHidden(),
      'nome_arquivo'       => new sfWidgetFormInputText(),
      'is_codigo_fonte'    => new sfWidgetFormInputText(),
      'repositorio_github' => new sfWidgetFormInputText(),
      'ordenacao'          => new sfWidgetFormInputText(),
      'nome_documento'     => new sfWidgetFormInputText(),
      'hits'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_documento'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_documento')), 'empty_value' => $this->getObject()->get('id_documento'), 'required' => false)),
      'id_usuario'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_pasta'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_pasta')), 'empty_value' => $this->getObject()->get('id_pasta'), 'required' => false)),
      'nome_arquivo'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_codigo_fonte'    => new sfValidatorInteger(array('required' => false)),
      'repositorio_github' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ordenacao'          => new sfValidatorInteger(array('required' => false)),
      'nome_documento'     => new sfValidatorString(array('max_length' => 255)),
      'hits'               => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentos';
  }

}
