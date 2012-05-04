<?php

/**
 * institucional actions.
 *
 * @package    robolivre
 * @subpackage institucional
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class institucionalActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex() {
        $this->redirect('institucional/sobre');
    }

    public function executeSobre() {
        
        // pega o endereço do diretório
        $diretorio = Util::getDiretorioArquivosInstitucionais();
        
        // abre o diretório
        $ponteiro = opendir($diretorio);
        // monta os vetores com os itens encontrados na pasta
        while ($nome_itens = readdir($ponteiro)) {
            if($nome_itens!="." && $nome_itens!=".."){
                $path_parts = pathinfo($diretorio."/".$nome_itens);
                //echo "Modificado em ".date ("d/m/Y H:i:s.",filemtime($diretorio."/".$nome_itens));
                //Util::pre($path_parts);
                
                $array['nome'] = $path_parts['filename'];
                $array['extensao'] = $path_parts['extension'];
                $array['arquivo'] = $path_parts['basename'];
                $array['novo'] = false;
                $itens[] = $array;
            }
        }
        
        $this->arquivos = $itens;
        
    }

    public function executeInstituicoesParceiras() {
        
    }

    public function executeApresentacoes() {
        
    }

    public function executePublicacoesCientificas() {
        
    }
    
    public function executeCreditos() {
        
    }
    
}
