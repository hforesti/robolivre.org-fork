<?php

/**
 * UsuariosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UsuariosTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object UsuariosTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Usuarios');
    }

    public function buscarPorId($id) {
        
        $id_usuario_logado = UsuarioLogado::getInstancia()->getIdUsuario();
        
        $query = "SELECT u.*,a.id_usuario_a,
        IF (aceito is not null,aceito,null) as \"amigo\"
        FROM usuarios u LEFT JOIN amigos a 
        ON (id_usuario = id_usuario_a OR id_usuario = id_usuario_b) AND ((id_usuario_a = $id_usuario_logado OR id_usuario_b = $id_usuario_logado) OR (id_usuario_a is null AND id_usuario_b is null)) 
        WHERE id_usuario = $id AND ativo = 1";
        
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($query);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();
        if ($resultado) {
            foreach ($resultado as $reg) {
                $objUsuario = new Usuarios();

                $objUsuario->setCurso($reg['curso']);
                $objUsuario->setDataNascimento($reg['data_nascimento']);
                $objUsuario->setEmail($reg['email']);
                $objUsuario->setEndereco($reg['endereco']);
                $objUsuario->setHabilidades($reg['habilidades']);
                $objUsuario->setNivelEscolaridade($reg['nivel_escolaridade']);
                $objUsuario->setIdUsuario($reg['id_usuario']);
                $objUsuario->setLogin($reg['login']);
                $objUsuario->setSexo($reg['sexo']);
                $objUsuario->setSite($reg['site']);
                $objUsuario->setSiteEmpresa($reg['site_empresa']);
                $objUsuario->setSobreMim($reg['sobre_mim']);
                $objUsuario->setNome($reg['nome']);
                
                //sem registro de amizade
                if($reg['amigo']==null){
                    $objUsuario->setTipoSolicitacaoAmizade(Usuarios::SEM_SOLICITACAO);
                }else{
                    
                    if($id_usuario_logado != $reg['id_usuario_a'] && $reg['amigo'] == 0){
                        $objUsuario->setTipoSolicitacaoAmizade(Usuarios::AGUARDANDO_CONFIRMACAO);
                    }else{
                        $objUsuario->setTipoSolicitacaoAmizade($reg['amigo']);
                    }
                }
                return $objUsuario;
            }
        }
        return false;
    }
    
    
    public function getUsuariosListagem(){
        
        $arrayRetorno = array();
        
        $q = Doctrine_Query::create()
                ->select('id_usuario,nome')
                ->from('Usuarios')
                ->where("ativo =  1");

        $resultado = $q->fetchArray();
        
        if ($resultado) {
            foreach ($resultado as $reg) {
                $usuario = new Usuarios();
                $usuario->setNome($reg['nome']);
                $usuario->setIdUsuario($reg['id_usuario']);
                
                $arrayRetorno[]  = $usuario;
            }
        }
        
        return $arrayRetorno;
    }

    public function jaExiste($login, $email) {

        $q = Doctrine_Query::create()
                ->select('login,email')
                ->from('Usuarios')
                ->where("login = '$login' or email = '$email'")
                ->limit(1);

        $resultado = $q->fetchArray();

        if ($resultado) {
            foreach ($resultado as $reg) {
                if ($reg['login'] == $login) {
                    throw new ExceptionLoginExitente("O login $login já existe");
                }
                if ($reg['email'] == $email) {
                    throw new ExceptionEmailExistente("O email $email já exite");
                }
            }
        }
        return false;
    }

    public function login($login, $senha) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Usuarios')
                ->where("login = '$login' and senha = '$senha' and ativo = 1");


        $resultado = $q->fetchArray();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $objUsuario = new Usuarios();

                $objUsuario->setCurso($reg['curso']);
                $objUsuario->setDataNascimento($reg['data_nascimento']);
                $objUsuario->setEmail($reg['email']);
                $objUsuario->setEndereco($reg['endereco']);
                $objUsuario->setHabilidades($reg['habilidades']);
                $objUsuario->setNivelEscolaridade($reg['nivel_escolaridade']);
                $objUsuario->setIdUsuario($reg['id_usuario']);
                $objUsuario->setLogin($reg['login']);
                $objUsuario->setSexo($reg['sexo']);
                $objUsuario->setSite($reg['site']);
                $objUsuario->setSiteEmpresa($reg['site_empresa']);
                $objUsuario->setSobreMim($reg['sobre_mim']);
                $objUsuario->setNome($reg['nome']);

                return $objUsuario;
            }
        }
        return false;
    }

}