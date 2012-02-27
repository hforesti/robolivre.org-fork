<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DiariosBordo', 'doctrine');

/**
 * BaseDiariosBordo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_diario_bordo
 * @property integer $id_conteudo
 * @property integer $id_conjunto
 * @property integer $id_tipo_conjunto
 * @property integer $id_usuario
 * @property string $nome
 * @property string $descricao
 * 
 * @method integer      getIdDiarioBordo()    Returns the current record's "id_diario_bordo" value
 * @method integer      getIdConteudo()       Returns the current record's "id_conteudo" value
 * @method integer      getIdConjunto()       Returns the current record's "id_conjunto" value
 * @method integer      getIdTipoConjunto()   Returns the current record's "id_tipo_conjunto" value
 * @method integer      getIdUsuario()        Returns the current record's "id_usuario" value
 * @method string       getNome()             Returns the current record's "nome" value
 * @method string       getDescricao()        Returns the current record's "descricao" value
 * @method DiariosBordo setIdDiarioBordo()    Sets the current record's "id_diario_bordo" value
 * @method DiariosBordo setIdConteudo()       Sets the current record's "id_conteudo" value
 * @method DiariosBordo setIdConjunto()       Sets the current record's "id_conjunto" value
 * @method DiariosBordo setIdTipoConjunto()   Sets the current record's "id_tipo_conjunto" value
 * @method DiariosBordo setIdUsuario()        Sets the current record's "id_usuario" value
 * @method DiariosBordo setNome()             Sets the current record's "nome" value
 * @method DiariosBordo setDescricao()        Sets the current record's "descricao" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDiariosBordo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('diarios_bordo');
        $this->hasColumn('id_diario_bordo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_conteudo', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_conjunto', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
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
        $this->hasColumn('id_usuario', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
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