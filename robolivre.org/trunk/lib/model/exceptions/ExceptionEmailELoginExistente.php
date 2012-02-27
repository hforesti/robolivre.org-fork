<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExceptionEmailELoginExistente
 *
 * @author maxguenes
 */
class ExceptionEmailELoginExistente extends Exception{
   public function __toString() {
        return "Email e Login já existentes";
    }
}

?>
