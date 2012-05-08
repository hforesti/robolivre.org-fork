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
            $this->forward404();
        }
    }

//    public function executeAjaxValidaLinkYoutube(sfWebRequest $request){
//        $link = $request->getParameter("link");
//        
//        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $link, $matches);
//        if(isset($matches[2]) && $matches[2] != ''){
//            $YoutubeCode = $matches[2];
//        }
//        
//        $fh = fopen("http://gdata.youtube.com/feeds/api/videos/$YoutubeCode", "r");
//        $str = fread($fh, 10); 
//        fclose($fh);
//        
//        //Invalid id -> 10 char
//        sfContext::getInstance()->getLogger()->info("ENTROU AJAX: achou $str");
//        if($str=="Invalid id"){
//            $mensagem = "ok";
//        }else{
//            $mensagem = "falso";
//        }
//        
//        $this->mensagem = $mensagem;
//    }
    
    public function executeAjaxEsqueciSenha(sfWebRequest $request){
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','Url'));
            
        $email = $request->getParameter("email");
        
        $usuario = Doctrine::getTable('Usuarios')->esqueciSenha($email);

        if($usuario){
            
            $link = url_for("perfil/novaSenha?token=".$usuario->getToken()."&u=".$usuario->getIdUsuario(),true);

            Util::enviarEmail("Sua nova senha", "Para criar uma nova senha, entre no link : $link", $usuario->getEmail()) ;
            
            $mensagem = "<strong>Tudo bem!</strong> Um link para recuperar sua senha foi enviado para o seu email <em>".$usuario->getEmail()."</em>.";
    
        }else{
            $mensagem = "false";
        }
        
        $this->mensagem = $mensagem;
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
            $json['slug'] = Util::criaSlug($conteudo->getNome());
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
            $mensagem .= "id_conjunto=" . $objConteudo->getIdConjunto() . Util::SEPARADOR_PARAMETRO . "nome=" . $objConteudo->getNome(). Util::SEPARADOR_PARAMETRO . "slug=" .  Util::criaSlug($objConteudo->getNome());
        }

        $this->mensagem = $mensagem;
    }
    
    public function executeAjaxReceberMaisPublicacaoPerfil(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');
        $id_usuario = $request->getParameter('id_usuario');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoPerfil($id_usuario,$id_ultima_publicacao);
       
        foreach($publicacoesPerfil['publicacoes'] as $publicacao){
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
       
        foreach($publicacoesPerfil['publicacoes'] as $publicacao){
            echo $publicacao->getImpressaoEmConteudo();
        }
        
        $this->mensagem = "";
    }
    
    public function executeAjaxReceberMaisPublicacaoConteudosHome(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesHomeConteudo($id_ultima_publicacao);
       
        foreach($publicacoesPerfil['publicacoes'] as $publicacao){
            $publicacao->imprimir();
        }
        
        $this->mensagem = "";
    }
    
    public function executeAjaxReceberMaisPublicacaoAmigosHome(sfWebRequest $request) {
        $id_ultima_publicacao = $request->getParameter('ultimo_id_publicacao');

        $publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesHomeAmigos($id_ultima_publicacao);
        header("Content-type: text/html; charset=iso-8859-1");

        foreach($publicacoesPerfil['publicacoes'] as $publicacao){
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
        $allowedExtensions = array('txt', 'rtf', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'odt', 'fodt', 'odp', 'fodp', 'ods', 'fods', 'odg', 'fodg');
        // max file size in bytes
        $sizeLimit = 0.5 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('uploads/');
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    public function executeAjaxUlpoadImagens(sfWebRequest $request) {
        
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        
        // max file size in bytes
        $sizeLimit = 0.5 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('uploads/',true);
        
        $this->criarTumbnails($_GET['qqfile']);
        
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    
    
    private function criarTumbnails($nome_arquivo_completo){
        $array = explode(".", $nome_arquivo_completo);
        $nome_arquivo  = $array[0];
        $extensao = end($array);

        if(!isset($nome_arquivo)||$nome_arquivo=="" ){
            return "";
        }
        try{
//        die("nome do arquivo $nome_arquivo");
        $diretorioThumbnail = sfConfig::get('sf_upload_dir');

        $diretorio_arquivo = sfConfig::get('sf_upload_dir') . '/' . $nome_arquivo_completo;
        $thumbnail = new sfThumbnail(170, 170,true,true);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail."/".$nome_arquivo."_tmp_large." . $extensao);

        $thumbnail = new sfThumbnail(60, 60);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail."/".$nome_arquivo."_tmp_60." . $extensao);

        $thumbnail = new sfThumbnail(20, 20);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail."/".$nome_arquivo."_tmp_20." . $extensao);
        
        
        }catch(Exception $e){
                throw $e;
        }
        
        return "/".$nome_arquivo."_tmp_#.".$extensao;
    }
    
    
}