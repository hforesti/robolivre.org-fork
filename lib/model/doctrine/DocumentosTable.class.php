<?php

/**
 * DocumentosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DocumentosTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DocumentosTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Documentos');
    }
    public function removeDocumento($idDocumento){
        
        $query = "DELETE FROM documentos
                WHERE id_documento = '$idDocumento'";
        
            $connection = Doctrine_Manager::getInstance()
                            ->getCurrentConnection()->getDbh();
            // Get Connection of Database  
            $statement = $connection->prepare($query);
            // Make Statement  
            $statement->execute();
    }
    public function filtroDocumentosConteudo($idConjunto,$proprietario = false, $nome = null, $indicePagina = 1) {
        $arrayRetorno = array();
        $qtdDocumentos = 0;
        $arrayDocumentos = array();

        $queryDocumentos = "
            SELECT d.*
            FROM documentos d 
            LEFT JOIN pastas p ON p.id_pasta = d.id_pasta
            WHERE p.id_conjunto = $idConjunto AND p.tipo_pasta = ".Pastas::TIPO_PASTA_ANEXOS_CONJUNTO;
        if ($nome != null && trim($nome)!="") {
            $queryDocumentos .= "  AND (d.nome_arquivo LIKE '%$nome%' OR d.nome_documento LIKE '%$nome%')";
        }
        if($proprietario){
            $queryDocumentos .= "  AND d.id_usuario = ".UsuarioLogado::getInstancia()->getIdUsuario();
        }
        
        $queryDocumentos .= " ORDER BY d.nome_documento
            LIMIT " . (($indicePagina - 1) * Util::QUANTIDADE_PAGINACAO) . ", " . Util::QUANTIDADE_PAGINACAO;
        
        $queryQuantidade = "
            SELECT COUNT(*) AS \"quantidade\"
            FROM documentos d 
            LEFT JOIN pastas p ON p.id_pasta = d.id_pasta
            WHERE p.id_conjunto = $idConjunto AND p.tipo_pasta = ".Pastas::TIPO_PASTA_ANEXOS_CONJUNTO;
        if ($nome != null && trim($nome)!="") {
            $queryQuantidade .= "  AND (d.nome_arquivo LIKE '%$nome%' OR d.nome_documento LIKE '%$nome%')";
        }
        if($proprietario){
                $queryQuantidade .= "  AND d.id_usuario = ".UsuarioLogado::getInstancia()->getIdUsuario();
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
                $qtdDocumentos = $reg['quantidade'];
                break;
            }
        }

        $statement = $connection->prepare($queryDocumentos);
        // Make Statement  

        $statement->execute();
        // Execute Query  

        $resultado = $statement->fetchAll();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $documento = new Documentos();
                $documento->setIdDocumento($reg['id_documento']);
                $documento->setIdPasta($reg['id_pasta']);
                $documento->setIdUsuario($reg['id_usuario']);
                $documento->setNomeArquivo($reg['nome_arquivo']);
                $documento->setNomeDocumento($reg['nome_documento']);
                $documento->setIsCodigoFonte($reg['is_codigo_fonte']);
                
                $arrayDocumentos[] = $documento;
            }
        }
        
        $total = (int) ($qtdDocumentos / Util::QUANTIDADE_PAGINACAO);
        //caso a divisão real seja maior que a divisão inteira (resto)
        if (($qtdDocumentos / Util::QUANTIDADE_PAGINACAO) > $total) {
            ++$total;
        }

        $arrayRetorno['quantidade'] = $qtdDocumentos;
        $arrayRetorno['documentos'] = $arrayDocumentos;
        $arrayRetorno['totalPaginas'] = $total;

        return $arrayRetorno;
    }
}