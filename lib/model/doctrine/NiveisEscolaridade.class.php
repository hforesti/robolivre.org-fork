<?php

/**
 * NiveisEscolaridade
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 ** @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class NiveisEscolaridade{
    
    public static function getNiveisEscolaridade() {
        return array(1 => array('id'=>1 ,'descricao'=>"Ensino Fundamental"),
                     2 => array('id'=>2 ,'descricao'=>"Ensino Médio"),
                     3 => array('id'=>3 ,'descricao'=>"Ensino Superior Completo"),
                     4 => array('id'=>4 ,'descricao'=>"Ensino Superior Incompleto"),
                     5 => array('id'=>5 ,'descricao'=>"Pós-Graduação"),
                     6 => array('id'=>6 ,'descricao'=>"Mestrado"),
                     7 => array('id'=>7 ,'descricao'=>"Doutorado"),
           );
    }
    
    public static function getDescricoes() {
        return array('' => 'Sem resposta',
                     '1'=>"Ensino Fundamental",
                     '2'=>"Ensino Fundamental Incompleto",
                     '3'=>"Ensino Médio",
                     '4'=>"Ensino Médio Incompleto",
                     '5'=>"Ensino Superior Completo",
                     '6'=>"Ensino Superior Incompleto",
                     'Pós-graduação' => array(
                        '5'=>"Pós-Graduação",
                        '6'=>"Mestrado",
                        '7'=>"Doutorado"
                         )
            
           );
    }
    
    public static function getDescricao($id) {
        if(isset($id) && $id >= 1 && $id <= 7){
            $array = self::getNiveisEscolaridade();
            return $array[$id]['descricao'];
        }
        return "";
    }
}
