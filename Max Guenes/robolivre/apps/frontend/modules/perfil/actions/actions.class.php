<?php

/**
 * perfil actions.
 *
 * @package    robolivre
 * @subpackage perfil
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class perfilActions extends sfActions {
    
    public function execute($request) {
        
        if(!UsuarioLogado::getInstancia()->isLogado()){
            $this->redirect("inicial/index");
        }
        else{
            return parent::execute($request);
        }
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        
        $id = $request->getParameter("u");
        
        if(!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()){
            $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
        }
        
        $this->publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoPerfil($this->usuario->getIdUsuario());
        
        $this->formPublicacao = new PublicacoesForm();

    }
    
    public function executeEditarPerfil(sfWebRequest $request) {
        $u = $request->getParameter('u');
        
        if($u == UsuarioLogado::getInstancia()->getIdUsuario()){
            $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($u)), sprintf('Object usuarios does not exist (%s).', $u));
            $this->formUsuario = new UsuariosForm($usuarios,null,null,  UsuariosForm::SOMENTE_INFO);
        }else{
            $this->redirect("perfil/index");
        }
    }
    
    public function executeEditarRegistro(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        
        $array_info = $request->getParameter("usuarios");
        $id = $array_info['id_usuario'];
        
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($id)), sprintf('Object usuarios does not exist (%s).', $id));
        $form = new UsuariosForm($usuarios,null,null,  UsuariosForm::SOMENTE_INFO);
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        if ($form->isValid()) {
            $usuarios = $form->save();
            UsuarioLogado::getInstancia()->atualizaInformacoes($usuarios);
            $this->redirect('perfil/informacao?u=' . $usuarios->getIdUsuario());
        }
        
        $this->formUsuario = $form;
        $this->setTemplate('editarPerfil');
    }
    
   
    
    public function executeInformacao(sfWebRequest $request) {
        $id = $request->getParameter("u");
        
        if(!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()){
            $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
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
        if($request->getParameter('id_usuario_referencia')!=""){
            $objPublicacao->setIdUsuarioReferencia($request->getParameter('id_usuario_referencia'));
        }
        
        $objPublicacao->save();
        $this->redirect("perfil/index");
    }
    
    public function executeLista(sfWebRequest $request) {
        $this->listaUsuario = Doctrine::getTable("Usuarios")->getUsuariosListagem();
    }
    
    public function executeSolicitacoes(sfWebRequest $request){
        UsuarioLogado::getInstancia()->atualizaSolicitacoes();
    }
    
    public function executeAceitarSolicitacao(sfWebRequest $request){
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->setSolicitacao($id);
            Doctrine::getTable("Amigos")->aceitarAmizade($amizade);
            UsuarioLogado::getInstancia()->removeSolicitacao($id);
            $this->redirect('perfil/index?u='.$id);
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeRecusarSolicitacao(sfWebRequest $request){
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->setSolicitacao($id);
            Doctrine::getTable("Amigos")->recusarAmizade($amizade);
            UsuarioLogado::getInstancia()->removeSolicitacao($id);
            $this->redirect('perfil/index');
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeSolicitarAmizade(sfWebRequest $request) {
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->solicitarAmizade($id);
            Doctrine::getTable("Amigos")->solicitarAmizade($amizade);
            $this->redirect('perfil/index?u='.$id);
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeLogout(sfWebRequest $request) {
        UsuarioLogado::getInstancia()->deslogar();
        $this->redirect('inicial/index');
    }

}
