<?php

/**
 * LogsSistema
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class LogsSistema extends BaseLogsSistema
{
    const LOGIN_SISTEMA = 1;
    const CADASTRO_SISTEMA = 2;
    const RECUSAR_SOLICITACAO = 3;
    const ACEITAR_SOLICITACAO = 4;
    const SOLICITOU_AMIZADE = 5;
    const SEGUIR_CONTEUDO = 6;
    const PARTICIPAR_COMUNIDADE = 7;
    const SEPARADOR = "[*]";
    
    
    
    public static function getDescricaoPeloTipo($idTipo){
        $DESCRICOES_LOGS = array(
            1 => "Logou no sistema",
            2 => "Cadastrou no sistema",
            3 => "Recusou Solicitacao",
            4 => "Recusou Solicitacao",
            5 => "Solicitou Amizade",
            6 => "Solicitou Seguir conteúdo",
            7 => "Solicitou participação na comunidade",
        );
        
        return $DESCRICOES_LOGS[$idTipo];
    }
    
}