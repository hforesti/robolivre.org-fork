<?php

/**
 * ajax actions.
 *
 * @package    robolivre
 * @subpackage ajax
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajaxActions extends sfActions {
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function execute($request) {
        if ($request->isXmlHttpRequest()) {
            parent::execute($request);
            $this->setTemplate('retornoAjax');
        }else{
            $this->redirect('inicial/index');
        }
    }
    
    public function executeIndex(){}
    
    public function executeAjaxAutoSuggestConteudo(sfWebRequest $request) {
        $nome = $request->getParameter("q");
        $data = array();
        
        // query your DataBase here looking for a match to $input
        $arrayConteudos = Doctrine::getTable('Conteudos')->buscaPorNomeParcial($nome);
        foreach ($arrayConteudos as $conteudo) {
            $json = array();
            $json['value'] = $conteudo->getIdConjunto().Util::SEPARADOR_PARAMETRO.$conteudo->getIdConteudo();
            $json['name'] = $conteudo->getNome();
            $json['image'] = $conteudo->getImagemPerfil();
            $data[] = $json;
        }
        
        header("Content-type: application/json");
        echo json_encode($data);
        $this->mensagem = "";
    }
    
    public function executeAjaxValidaNomeConteudo(sfWebRequest $request) {
        $mensagem = "";
        $nome = $request->getParameter("nome");
        $objConteudo = Doctrine::getTable('Conteudos')->validaNomeConteudo($nome);
        
        if(!$objConteudo){
            $mensagem = "ok";
        } else {
            $mensagem .= "id_conjunto=" . $objConteudo->getIdConjunto() . Util::SEPARADOR_PARAMETRO . "nome=" . $objConteudo->getNome();
        }

        $this->mensagem = $mensagem;
    }
    
    public function executeAjaxReceberMaisPublicacaoPerfil(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');
        $id_usuario = $request->getParameter('id_usuario');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoPerfil($id_usuario,$id_ultima_publicacao);
       
        foreach($publicacoesPerfil as $publicacao){
            $publicacao->imprimir(); //getImpressao();
        }
        
        $this->mensagem = "";
                
    }
    
    public function executeAjaxNomesTags(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
            
        $tags = array();
        
        $tags[$request->getParameter('q')] = Doctrine::getTable('Conteudos')->buscaPorId($request->getParameter('q'));

        return $this->renderText(json_encode($tags)); 
    }
    
    public function executeAjaxReceberMaisPublicacaoConteudo(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');
        $id_conjunto = $request->getParameter('id_conjunto');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($id_conjunto,$id_ultima_publicacao);
       
        foreach($publicacoesPerfil as $publicacao){
            echo $publicacao->getImpressaoEmConteudo();
        }
        
        $this->mensagem = "";
    }
    
    public function executeAjaxReceberMaisPublicacaoConteudosHome(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesHomeConteudo($id_ultima_publicacao);
       
        foreach($publicacoesPerfil as $publicacao){
            $publicacao->imprimir();
        }
        
        $this->mensagem = "";
    }
    
    public function executeAjaxReceberMaisPublicacaoAmigosHome(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesHomeAmigos($id_ultima_publicacao);
       
        foreach($publicacoesPerfil as $publicacao){
            $publicacao->imprimir();
        }
        
        $this->mensagem = "";
    }
    
    public function executeAjaxValidacaoFormCadastro(sfWebRequest $request) {

        $mensagem = "";
        $erros = null; 
        
        {
            $form = new UsuariosForm(null, null, null, UsuariosForm::SOMENTE_INFO_CADASTRO);
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            $form->validaDadosIniciais();
            $erros = $form->getErrorSchema()->getErrors();
        }

        
        if (isset($erros['nome'])) {
            $mensagem .= "nome=".$erros['nome']. Util::SEPARADOR_PARAMETRO;
        }else{
            $mensagem .= "nome=". Util::SEPARADOR_PARAMETRO;
        }
        
        
        if (isset($erros['login'])) {
            $mensagem .= "login=".$erros['login']. Util::SEPARADOR_PARAMETRO;
        }else{
            $mensagem .= "login=". Util::SEPARADOR_PARAMETRO;
        }
        
        
        if (isset($erros['email'])) {
            $mensagem .= "email=".$erros['email']. Util::SEPARADOR_PARAMETRO;
        }else{
            $mensagem .= "email=". Util::SEPARADOR_PARAMETRO;
        }
        

        $this->mensagem = $mensagem;
    }
    
    public function executeAjaxUlpoadArquivos(sfWebRequest $request) {
//        sfContext::getInstance()->getLogger()->info("ENTROU UPLOAD ARQUIVOS");
//        sfContext::getInstance()->getLogger()->info(print_r($_GET,true));
//        sfContext::getInstance()->getLogger()->info(print_r($_POST,true));
//        sfContext::getInstance()->getLogger()->info(print_r($_FILES,true));
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array();
        // max file size in bytes
        $sizeLimit = 0.5 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('uploads/');
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    public function executeAjaxUlpoadImagens(sfWebRequest $request) {
//        sfContext::getInstance()->getLogger()->info("ENTROU UPLOAD IMAGENS");
//        sfContext::getInstance()->getLogger()->info(print_r($_GET,true));
//        sfContext::getInstance()->getLogger()->info(print_r($_POST,true));
//        sfContext::getInstance()->getLogger()->info(print_r($_FILES,true));
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array("jpeg","png","jpg", "xml", "bmp");
        
        // max file size in bytes
        $sizeLimit = 0.5 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('uploads/');
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
}

/**
* Handle file uploads via XMLHttpRequest
*/
class qqUploadedFileXhr {

    /**
        * Save the file to the specified path
        * @return boolean TRUE on success
        */
    function save($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
    * Handle file uploads via regular form post (uses the $_FILES array)
    */
class qqUploadedFileForm {

    /**
        * Save the file to the specified path
        * @return boolean TRUE on success
        */
    function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName() {
        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class qqFileUploader {

    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760) {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));
        sfContext::getInstance()->getLogger()->info("posSize = $postSize uploadSize = $uploadSize sizeLimit = ".$this->sizeLimit);
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
        * Returns array('success'=>true) or array('error'=>'error message')
        */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE) {
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of ' . $these . '.');
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) {
            return array('success' => true);
        } else {
            return array('error' => 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

}