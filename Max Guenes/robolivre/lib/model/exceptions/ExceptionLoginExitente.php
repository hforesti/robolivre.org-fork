<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExceptionLoginExitente
 *
 * @author maxguenes
 */
class ExceptionLoginExitente extends Exception{
    public function __toString() {
        return "Login já existente";
    }
}

?>
