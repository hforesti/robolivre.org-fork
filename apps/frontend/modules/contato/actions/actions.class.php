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
            
        }else{
            $this->formContato = $form;
        }

        $this->setTemplate("index");

    }

    public function executeReportarErro(sfWebRequest $request) {
        $this->formContato = new ContatoForm();
    }

    public function executeEnviarEmailReportarErro(sfWebRequest $request) {
        $form = new ContatoForm();
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid()){
            
        }else{
            $this->formContato = $form;
        }
        
        $this->setTemplate("reportarErro");
    }

}
