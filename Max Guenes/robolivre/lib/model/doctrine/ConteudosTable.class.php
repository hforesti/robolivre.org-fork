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

    public function gravarConteudo(Conteudos $conteudo) {
        $query = "
        INSERT INTO conjuntos (id_usuario, id_tipo_conjunto) VALUES (" . UsuarioLogado::getInstancia()->getIdUsuario() . ", " . TiposConjuntos::CONTEUDO . ");
        INSERT INTO conteudos (id_conjunto, id_tipo_conjunto,nome,descricao,enviar_email_criador)
            VALUES (LAST_INSERT_ID(), " . TiposConjuntos::CONTEUDO . ",'" . $conteudo->getNome() . "','" . $conteudo->getDescricao() . "','" . $conteudo->getEnviarEmailCriador() . "')";
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();
    }

    public function getConteudosListagem() {

        $arrayRetorno = array();

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Conteudos');

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

}