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
        $this->redirect("conteudos/index");
    }
    
    public function executeExibir(sfWebRequest $request) {
        $slug = $request->getParameter('slug');
        
        if(!isset($slug)){
            $this->redirect('conteudos/index');
        }else{
            $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
            $this->formPublicacao = new PublicacoesForm();
            $this->publicacoesConjunto = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($this->conteudo->getIdConjunto()); //array();
            $chaves = array_keys($this->publicacoesConjunto);
            $this->ultimaAtulizacao = Util::getDataFormatada($this->publicacoesConjunto[$chaves[0]]->getDataPublicacao());
            
            {
                $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
                $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
                $this->arrayParticipantes = array_splice($arrayRetorno['participantes'],0,6);
            }
            
            {
                $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosRelacionados($this->conteudo->getIdConjunto());
                $this->quantidadeConteudosRelacionados = $arrayRetorno['quantidade'];
                $this->arrayConteudosRelacionados = array_splice($arrayRetorno['conteudos'],0,9);
            }
            
        }
    }
}
