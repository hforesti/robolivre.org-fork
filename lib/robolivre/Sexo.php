<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sexo
 *
 * @author maxguenes
 */
class Sexo {
    
    public static function getDescricoes() {
        return array('' => 'Sem resposta','1'=>"Masculino",'2'=>"Feminino",'3'=>"Outro");
    }
    
    public static function getDescricao($id) {
        if(isset($id) && $id >= 1 && $id <= 7){
            $array = self::getDescricoes();
            return $array[$id];
        }
        return "";
    }
}

?>
