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
abstract class robolivreAction extends sfActions {

    public function execute($request,$executarTeste = true) {
        $this->formLoginLayout = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
        
        if ($executarTeste && !UsuarioLogado::getInstancia()->isLogado() && !UsuarioLogado::getInstancia()->isUsuarioPublico()) {
            $request->setAttribute('ultima_pagina', $request->getUri()) ;
            $this->forward("inicial","telaLogin");
        } else {
            return parent::execute($request);
        }
    }

}

?>
