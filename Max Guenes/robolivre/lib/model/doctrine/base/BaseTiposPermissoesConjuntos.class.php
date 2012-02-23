<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TiposPermissoesConjuntos', 'doctrine');

/**
 * BaseTiposPermissoesConjuntos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_tipo_permissao_conjunto
 * @property integer $id_tipo_conjunto
 * @property string $nome
 * @property string $descricao
 * @property integer $prioridade
 * 
 * @method integer                  getIdTipoPermissaoConjunto()    Returns the current record's "id_tipo_permissao_conjunto" value
 * @method integer                  getIdTipoConjunto()             Returns the current record's "id_tipo_conjunto" value
 * @method string                   getNome()                       Returns the current record's "nome" value
 * @method string                   getDescricao()                  Returns the current record's "descricao" value
 * @method integer                  getPrioridade()                 Returns the current record's "prioridade" value
 * @method TiposPermissoesConjuntos setIdTipoPermissaoConjunto()    Sets the current record's "id_tipo_permissao_conjunto" value
 * @method TiposPermissoesConjuntos setIdTipoConjunto()             Sets the current record's "id_tipo_conjunto" value
 * @method TiposPermissoesConjuntos setNome()                       Sets the current record's "nome" value
 * @method TiposPermissoesConjuntos setDescricao()                  Sets the current record's "descricao" value
 * @method TiposPermissoesConjuntos setPrioridade()                 Sets the current record's "prioridade" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTiposPermissoesConjuntos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipos_permissoes_conjuntos');
        $this->hasColumn('id_tipo_permissao_conjunto', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_tipo_conjunto', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
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
        $this->hasColumn('prioridade', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
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