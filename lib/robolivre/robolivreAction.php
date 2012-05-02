<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of robolivreAction
 *
 * @author maxguenes
 */
class robolivreAction extends sfActions {

    public function execute($request,$executarTeste = true) {
        if ($executarTeste && !UsuarioLogado::getInstancia()->isLogado() && !UsuarioLogado::getInstancia()->isUsuarioPublico()) {
            $this->redirect("inicial/telaLogin");
        } else {
            return parent::execute($request);
        }
    }

}

?>
