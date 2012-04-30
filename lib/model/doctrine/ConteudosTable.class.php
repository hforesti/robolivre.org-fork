<?php

/**
 * ConteudosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ConteudosTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ConteudosTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Conteudos');
    }

    public function getConteudosSeguidosPerfil($idUsuario) {
        $arrayRetorno = array();
        $qtdConteudosSeguidos = 0;

        $queryConteudos = "
            SELECT c.*,
            i.id_conjunto as \"i.id_conjunto\",i.id_tipo_conjunto as \"i.id_tipo_conjunto\",i.id_usuario AS \"i.id_usuario\",i.imagem_perfil AS \"i.imagem_perfil\"
            FROM conteudos c 
            LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto  
            LEFT JOIN participantes_conjuntos p ON p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
            WHERE p.id_usuario = $idUsuario AND p.aceito  = 1 OR i.id_usuario = $idUsuario
            LIMIT 0, 20
        ";

        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM conteudos c 
            LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto  
            LEFT JOIN participantes_conjuntos p ON p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
            WHERE p.id_usuario = $idUsuario AND p.aceito  = 1 OR i.id_usuario = $idUsuario
        ";
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        $arrayConteudos = array();
        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdConteudosSeguidos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryConteudos);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        $arrayConteudos = array();
        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['i.id_conjunto']);
                $conjunto->setIdUsuario($reg['i.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['i.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['i.imagem_perfil']);

                $conteudo->setConjunto($conjunto);

                $arrayConteudos[] = $conteudo;
            }
        }

        $arrayRetorno['quantidade'] = $qtdConteudosSeguidos;
        $arrayRetorno['conteudos'] = $arrayConteudos;

//        Util::pre($arrayRetorno, true);

        return $arrayRetorno;
    }

    public function buscaPorId($idConjunto, $idConteudo = null) {

        $id_usuario_logado = UsuarioLogado::getInstancia()->getIdUsuario();
        $query = "SELECT IF (p.aceito is not null,p.aceito,null) as \"participante\",c.*,
        i.id_conjunto as \"i.id_conjunto\",i.id_tipo_conjunto as \"i.id_tipo_conjunto\",i.id_usuario AS \"i.id_usuario\",i.imagem_perfil AS \"i.imagem_perfil\",
        t.id_tipo_permissao_conjunto as \"t.id_tipo_permissao_conjunto\",
        u.nome as \"u.nome\"
        FROM conteudos c 
        LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto 
        LEFT JOIN participantes_conjuntos p ON p.id_usuario = $id_usuario_logado AND p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
        LEFT JOIN tipos_permissoes_conjuntos t ON t.id_tipo_permissao_conjunto = p.id_tipo_permissao_conjunto       
        LEFT JOIN usuarios u ON i.id_usuario = u.id_usuario
        WHERE c.id_conjunto = $idConjunto";

        if ($idConteudo != null) {
            $query .= " AND c.id_conteudo = $idConteudo";
        }

        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($query);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

//        Util::pre($statement);
//        Util::pre($resultado,true);

        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['i.id_conjunto']);
                $conjunto->setIdUsuario($reg['i.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['i.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['i.imagem_perfil']);

                $conteudo->setConjunto($conjunto);
                $conteudo->setNomeProprietario($reg['u.nome']);

                if ($conjunto->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) {
                    $conteudo->setTipoUsuario(Conteudos::PROPRIETARIO);
                    $conteudo->setTipoSolicitacao(Conteudos::PARTICIPANTE);
                } else {
                    $conteudo->setTipoUsuario($reg['t.id_tipo_permissao_conjunto']);
                    if ($reg['participante'] == null) {
                        $conteudo->setTipoSolicitacao(Conteudos::SEM_SOLICITACAO);
                    } else {
                        $conteudo->setTipoSolicitacao($reg['participante']);
                    }
                }

                return $conteudo;
            }
        }
    }

    private function getSQLPontuacaoConteudo() {
        return "SELECT caux.id_conteudo, (COUNT( paux.id_conjunto )-1) as \"pontos\"
                FROM conteudos caux
                LEFT JOIN publicacoes paux ON paux.id_conjunto = caux.id_conjunto
                GROUP BY paux.id_conjunto";
    }
    
    private function getSQLQuantidadesArquivosConteudo(){
        return "SELECT id_conjunto, COUNT( id_imagem ) as \"imagens\" , COUNT( id_video ) as \"videos\" , COUNT( link ) as \"links\"
                    FROM publicacoes 
                    WHERE id_conjunto IS NOT NULL
                    GROUP BY id_conjunto";
    }
    private function getSQLQuantidadesSeguidores(){
        return  "SELECT id_conjunto, COUNT(id_conjunto) AS \"seguidores\" 
                    FROM participantes_conjuntos 
                    GROUP BY id_conjunto";
    }

    public function filtroConteudosPerfil($idUsuario,$isProprietario=false, $nome = null, $indicePagina = 1) {

        $arrayRetorno = array();
        $qtdConteudosSeguidos = 0;

        $SQLPontuacao = $this->getSQLPontuacaoConteudo();
        $SQLQuantidadesArquivos = $this->getSQLQuantidadesArquivosConteudo();
        $SQLQuantidadesSeguidores = $this->getSQLQuantidadesSeguidores();
        
        $queryConteudos = "
            SELECT c.*,IF (p.aceito is not null,p.aceito,null) as \"participante\",
            i.id_conjunto as \"i.id_conjunto\",i.id_tipo_conjunto as \"i.id_tipo_conjunto\",i.id_usuario AS \"i.id_usuario\",i.imagem_perfil AS \"i.imagem_perfil\",
            qts.imagens , qts.videos, qts.links,IF (seg.seguidores is not null,seg.seguidores+1,1) as \"seguidores\",
            t.id_tipo_permissao_conjunto as \"t.id_tipo_permissao_conjunto\"
            FROM conteudos c 
            LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto  
            LEFT JOIN participantes_conjuntos p ON p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
            LEFT JOIN tipos_permissoes_conjuntos t ON t.id_tipo_permissao_conjunto = p.id_tipo_permissao_conjunto       
            LEFT JOIN ($SQLPontuacao) pts ON pts.id_conteudo = c.id_conteudo
            LEFT JOIN ($SQLQuantidadesArquivos) qts ON qts.id_conjunto = c.id_conjunto
            LEFT JOIN ($SQLQuantidadesSeguidores) seg ON seg.id_conjunto = c.id_conjunto
            WHERE (p.id_usuario = $idUsuario OR i.id_usuario = $idUsuario)";
        if ($nome != null && trim($nome)!="") {
            $queryConteudos .= "  AND c.nome LIKE '%$nome%'";
        }
        if($isProprietario){
            $queryConteudos .= "  AND i.id_usuario = ".UsuarioLogado::getInstancia()->getIdUsuario();
        }
        $queryConteudos .= "     ORDER BY pts.pontos,c.nome
            LIMIT " . (($indicePagina - 1) * Util::QUANTIDADE_PAGINACAO) . ", " . Util::QUANTIDADE_PAGINACAO;

        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM conteudos c 
            LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto  
            LEFT JOIN participantes_conjuntos p ON p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
            LEFT JOIN tipos_permissoes_conjuntos t ON t.id_tipo_permissao_conjunto = p.id_tipo_permissao_conjunto       
            LEFT JOIN ($SQLPontuacao) pts ON pts.id_conteudo = c.id_conteudo
            LEFT JOIN ($SQLQuantidadesArquivos) qts ON qts.id_conjunto = c.id_conjunto
            LEFT JOIN ($SQLQuantidadesSeguidores) seg ON seg.id_conjunto = c.id_conjunto
            WHERE (p.id_usuario = $idUsuario OR i.id_usuario = $idUsuario)";
        if ($nome != null && trim($nome)!="") {
            $queryQuantidade .= "  AND c.nome LIKE '%$nome%'";
        }
        if($isProprietario){
            $queryQuantidade .= "  AND i.id_usuario = ".UsuarioLogado::getInstancia()->getIdUsuario();
        }
        
        //die("$queryConteudos<br/><br/>$queryQuantidade");
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($queryQuantidade);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        $arrayConteudos = array();
        if ($resultado) {
            foreach ($resultado as $reg) {
                $qtdConteudosSeguidos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryConteudos);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        $arrayConteudos = array();
        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);
                
                $conteudo->setQuantidadeImagens($reg['imagens']);
                $conteudo->setQuantidadeVideos($reg['videos']);
                $conteudo->setQuantidadeLinks($reg['links']);
                $conteudo->setQuantidadeSeguidores($reg['seguidores']);
                
                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['i.id_conjunto']);
                $conjunto->setIdUsuario($reg['i.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['i.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['i.imagem_perfil']);

                $conteudo->setConjunto($conjunto);
                
                if ($conjunto->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) {
                    $conteudo->setTipoUsuario(Conteudos::PROPRIETARIO);
                    $conteudo->setTipoSolicitacao(Conteudos::PARTICIPANTE);
                } else {
                    $conteudo->setTipoUsuario($reg['t.id_tipo_permissao_conjunto']);
                    if ($reg['participante'] == null) {
                        $conteudo->setTipoSolicitacao(Conteudos::SEM_SOLICITACAO);
                    } else {
                        $conteudo->setTipoSolicitacao($reg['participante']);
                    }
                }
                
                $arrayConteudos[] = $conteudo;
            }
        }

        $total = (int) ($qtdConteudosSeguidos / Util::QUANTIDADE_PAGINACAO);
        //caso a divisão real seja maior que a divisão inteira (resto)
        if (($qtdConteudosSeguidos / Util::QUANTIDADE_PAGINACAO) > $total) {
            ++$total;
        }

        $arrayRetorno['quantidade'] = $qtdConteudosSeguidos;
        $arrayRetorno['conteudos'] = $arrayConteudos;
        $arrayRetorno['totalPaginas'] = $total;

        return $arrayRetorno;
    }

    public function buscaPorSlug($slug) {

        $slug = strtolower($slug);

        $id_usuario_logado = UsuarioLogado::getInstancia()->getIdUsuario();
        $query = "SELECT IF (p.aceito is not null,p.aceito,null) as \"participante\",c.*,
        i.id_conjunto as \"i.id_conjunto\",i.id_tipo_conjunto as \"i.id_tipo_conjunto\",i.id_usuario AS \"i.id_usuario\",i.imagem_perfil AS \"i.imagem_perfil\",
        t.id_tipo_permissao_conjunto as \"t.id_tipo_permissao_conjunto\",
        u.nome as \"u.nome\"
        FROM conteudos c 
        LEFT JOIN conjuntos i ON c.id_conjunto = i.id_conjunto AND c.id_tipo_conjunto = i.id_tipo_conjunto 
        LEFT JOIN participantes_conjuntos p ON p.id_usuario = $id_usuario_logado AND p.id_conjunto = i.id_conjunto AND p.id_tipo_conjunto = i.id_tipo_conjunto
        LEFT JOIN tipos_permissoes_conjuntos t ON t.id_tipo_permissao_conjunto = p.id_tipo_permissao_conjunto       
        LEFT JOIN usuarios u ON i.id_usuario = u.id_usuario
        WHERE i.slug = '$slug'";

        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  

        $statement = $connection->prepare($query);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

//        Util::pre($statement);
//        Util::pre($resultado,true);

        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['i.id_conjunto']);
                $conjunto->setIdUsuario($reg['i.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['i.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['i.imagem_perfil']);

                $conteudo->setConjunto($conjunto);
                $conteudo->setNomeProprietario($reg['u.nome']);

                if ($conjunto->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) {
                    $conteudo->setTipoUsuario(Conteudos::PROPRIETARIO);
                    $conteudo->setTipoSolicitacao(Conteudos::PARTICIPANTE);
                } else {
                    $conteudo->setTipoUsuario($reg['t.id_tipo_permissao_conjunto']);
                    if ($reg['participante'] == null) {
                        $conteudo->setTipoSolicitacao(Conteudos::SEM_SOLICITACAO);
                    } else {
                        $conteudo->setTipoSolicitacao($reg['participante']);
                    }
                }
                return $conteudo;
            }
        }

        return false;
    }

    public function buscaPorNomeParcial($nome) {

        $nome = strtolower($nome);

        $retorno = array();
        $query = "SELECT c.nome,c.id_conteudo,u.id_conjunto, u.imagem_perfil
            FROM conteudos c 
            LEFT JOIN conjuntos u ON c.id_conjunto = u.id_conjunto
            WHERE LOWER(c.nome) LIKE '$nome%' OR LOWER(c.nome) LIKE '% $nome%'";

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
                $conteudo = new Conteudos();
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setNome($reg['nome']);
                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['id_conjunto']);
                $conjunto->setImagemPerfil($reg['imagem_perfil']);
                $conteudo->setConjunto($conjunto);


                $retorno[] = $conteudo;
            }
        }
        return $retorno;
    }

    public function editarConteudo(Conteudos $conteudo) {
        $slug = Util::criaSlug($conteudo->getNome());

        $imagem_perfil = $conteudo->getConjunto()->getImagemPerfil();

        if (!isset($imagem_perfil) || $imagem_perfil == "") {
            $imagem_perfil = "NULL";
        } else {
            $imagem_perfil = "'$imagem_perfil'";
        }

        $query = "UPDATE conjuntos 
                 SET imagem_perfil = $imagem_perfil, slug = '$slug'
                WHERE id_conjunto = " . $conteudo->getIdConjunto();

        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();

        $query = "UPDATE conteudos 
                 SET nome = '" . $conteudo->getNome() . "',descricao='" . $conteudo->getDescricao() . "',enviar_email_criador=" . $conteudo->getEnviarEmailCriador() . "
                WHERE id_conjunto = " . $conteudo->getIdConjunto();
//        die($query);
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();

        return $conteudo;
    }

    public function gravarConteudo(Conteudos $conteudo) {

        $slug = Util::criaSlug($conteudo->getNome());

        $imagem_perfil = $conteudo->getConjunto()->getImagemPerfil();

        if (!isset($imagem_perfil) || $imagem_perfil == "") {
            $imagem_perfil = "NULL";
        } else {
            $imagem_perfil = "'$imagem_perfil'";
        }

        $query = "
        INSERT INTO conjuntos (id_usuario, id_tipo_conjunto,slug,imagem_perfil) VALUES (" . UsuarioLogado::getInstancia()->getIdUsuario() . ", " . TiposConjuntos::CONTEUDO . ",'$slug',$imagem_perfil);
        INSERT INTO conteudos (id_conjunto, id_tipo_conjunto,nome,descricao,enviar_email_criador)
            VALUES (LAST_INSERT_ID(), " . TiposConjuntos::CONTEUDO . ",'" . $conteudo->getNome() . "','" . $conteudo->getDescricao() . "','" . $conteudo->getEnviarEmailCriador() . "')";
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();

        $id = $connection->lastInsertId();

        $query = "SELECT c.*,
        u.id_conjunto as \"u.id_conjunto\",u.id_tipo_conjunto as \"u.id_tipo_conjunto\",u.id_usuario AS \"u.id_usuario\",u.imagem_perfil AS \"u.imagem_perfil\"
        FROM conteudos c 
        LEFT JOIN conjuntos u ON c.id_conjunto = u.id_conjunto AND c.id_tipo_conjunto = u.id_tipo_conjunto 
        WHERE id_conteudo = $id";

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

                $id_conjunto = $reg['u.id_conjunto'];

                $logSistema = new LogsSistema();
                $logSistema->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $logSistema->setTipoLog(LogsSistema::CRIOU_CONTEUDO);
                $logSistema->setDescricao(LogsSistema::getDescricaoPeloTipo(LogsSistema::CRIOU_CONTEUDO));
                $logSistema->setDataPublicacao(date('Y-m-d H:i:s'));
                $logSistema->setParametros(
                        "IP:" . UsuarioLogado::getInstancia()->getEnderecoRemoto() . LogsSistema::SEPARADOR .
                        "ID_CONJUNTO:" . $id_conjunto . LogsSistema::SEPARADOR
                );
                $logSistema->save();

                $objPublicacao = new Publicacoes();
                $objPublicacao->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $objPublicacao->setDataPublicacao(date('Y-m-d H:i:s'));
                $objPublicacao->setIdConjunto($id_conjunto);
                $objPublicacao->setTipoPublicacao(Publicacoes::CRIACAO_CONJUNTO);

                $objPublicacao->save();

                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($id_conjunto);
                $conjunto->setIdUsuario($reg['u.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['u.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['u.imagem_perfil']);
                $conjunto->setSlug($slug);

                $conteudo->setConjunto($conjunto);
                $conteudo->setTipoUsuario(Conteudos::PROPRIETARIO);
                $conteudo->setNomeProprietario(UsuarioLogado::getInstancia()->getNome());
                return $conteudo;
            }
        }
    }

    public function getConteudosListagem() {

        $arrayRetorno = array();

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Conteudos')
                ->leftJoin("Conjuntos");


        $resultado = $q->fetchArray();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $arrayRetorno[] = $conteudo;
            }
        }

        return $arrayRetorno;
    }

    public function validaNomeConteudo($nome, $idConjunto = "") {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Conteudos')
                ->where("nome = '$nome'");
        if ($idConjunto != "") {
            $q->andWhere("id_conjunto <> $idConjunto");
        }

        $resultado = $q->fetchArray();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                return $conteudo;
            }
        }

        return false;
    }

    function getConteudosRelacionados($idConjunto) {
        $arrayRetorno = array();
        $qtdConteudos = 0;
        $arrayConteudos = array();

        $queryAmigos = "
            SELECT c.*,
            u.id_conjunto as \"u.id_conjunto\",u.id_tipo_conjunto as \"u.id_tipo_conjunto\",u.id_usuario AS \"u.id_usuario\",u.imagem_perfil AS \"u.imagem_perfil\"
            FROM conteudos c
            LEFT JOIN conjuntos u ON u.id_conjunto = c.id_conjunto
            LEFT JOIN tags_conteudos t
            ON c.id_conjunto = t.id_conjunto_referencia OR c.id_conjunto = t.id_conjunto_referenciado
            WHERE c.id_conjunto <> $idConjunto AND (t.id_conjunto_referencia = $idConjunto OR t.id_conjunto_referenciado = $idConjunto)
            GROUP BY c.id_conjunto
            LIMIT 0, 20";

        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM conteudos c
            LEFT JOIN conjuntos u ON u.id_conjunto = c.id_conjunto
            LEFT JOIN tags_conteudos t
            ON c.id_conjunto = t.id_conjunto_referencia OR c.id_conjunto = t.id_conjunto_referenciado
            WHERE c.id_conjunto <> $idConjunto AND (t.id_conjunto_referencia = $idConjunto OR t.id_conjunto_referenciado = $idConjunto)
            GROUP BY c.id_conjunto";

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
                $qtdConteudos = $reg['quantidade'];
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
                $conteudo = new Conteudos();

                $conteudo->setIdConteudo($reg['id_conteudo']);
                $conteudo->setIdTipoConjunto($reg['id_tipo_conjunto']);
                $conteudo->setIdConjunto($reg['id_conjunto']);
                $conteudo->setIdSuperTipo($reg['id_super_tipo']);
                $conteudo->setNome($reg['nome']);
                $conteudo->setDescricao($reg['descricao']);
                $conteudo->setEnviarEmailCriador($reg['enviar_email_criador']);
                $conteudo->setNomeRepositorioGithub($reg['nome_repositorio_github']);

                $conjunto = new Conjuntos();
                $conjunto->setIdConjunto($reg['u.id_conjunto']);
                $conjunto->setIdUsuario($reg['u.id_usuario']);
                $conjunto->setIdTipoConjunto($reg['u.id_tipo_conjunto']);
                $conjunto->setImagemPerfil($reg['u.imagem_perfil']);

                $conteudo->setConjunto($conjunto);

                $arrayConteudos[] = $conteudo;
            }
        }

        $arrayRetorno['quantidade'] = $qtdConteudos;
        $arrayRetorno['conteudos'] = $arrayConteudos;

//        Util::pre($arrayRetorno, true);

        return $arrayRetorno;
    }

}