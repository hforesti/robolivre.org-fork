<?php

/**
 * Conteudos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 ** @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Conteudos extends BaseConteudos
{
    
    private $tipoUsuario;
    private $tipoSolicitacao;
    private $conjunto;
    private $nomeProprietario;
    private $quantidadeImagens;
    private $quantidadeVideos;
    private $quantidadeLinks;
    private $quantidadeSeguidores;
    
    const PROPRIETARIO = -1;
    const NAO_PARTICIPA = -2;
    
    const SEM_SOLICITACAO = 2;
    const PARTICIPANTE = 1;
    const SOLICITADA_PARTICIPACAO = 0;
    const AGUARDANDO_CONFIRMACAO = 3;
    
    public function setEnviarEmailCriador($valor) {
        parent::_set('enviar_email_criador', ($valor=="on"||$valor==true)?1:0);
        return $this;
    }
        
    public function getTipoSolicitacao() {
        return $this->tipoSolicitacao;
    }

    public function setTipoSolicitacao($tipoSolicitacao) {
        $this->tipoSolicitacao = $tipoSolicitacao;
    }
    
    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }
    
    /**
     *
     * @return Conjuntos 
     */
    public function getConjunto() {
        
        if(!isset($this->conjunto)|| $this->conjunto==null){
            $this->conjunto = new Conjuntos();
        }
        
        return $this->conjunto;
    }

    public function setConjunto($conjunto) {
        $this->conjunto = $conjunto;
    }
    
    public function getNomeProprietario() {
        if(!isset($this->nomeProprietario)){
            if(isset($this->conjunto) && $this->conjunto->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()){
                $this->nomeProprietario = UsuarioLogado::getInstancia()->getNome();
            }
        }
        return $this->nomeProprietario;
    }

    public function setNomeProprietario($nomeProprietario) {
        $this->nomeProprietario = $nomeProprietario;
    }
    
    public function getImagemPerfil($tipoImagem = Util::IMAGEM_MEDIA) {
        $imagem = ($this->getConjunto()!=null)? $this->getConjunto()->getImagemPerfil() : "";
        return Util::validaImagem($imagem, $tipoImagem,Util::TIPO_IMAGEM_CONTEUDO);
    }
    
    public function getQuantidadeImagens() {
        return $this->quantidadeImagens;
    }

    public function setQuantidadeImagens($quantidadeImagens) {
        $this->quantidadeImagens = $quantidadeImagens;
    }

    public function getQuantidadeVideos() {
        return $this->quantidadeVideos;
    }

    public function setQuantidadeVideos($quantidadeVideos) {
        $this->quantidadeVideos = $quantidadeVideos;
    }

    public function getQuantidadeLinks() {
        return $this->quantidadeLinks;
    }

    public function setQuantidadeLinks($quantidadeLinks) {
        $this->quantidadeLinks = $quantidadeLinks;
    }
    
    public function getQuantidadeSeguidores() {
        return $this->quantidadeSeguidores;
    }

    public function setQuantidadeSeguidores($quantidadeSeguidores) {
        $this->quantidadeSeguidores = $quantidadeSeguidores;
    }

}
