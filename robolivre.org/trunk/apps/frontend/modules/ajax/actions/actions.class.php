<?php

/**
 * ajax actions.
 *
 * @package    robolivre
 * @subpackage ajax
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajaxActions extends sfActions {
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function execute($request) {
        if ($request->isXmlHttpRequest()) {
            parent::execute($request);
            $this->setTemplate('retornoAjax');
        }else{
            $this->redirect('inicial/index');
        }
    }
    
    public function executeIndex(sfWebRequest $request) {}

    public function executeAjaxValidacaoFormCadastro(sfWebRequest $request) {

        $mensagem = "";
        $erros = null; 
        
        {
            $form = new UsuariosForm(null, null, null, UsuariosForm::SOMENTE_INFO_CADASTRO);
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            $form->validaDadosIniciais();
            $erros = $form->getErrorSchema()->getErrors();
        }

        if (isset($erros['login'])) {
            $mensagem .= "login=".$erros['login']. Util::SEPARADOR_PARAMETRO;
        }else{
            $mensagem .= "login=". Util::SEPARADOR_PARAMETRO;
        }
        if (isset($erros['email'])) {
            $mensagem .= "email=".$erros['email']. Util::SEPARADOR_PARAMETRO;
        }else{
            $mensagem .= "email=". Util::SEPARADOR_PARAMETRO;
        }
        

        $this->mensagem = $mensagem;
    }

}
