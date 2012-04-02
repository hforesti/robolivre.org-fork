<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioLogado
 * 
 * @author maxguenes
 */
class UsuarioLogado{

    private static $instancia;
    private static $TEMPO_ATUALIZACAO = 45; //SEGUNDOS

    private function __construct() {
        
    }

    public function logar(Usuarios $objUsuario) {
        
        if ($objUsuario) {
            try {
                $this->setCurso($objUsuario->getCurso());
                $this->setDataNascimento($objUsuario->getDataNascimento());
                $this->setEmail($objUsuario->getEmail());
                $this->setEndereco($objUsuario->getEndereco());
                $this->setHabilidades($objUsuario->getHabilidades());
                $this->setNivelEscolaridade($objUsuario->getNivelEscolaridade());
                $this->setIdUsuario($objUsuario->getIdUsuario());
                $this->setLogin($objUsuario->getLogin());
                $this->setSexo($objUsuario->getSexo());
                $this->setSite($objUsuario->getSite());
                $this->setSiteEmpresa($objUsuario->getSiteEmpresa());
                $this->setSobreMim($objUsuario->getSobreMim());
                $this->setNome($objUsuario->getNome());
                $this->setTwitter($objUsuario->getTwitter());
                $this->setParametrosPrivacidade($objUsuario->getParametrosPrivacidade());
                $this->setImagemPerfil($objUsuario->getImagemPerfil());
                $_SESSION['sesStatusLogin'] = 'logado';
                $_SESSION['sesIP'] = $_SERVER['REMOTE_ADDR'];

                $this->setSolicitacoesPendentes(Doctrine::getTable("Amigos")->getSolicitacoesPendentes($objUsuario->getIdUsuario()));
                $this->setUltimaAtualizacao();

                $logSistema = new LogsSistema();
                $logSistema->setIdUsuario($objUsuario->getIdUsuario());
                $logSistema->setTipoLog(LogsSistema::LOGIN_SISTEMA);
                $logSistema->setDescricao(LogsSistema::getDescricaoPeloTipo(LogsSistema::LOGIN_SISTEMA));
                $logSistema->setDataPublicacao(date('Y-m-d H:i:s'));
                $logSistema->setParametros("IP:" . $_SERVER['REMOTE_ADDR']);
                $logSistema->save();
            } catch (Exception $e) {
                $this->deslogar();
                throw $e;
            }
        } else {
            throw new Exception("É preciso de um objeto usuario para logar no sistema");
        }
    }

    public function deslogar() {
        
        unset($_SESSION['sesStatusLogin'], $_SESSION['sesIP'], $_SESSION['sesNome'], $_SESSION['sesLogin'], $_SESSION['sesEmail'], $_SESSION['sesCurso'], $_SESSION['sesDataNascimento'], $_SESSION['sesEndereco'], $_SESSION['sesHabilidades'], $_SESSION['sesIdNivelEscolaridade'], $_SESSION['sesIdUsuario'], $_SESSION['sesSite'], $_SESSION['sesSiteEmpresa'], $_SESSION['sesSobreMim'], $_SESSION['sesSexo']);
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
    }

    public function atualizaSolicitacoes() {
        $this->setSolicitacoesPendentes(Doctrine::getTable("Amigos")->getSolicitacoesPendentes($this->getIdUsuario()));
    }

    public function atualizaInformacoes(Usuarios $objUsuario = null) {
        if ($this->isLogado()) {
            if ($objUsuario != null) {
                $this->setCurso($objUsuario->getCurso());
                $this->setDataNascimento($objUsuario->getDataNascimento());
                $this->setEmail($objUsuario->getEmail());
                $this->setEndereco($objUsuario->getEndereco());
                $this->setHabilidades($objUsuario->getHabilidades());
                $this->setNivelEscolaridade($objUsuario->getNivelEscolaridade());
                $this->setIdUsuario($objUsuario->getIdUsuario());
                $this->setLogin($objUsuario->getLogin());
                $this->setSexo($objUsuario->getSexo());
                $this->setSite($objUsuario->getSite());
                $this->setSiteEmpresa($objUsuario->getSiteEmpresa());
                $this->setSobreMim($objUsuario->getSobreMim());
                $this->setNome($objUsuario->getNome());
                $this->setTwitter($objUsuario->getTwitter());
                $this->setParametrosPrivacidade($objUsuario->getParametrosPrivacidade());
                $this->setImagemPerfil($objUsuario->getImagemPerfil());
            }

            $this->atualizaSolicitacoes();
            $this->setUltimaAtualizacao();
        }
    }

    /**
     * 
     * @return UsuarioLogado  
     */
    public static function getInstancia() {
        if (!isset(self::$instancia) || self::$instancia == null) {
            self::$instancia = new UsuarioLogado();
        }
        
        if(!self::$instancia->isLogado()){
            if(isset($_COOKIE['cooLogin']) && $_COOKIE['cooLogin']!="" && isset($_COOKIE['cooSenha']) && $_COOKIE['cooSenha']!="" ){
                $objUsuario = Doctrine::getTable('Usuarios')->login($_COOKIE['cooLogin'], $_COOKIE['cooSenha']);
                self::$instancia->logar($objUsuario);
               
            }

        }else{
            //Atualiza informações a cada [TEMPO_ATUALIZACAO] segundos
            if (self::$instancia->getDiffTempoAtualizacao() >= self::$TEMPO_ATUALIZACAO) {
                self::$instancia->atualizaInformacoes();
            }
        }
        
        return self::$instancia;
    }

    public function getDiffTempoAtualizacao() {
        return time() - $this->getUltimaAtualizacao();
    }

    public function isLogado() {
        if (isset($_SESSION) && isset($_SESSION['sesStatusLogin']) && $_SESSION['sesStatusLogin'] == 'logado') {
            return true;
        } else {
            return false;
        }
    }

    public function getEnderecoRemoto() {
        return $_SESSION['sesIP'];
    }

    public function getUltimaAtualizacao() {
        return $_SESSION['sesUltimaAtualizacao'];
    }

    public function getNome() {
        return $_SESSION['sesNome'];
    }

    public function getEmail() {
        return $_SESSION['sesEmail'];
    }

    public function getCurso() {
        return $_SESSION['sesCurso'];
    }

    public function getDataNascimento() {
        return $_SESSION['sesDataNascimento'];
    }

    public function getEndereco() {
        return $_SESSION['sesEndereco'];
    }

    public function getHabilidades() {
        return $_SESSION['sesHabilidades'];
    }

    public function getNivelEscolaridade() {
        return $_SESSION['sesIdNivelEscolaridade'];
    }

    public function getIdUsuario() {
        return $_SESSION['sesIdUsuario'];
    }

    public function getLogin() {
        return $_SESSION['sesLogin'];
    }

    public function getSexo() {
        return $_SESSION['sesSexo'];
    }

    public function getSite() {
        return $_SESSION['sesSite'];
    }

    public function getSiteEmpresa() {
        return $_SESSION['sesSiteEmpresa'];
    }

    public function getSobreMim() {
        return $_SESSION['sesSobreMim'];
    }

    public function setCurso($valor) {
        $_SESSION['sesCurso'] = $valor;
    }

    public function setDataNascimento($valor) {
        $_SESSION['sesDataNascimento'] = $valor;
    }

    public function setEmail($valor) {
        $_SESSION['sesEmail'] = $valor;
    }

    public function setEndereco($valor) {
        $_SESSION['sesEndereco'] = $valor;
    }

    public function setHabilidades($valor) {
        $_SESSION['sesHabilidades'] = $valor;
    }

    public function setNivelEscolaridade($valor) {
        $_SESSION['sesIdNivelEscolaridade'] = $valor;
    }

    public function setIdUsuario($valor) {
        $_SESSION['sesIdUsuario'] = $valor;
    }

    public function setLogin($valor) {
        $_SESSION['sesLogin'] = $valor;
    }

    public function setNome($valor) {
        $_SESSION['sesNome'] = $valor;
    }

    public function setSexo($valor) {
        $_SESSION['sesSexo'] = $valor;
    }

    public function setSite($valor) {
        $_SESSION['sesSite'] = $valor;
    }

    public function setSiteEmpresa($valor) {
        $_SESSION['sesSiteEmpresa'] = $valor;
    }

    public function setSobreMim($valor) {
        $_SESSION['sesSobreMim'] = $valor;
    }

    public function setUltimaAtualizacao() {
        $_SESSION['sesUltimaAtualizacao'] = time();
    }
    
    public function getImagemPerfil() {
        return $_SESSION['sesImagemPerfil'];
    }
    public function getImagemPerfilFormatada($tipoImagem = Util::IMAGEM_GRANDE) {
        $imagem = $_SESSION['sesImagemPerfil'];

        return Util::validaImagem($imagem, $tipoImagem,Util::TIPO_IMAGEM_USUARIO);
    }

    public function getParametrosPrivacidade() {
        return $_SESSION['sesParametrosPrivacidade'];
    }

    public function getTwitter() {
        return $_SESSION['sesTwitter'];
    }

    public function setImagemPerfil($valor) {
        $_SESSION['sesImagemPerfil'] = $valor;
    }

    public function setParametrosPrivacidade($valor) {
        $_SESSION['sesParametrosPrivacidade'] = $valor;
    }

    public function setTwitter($valor) {
        $_SESSION['sesTwitter'] = $valor;
    }


    public function setSolicitacoesPendentes($solicitacoes) {
        if (is_array($solicitacoes)) {
            $_SESSION['sesSolicitacoesPendentes'] = $solicitacoes;
        } else {
            throw new Exception("solicitacoes precisa ser array");
        }
    }

    public function getSolicitacoesPendentes() {
        if (is_array($_SESSION['sesSolicitacoesPendentes'])) {
            return $_SESSION['sesSolicitacoesPendentes'];
        } else {
            return array();
        }
    }

    public function getQuantidadeSolicitacoesPendentes() {
        return count($this->getSolicitacoesPendentes());
    }

    public function removeSolicitacao($id) {
        if (isset($_SESSION['sesSolicitacoesPendentes'])) {
            unset($_SESSION['sesSolicitacoesPendentes'][$id]);
        }
    }

}

?>
