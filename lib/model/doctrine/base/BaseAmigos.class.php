<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Amigos', 'doctrine');

/**
 * BaseAmigos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_usuario_a
 * @property integer $id_usuario_b
 * @property integer $aceito
 * 
 * @method integer getIdUsuarioA()   Returns the current record's "id_usuario_a" value
 * @method integer getIdUsuarioB()   Returns the current record's "id_usuario_b" value
 * @method integer getAceito()       Returns the current record's "aceito" value
 * @method Amigos  setIdUsuarioA()   Sets the current record's "id_usuario_a" value
 * @method Amigos  setIdUsuarioB()   Sets the current record's "id_usuario_b" value
 * @method Amigos  setAceito()       Sets the current record's "aceito" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAmigos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('amigos');
        $this->hasColumn('id_usuario_a', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_usuario_b', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('aceito', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}