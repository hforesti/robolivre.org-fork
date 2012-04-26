<?php

/**
 * Amigos form base class.
 *
 * @method Amigos getObject() Returns the current form's model object
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class ContatoForm extends BaseForm {

    public function setup() {
        $this->setWidgets(array(
            'nome' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'mensagem' => new sfWidgetFormTextarea(),
            'telefone' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'nome' => new sfValidatorString(array('max_length' => 255)),
            'email' => new sfValidatorEmail(array('max_length' => 100), array('invalid' => 'O e-mail não parece ser válido. Verifique a digitação.')),
            'mensagem' => new sfValidatorString(),
            'telefone' => new sfValidatorString(array('max_length' => 15, 'required' => false)),
        ));


        $this->widgetSchema->setNameFormat('contato_form[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
