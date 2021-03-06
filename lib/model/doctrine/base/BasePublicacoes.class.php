<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Publicacoes', 'doctrine');

/**
 * BasePublicacoes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_publicacao
 * @property integer $id_usuario
 * @property integer $id_conteudo
 * @property integer $id_tipo_conjunto
 * @property integer $id_conjunto
 * @property integer $id_diario_bordo
 * @property integer $id_pasta
 * @property integer $id_video
 * @property integer $id_imagem
 * @property integer $id_usuario_original
 * @property integer $id_publicacao_original
 * @property integer $id_usuario_referencia
 * @property string $comentario
 * @property string $link
 * @property timestamp $data_publicacao
 * @property integer $visivel
 * @property integer $tipo_publicacao
 * @property integer $privacidade_publicacao
 * 
 * @method integer     getIdPublicacao()           Returns the current record's "id_publicacao" value
 * @method integer     getIdUsuario()              Returns the current record's "id_usuario" value
 * @method integer     getIdConteudo()             Returns the current record's "id_conteudo" value
 * @method integer     getIdTipoConjunto()         Returns the current record's "id_tipo_conjunto" value
 * @method integer     getIdConjunto()             Returns the current record's "id_conjunto" value
 * @method integer     getIdDiarioBordo()          Returns the current record's "id_diario_bordo" value
 * @method integer     getIdPasta()                Returns the current record's "id_pasta" value
 * @method integer     getIdVideo()                Returns the current record's "id_video" value
 * @method integer     getIdImagem()               Returns the current record's "id_imagem" value
 * @method integer     getIdUsuarioOriginal()      Returns the current record's "id_usuario_original" value
 * @method integer     getIdPublicacaoOriginal()   Returns the current record's "id_publicacao_original" value
 * @method integer     getIdUsuarioReferencia()    Returns the current record's "id_usuario_referencia" value
 * @method string      getComentario()             Returns the current record's "comentario" value
 * @method string      getLink()                   Returns the current record's "link" value
 * @method timestamp   getDataPublicacao()         Returns the current record's "data_publicacao" value
 * @method integer     getVisivel()                Returns the current record's "visivel" value
 * @method integer     getTipoPublicacao()         Returns the current record's "tipo_publicacao" value
 * @method integer     getPrivacidadePublicacao()  Returns the current record's "privacidade_publicacao" value
 * @method Publicacoes setIdPublicacao()           Sets the current record's "id_publicacao" value
 * @method Publicacoes setIdUsuario()              Sets the current record's "id_usuario" value
 * @method Publicacoes setIdConteudo()             Sets the current record's "id_conteudo" value
 * @method Publicacoes setIdTipoConjunto()         Sets the current record's "id_tipo_conjunto" value
 * @method Publicacoes setIdConjunto()             Sets the current record's "id_conjunto" value
 * @method Publicacoes setIdDiarioBordo()          Sets the current record's "id_diario_bordo" value
 * @method Publicacoes setIdPasta()                Sets the current record's "id_pasta" value
 * @method Publicacoes setIdVideo()                Sets the current record's "id_video" value
 * @method Publicacoes setIdImagem()               Sets the current record's "id_imagem" value
 * @method Publicacoes setIdUsuarioOriginal()      Sets the current record's "id_usuario_original" value
 * @method Publicacoes setIdPublicacaoOriginal()   Sets the current record's "id_publicacao_original" value
 * @method Publicacoes setIdUsuarioReferencia()    Sets the current record's "id_usuario_referencia" value
 * @method Publicacoes setComentario()             Sets the current record's "comentario" value
 * @method Publicacoes setLink()                   Sets the current record's "link" value
 * @method Publicacoes setDataPublicacao()         Sets the current record's "data_publicacao" value
 * @method Publicacoes setVisivel()                Sets the current record's "visivel" value
 * @method Publicacoes setTipoPublicacao()         Sets the current record's "tipo_publicacao" value
 * @method Publicacoes setPrivacidadePublicacao()  Sets the current record's "privacidade_publicacao" value
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePublicacoes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('publicacoes');
        $this->hasColumn('id_publicacao', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_usuario', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_conteudo', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_conjunto', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_conjunto', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_diario_bordo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_pasta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_video', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_imagem', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_usuario_original', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_publicacao_original', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_usuario_referencia', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('comentario', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('link', 'string', 300, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 300,
             ));
        $this->hasColumn('data_publicacao', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('visivel', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tipo_publicacao', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('privacidade_publicacao', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '1',
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