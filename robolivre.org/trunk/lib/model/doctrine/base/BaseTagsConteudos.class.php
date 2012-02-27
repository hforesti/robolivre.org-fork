<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TagsConteudos', 'doctrine');

/**
 * BaseTagsConteudos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_conteudo_referencia
 * @property integer $id_conteudo_referenciado
 * @property integer $id_conjunto_referencia
 * @property integer $id_tipo_conjunto_referencia
 * @property integer $id_conjunto_referenciado
 * @property integer $id_tipo_conjunto_referenciado
 * 
 * @method integer       getIdConteudoReferencia()          Returns the current record's "id_conteudo_referencia" value
 * @method integer       getIdConteudoReferenciado()        Returns the current record's "id_conteudo_referenciado" value
 * @method integer       getIdConjuntoReferencia()          Returns the current record's "id_conjunto_referencia" value
 * @method integer       getIdTipoConjuntoReferencia()      Returns the current record's "id_tipo_conjunto_referencia" value
 * @method integer       getIdConjuntoReferenciado()        Returns the current record's "id_conjunto_referenciado" value
 * @method integer       getIdTipoConjuntoReferenciado()    Returns the current record's "id_tipo_conjunto_referenciado" value
 * @method TagsConteudos setIdConteudoReferencia()          Sets the current record's "id_conteudo_referencia" value
 * @method TagsConteudos setIdConteudoReferenciado()        Sets the current record's "id_conteudo_referenciado" value
 * @method TagsConteudos setIdConjuntoReferencia()          Sets the current record's "id_conjunto_referencia" value
 * @method TagsConteudos setIdTipoConjuntoReferencia()      Sets the current record's "id_tipo_conjunto_referencia" value
 * @method TagsConteudos setIdConjuntoReferenciado()        Sets the current record's "id_conjunto_referenciado" value
 * @method TagsConteudos setIdTipoConjuntoReferenciado()    Sets the current record's "id_tipo_conjunto_referenciado" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTagsConteudos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tags_conteudos');
        $this->hasColumn('id_conteudo_referencia', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_conteudo_referenciado', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_conjunto_referencia', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_conjunto_referencia', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_conjunto_referenciado', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_conjunto_referenciado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}