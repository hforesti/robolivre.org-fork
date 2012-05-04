<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuracoes
 *
 * @author maxguenes
 */
class ConfiguracoesEmailUsario {
    
    const SEPARADOR_GRUPOS = " ";
    
    const GRUPO_INFORMATIVO = "i";
    const GRUPO_AMIGO = "a";
    const GRUPO_CONTEUDO = "c";
    
    /* INFORMATIVO */
    const INFORMATIVO_NEWSLETTER = "i";
    
    /* AMIGO */
    const AMIGO_ADICIONAR = "a";
    
    /* CONTEUDO */
    const CONTEUDO_COLABORAR = "c";
    
    public static function getChavesConfiguracoesInformativo(){
        return array_keys(self::getConfiguracoesInformativo());
    }
    
    private static function getConfiguracoesInformativo() {
        return array(
            self::INFORMATIVO_NEWSLETTER => 'Receber nossa super newsletter com super novidades da rede e dos nossos super projetos :-)',
            );
    }
    
    public static function getChavesConfiguracoesAmigo(){
        return array_keys(self::getConfiguracoesAmigo());
    }
    
    private static function getConfiguracoesAmigo() {
        return array(
            self::AMIGO_ADICIONAR => 'Receber email quando alguém lhe adicionar como amigo',
            );
    }
    
    public static function getChavesConfiguracoesConteudo(){
        return array_keys(self::getConfiguracoesConteudo());
    }
    
    private static function getConfiguracoesConteudo() {
        return array(
            self::CONTEUDO_COLABORAR => 'Receber email quando alguém lhe convidar para colaborar com um conteúdo',
            );
    }
    
    public static function getWidgetsInputsConfiguracao(){
        
        $arrayRetorno = array();
        $array = self::getConfiguracoesInformativo();
        foreach(array_keys($array) as $chave){
            $label = $array[$chave];
            $widget = new sfWidgetFormInputCheckbox(array(),array('value'=>$chave));
            $widget->setLabel($label);
            $arrayRetorno["informativo_$chave"] = $widget;
        }

        $array = self::getConfiguracoesAmigo();
        foreach(array_keys($array) as $chave){
            $label = $array[$chave];
            $widget = new sfWidgetFormInputCheckbox(array(),array('value'=>$chave));
            $widget->setLabel($label);
            $arrayRetorno["amigo_$chave"] = $widget;
        }
        

        $array = self::getConfiguracoesConteudo();
        foreach(array_keys($array) as $chave){
            $label = $array[$chave];
            $widget = new sfWidgetFormInputCheckbox(array(),array('value'=>$chave));
            $widget->setLabel($label);
            $arrayRetorno["conteudo_$chave"] = $widget;
        }
        
        return $arrayRetorno;
    }
    
    public static function getWidgetsValidatorsConfiguracao(){
        
        $arrayRetorno = array();
        $array = self::getConfiguracoesInformativo();
        foreach(array_keys($array) as $chave){
            $widget = new sfValidatorString(array('max_length' => 4, 'required' => false));
            $arrayRetorno["informativo_$chave"] = $widget;
        }

        $array = self::getConfiguracoesAmigo();
        foreach(array_keys($array) as $chave){
            $widget = new sfValidatorString(array('max_length' => 4, 'required' => false));
            $arrayRetorno["amigo_$chave"] = $widget;
        }
        

        $array = self::getConfiguracoesConteudo();
        foreach(array_keys($array) as $chave){
            $widget = new sfValidatorString(array('max_length' => 4, 'required' => false));
            $arrayRetorno["conteudo_$chave"] = $widget;
        }
        
        
        return $arrayRetorno;
    }
   
    
    public static function getTodosParametrosConfiguracao($array){
        
        $retorno = "";
        $parametrosAmigos = "";
        $parametrosInformativo = "";
        $parametrosConteudo = "";
        
        foreach(array_keys($array) as $chave){
            
            if(strstr($chave, "informativo_")){
                $parametrosInformativo.= $array[$chave];
            }
            else if(strstr($chave, "amigo_")){
                $parametrosAmigos.= $array[$chave];
            }
            else if(strstr($chave, "conteudo_")){
                $parametrosConteudo.= $array[$chave];
            }
        }
        
        if($parametrosInformativo!=""){
            $retorno .= self::GRUPO_INFORMATIVO."[$parametrosInformativo]".self::SEPARADOR_GRUPOS;
        }
        if($parametrosAmigos!=""){
            $retorno .= self::GRUPO_AMIGO."[$parametrosAmigos]".self::SEPARADOR_GRUPOS;
        }
        if($parametrosConteudo!=""){
            $retorno .= self::GRUPO_CONTEUDO."[$parametrosConteudo]".self::SEPARADOR_GRUPOS;
        }
        
        return $retorno;
    }
}

?>
