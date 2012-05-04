<?php

/**
 * publicacao actions.
 *
 * @package    robolivre
 * @subpackage publicacao
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class publicacaoActions extends robolivreAction {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward404Unless($request->hasParameter('u'));
        $this->redirect("publicacao/exibir?u=" . $request->hasParameter('u'));
    }

    public function executeRemover(sfWebRequest $request) {
        $ultimaUrl = $request->getReferer();
        
        if($request->hasParameter('u')){
            Doctrine::getTable('Publicacoes')->removePublicacao($request->getParameter('u'));
            $this->redirect($ultimaUrl);
        }else{
            $this->forward404();
        }
        
        
    }
    
    public function executeExibir(sfWebRequest $request) {
        if($request->hasParameter('u')){
            $this->publicacao = Doctrine::getTable('Publicacoes')->getPublicacaoPermalink($request->getParameter('u'));
            $this->forward404Unless($this->publicacao);


            if($this->publicacao->getIdConjunto()!= null && $this->publicacao->getIdTipoConjunto()==Conjuntos::TIPO_CONTEUDO){
                $slug = Util::criaSlug($this->publicacao->getNomeConjunto());
                $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
                $this->formPublicacao = new PublicacoesForm();
                $this->publicacoesConjunto = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($this->conteudo->getIdConjunto()); //array();
                $chaves = array_keys($this->publicacoesConjunto);
                $this->ultimaAtulizacao = Util::getDataFormatada($this->publicacoesConjunto[$chaves[0]]->getDataPublicacao()); 
                {
                    $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
                    $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
                    $this->arrayParticipantes = array_splice($arrayRetorno['participantes'], 0, 6);
                } 
                {
                    $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosRelacionados($this->conteudo->getIdConjunto());
                    $this->quantidadeConteudosRelacionados = $arrayRetorno['quantidade'];
                    $this->arrayConteudosRelacionados = array_splice($arrayRetorno['conteudos'], 0, 9);
                }
                
                $this->setTemplate('exibirPublicacaoConteudo');
            }else{
                $id = $this->publicacao->getIdUsuario();
                if(!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()){
                    $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
                }else{
                    $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
                }
                
                {
                    $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
                    $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
                    $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'],0,6);
                }

                {
                    $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
                    $this->quantidadeAmigos = $arrayRetorno['quantidade'];
                    $this->arrayAmigos = array_splice($arrayRetorno['amigos'],0,6);
                }
                
                $this->setTemplate('exibirPublicacaoPerfil');
            }
        }else{
            $this->forward404();
        }
     }
     

}
