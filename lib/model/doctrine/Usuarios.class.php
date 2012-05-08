<?php

/**
 * Usuarios
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 * @author    Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Usuarios extends BaseUsuarios
{   
    
    const SEM_SOLICITACAO = 2;
    const AMIGO = 1;
    const SOLICITADA_AMIZADE = 0;
    const PROPRIO_USUARIO = -1;
    const AGUARDANDO_CONFIRMACAO = 3;
    
    private $tipoSolicitacaoAmizade = false;
    
    public function __construct($table = null, $isNewEntry = false,UsuarioLogado $usuario_logado = null) {
        
        parent::__construct($table, $isNewEntry);
        
        if($usuario_logado!=null){
            parent::_set('nome', $usuario_logado->getNome());
            parent::_set('curso', $usuario_logado->getCurso());
            parent::_set('data_nascimento', $usuario_logado->getDataNascimento());
            parent::_set('email', $usuario_logado->getEmail());
            parent::_set('endereco', $usuario_logado->getEndereco());
            parent::_set('habilidades', $usuario_logado->getHabilidades());
            parent::_set('nivel_escolaridade', $usuario_logado->getNivelEscolaridade());
            parent::_set('id_usuario', $usuario_logado->getIdUsuario());
            parent::_set('login', $usuario_logado->getLogin());
            parent::_set('nome', $usuario_logado->getNome());
            parent::_set('sexo', $usuario_logado->getSexo());
            parent::_set('site', $usuario_logado->getSite());
            parent::_set('site_empresa', $usuario_logado->getSiteEmpresa());
            parent::_set('sobre_mim', $usuario_logado->getSobreMim());
            parent::_set('imagem_perfil', $usuario_logado->getImagemPerfil());
            parent::_set('data_criacao_perfil', $usuario_logado->getDataCriacaoPerfil());
            parent::_set('empresa',$usuario_logado->getEmpresa());
            parent::_set('escola',$usuario_logado->getEscola());
            parent::_set('profissao',$usuario_logado->getProfissao());
            parent::_set('aula_robolivre',$usuario_logado->getAulaRobolivre());
            parent::_set('parametros_email',$usuario_logado->getParametrosEmail());
//            die($usuario_logado->getParametrosEmail());
            $this->setTipoSolicitacaoAmizade(self::PROPRIO_USUARIO);
        }
    }
    
    public function setSenha($senha) {
        parent::_set('senha', md5($senha));
        return $this;
    }
    
    public function getTipoSolicitacaoAmizade() {
        return $this->tipoSolicitacaoAmizade;
    }
    
    public function setTipoSolicitacaoAmizade($amigo) {
        $this->tipoSolicitacaoAmizade = $amigo;
    }
    
    public function getImagemPerfil(){
        return parent::_get('imagem_perfil');
    }
    
    public function getImagemPerfilFormatada($tipoImagem = Util::IMAGEM_MINIATURA) {
        $imagem =  parent::_get('imagem_perfil');
        return Util::validaImagem($imagem, $tipoImagem,Util::TIPO_IMAGEM_USUARIO);
    }
    
    public function setAulaRobolivre($valor) {
        parent::_set('aula_robolivre', ($valor=="on"||$valor==true)?1:0);
        return $this;
    }
    
}
