<?php

/**
 * perfil actions.
 *
 * @package    robolivre
 * @subpackage perfil
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class perfilActions extends robolivreAction {
    
    public function executeIndex(sfWebRequest $request) {
        
        $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
//        die($this->usuario->getImagemPerfil());
        $this->publicacoesHome = Doctrine::getTable("Publicacoes")->getPublicacoesHome();
        
        {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'],0,6);
        }
        
        {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'],0,6);
        }
        
        
        $this->formPublicacao = new PublicacoesForm();

    }
    
    public function executeNovaSenha(sfWebRequest $request) {
        $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
        $this->forward404Unless($this->usuario);
    }
    
    public function executeConfiguracoes(sfWebRequest $request) {
        $usuarios = new Usuarios(null,false,UsuarioLogado::getInstancia());
        $this->formUsuario = new UsuariosForm($usuarios, null, null, UsuariosForm::CONFIGURACAO);

    }
    
    public function executeExibir(sfWebRequest $request) {
        
        
        $id = $request->getParameter("u");
        
        if(!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()){
            $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
        }
        
        $this->forward404Unless($this->usuario);
        
        {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'],0,6);
        }
        
        {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'],0,6);
        }
        
        $this->publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoPerfil($this->usuario->getIdUsuario());
        
        $this->formPublicacao = new PublicacoesForm();

    }
    
    public function executeEditarPerfil(sfWebRequest $request) {
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array(UsuarioLogado::getInstancia()->getIdUsuario())), sprintf('Object usuarios does not exist (%s).', UsuarioLogado::getInstancia()->getIdUsuario()));
        $this->formUsuario = new UsuariosForm($usuarios,null,null,  UsuariosForm::SOMENTE_INFO);
    }
    
    public function executeEditarRegistro(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        
        $id = UsuarioLogado::getInstancia()->getIdUsuario();
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($id)), sprintf('Object usuarios does not exist (%s).', $id));
        $form = new UsuariosForm($usuarios,null,null,  UsuariosForm::SOMENTE_INFO);
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        //Util::pre($form->getTaintedValues(),true);

        if ($form->isValid()) {
            $usuarios = $form->save();
            UsuarioLogado::getInstancia()->atualizaInformacoes($usuarios);
            $this->redirect('perfil/informacao?u=' . $usuarios->getIdUsuario());
        }else{
            $this->formUsuario = $form;
            $this->setTemplate('editarPerfil');
        }
    }
    
    public function executeInformacao(sfWebRequest $request) {
        $id = $request->getParameter("u");
        
        if(!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()){
            $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
        }
        
        $this->forward404Unless($this->usuario);
        
        {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'],0,6);
        }
        
        {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'],0,6);
        }
        
    }
    
    public function executePublicar(sfWebRequest $request) {

        //Util::pre(array($request->getFiles(),$request->getPostParameters()), true);
        $form = new PublicacoesForm();
        $parametros = $request->getParameter($form->getName());
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $form->updateObject();
        $objPublicacao = $form->getObject();
        $objPublicacao->setDataPublicacao(date('Y-m-d H:i:s'));
        $objPublicacao->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
        $objPublicacao->setComentario($parametros['comentario']);
        
        $tipoConteudoPublicacao = $request->getParameter('tipo_conteudo_publicacao');
        if($tipoConteudoPublicacao != Publicacoes::TIPO_LINK && $tipoConteudoPublicacao != Publicacoes::TIPO_NORMAL){
            
            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_PUBLICACOES);
            if(!$pasta){
                
                $pasta = new Pastas();
                $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $pasta->setNome("Publicações de ".UsuarioLogado::getInstancia()->getNome());
                $pasta->setDescricao("Pasta de arquivos enviados das publicações de ".UsuarioLogado::getInstancia()->getNome());
                $pasta->setTipoPasta(Pastas::TIPO_PASTA_PUBLICACOES);
                $pasta->save();
                
                $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(),Pastas::TIPO_PASTA_PUBLICACOES);
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
        
        
        if( $request->getParameter('id_publicacao_original')!= "" && $request->getParameter('id_usuario_original') != ""){ 
            $objPublicacao->setIdUsuarioOriginal ($request->getParameter('id_usuario_original'));
            $objPublicacao->setIdPublicacaoOriginal($request->getParameter('id_publicacao_original'));
        } 
        
        if($request->getParameter('id_usuario_referencia')!=""){
            $objPublicacao->setIdUsuarioReferencia($request->getParameter('id_usuario_referencia'));
        }
        
        if($request->getParameter('privacidade_publicacao')!=""){
            $objPublicacao->setPrivacidadePublicacao($request->getParameter('privacidade_publicacao'));
        }
        
        
        if($request->getParameter('id_usuario_referencia')=="" || $request->getParameter('id_usuario_referencia') == null)
            $id_usuario = UsuarioLogado::getInstancia()->getIdUsuario();
        else
            $id_usuario = $request->getParameter('id_usuario_referencia');
        
        $objPublicacao->save();
        $this->redirect("perfil/exibir?u=".$id_usuario);
    }
    
    public function executeLista(sfWebRequest $request) {
        $this->listaUsuario = Doctrine::getTable("Usuarios")->getUsuariosListagem();
    }
    
    public function executeSolicitacoes(sfWebRequest $request){
        UsuarioLogado::getInstancia()->atualizaSolicitacoes();
        $this->usuario = new Usuarios(null,false,UsuarioLogado::getInstancia());
    }
    
    public function executeAceitarSolicitacao(sfWebRequest $request){
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->setSolicitacao($id);
            Doctrine::getTable("Amigos")->aceitarAmizade($amizade);
            UsuarioLogado::getInstancia()->removeSolicitacao($id);
            $this->redirect('perfil/exibir?u='.$id);
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeRecusarSolicitacao(sfWebRequest $request){
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->setSolicitacao($id);
            Doctrine::getTable("Amigos")->recusarAmizade($amizade);
            UsuarioLogado::getInstancia()->removeSolicitacao($id);
            $this->redirect('perfil/index');
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeSolicitarAmizade(sfWebRequest $request) {
        $amizade = new Amigos();
        $id = $request->getParameter("u");
        
        if(isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()){
            $amizade->solicitarAmizade($id);
            Doctrine::getTable("Amigos")->solicitarAmizade($amizade);
            $this->redirect('perfil/exibir?u='.$id);
        }else{
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }
    
    public function executeExibirAmigos(sfWebRequest $request) {
        $id = $request->getParameter("u");

        if (isset($id) && $id != "" && is_numeric($id)) {
            $id = $request->getParameter("u");

            if (!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()) {
                $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
            } else {
                $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            }

            $this->forward404Unless($this->usuario);

            if ($this->usuario) {
                
                $nome = $request->getParameter("nome");
                $pagina = $request->getParameter("pagina");
                
                if(!isset($nome) || trim($nome)==""){
                    $nome = "";
                }
                
                if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
                    $pagina = 1;
                }
                
                $arrayRetorno = Doctrine::getTable("Usuarios")->filtroAmigosPerfil($this->usuario->getIdUsuario(), $nome, $pagina);
                $this->quantidadeAmigos = $arrayRetorno['quantidade'];
                $this->amigos = $arrayRetorno['amigos'];
                $this->nome = $nome;
                $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
                $this->pagina = $pagina;
            }
        }
    }
    public function executeExibirConteudos(sfWebRequest $request) {
        $id = $request->getParameter("u");
        
        if (isset($id) && $id != "" && is_numeric($id)) {
            $id = $request->getParameter("u");

            if (!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()) {
                $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
            } else {
                $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            }
            
            $this->forward404Unless($this->usuario);

            if($this->usuario){
                
                
                $nome = $request->getParameter("nome");
                $pagina = $request->getParameter("pagina");
                $isProprietario = $request->getParameter("proprietario");
                if(!isset($nome) || trim($nome)==""){
                    $nome = "";
                }
                
                if(!isset($isProprietario) || $isProprietario==""){
                    $isProprietario = false;
                }  else {
                    $isProprietario = true;
                }
                
                if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
                    $pagina = 1;
                }
                
                $arrayRetorno = Doctrine::getTable("Conteudos")->filtroConteudosPerfil($this->usuario->getIdUsuario(),$isProprietario,$nome,$pagina);
                $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
                $this->arrayConteudoSeguido = $arrayRetorno['conteudos'];
                $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
                $this->nome = $nome;
                $this->pagina = $pagina;
                $this->proprietario = $isProprietario;
                        
                
            }else{
               $this->redirect('perfil/index');
            }
        } else {
            $this->redirect('perfil/index');
        }
    }
    
    public function executeLogout(sfWebRequest $request) {
        UsuarioLogado::getInstancia()->deslogar();
        $this->redirect('inicial/index');
    }

    public function executeAtualizarFoto(sfWebRequest $request) {
        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
        $this->formUpload = new AtualizacaoFotoForm();
    }
    
    public function executePreviaFoto(sfWebRequest $request) {
       
        $this->form = new AtualizacaoFotoForm();
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('upload_foto'), $request->getFiles('upload_foto'));
            if ($this->form->isValid()) {
                $file = $this->form->getValue('arquivo');
                $filename = 'temp_usu'.  UsuarioLogado::getInstancia()->getIdUsuario(); //.sha1($file->getOriginalName());
                $extension = $file->getExtension($file->getOriginalExtension());
                $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
                
            }
        }
        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
        $this->imagem = '/uploads/'.$filename.$extension;
        $this->nome_arquivo = $filename.$extension;
        $this->formUpload = new AtualizacaoFotoForm();
        $this->setTemplate('atualizarFoto');
        
    }
     
    public function executeConfirmarFotoPerfil(sfWebRequest $request) {
        $nome_arquivo = $request->getParameter('arq');
        
        $diretorioThumbnail = Util::getDiretorioThumbnail();
        
        $diretorio_arquivo = sfConfig::get('sf_upload_dir') . '/' . $nome_arquivo;
        $extensao = end(explode(".", $nome_arquivo));
        $thumbnail = new sfThumbnail(170, 170);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_large.' . $extensao);

        $thumbnail = new sfThumbnail(60, 60);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_60.' . $extensao);

        $thumbnail = new sfThumbnail(20, 20);
        $thumbnail->loadFile($diretorio_arquivo);
        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_20.' . $extensao);
        
        $objUsuario = Doctrine::getTable("Usuarios")->atualizarImagemPerfil(UsuarioLogado::getInstancia()->getIdUsuario(),'_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_#.'.$extensao);
        
        UsuarioLogado::getInstancia()->atualizaInformacoes($objUsuario);
        
        $this->redirect('perfil/index');
        
    }

}
