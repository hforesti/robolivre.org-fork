<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExceptionEmailExistente
 *
 * @author maxguenes
 */
class ExceptionEmailExistente extends Exception{
    public function __toString() {
        return "Email já existente";
    }
}

?>
