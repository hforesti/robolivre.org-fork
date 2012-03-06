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
    
    public function executeExibir(sfWebRequest $request) {
        $idConjunto = $request->getParameter('u');
        if(!isset($idConjunto)){
            $this->redirect('conteudo/index');
        }else{
            $idConteudo = $request->getParameter('i');
            
            $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorId($idConjunto,$idConteudo);
            $this->formPublicacao = new PublicacoesForm();
            $this->publicacoesConjunto = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($this->conteudo->getIdConjunto()); //array();
        }
    }

    public function executeSolicitarParticipacao(sfWebRequest $request) {
        $participacao = new ParticipantesConjuntos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $participacao->solicitarParticipacao($id);
            Doctrine::getTable("ParticipantesConjuntos")->solicitarParticipacao($participacao);
            $this->redirect('conteudo/exibir?u='.$id);
        }else{
            $this->redirect('conteudo/exibir?u='.$id);
        }
    }
    
    public function executeGravar(sfWebRequest $request) {

        $form = new ConteudosForm();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $form->updateObject();
            $this->conteudo = Doctrine::getTable("Conteudos")->gravarConteudo($form->getObject());
            $this->redirect('conteudo/exibir?u='.$this->conteudo->getIdConjunto());
        } else {
            $this->formConteudo = $form;
            $this->setTemplate("criar");
        }
    }
    
    public function executePublicar(sfWebRequest $request) {
        $form = new PublicacoesForm();
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $form->updateObject();
        $objPublicacao = $form->getObject();
        $objPublicacao->setDataPublicacao(date('Y-m-d H:i:s'));
        if( $request->getParameter('id_publicacao_original')!= "" && $request->getParameter('id_usuario_original') != ""){ 
            $objPublicacao->setIdUsuarioOriginal ($request->getParameter('id_usuario_original'));
            $objPublicacao->setIdPublicacaoOriginal($request->getParameter('id_publicacao_original'));
        }
        
        if($request->getParameter('id_conjunto')!=""){
            $objPublicacao->setIdConjunto($request->getParameter('id_conjunto'));
        }
        
//        Util::pre($objPublicacao, true);
        $objPublicacao->save();
        $this->redirect("conteudo/exibir?u=".$request->getParameter('id_conjunto'));
    }

}
