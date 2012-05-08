<?php

/**
 * institucional actions.
 *
 * @package    robolivre
 * @subpackage institucional
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class institucionalActions extends robolivreAction {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex() {
        $this->redirect('institucional/sobre');
    }

    public function executeSobre() {
        
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
