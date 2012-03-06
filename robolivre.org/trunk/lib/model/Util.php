<?php

include_once "tipografia/php-typography.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author maxguenes
 */
class Util {

    const SEPARADOR_PARAMETRO = '[[*]]';
    
    public static function getTagUsuario($nomeUsuario,$idUsuario){
        return "<a href=\"".url_for('perfil/exibir?u='.$idUsuario)."\">$nomeUsuario</a>";
    }
    
    public static function getTagConteudo($nomeConteudo,$idConjunto){
        return "<a href=\"".url_for('conteudo/exibir?u='.$idConjunto)."\" class=\"fn\">$nomeConteudo</a>";
    }
    
    public static function getTextoFormatado($texto){
        $typo = new phpTypography();
        return $typo->process($texto);
    }

    public static function pre($string,$stop = false) {
        echo "<pre>";
        print_r($string);
        echo "</pre>";
        
        if($stop){
            die();
        }
    }

    public static function validaNullInserBanco($valor) {
        return ($valor == "" || $valor == null) ? 'null' : "'$valor'";
    }

    public static function dataIng($data) {

        $vetorData = explode("/", $data);

        return $vetorData[2] . "-" . $vetorData[1] . "-" . $vetorData[0];
    }

    public static function dataBr($data) {

        $vetorData = explode("-", $data);

        return $vetorData[2] . "/" . $vetorData[1] . "/" . $vetorData[0];
    }

    public static function dataBrHora($data) {

        $vetorData = explode(" ", $data);

        $vetorData[0] = Util::dataBr($vetorData[0]);
        $vetorData[1] = substr($vetorData[1], 0, 5);

        return $vetorData;
    }

    public static function dataIngHora($data) {

        $vetorData = explode(" ", $data);

        $vetorData[0] = Util::dataIng($vetorData[0]);

        return $vetorData[0] . " " . $vetorData[1];
    }

}

?>
