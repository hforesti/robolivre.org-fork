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

        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());


        $this->iniciaTabAmigo = $request->hasParameter("i");


        $this->publicacoesHome = Doctrine::getTable("Publicacoes")->getPublicacoesHome(); {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['conteudos']);
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'], 0, 6);
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['amigos']);
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'], 0, 6);
        }


        $this->formPublicacao = new PublicacoesForm();
    }

    public function executeIgnorar(sfWebRequest $request) {
        $ultimaUrl = $request->getReferer();
        $id = $request->getParameter('u');
        $amizade = new Amigos();
        $amizade->setSolicitacao($id);
        Doctrine::getTable("Amigos")->recusarAmizade($amizade);
        Doctrine::getTable("Ignorados")->ignorar($id);
        $this->redirect($ultimaUrl);
    }

    public function executeNovaSenha(sfWebRequest $request) {
        $id = $request->getParameter('u');
        $token = $request->getParameter('token');

        $this->usuario = Doctrine::getTable("Usuarios")->validaToken($id, $token);
        $this->forward404Unless($this->usuario);

        $this->formSenha = new UsuariosForm(null, array(), null, UsuariosForm::REDEFINIR_SENHA);
        $this->resultado = false;
        $this->token = $token;
        $this->id = $id;
    }

    public function executeProcessarNovaSenha(sfWebRequest $request) {
        $id = $request->getParameter('u');
        $token = $request->getParameter('token');

        $usuario = Doctrine::getTable("Usuarios")->validaToken($id, $token);
        $this->forward404Unless($usuario);

        $form = new UsuariosForm($usuario, null, null, UsuariosForm::REDEFINIR_SENHA);

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $valores = $form->getTaintedValues();
            $objUsuario = $form->getObject();

            if (isset($valores['senhaNova']) && $valores['senhaNova'] != "") {
                $objUsuario->setSenha($valores['senhaNova']);
            }
            $objUsuario->setIdUsuario($id);
            $objUsuario->setToken($token);

            $usuario = Doctrine::getTable('Usuarios')->redefinirSenhaUsuario($objUsuario);

            $this->resultado = true;
        } else {
            $this->formSenha = $form;
            $this->resultado = false;
            $this->token = $token;
            $this->id = $id;
        }

        $this->setTemplate('novaSenha');
    }

    public function executeConfiguracoes(sfWebRequest $request) {
        $usuarios = new Usuarios(null, false, UsuarioLogado::getInstancia());
        $this->formUsuario = new UsuariosForm($usuarios, null, null, UsuariosForm::CONFIGURACAO);
    }

    public function executeGravarConfiguracoes(sfWebRequest $request) {

        $usuarios = new Usuarios(null, false, UsuarioLogado::getInstancia());
        $this->retorno = false;
        $form = new UsuariosForm($usuarios, null, null, UsuariosForm::CONFIGURACAO);
        $parametrosEmail = ConfiguracoesEmailUsario::getTodosParametrosConfiguracao($request->getPostParameter('usuarios'));
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {

            $valores = $form->getTaintedValues();

            $objUsuario = $form->getObject();
            $objUsuario->setParametrosEmail($parametrosEmail);
            if (isset($valores['senhaNova']) && $valores['senhaNova'] != "") {
                $objUsuario->setSenha($valores['senhaNova']);
            }

            if (isset($valores['nome']) && $valores['nome'] != "") {
                $objUsuario->setNome($valores['nome']);
            }

            $usuario = Doctrine::getTable('Usuarios')->editarConfiguracaoUsuario($objUsuario);

            UsuarioLogado::getInstancia()->atualizaInformacoes($usuario);
            $usuarios = new Usuarios(null, false, UsuarioLogado::getInstancia());
            $this->formUsuario = new UsuariosForm($usuarios, null, null, UsuariosForm::CONFIGURACAO);
            $this->retorno = true;
        } else {
            $this->parametrosEmail = $parametrosEmail;
            $this->formUsuario = $form;
        }

        $this->setTemplate('configuracoes');
    }

    public function executeExibir(sfWebRequest $request) {


        $id = $request->getParameter("u");
        $this->ignorado = null;

        if (!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()) {
            $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
        } else {
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            if (Doctrine::getTable("Ignorados")->estaIgnorado($id)) {
                $this->ignorado = true;
            }
        }

        $this->forward404Unless($this->usuario); {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['conteudos']);
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'], 0, 6);
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['amigos']);
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'], 0, 6);
        }

        $this->publicacoesPerfil = Doctrine::getTable("Publicacoes")->getPublicacoesDoPerfil($this->usuario->getIdUsuario());

        $this->formPublicacao = new PublicacoesForm();
    }

    public function executeEditarPerfil(sfWebRequest $request) {
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array(UsuarioLogado::getInstancia()->getIdUsuario())), sprintf('Object usuarios does not exist (%s).', UsuarioLogado::getInstancia()->getIdUsuario()));
        $this->formUsuario = new UsuariosForm($usuarios, null, null, UsuariosForm::SOMENTE_INFO);
    }

    public function executeEditarRegistro(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

        $id = UsuarioLogado::getInstancia()->getIdUsuario();
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($id)), sprintf('Object usuarios does not exist (%s).', $id));
        $form = new UsuariosForm($usuarios, null, null, UsuariosForm::SOMENTE_INFO);

        $postParameters = $request->getParameter($form->getName());


        $postParameters['sobre_mim'] = Util::getHtmlPurificado($postParameters['sobre_mim']);
        $postParameters['escola'] = Util::getHtmlPurificado($postParameters['escola']);
        $postParameters['curso'] = Util::getHtmlPurificado($postParameters['curso']);
        $postParameters['profissao'] = Util::getHtmlPurificado($postParameters['profissao']);
        $postParameters['empresa'] = Util::getHtmlPurificado($postParameters['empresa']);


        $form->bind($postParameters, $request->getFiles($form->getName()));
        $link = null;
        if ($form->isValid()) {
            if ($usuarios->getEmail() != $postParameters['email']) {
                sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Url'));
                Doctrine_Core::getTable('Usuarios')->atualizarEmail();
                $link = url_for("perfil/novoEmail?token=" . md5($usuarios->getLogin()) . "&u=" . $usuarios->getIdUsuario(), true);
                Util::enviarEmail("[robolivre.org] Redefinição de email", Util::getTextoEmailRedefnirEmail($link, $usuarios->getNome(), $usuarios->getLogin()), $usuarios->getEmail());
            }
            $usuarios = $form->save();
            UsuarioLogado::getInstancia()->atualizaInformacoes($usuarios);
            if ($link) {
                $this->redirect('perfil/editarPerfil');
            } else {
                $this->redirect('perfil/informacaoHome');
            }
        } else {
            $this->formUsuario = $form;
            $this->setTemplate('editarPerfil');
        }
    }

    public function executeNovoEmail(sfWebRequest $request) {
        $id = $request->getParameter('u');
        $this->forward404Unless($usuario = Doctrine_Core::getTable('Usuarios')->find(array($id)), sprintf('Object usuarios does not exist (%s).', $id));
        $this->forward404Unless(md5($usuario->getLogin()) == $request->getParameter('token') && $usuario->getEmailNovo());
        Doctrine_Core::getTable('Usuarios')->confirmarEmail($usuario->getIdUsuario());
        if (UsuarioLogado::getInstancia()->isLogado()) {
            $this->redirect('perfil/editarPerfil');
        } else {
            $this->redirect('inicial/index');
        }
    }

    public function executeInformacao(sfWebRequest $request) {
        $id = $request->getParameter("u");

        if (!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()) {
            $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
        } else {
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
        }

        $this->forward404Unless($this->usuario); {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['conteudos']);
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'], 0, 6);
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['amigos']);
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'], 0, 6);
        }
    }

    public function executeInformacaoHome(sfWebRequest $request) {

        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia()); {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['conteudos']);
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'], 0, 6);
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil($this->usuario->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['amigos']);
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'], 0, 6);
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
        if ($tipoConteudoPublicacao != Publicacoes::TIPO_LINK && $tipoConteudoPublicacao != Publicacoes::TIPO_NORMAL) {

            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(), Pastas::TIPO_PASTA_PUBLICACOES);
            if (!$pasta) {

                $pasta = new Pastas();
                $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
                $pasta->setNome("Publicações de " . UsuarioLogado::getInstancia()->getNome());
                $pasta->setDescricao("Pasta de arquivos enviados das publicações de " . UsuarioLogado::getInstancia()->getNome());
                $pasta->setTipoPasta(Pastas::TIPO_PASTA_PUBLICACOES);
                $pasta->save();

                $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(), Pastas::TIPO_PASTA_PUBLICACOES);
            }

            if ($tipoConteudoPublicacao == Publicacoes::TIPO_VIDEO) {
                $video = new Videos();
                $video->setIdPasta($pasta->getIdPasta());
                $video->setIdUsuario($pasta->getIdUsuario());
                $video->setLinkVideo($request->getParameter("url_video"));

                $video = Doctrine::getTable("Videos")->gravarVideo($video);
                $objPublicacao->setIdVideo($video->getIdVideo());
                $objPublicacao->setIdPasta($video->getIdPasta());
            } else if ($tipoConteudoPublicacao == Publicacoes::TIPO_FOTO) {
                //mas 550x550   
                $diretorio_arquivo = Util::getDiretorioFotosPublicacoes(UsuarioLogado::getInstancia()->getIdUsuario());
                $file = $form->getValue('foto');

                $extension = $file->getExtension($file->getOriginalExtension());
                $extensao = str_replace('.', '', strtolower($extension));

                $nome_arquivo = 'img_publicacao_usu_' . UsuarioLogado::getInstancia()->getIdUsuario() . "_" . md5(time());

                $file->save($diretorio_arquivo . '/' . $nome_arquivo . $extension);

                $img = new sfImage($diretorio_arquivo . '/' . $nome_arquivo . $extension, "image/{$extensao}");
                if ($img->getWidth() > 570) {
                    $largura = $img->getWidth();
                    $diferenca = 570 / $largura;
                    $altura = $img->getHeight() * $diferenca;
                    $img->resize(570, $altura);
                }
                if ($extensao != 'gif') {
                    $img->setQuality(75);
                    $img->saveAs($diretorio_arquivo . '/' . $nome_arquivo . $extension);
                }
                $img->thumbnail(60, 60);
                $img->setQuality(75);
                $img->saveAs($diretorio_arquivo . '/' . $nome_arquivo . '_60' . $extension);

//                var_dump($file);
//                die;
//                $thumbnail = new sfThumbnail(550, null);
//                $thumbnail->loadFile($diretorio_arquivo.'/'.$nome_arquivo.$extension);
//                $thumbnail->save($diretorio_arquivo.'/'.$nome_arquivo . $extension);

                $imagem = new Imagens();
                $imagem->setIdPasta($pasta->getIdPasta());
                $imagem->setIdUsuario($pasta->getIdUsuario());
                $imagem->setNomeArquivo($nome_arquivo . $extension);
                $imagem = Doctrine::getTable("Imagens")->gravarImagem($imagem);
                $objPublicacao->setIdImagem($imagem->getIdImagem());
                $objPublicacao->setIdPasta($imagem->getIdPasta());
            }
        } else {
            if ($tipoConteudoPublicacao == Publicacoes::TIPO_LINK) {
                $objPublicacao->setLink($request->getParameter('url_link'));
            }
        }


        if ($request->getParameter('id_publicacao_original') != "" && $request->getParameter('id_usuario_original') != "") {
            $objPublicacao->setIdUsuarioOriginal($request->getParameter('id_usuario_original'));
            $objPublicacao->setIdPublicacaoOriginal($request->getParameter('id_publicacao_original'));
        }

        if ($request->getParameter('id_usuario_referencia') != "") {
            $objPublicacao->setIdUsuarioReferencia($request->getParameter('id_usuario_referencia'));
        }

        if ($request->getParameter('privacidade_publicacao') != "") {
            $objPublicacao->setPrivacidadePublicacao($request->getParameter('privacidade_publicacao'));
        }


        if ($request->getParameter('id_usuario_referencia') == "" || $request->getParameter('id_usuario_referencia') == null)
            $id_usuario = UsuarioLogado::getInstancia()->getIdUsuario();
        else
            $id_usuario = $request->getParameter('id_usuario_referencia');

        $objPublicacao->save();
        $this->redirect("perfil/index?&i=1");
    }

    public function executeLista(sfWebRequest $request) {
        $this->listaUsuario = Doctrine::getTable("Usuarios")->getUsuariosListagem();
    }

    public function executeNotificacoes(sfWebRequest $request) {
        UsuarioLogado::getInstancia()->atualizaSolicitacoes(); {
            $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosSeguidosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['conteudos']);
            $this->arrayConteudoSeguido = array_splice($arrayRetorno['conteudos'], 0, 6);
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getAmigosPerfil(UsuarioLogado::getInstancia()->getIdUsuario());
            $this->quantidadeAmigos = $arrayRetorno['quantidade'];
            shuffle($arrayRetorno['amigos']);
            $this->arrayAmigos = array_splice($arrayRetorno['amigos'], 0, 6);
        }
    }

    public function executeAceitarSolicitacao(sfWebRequest $request) {
        $amizade = new Amigos();
        $id = $request->getParameter("u");

        if (isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()) {
            $amizade->setSolicitacao($id);

            Doctrine::getTable('Ignorados')->removerIgnorar($id);

            Doctrine::getTable("Amigos")->aceitarAmizade($amizade);
            //UsuarioLogado::getInstancia()->removeSolicitacao($id);
            UsuarioLogado::getInstancia()->atualizaSolicitacoes();
            $this->redirect('perfil/exibir?u=' . $id);
        } else {
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }

    public function executeRemoverAmigo(sfWebRequest $request) {
        $id = $request->getParameter("u");
        if (isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()) {
            $amizade = new Amigos();
            $amizade->setSolicitacao($id);

            Doctrine::getTable("Amigos")->recusarAmizade($amizade);
            $this->redirect('perfil/exibirAmigosHome');
        } else {
            $this->redirect('perfil/exibirAmigosHome');
        }
    }

    public function executeRecusarSolicitacao(sfWebRequest $request) {
        $amizade = new Amigos();
        $id = $request->getParameter("u");

        if (isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()) {
            $amizade->setSolicitacao($id);
            Doctrine::getTable("Amigos")->recusarAmizade($amizade);
            //UsuarioLogado::getInstancia()->removeSolicitacao($id);
            UsuarioLogado::getInstancia()->atualizaSolicitacoes();
            $this->redirect('perfil/index');
        } else {
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }

    public function executeSolicitarAmizade(sfWebRequest $request) {
        $amizade = new Amigos();
        $id = $request->getParameter("u");

        if (isset($id) && $id != UsuarioLogado::getInstancia()->getIdUsuario()) {
            $amizade->solicitarAmizade($id);
            Doctrine::getTable("Amigos")->solicitarAmizade($amizade);
            $this->redirect('perfil/exibir?u=' . $id);
        } else {
            $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            $this->redirect('perfil/index');
        }
    }

    public function executeExibirAmigos(sfWebRequest $request) {
        $id = $request->getParameter("u");

        if (isset($id) && $id != "" && is_numeric($id)) {
            $id = $request->getParameter("u");

            if (!isset($id) || $id == UsuarioLogado::getInstancia()->getIdUsuario()) {
                $this->redirect('exibirAmigosHome');
            } else {
                $this->usuario = Doctrine::getTable("Usuarios")->buscarPorId($id);
            }

            $this->forward404Unless($this->usuario);

            if ($this->usuario) {

                $nome = $request->getParameter("nome");
                $pagina = $request->getParameter("pagina");

                if (!isset($nome) || trim($nome) == "") {
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

    public function executeExibirAmigosHome(sfWebRequest $request) {

        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());


        $nome = $request->getParameter("nome");
        $pagina = $request->getParameter("pagina");

        if (!isset($nome) || trim($nome) == "") {
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

            if ($this->usuario) {


                $nome = $request->getParameter("nome");
                $pagina = $request->getParameter("pagina");
                $isProprietario = $request->getParameter("proprietario");
                if (!isset($nome) || trim($nome) == "") {
                    $nome = "";
                }

                if (!isset($isProprietario) || $isProprietario == "") {
                    $isProprietario = false;
                } else {
                    $isProprietario = true;
                }

                if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
                    $pagina = 1;
                }

                $arrayRetorno = Doctrine::getTable("Conteudos")->filtroConteudosPerfil($this->usuario->getIdUsuario(), $isProprietario, $nome, $pagina);
                $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
                $this->arrayConteudoSeguido = $arrayRetorno['conteudos'];
                $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
                $this->nome = $nome;
                $this->pagina = $pagina;
                $this->proprietario = $isProprietario;
            } else {
                $this->redirect('perfil/index');
            }
        } else {
            $this->redirect('perfil/index');
        }
    }

    public function executeExibirConteudosHome(sfWebRequest $request) {

        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());

        $nome = $request->getParameter("nome");
        $pagina = $request->getParameter("pagina");
        $isProprietario = $request->getParameter("proprietario");
        if (!isset($nome) || trim($nome) == "") {
            $nome = "";
        }

        if (!isset($isProprietario) || $isProprietario == "") {
            $isProprietario = false;
        } else {
            $isProprietario = true;
        }

        if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
            $pagina = 1;
        }

        $arrayRetorno = Doctrine::getTable("Conteudos")->filtroConteudosPerfil($this->usuario->getIdUsuario(), $isProprietario, $nome, $pagina);
        $this->quantidadeConteudoSeguido = $arrayRetorno['quantidade'];
        $this->arrayConteudoSeguido = $arrayRetorno['conteudos'];
        $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
        $this->nome = $nome;
        $this->pagina = $pagina;
        $this->proprietario = $isProprietario;
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
                $filename = 'temp_usu' . UsuarioLogado::getInstancia()->getIdUsuario(); //.sha1($file->getOriginalName());
                $extension = $file->getExtension($file->getOriginalExtension());
                $file->save(sfConfig::get('sf_upload_dir') . '/' . $filename . $extension);
            }
        }
        $this->usuario = new Usuarios(null, false, UsuarioLogado::getInstancia());
        $this->imagem = '/uploads/' . $filename . $extension;
        $this->nome_arquivo = $filename . $extension;
        $this->formUpload = new AtualizacaoFotoForm();
        $this->setTemplate('atualizarFoto');
    }

    public function executeConfirmarFotoPerfil(sfWebRequest $request) {
        $nome_arquivo = $request->getParameter('imagem_selecionada');

        if ($nome_arquivo) {
            $diretorioThumbnail = Util::getDiretorioThumbnail();

            $diretorio_arquivo = sfConfig::get('sf_upload_dir') . '/' . $nome_arquivo;
            $extensao = end(explode(".", $nome_arquivo));
            $extensao = strtolower($extensao);

            $img = new sfImage($diretorio_arquivo, "image/{$extensao}");

            if ($img->getHeight() > 170 && $img->getWidth() > 170) {

                if ($img->getWidth() > $img->getHeight()) {
                    $scale = 170 / $img->getHeight();
                } else {
                    $scale = 170 / $img->getWidth();
                }

                $img->scale($scale);

                if ($img->getWidth() > $img->getHeight()) {
                    $largura = ($img->getWidth() / 2);
                    $pontoX = $largura - (170 / 2);

                    if ($pontoX < 0) {
                        $pontoX = 0;
                    }
                    $pontoY = 0;
                } else {
                    $altura = ($img->getHeight() / 2);
                    $pontoY = $altura - (170 / 2);

                    if ($pontoY < 0) {
                        $pontoY = 0;
                    }
                    $pontoX = 0;
                }

                $img->crop($pontoX, $pontoY, 170, 170);
            } else {

                if ($img->getWidth() > $img->getHeight()) {
                    $scale = 170 / $img->getHeight();
                } else {
                    $scale = 170 / $img->getWidth();
                }

                $img->scale($scale);

                if ($img->getWidth() > $img->getHeight()) {
                    $largura = ($img->getWidth() / 2);
                    $pontoX = $largura - (170 / 2);

                    if ($pontoX < 0) {
                        $pontoX = 0;
                    }
                    $pontoY = 0;
                } else {
                    $altura = ($img->getHeight() / 2);
                    $pontoY = $altura - (170 / 2);

                    if ($pontoY < 0) {
                        $pontoY = 0;
                    }
                    $pontoX = 0;
                }
                $img->crop($pontoX, $pontoY, 170, 170);
            }

            $img->setQuality(75);
            $img->saveAs($diretorioThumbnail . '/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_large.' . $extensao);
            $img->thumbnail(60, 60);
            $img->setQuality(75);
            $img->saveAs($diretorioThumbnail . '/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_60.' . $extensao);
            $img->thumbnail(20, 20);
            $img->setQuality(75);
            $img->saveAs($diretorioThumbnail . '/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_20.' . $extensao);

//        $thumbnail = new sfThumbnail(170, 170,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_large.' . $extensao);
//
//        $thumbnail = new sfThumbnail(60, 60,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_60.' . $extensao);
//
//        $thumbnail = new sfThumbnail(20, 20,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_20.' . $extensao);

            $objUsuario = Doctrine::getTable("Usuarios")->atualizarImagemPerfil(UsuarioLogado::getInstancia()->getIdUsuario(), '_avatar_usu' . UsuarioLogado::getInstancia()->getIdUsuario() . '_#.' . $extensao);

            UsuarioLogado::getInstancia()->atualizaInformacoes($objUsuario);
        }
        $this->redirect('perfil/index');
    }

}
