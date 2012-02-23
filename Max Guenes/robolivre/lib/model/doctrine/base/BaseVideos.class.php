<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Videos', 'doctrine');

/**
 * BaseVideos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_video
 * @property integer $id_usuario
 * @property integer $id_pasta
 * @property string $nome_arquivo
 * @property integer $ordenacao
 * 
 * @method integer getIdVideo()      Returns the current record's "id_video" value
 * @method integer getIdUsuario()    Returns the current record's "id_usuario" value
 * @method integer getIdPasta()      Returns the current record's "id_pasta" value
 * @method string  getNomeArquivo()  Returns the current record's "nome_arquivo" value
 * @method integer getOrdenacao()    Returns the current record's "ordenacao" value
 * @method Videos  setIdVideo()      Sets the current record's "id_video" value
 * @method Videos  setIdUsuario()    Sets the current record's "id_usuario" value
 * @method Videos  setIdPasta()      Sets the current record's "id_pasta" value
 * @method Videos  setNomeArquivo()  Sets the current record's "nome_arquivo" value
 * @method Videos  setOrdenacao()    Sets the current record's "ordenacao" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVideos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('videos');
        $this->hasColumn('id_video', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_usuario', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_pasta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nome_arquivo', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('ordenacao', 'integer', 4, array(
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