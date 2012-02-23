<?php

/**
 * Amigos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 ** @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Amigos extends BaseAmigos
{
    public function solicitarAmizade($id_usuario_amigo) {
        parent::_set('id_usuario_a', UsuarioLogado::getInstancia()->getIdUsuario());
        parent::_set('id_usuario_b', $id_usuario_amigo);
        parent::_set('aceito',0);    
    }
    
    public function setSolicitacao($id_usuario){
        parent::_set('id_usuario_b', UsuarioLogado::getInstancia()->getIdUsuario());
        parent::_set('id_usuario_a', $id_usuario);
    }
    
}
