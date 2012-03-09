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
    
    const IMAGEM_GRANDE = 1;
    const IMAGEM_MEDIA = 2;
    const IMAGEM_MINIATURA = 3;
    
    
    public static function getTagUsuario($nomeUsuario,$idUsuario){
        return "<a href=\"".url_for('perfil/exibir?u='.$idUsuario)."\">$nomeUsuario</a>";
    }
    
    public static function getTagConteudo($nomeConteudo,$idConjunto,$comImagemReferencia = false){
        return (($comImagemReferencia)?"<i class=\"icon-tag icon-gray\"></i>":"")."<a href=\"".url_for('conteudo/exibir?u='.$idConjunto)."\" class=\"fn\">$nomeConteudo</a>";
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
    
    public static function getNomeSimplificado($nome) {
        $array = explode(" ", $nome);
        return $array[0];
    }
    
    public static function getDataFormatada($data){
        $dataRetorno = self::dataBrHora($data);
        return self::getDiaSemana($dataRetorno[0]).", ".$dataRetorno[0]." ".$dataRetorno[1];
    }
    
    
    public static function getDataSimplificada($data){
        $dataRetorno = self::dataBrHora($data);
        return self::getDiaSemana($dataRetorno[0]).", ".$dataRetorno[0]." ".$dataRetorno[1];
    }
    
    
    
    
    public static function getDiaSemana($pData){
        $data = explode("/", $pData);
        $data = getdate(mktime(0,0, 0, $data[1], $data[0], $data[2]));
        $dias_semana = array('Domingo', 'Segunda', 'Terça','Quarta', 'Quinta', 'Sexta', 'Sábado');
        return $dias_semana[$data['wday']];
    }
    
    public static function getDiretorioThumbnail(){
        $v = new sfProjectConfiguration(); 
        return $v->getRootDir()."/web/assets/img/thumbnails";
    }

}

?>
