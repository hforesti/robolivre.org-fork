<?php

/**
 * erros actions.
 *
 * @package    robolivre
 * @subpackage erros
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class errosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->setTemplate("404error");
  }
  
  public function execute404error(sfWebRequest $request){
      
  }
}
