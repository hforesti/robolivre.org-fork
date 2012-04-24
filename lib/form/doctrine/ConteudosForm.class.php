<?php

/**
 * Conteudos form.
 *
 * @package    robolivre
 * @subpackage form
 * * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConteudosForm extends BaseConteudosForm {

    public function configure() {
        $this->setWidgets(array(
            'id_conteudo' => new sfWidgetFormInputHidden(),
            'id_tipo_conjunto' => new sfWidgetFormInputHidden(),
            'id_conjunto' => new sfWidgetFormInputHidden(),
            'nome' => new sfWidgetFormInputText(),
            'descricao' => new sfWidgetFormTextarea(),
            'enviar_email_criador' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'id_conteudo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conteudo')), 'empty_value' => $this->getObject()->get('id_conteudo'), 'required' => false)),
            'id_tipo_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_conjunto')), 'empty_value' => $this->getObject()->get('id_tipo_conjunto'), 'required' => false)),
            'id_conjunto' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_conjunto')), 'empty_value' => $this->getObject()->get('id_conjunto'), 'required' => false)),
            'nome' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'descricao' => new sfValidatorString(array('required' => false)),
            'enviar_email_criador' => new sfValidatorString(array('required' => false)),
        ));


        $this->widgetSchema->setNameFormat('conteudos[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }
    
    public function isValid() {
        $isValid = parent::isValid();
        $erros = $this->getErrorSchema()->getErrors();
        if($isValid || (isset($erros['id_conteudo'])&& isset($erros['id_tipo_conjunto']) && isset($erros['id_conjunto']))){
            $valores = $this->getTaintedValues();
            $nomeConteudo = $valores['nome'];
            $idConjunto = $valores['id_conjunto'];
            
            if(Doctrine::getTable("Conteudos")->validaNomeConteudo($nomeConteudo,$idConjunto)){
                $error = new sfValidatorError($this->validatorSchema['nome'], 'Este conteúdo já existe');
                $this->errorSchema->addError($error, 'nome');
                return false;
            }
            
            return true;
        }
        else{
            return false;
        }
    }

}
