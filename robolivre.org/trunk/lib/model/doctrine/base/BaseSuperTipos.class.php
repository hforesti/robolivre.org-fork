<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SuperTipos', 'doctrine');

/**
 * BaseSuperTipos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_super_tipo
 * @property string $nome
 * @property string $descricao
 * 
 * @method integer    getIdSuperTipo()   Returns the current record's "id_super_tipo" value
 * @method string     getNome()          Returns the current record's "nome" value
 * @method string     getDescricao()     Returns the current record's "descricao" value
 * @method SuperTipos setIdSuperTipo()   Sets the current record's "id_super_tipo" value
 * @method SuperTipos setNome()          Sets the current record's "nome" value
 * @method SuperTipos setDescricao()     Sets the current record's "descricao" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSuperTipos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('super_tipos');
        $this->hasColumn('id_super_tipo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nome', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('descricao', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}