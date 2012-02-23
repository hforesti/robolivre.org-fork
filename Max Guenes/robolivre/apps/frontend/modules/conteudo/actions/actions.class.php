<?php

/**
 * conteudo actions.
 *
 * @package    robolivre
 * @subpackage conteudo
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conteudoActions extends sfActions {

    public function execute($request) {

        if (!UsuarioLogado::getInstancia()->isLogado()) {
            $this->redirect("inicial/index");
        } else {
            return parent::execute($request);
        }
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->conteudos = Doctrine::getTable("Conteudos")->getConteudosListagem();
    }

    public function executeCriar(sfWebRequest $request) {
        $this->formConteudo = new ConteudosForm();
    }

    public function executeGravar(sfWebRequest $request) {

        $form = new ConteudosForm();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $form->updateObject();
            Doctrine::getTable("Conteudos")->gravarConteudo($form->getObject());
            $this->redirect('conteudo/index');
        } else {
            $this->formConteudo = $form;
            $this->setTemplate("criar");
        }
    }

}
