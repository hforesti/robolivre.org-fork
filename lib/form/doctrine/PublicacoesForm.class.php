<?php

/**
 * Publicacoes form.
 *
 * @package    robolivre
 * @subpackage form
 * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PublicacoesForm extends BasePublicacoesForm {
    
    
    public function configure() {

        $this->setWidgets(array(
            'id_publicacao' => new sfWidgetFormInputHidden(),
            'id_usuario' => new sfWidgetFormInput(array('is_hidden'=>true), array('value'=> UsuarioLogado::getInstancia()->getIdUsuario(),'type' => 'hidden')),
            'foto'    => new sfWidgetFormInputFile(),
            'comentario' => new sfWidgetFormTextarea(),
        ));

        $this->setValidators(array(
            'id_publicacao' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_publicacao')), 'empty_value' => $this->getObject()->get('id_publicacao'), 'required' => false)),
            'id_usuario' => new sfValidatorString(),//array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
            'foto'    => new sfValidatorFile(),
            'comentario' => new sfValidatorString(array('required' => false)),
        ));
        
        $this->widgetSchema->setNameFormat('publicacoes[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        //$this->setDefault("id_usuario", UsuarioLogado::getInstancia()->getIdUsuario()); //widgetSchema['id_usuario']->setOption('value_attribute_value', UsuarioLogado::getInstancia()->getIdUsuario());
    }

}
