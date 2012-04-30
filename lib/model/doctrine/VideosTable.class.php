<?php

/**
 * VideosTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VideosTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object VideosTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Videos');
    }
    
    public function gravarVideo(Videos $video){
        
        $nomeArquivo = Util::validaNullInserBanco($video->getNomeArquivo());
        $linkVideo = Util::validaNullInserBanco($video->getLinkVideo());
        
        $query = "
        INSERT INTO videos (id_usuario, id_pasta,nome_arquivo,link_video) VALUES (" . UsuarioLogado::getInstancia()->getIdUsuario() . ", " . $video->getIdPasta() . ",$nomeArquivo,$linkVideo)";
        $connection = Doctrine_Manager::getInstance()
                        ->getCurrentConnection()->getDbh();
        // Get Connection of Database  
        $statement = $connection->prepare($query);
        // Make Statement  
        $statement->execute();
        
        $id = $connection->lastInsertId();
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('videos')
                ->where("id_video = $id");
        

        $resultado = $q->fetchArray();

        if ($resultado) {
            foreach ($resultado as $reg) {
                $video = new Videos();
                $video->setIdVideo($reg['id_video']);
                $video->setIdPasta($reg['id_pasta']);
                $video->setIdUsuario($reg['id_usuario']);
                $video->setLinkVideo($reg['link_video']);
                $video->setNomeArquivo($reg['nome_arquivo']);
                
                return $video;
            }
        }
    }
}