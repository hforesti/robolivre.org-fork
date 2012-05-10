<?php

/**
 * contato actions.
 *
 * @package    robolivre
 * @subpackage contato
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contatoActions extends robolivreAction {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->formContato = new ContatoForm();
    }

    public function executeEnviarEmailContato(sfWebRequest $request) {
        $form = new ContatoForm();
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid()){
            //enviar email de contato para robolivre@robolivre.org
        }else{
            $this->formContato = $form;
        }

        $this->setTemplate("index");

    }

    public function executeReportarErro(sfWebRequest $request) {
        
        if($request->hasParameter('mensagem_sistema')){
            $this->mensagemSistema = $request->getParameter('mensagem_sistema');
        }
        
        $this->formContato = new ContatoForm();
    }

    public function executeEnviarEmailReportarErro(sfWebRequest $request) {
        $form = new ContatoForm();
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid()){
            //enviar email de erro para robolivre@robolivre.org
            $valores = $form->getTaintedValues();
            $mensagem = $valores['mensagem'];
            if($request->hasParameter('mensagem_sistema')){
                $mensagemSistema = $request->getParameter('mensagem_sistema');
            }else{
                $mensagemSistema = null;
            }
            
            Util::enviarEmail("[robolivre.org] Reportar Erro", Util::getTextoEmailReportarErro($mensagem, $valores['nome'],$valores['email'],$mensagemSistema), Util::getEmailContato());
        }else{
            $this->formContato = $form;
            if($request->hasParameter('mensagem_sistema')){
                $this->mensagemSistema = $request->getParameter('mensagem_sistema');
            }
        }
        
        $this->setTemplate("reportarErro");
    }

}
