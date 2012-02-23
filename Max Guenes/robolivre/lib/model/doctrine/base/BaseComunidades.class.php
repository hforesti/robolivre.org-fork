<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Comunidades', 'doctrine');

/**
 * BaseComunidades
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_comunidade
 * @property integer $id_tipo_conjunto
 * @property integer $id_conjunto
 * @property string $nome
 * @property string $descricao
 * 
 * @method integer     getIdComunidade()     Returns the current record's "id_comunidade" value
 * @method integer     getIdTipoConjunto()   Returns the current record's "id_tipo_conjunto" value
 * @method integer     getIdConjunto()       Returns the current record's "id_conjunto" value
 * @method string      getNome()             Returns the current record's "nome" value
 * @method string      getDescricao()        Returns the current record's "descricao" value
 * @method Comunidades setIdComunidade()     Sets the current record's "id_comunidade" value
 * @method Comunidades setIdTipoConjunto()   Sets the current record's "id_tipo_conjunto" value
 * @method Comunidades setIdConjunto()       Sets the current record's "id_conjunto" value
 * @method Comunidades setNome()             Sets the current record's "nome" value
 * @method Comunidades setDescricao()        Sets the current record's "descricao" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComunidades extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comunidades');
        $this->hasColumn('id_comunidade', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_conjunto', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_conjunto', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('nome', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}