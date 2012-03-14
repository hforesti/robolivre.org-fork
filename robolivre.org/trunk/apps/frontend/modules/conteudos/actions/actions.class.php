<?php

/**
 * conteudos actions.
 *
 * @package    robolivre
 * @subpackage conteudos
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conteudosActions extends sfActions
{
    public function execute($request) {
        if (!UsuarioLogado::getInstancia()->isLogado()) {
            $this->redirect("inicial/index");
        } else {
//            $this->exibirConteudo($request);
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
        $this->nomeConteudo = $request->getParameter('nome');
        
        {
            $objConteudo = Doctrine::getTable('Conteudos')->validaNomeConteudo($this->nomeConteudo);

            if($objConteudo){
                $this->idConjuntoErro = $objConteudo->getIdConjunto();
                $this->nomeConteudoErro = $objConteudo->getNome();
            }

            
        }
    }
    
    public function executeSolicitarParticipacao(sfWebRequest $request) {
        $participacao = new ParticipantesConjuntos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $participacao->solicitarParticipacao($id);
            Doctrine::getTable("ParticipantesConjuntos")->solicitarParticipacao($participacao);
            $slug = Doctrine::getTable("Conjuntos")->getSlug($id);
            $this->redirect("conteudo/$slug");
        }else{
            throw new Exception("ID da participação não encontrado");
        }
    }
    
    public function executeGravar(sfWebRequest $request) {

        $form = new ConteudosForm();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $form->updateObject();
            $this->conteudo = Doctrine::getTable("Conteudos")->gravarConteudo($form->getObject());
            $this->redirect('conteudo/'.$this->conteudo->getConjunto()->getSlug());
        } else {
            $this->formConteudo = $form;
            $this->setTemplate("criar");
        }
    }
}
