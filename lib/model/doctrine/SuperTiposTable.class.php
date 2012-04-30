<?php

/**
 * SuperTiposTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SuperTiposTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SuperTiposTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SuperTipos');
    }
    
    public function getSuperTipos() {
        
        $arrayRetorno = array();
        
        $q = Doctrine_Query::create()
                ->select('id_super_tipo,nome,descricao')
                ->from('SuperTipos');

        $resultado = $q->fetchArray();
        
        $arrayRetorno['null'] = 'Conteudo';
        
        if ($resultado) 
            foreach ($resultado as $reg){ 
                $arrayRetorno[$reg['id_super_tipo']] = $reg['nome'];
            }
        
        return $arrayRetorno;
    }
    
}