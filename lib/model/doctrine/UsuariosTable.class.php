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

    public function filtroSeguidoresConteudo($idConjunto, $nome = null, $indicePagina = 1) {
        $arrayRetorno = array();
        $qtdParticipantes = 0;
        $arrayAmigos = array();

        $queryParticipantes = "
            SELECT u.*
            FROM usuarios u 
            LEFT JOIN participantes_conjuntos p 
            ON u.id_usuario = p.id_usuario AND p.id_conjunto = $idConjunto
            LEFT JOIN conjuntos i
            ON  u.id_usuario  = i.id_usuario AND i.id_conjunto = $idConjunto
            WHERE ((p.aceito = 1 AND p.id_conjunto = $idConjunto) OR u.id_usuario = i.id_usuario)";
        if ($nome != null && trim($nome)!="") {
            $queryParticipantes .= "  AND u.nome LIKE '%$nome%' ";
        }
        
        $queryParticipantes .= " ORDER BY u.nome
            LIMIT " . (($indicePagina - 1) * Util::QUANTIDADE_PAGINACAO) . ", " . Util::QUANTIDADE_PAGINACAO;
        
        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM usuarios u 
            LEFT JOIN participantes_conjuntos p 
            ON u.id_usuario = p.id_usuario  AND p.id_conjunto = $idConjunto
            LEFT JOIN conjuntos i
            ON  u.id_usuario  = i.id_usuario AND i.id_conjunto = $idConjunto
            WHERE ((p.aceito = 1 AND p.id_conjunto = $idConjunto) OR u.id_usuario = i.id_usuario)";
        if ($nome != null && trim($nome)!="") {
            $queryQuantidade .= "  AND u.nome LIKE '%$nome%' ";
        }
        
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();


        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdParticipantes = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryParticipantes);
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
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                $objUsuario->setDataCriacaoPerfil($reg['data_criacao_perfil']);
                $objUsuario->setEmpresa($reg['empresa']);
                $objUsuario->setEscola($reg['escola']);
                $objUsuario->setProfissao($reg['profissao']);
                $objUsuario->setAulaRobolivre($reg['aula_robolivre']);
                
                $arrayAmigos[] = $objUsuario;
            }
        }
        
        $total = (int) ($qtdParticipantes / Util::QUANTIDADE_PAGINACAO);
        //caso a divisão real seja maior que a divisão inteira (resto)
        if (($qtdParticipantes / Util::QUANTIDADE_PAGINACAO) > $total) {
            ++$total;
        }

        $arrayRetorno['quantidade'] = $qtdParticipantes;
        $arrayRetorno['participantes'] = $arrayAmigos;
        $arrayRetorno['totalPaginas'] = $total;

        return $arrayRetorno;
    }
    
    public function filtroAmigosPerfil($idUsuario, $nome = null, $indicePagina = 1) {
        $arrayRetorno = array();
        $qtdAmigos = 0;
        $arrayAmigos = array();

        $queryAmigos = "
            SELECT u.*
            FROM usuarios u 
            LEFT JOIN amigos a 
            ON id_usuario = id_usuario_a OR id_usuario = id_usuario_b
            WHERE id_usuario <> $idUsuario AND a.aceito = 1 AND (a.id_usuario_a = $idUsuario OR a.id_usuario_b = $idUsuario)";
        if ($nome != null && trim($nome)!="") {
            $queryAmigos .= "  AND u.nome LIKE '%$nome%'";
        }
        
        $queryAmigos .= "     ORDER BY u.nome
            LIMIT " . (($indicePagina - 1) * Util::QUANTIDADE_PAGINACAO) . ", " . Util::QUANTIDADE_PAGINACAO;
        
        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM usuarios u 
            LEFT JOIN amigos a 
            ON id_usuario = id_usuario_a OR id_usuario = id_usuario_b
            WHERE id_usuario <> $idUsuario AND a.aceito = 1 AND (a.id_usuario_a = $idUsuario OR a.id_usuario_b = $idUsuario)";
        if ($nome != null && trim($nome)!="") {
            $queryQuantidade .= "  AND u.nome LIKE '%$nome%'";
        }
        
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();


        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdAmigos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryAmigos);
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
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                $objUsuario->setDataCriacaoPerfil($reg['data_criacao_perfil']);
                $objUsuario->setEmpresa($reg['empresa']);
                $objUsuario->setEscola($reg['escola']);
                $objUsuario->setProfissao($reg['profissao']);
                $objUsuario->setAulaRobolivre($reg['aula_robolivre']);
                
                $arrayAmigos[] = $objUsuario;
            }
        }
        
        $total = (int) ($qtdAmigos / Util::QUANTIDADE_PAGINACAO);
        //caso a divisão real seja maior que a divisão inteira (resto)
        if (($qtdAmigos / Util::QUANTIDADE_PAGINACAO) > $total) {
            ++$total;
        }

        $arrayRetorno['quantidade'] = $qtdAmigos;
        $arrayRetorno['amigos'] = $arrayAmigos;
        $arrayRetorno['totalPaginas'] = $total;

        return $arrayRetorno;
    }
    
    public function getAmigosPerfil($idUsuario) {

        $arrayRetorno = array();
        $qtdAmigos = 0;
        $arrayAmigos = array();

        $queryAmigos = "
            SELECT u.*
            FROM usuarios u 
            LEFT JOIN amigos a 
            ON id_usuario = id_usuario_a OR id_usuario = id_usuario_b
            WHERE id_usuario <> $idUsuario AND a.aceito = 1 AND (a.id_usuario_a = $idUsuario OR a.id_usuario_b = $idUsuario)
            LIMIT 0, 20";

        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM usuarios u 
            LEFT JOIN amigos a 
            ON id_usuario = id_usuario_a OR id_usuario = id_usuario_b
            WHERE id_usuario <> $idUsuario AND a.aceito = 1 AND (a.id_usuario_a = $idUsuario OR a.id_usuario_b = $idUsuario)";
        
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();


        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdAmigos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryAmigos);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $objUsuario = new Usuarios();
                $objUsuario->setIdUsuario($reg['id_usuario']);
                $objUsuario->setNome($reg['nome']);
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                
                $arrayAmigos[] = $objUsuario;
            }
        }

        $arrayRetorno['quantidade'] = $qtdAmigos;
        $arrayRetorno['amigos'] = $arrayAmigos;

//        Util::pre($arrayRetorno, true);

        return $arrayRetorno;
    }

    public function getParticipantesConjunto($idConjunto) {

        $arrayRetorno = array();
        $qtdAmigos = 0;
        $arrayParticipantes = array();

        $queryParticipantes = "
            SELECT u.*
            FROM usuarios u 
            LEFT JOIN participantes_conjuntos p 
            ON u.id_usuario = p.id_usuario AND p.id_conjunto = $idConjunto
            LEFT JOIN conjuntos i
            ON  u.id_usuario  = i.id_usuario AND i.id_conjunto = $idConjunto
            WHERE (p.aceito = 1 AND p.id_conjunto = $idConjunto) OR u.id_usuario = i.id_usuario
            LIMIT 0, 20";

        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM usuarios u 
            LEFT JOIN participantes_conjuntos p 
            ON u.id_usuario = p.id_usuario AND p.id_conjunto = $idConjunto
            LEFT JOIN conjuntos i
            ON  u.id_usuario  = i.id_usuario AND i.id_conjunto = $idConjunto
            WHERE (p.aceito = 1 AND p.id_conjunto = $idConjunto) OR u.id_usuario = i.id_usuario";
        
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();


        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdAmigos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryParticipantes);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $objUsuario = new Usuarios();
                $objUsuario->setIdUsuario($reg['id_usuario']);
                $objUsuario->setNome($reg['nome']);
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                
                $arrayParticipantes[] = $objUsuario;
            }
        }

        $arrayRetorno['quantidade'] = $qtdAmigos;
        $arrayRetorno['participantes'] = $arrayParticipantes;

//        Util::pre($arrayRetorno, true);

        return $arrayRetorno;
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
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                $objUsuario->setDataCriacaoPerfil($reg['data_criacao_perfil']);
                $objUsuario->setEmpresa($reg['empresa']);
                $objUsuario->setEscola($reg['escola']);
                $objUsuario->setProfissao($reg['profissao']);
                $objUsuario->setAulaRobolivre($reg['aula_robolivre']);
                
                //sem registro de amizade
                if ($reg['amigo'] == null) {
                    $objUsuario->setTipoSolicitacaoAmizade(Usuarios::SEM_SOLICITACAO);
                } else {

                    if ($id_usuario_logado != $reg['id_usuario_a'] && $reg['amigo'] == 0) {
                        $objUsuario->setTipoSolicitacaoAmizade(Usuarios::AGUARDANDO_CONFIRMACAO);
                    } else {
                        $objUsuario->setTipoSolicitacaoAmizade($reg['amigo']);
                    }
                }
                return $objUsuario;
            }
        }
        return false;
    }

    public function getUsuariosListagem() {

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

                $arrayRetorno[] = $usuario;
            }
        }

        return $arrayRetorno;
    }

    public function jaExiste($login, $email) {

        $q = Doctrine_Query::create()
                ->select('login,email')
                ->from('Usuarios')
                ->where("login = '$login' OR email = '$email'");

        $resultado = $q->fetchArray();
        $temLogin = false;
        $temEmail = false;
        if ($resultado) {
            foreach ($resultado as $reg) {
                if ($reg['login'] == $login) {
                    $temLogin = true;
                }
                if ($reg['email'] == $email) {
                    $temEmail = true;
                }
            }
        }

        if ($temLogin && $temEmail)
            throw new ExceptionEmailELoginExistente("O login $login e email $email já exite");
        if ($temLogin)
            throw new ExceptionLoginExitente("O login $login já existe");
        if ($temEmail)
            throw new ExceptionEmailExistente("O email $email já exite");


        return false;
    }

    public function login($login, $senha) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Usuarios')
                ->where("(login = '$login' OR email='$login')")
                ->andWhere("senha = '$senha'")
                ->andWhere("ativo = 1");


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
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                $objUsuario->setDataCriacaoPerfil($reg['data_criacao_perfil']);
                $objUsuario->setEmpresa($reg['empresa']);
                $objUsuario->setEscola($reg['escola']);
                $objUsuario->setProfissao($reg['profissao']);
                $objUsuario->setAulaRobolivre($reg['aula_robolivre']);
                
                return $objUsuario;
            }
        }
        return false;
    }
    
    public function atualizarImagemPerfil($idUsuario, $imagem) {
        $query = "UPDATE usuarios 
                 SET imagem_perfil = '$imagem'
                WHERE id_usuario = $idUsuario";
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();
        
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Usuarios')
                ->where("id_usuario = $idUsuario");

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
                $objUsuario->setImagemPerfil($reg['imagem_perfil']);
                $objUsuario->setDataCriacaoPerfil($reg['data_criacao_perfil']);
                $objUsuario->setEmpresa($reg['empresa']);
                $objUsuario->setEscola($reg['escola']);
                $objUsuario->setProfissao($reg['profissao']);
                $objUsuario->setAulaRobolivre($reg['aula_robolivre']);
                
                return $objUsuario;
            }
        }
    }

}