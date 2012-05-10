<?php

/**
 * conteudos actions.
 *
 * @package    robolivre
 * @subpackage conteudos
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conteudosActions extends robolivreAction
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->melhoresConteudos = Doctrine::getTable("Conteudos")->getConteudosListagem();
    }

    
    
    public function executeRemoverDocumento(sfWebRequest $request) {
        $ultimaUrl = $request->getReferer();
        $slug = $request->getParameter('slug');
        $conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $this->forward404Unless($conteudo,"Conteudo $slug não encontrado");
        if($conteudo->getPodeColaborar() && $request->hasParameter('u')){
            Doctrine::getTable('Documentos')->removeDocumento($request->getParameter('u'));
            $this->redirect($ultimaUrl);
        }else{
            $this->forward404("Não pode colaborar com o conteudo");
        }
    }
    
    public function executeCriar(sfWebRequest $request) {
        $this->formConteudo = new ConteudosForm();
        
        $this->nomeConteudo = $request->getParameter('nome');
        
        {
            $objConteudo = Doctrine::getTable('Conteudos')->validaNomeConteudo($this->nomeConteudo);

            if($objConteudo){
                $this->idConjuntoErro = $objConteudo->getIdConjunto();
                $this->nomeConteudoErro = $objConteudo->getNome();
            }
        }
    }
    
    
    public function executeEditar(sfWebRequest $request){
        $idConjunto = $request->getParameter('u');
        $objConteudo = Doctrine::getTable('Conteudos')->buscaPorId($idConjunto);
        
        $this->conteudo = $objConteudo;
        $this->formConteudo = new ConteudosForm($objConteudo);
        $this->nomeConteudo = $objConteudo->getNome();
        $this->tags = Doctrine::getTable('TagsConteudos')->getTagsConteudo($idConjunto);
    }
    
    public function executePreviaFoto(sfWebRequest $request){
        $this->formConteudo = new ConteudosForm();
        
        if ($request->isMethod('post')) {
            $this->formConteudo->bind($request->getParameter($this->formConteudo->getName()), $request->getFiles($this->formConteudo->getName()));
            if ($this->formConteudo->isValid()) {
                $file = $this->formConteudo->getValue('imagem_perfil');
                $filename = 'temp_usu'.  UsuarioLogado::getInstancia()->getIdUsuario(); //.sha1($file->getOriginalName());
                $extension = $file->getExtension($file->getOriginalExtension());
                $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
                
            }
        }
        
        {
            $objConteudo = Doctrine::getTable('Conteudos')->validaNomeConteudo($this->formConteudo->getObject()->getNome());

            if($objConteudo){
                $this->idConjuntoErro = $objConteudo->getIdConjunto();
                $this->nomeConteudoErro = $objConteudo->getNome();
            }
        }
        
        $this->setTemplate('criar');
    }
    
    public function executeSolicitarParticipacao(sfWebRequest $request) {
        $participacao = new ParticipantesConjuntos();
        $id = $request->getParameter("u");
        
        $this->forward404Unless(isset($id) && $id!="");

        $participacao->solicitarParticipacao($id);
        Doctrine::getTable("ParticipantesConjuntos")->solicitarParticipacao($participacao);
        $slug = Doctrine::getTable("Conjuntos")->getSlug($id);
        $this->redirect("conteudo/$slug");

    }
    
    public function executeRemoverParticipacao(sfWebRequest $request) {
        $participacao = new ParticipantesConjuntos();
        $id = $request->getParameter("u");
        
        $this->forward404Unless(isset($id) && $id!="");

        $participacao->solicitarParticipacao($id);
        Doctrine::getTable("ParticipantesConjuntos")->removerParticipacao($participacao);
        $slug = Doctrine::getTable("Conjuntos")->getSlug($id);
        $this->redirect("conteudo/$slug");

    }
    
    private function criarTumbnails(sfWebRequest $request,$slugConteudo){
        $nome_arquivo = $request->getParameter('imagem_selecionada');
        
        if(!isset($nome_arquivo)||$nome_arquivo=="" ){
            return "";
        }
        try{
        
        $diretorioThumbnail = Util::getDiretorioThumbnail();
        
        $diretorio_arquivo = sfConfig::get('sf_upload_dir') . '/' . $nome_arquivo;
        $extensao = end(explode(".", $nome_arquivo));
        
        $img = new sfImage($diretorio_arquivo, 'image/jpg');
        
        if($img->getHeight()>170 && $img->getWidth()>170){
            
            if($img->getWidth()>$img->getHeight()){
                $scale = 170/$img->getHeight();
            }else{
                $scale = 170/$img->getWidth();
            }
            
            $img->scale($scale);
            
            if($img->getWidth()>$img->getHeight()){
                $largura = ($img->getWidth()/2);
                $pontoX = $largura-(170/2);
                
                if($pontoX<0){
                    $pontoX = 0;
                }
                $pontoY = 0;
            }else{
                $altura = ($img->getHeight()/2);
                $pontoY = $altura-(170/2);
                
                if($pontoY<0){
                    $pontoY = 0;
                }
                $pontoX = 0;
            }
            
            $img->crop($pontoX,$pontoY,170,170); 
        }else{
            
            if($img->getWidth()>$img->getHeight()){
                $scale = 170/$img->getHeight();
            }else{
                $scale = 170/$img->getWidth();
            }
            
            $img->scale($scale);
            
            if($img->getWidth()>$img->getHeight()){
                $largura = ($img->getWidth()/2);
                $pontoX = $largura-(170/2);
                
                if($pontoX<0){
                    $pontoX = 0;
                }
                $pontoY = 0;
            }else{
                $altura = ($img->getHeight()/2);
                $pontoY = $altura-(170/2);
                
                if($pontoY<0){
                    $pontoY = 0;
                }
                $pontoX = 0;
            }
            $img->crop($pontoX,$pontoY,170,170); 
        }
                
        $img->setQuality(75);
        $img->saveAs($diretorioThumbnail.'/_avatar_con_' . $slugConteudo . '_large.' . $extensao);
        $img->thumbnail(60, 60);
        $img->setQuality(75);
        $img->saveAs($diretorioThumbnail.'/_avatar_con_' . $slugConteudo . '_60.' . $extensao);
        $img->thumbnail(20, 20);
        $img->setQuality(75);
        $img->saveAs($diretorioThumbnail.'/_avatar_con_' . $slugConteudo . '_20.' . $extensao);
        
//        $thumbnail = new sfThumbnail(170, 170);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save();
//
//        $thumbnail = new sfThumbnail(60, 60);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_con_' . $slugConteudo . '_60.' . $extensao);
//
//        $thumbnail = new sfThumbnail(20, 20);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_con_' . $slugConteudo . '_20.' . $extensao);
        }catch(Exception $e){
            if(strstr($e->getMessage()," is not readable.")){
                return $nome_arquivo;
            }else{
                throw $e;
            }
        }
        
        return '_avatar_con_' . $slugConteudo . '_#.'.$extensao;
    }
    
    public function executeGravar(sfWebRequest $request) {
        
        $arrayTags = $request->getParameter('tags');
        $arrayTags = explode(",", $arrayTags);
        
        $arrayTagsTemaAula = $request->getPostParameter('tema_aula');
        
        foreach($arrayTagsTemaAula as $tema){
            $arrayTags[] = $tema;
        }
        $arrayTags = array_unique($arrayTags);
        
        
        $arrayArquivos = explode(Util::SEPARADOR_PARAMETRO,$request->getPostParameter('documentos_selecionados'));
        
        $form = new ConteudosForm();
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $form->updateObject(); 
            $valores = $form->getTaintedValues();

            $objConteudo = $form->getObject();
            
            $objConteudo->setNome(Util::getHtmlPurificado($valores['nome']));
            $objConteudo->setDescricao(Util::getHtmlPurificadoDescricao($valores['descricao']));

            $nomeArquivo = $this->criarTumbnails($request,  Util::criaSlug($objConteudo->getNome()));
            $objConteudo->getConjunto()->setImagemPerfil($nomeArquivo);
            $this->conteudo = Doctrine::getTable("Conteudos")->gravarConteudo($objConteudo);
            $arrayObjTag = array();
            
            foreach($arrayTags as $tag){
                if(isset($tag) && $tag!="" && $tag!=" "){
                    $objTag = new TagsConteudos();
            
                    $objTag->setIdConjuntoReferencia($this->conteudo->getIdConjunto());
                    $objTag->setIdConteudoReferencia($this->conteudo->getIdConteudo());
                    $objTag->setIdTipoConjuntoReferencia($this->conteudo->getIdTipoConjunto());
                    
                    //CONTEUDO EXSTENTE
                    if(strstr($tag, Util::SEPARADOR_PARAMETRO)){
                        $arrayId = explode(Util::SEPARADOR_PARAMETRO, $tag);
                        $objTag->setIdConjuntoReferenciado($arrayId[0]);
                        $objTag->setIdConteudoReferenciado($arrayId[1]);
                        $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                    //CONTEUDO INEXISTENTE
                    }else{
                        $conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug(Util::criaSlug($tag));
                        if($conteudo){
                            $objTag->setIdConjuntoReferenciado($conteudo->getIdConjunto());
                            $objTag->setIdConteudoReferenciado($conteudo->getIdConteudo());
                            $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                            $tag = $conteudo->getIdConjunto().Util::SEPARADOR_PARAMETRO.$conteudo->getIdConteudo();
                        }else{
                            $conteudoNovo = new Conteudos();
                            
                            $conteudoNovo->setNome(Util::getHtmlPurificado($tag));
                            $conteudoNovo->setDescricao("");
                            $conteudoNovo->setEnviarEmailCriador(true);
                            
                            $conteudoNovo = Doctrine::getTable("Conteudos")->gravarConteudo($conteudoNovo);
                            $objTag->setIdConjuntoReferenciado($conteudoNovo->getIdConjunto());
                            $objTag->setIdConteudoReferenciado($conteudoNovo->getIdConteudo());
                            $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                            $tag = $conteudoNovo->getIdConjunto().Util::SEPARADOR_PARAMETRO.$conteudoNovo->getIdConteudo();
                        }
                    }
                    $arrayObjTag[$tag] = $objTag;
                }
            }
            
            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_ANEXOS_CONJUNTO,$this->conteudo->getIdConjunto(),Conjuntos::TIPO_CONTEUDO);
            if(!$pasta){
                $pasta = new Pastas();
                $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $pasta->setNome("Anexo de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setDescricao("Arquivos anexos de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setTipoPasta(Pastas::TIPO_PASTA_ANEXOS_CONJUNTO);
                $pasta->setIdConjunto($this->conteudo->getIdConjunto());
                $pasta->setIdTipoConjunto(Conjuntos::TIPO_CONTEUDO);
                
                $pasta->save();
                
                $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_ANEXOS_CONJUNTO,$this->conteudo->getIdConjunto(),Conjuntos::TIPO_CONTEUDO);
                if(!file_exists(sfConfig::get('sf_upload_dir')."/documentos/$slug")){
                   mkdir(sfConfig::get('sf_upload_dir')."/documentos/$slug");
                }
            }
            foreach($arrayArquivos as $nomeArquivo){
                if($nomeArquivo!="" && file_exists(sfConfig::get('sf_upload_dir')."/".$nomeArquivo)){
                    $arrayFile = explode(".",$nomeArquivo);
                    $nomeFile = $arrayFile[0];
                    $extensao = end($arrayFile);
                    $idUsuarioLogado = UsuarioLogado::getInstancia()->getIdUsuario();
                    copy(sfConfig::get('sf_upload_dir')."/".$nomeArquivo,sfConfig::get('sf_upload_dir')."/documentos/$slug/".$nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);

                    $documento = new Documentos();
                    $documento->setIdPasta($pasta->getIdPasta());
                    $documento->setIdUsuario($pasta->getIdUsuario());
                    $documento->setIsCodigoFonte(false);
                    $documento->setNomeArquivo($nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);
                    $documento->setNomeDocumento($nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);
                    
                    $documento->save();
                }
            }
            
            foreach ($arrayObjTag as $objTag) {
                $objTag->save();
            }
            
            $this->redirect('conteudo/'.$this->conteudo->getConjunto()->getSlug());
        } else {
            $valores = $form->getTaintedValues();
            $this->formConteudo = $form;
            $erros = $form->getErrorSchema()->getErrors();
            
            if (isset($erros['nome'])) {
                $this->nomeConteudoErro = $valores['nome'];
            }
            
            
            /* FAZER ARRAY TAGS VIRAR OBJETO, VER MODELO TagsConteudosTable->getTagsConteudo() */
            
            $arrayTagsRetorno = array();
            
            foreach($arrayTags as $tagRecuperar){
                if($tagRecuperar==""){
                    continue;
                }
                $tag = new TagsConteudos();
                if(strstr($tagRecuperar, Util::SEPARADOR_PARAMETRO)){
                    $array = explode(Util::SEPARADOR_PARAMETRO, $tagRecuperar);
                    $conteudo = Doctrine::getTable("Conteudos")->buscaPorId($array[0]);
                    $tag->setConteudo($conteudo);
                }else{
                    $objConteudo = new Conteudos();
                    $objConteudo->setNome($tagRecuperar);
                    $tag->setConteudo($objConteudo);
                }
                $arrayTagsRetorno[$tagRecuperar] = $tag;
            }
            $this->tags = $arrayTagsRetorno;
            $this->setTemplate("criar");
        }
    }
    
    public function executeGravarEdicao(sfWebRequest $request) {

        
        $arrayTags = $request->getParameter('tags');
        $arrayTags = explode(",", $arrayTags);
        
        $arrayTagsTemaAula = $request->getPostParameter('tema_aula');
        
        foreach($arrayTagsTemaAula as $tema){
            $arrayTags[] = $tema;
        }
        $arrayTags = array_unique($arrayTags);
        
        $arrayArquivos = explode(Util::SEPARADOR_PARAMETRO,$request->getPostParameter('documentos_selecionados'));
        
        $form = new ConteudosForm();
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        if ($form->isValid()) {
            $form->updateObject(); 
            $valores = $form->getTaintedValues();
            $objConteudo = $form->getObject();

            $objConteudo->setIdConjunto($valores['id_conjunto']);
            $objConteudo->setIdTipoConjunto($valores['id_tipo_conjunto']);
            $objConteudo->setIdConteudo($valores['id_conteudo']);
            $objConteudo->setNome(Util::getHtmlPurificado($valores['nome']));
            $objConteudo->setDescricao(Util::getHtmlPurificadoDescricao($valores['descricao']));
            
            $objConteudo->setEnviarEmailCriador($valores['enviar_email_criador']);
                        
            $slug = Util::criaSlug($objConteudo->getNome());
            $nomeArquivo = $this->criarTumbnails($request, $slug);
            $objConteudo->getConjunto()->setImagemPerfil($nomeArquivo);
            $this->conteudo = Doctrine::getTable("Conteudos")->editarConteudo($objConteudo);
            $tagsExistentes = Doctrine::getTable('TagsConteudos')->getTagsConteudo($this->conteudo->getIdConjunto());
            
            $arrayObjTag = array();
            foreach($arrayTags as $tag){
                if(isset($tag) && $tag!="" && $tag!=" "){
                    
                    if(array_key_exists($tag, $tagsExistentes)){
                        unset($tagsExistentes[$tag]);
                        continue;
                    }
                    
                    $objTag = new TagsConteudos();
            
                    $objTag->setIdConjuntoReferencia($this->conteudo->getIdConjunto());
                    $objTag->setIdConteudoReferencia($this->conteudo->getIdConteudo());
                    $objTag->setIdTipoConjuntoReferencia($this->conteudo->getIdTipoConjunto());
                    
                    //CONTEUDO EXSTENTE
                    if(strstr($tag, Util::SEPARADOR_PARAMETRO)){
                        $arrayId = explode(Util::SEPARADOR_PARAMETRO, $tag);
                        $objTag->setIdConjuntoReferenciado($arrayId[0]);
                        $objTag->setIdConteudoReferenciado($arrayId[1]);
                        $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                    //CONTEUDO INEXISTENTE
                    }else{
                        $conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug(Util::criaSlug($tag));
                        if($conteudo){
                            $objTag->setIdConjuntoReferenciado($conteudo->getIdConjunto());
                            $objTag->setIdConteudoReferenciado($conteudo->getIdConteudo());
                            $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                            $tag = $conteudo->getIdConjunto().Util::SEPARADOR_PARAMETRO.$conteudo->getIdConteudo();
                        }else{
                            $conteudoNovo = new Conteudos();
                            
                            $conteudoNovo->setNome(Util::getHtmlPurificado($tag));
                            $conteudoNovo->setDescricao("");
                            $conteudoNovo->setEnviarEmailCriador(true);
                            
                            $conteudoNovo = Doctrine::getTable("Conteudos")->gravarConteudo($conteudoNovo);
                            $objTag->setIdConjuntoReferenciado($conteudoNovo->getIdConjunto());
                            $objTag->setIdConteudoReferenciado($conteudoNovo->getIdConteudo());
                            $objTag->setIdTipoConjuntoReferenciado(Conjuntos::TIPO_CONTEUDO);
                            $tag = $conteudoNovo->getIdConjunto().Util::SEPARADOR_PARAMETRO.$conteudoNovo->getIdConteudo();
                        }
                    }
                    $arrayObjTag[$tag] = $objTag;
                }
            }
            
            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_ANEXOS_CONJUNTO,$this->conteudo->getIdConjunto(),Conjuntos::TIPO_CONTEUDO);
            if(!$pasta){
                $pasta = new Pastas();
                $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $pasta->setNome("Anexo de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setDescricao("Arquivos anexos de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setTipoPasta(Pastas::TIPO_PASTA_ANEXOS_CONJUNTO);
                $pasta->setIdConjunto($this->conteudo->getIdConjunto());
                $pasta->setIdTipoConjunto(Conjuntos::TIPO_CONTEUDO);
                
                $pasta->save();
                
                $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_ANEXOS_CONJUNTO,$this->conteudo->getIdConjunto(),Conjuntos::TIPO_CONTEUDO);
                if(!file_exists(sfConfig::get('sf_upload_dir')."/documentos/$slug")){
                   mkdir(sfConfig::get('sf_upload_dir')."/documentos/$slug");
                }
            }
            foreach($arrayArquivos as $nomeArquivo){
                if($nomeArquivo!="" && file_exists(sfConfig::get('sf_upload_dir')."/".$nomeArquivo)){
                    $arrayFile = explode(".",$nomeArquivo);
                    $nomeFile = $arrayFile[0];
                    $extensao = end($arrayFile);
                    $idUsuarioLogado = UsuarioLogado::getInstancia()->getIdUsuario();
                    copy(sfConfig::get('sf_upload_dir')."/".$nomeArquivo,sfConfig::get('sf_upload_dir')."/documentos/$slug/".$nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);

                    $documento = new Documentos();
                    $documento->setIdPasta($pasta->getIdPasta());
                    $documento->setIdUsuario($pasta->getIdUsuario());
                    $documento->setIsCodigoFonte(false);
                    $documento->setNomeArquivo($nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);
                    $documento->setNomeDocumento($nomeFile."_".$idUsuarioLogado."_".time().".".$extensao);
                    
                    $documento->save();
                }
            }
            
            foreach ($arrayObjTag as $objTag) {
                $objTag->save();
            }
            
            foreach ($tagsExistentes as $tagParaRemover){
                Doctrine::getTable('TagsConteudos')->removeTag($tagParaRemover);
            }
            
            $this->redirect('conteudo/'.$slug);
        } else {
            $this->formConteudo = $form;
            $this->conteudo = $form->getObject();

            $erros = $form->getErrorSchema()->getErrors();
            
            if (isset($erros['nome'])) {
                $taintedValues = $form->getTaintedValues();
                $this->nomeConteudoErro = $taintedValues['nome'];
            }
            $this->conteudo->setImagemPerfil($request->getParameter('imagem_selecionada'));
            
            $arrayTagsRetorno = array();
            
            foreach($arrayTags as $tagRecuperar){
                if($tagRecuperar==""){
                    continue;
                }
                $tag = new TagsConteudos();
                if(strstr($tagRecuperar, Util::SEPARADOR_PARAMETRO)){
                    $array = explode(Util::SEPARADOR_PARAMETRO, $tagRecuperar);
                    $conteudo = Doctrine::getTable("Conteudos")->buscaPorId($array[0]);
                    $tag->setConteudo($conteudo);
                }else{
                    $objConteudo = new Conteudos();
                    $objConteudo->setNome($tagRecuperar);
                    $tag->setConteudo($objConteudo);
                }
                $arrayTagsRetorno[$tagRecuperar] = $tag;
            }
            $this->tags = $arrayTagsRetorno;
            
            $this->setTemplate("editar");
        }
    }
    
    public function executePublicar(sfWebRequest $request) {
        
        $form = new PublicacoesForm();
        $parametros = $request->getParameter($form->getName());
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $form->updateObject();
        $objPublicacao = $form->getObject();
        $objPublicacao->setDataPublicacao(date('Y-m-d H:i:s'));
        $objPublicacao->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
        $objPublicacao->setComentario(Util::getHtmlPurificado($parametros['comentario']));
        
        $tipoConteudoPublicacao = $request->getParameter('tipo_conteudo_publicacao');
        
        if($tipoConteudoPublicacao != Publicacoes::TIPO_LINK && $tipoConteudoPublicacao != Publicacoes::TIPO_NORMAL){
            
            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_PUBLICACOES_CONJUNTO,$request->getParameter('id_conjunto'),Conjuntos::TIPO_CONTEUDO);
            if(!$pasta){
                $pasta = new Pastas();
                $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $pasta->setNome("Publicações de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setDescricao("Arquivos enviados das publicações de ".UsuarioLogado::getInstancia()->getNome()." no Conteudo ".$request->getParameter('nome_conteudo'));
                $pasta->setTipoPasta(Pastas::TIPO_PASTA_PUBLICACOES_CONJUNTO);
                $pasta->setIdConjunto($request->getParameter('id_conjunto'));
                $pasta->setIdTipoConjunto(Conjuntos::TIPO_CONTEUDO);
                
                $pasta->save();
                
                $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_PUBLICACOES_CONJUNTO,$request->getParameter('id_conjunto'),Conjuntos::TIPO_CONTEUDO);
            }
            
            if($tipoConteudoPublicacao== Publicacoes::TIPO_VIDEO){
                $video = new Videos();
                $video->setIdPasta($pasta->getIdPasta());
                $video->setIdUsuario($pasta->getIdUsuario());
                $video->setLinkVideo($request->getParameter("url_video"));
                
                $video = Doctrine::getTable("Videos")->gravarVideo($video);
                $objPublicacao->setIdVideo($video->getIdVideo());
                $objPublicacao->setIdPasta($video->getIdPasta());
            }else if($tipoConteudoPublicacao== Publicacoes::TIPO_FOTO){
                //mas 550x550   
                $diretorio_arquivo = Util::getDiretorioFotosPublicacoes(UsuarioLogado::getInstancia()->getIdUsuario());
                $file = $form->getValue('foto');
                $extension = $file->getExtension($file->getOriginalExtension());
                $nome_arquivo = 'img_publicacao_usu_'.UsuarioLogado::getInstancia()->getIdUsuario()."_". md5(time());
                $file->save($diretorio_arquivo.'/'.$nome_arquivo.$extension);
                
                $thumbnail = new sfThumbnail(550, null);
                $thumbnail->loadFile($diretorio_arquivo.'/'.$nome_arquivo.$extension);
                $thumbnail->save($diretorio_arquivo.'/'.$nome_arquivo. '_min' . $extension);
                
                $imagem = new Imagens();
                $imagem->setIdPasta($pasta->getIdPasta());
                $imagem->setIdUsuario($pasta->getIdUsuario());
                $imagem->setNomeArquivo($nome_arquivo.$extension);
                
                $imagem = Doctrine::getTable("Imagens")->gravarImagem($imagem);
                $objPublicacao->setIdImagem($imagem->getIdImagem());
                $objPublicacao->setIdPasta($imagem->getIdPasta());
            }
        }else{
            if($tipoConteudoPublicacao == Publicacoes::TIPO_LINK){
                $objPublicacao->setLink($request->getParameter('url_link'));
            }
        }
        
        
        if ($request->getParameter('id_publicacao_original') != "" && $request->getParameter('id_usuario_original') != "") {
            $objPublicacao->setIdUsuarioOriginal($request->getParameter('id_usuario_original'));
            $objPublicacao->setIdPublicacaoOriginal($request->getParameter('id_publicacao_original'));
        }

        $objPublicacao->setIdConjunto($request->getParameter('id_conjunto'));
        $objPublicacao->setIdTipoConjunto(Conjuntos::TIPO_CONTEUDO);
        
        if($request->getParameter('privacidade_publicacao')!=""){
            $objPublicacao->setPrivacidadePublicacao($request->getParameter('privacidade_publicacao'));
        }
        
        $objPublicacao->save();

        $this->redirect("conteudo/" . Util::criaSlug($request->getParameter('nome_conteudo')));
    }
}
