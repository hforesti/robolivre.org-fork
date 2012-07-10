<?php

/**
 * conteudo actions.
 *
 * @package    robolivre
 * @subpackage conteudo
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conteudoActions extends robolivreAction {

    public function execute($request, $executarTeste = true) {

        $acao = $request->getParameter('acao');
        switch ($acao) {
            case 'download' : $this->executeDownload($request);
                return;
            case 'editarNome' : $this->executeEditarNome($request);
                return;
            case 'exibirSeguidores' : $this->executeExibirSeguidores($request);
                return;
            case 'exibirConteudosRelacionados' : $this->executeExibirConteudosRelacionados($request);
                return;
            case 'atualizarFoto' : $this->executeAtualizarFoto($request);
                return;
            case 'modificarFotoConteudo' : $this->executeModificarFotoConteudo($request);
                return;
            case 'exibirDocumentos' : $this->executeExibirDocumentos($request);
                return;
            case 'adicionarDoc' : $this->executeAdicionarDocumentos($request);
                return;
            case 'gravarDocumento' : $this->executeGravarDocumento($request);
                return;
            case 'video' :
                $this->executeExibir($request, "video");
                return;
            case 'link' :
                $this->executeExibir($request, "link");
                return;
            case 'imagem' :
                $this->executeExibir($request, "imagem");
                return;
            case '' :
            case 'index' :
                break;
            default: $this->forward404("Ação '$acao' inexistente em conteudo");
                return;
        }
        parent::execute($request, $executarTeste);
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->redirect("conteudos/index");
    }

    public function executeDownload(sfWebRequest $request){
        $slug = $request->getParameter('slug');
        $id = $request->getParameter('idDoc');
        $documento = Doctrine::getTable('Documentos')->getPorId($id);
        $documento->setHits($documento->getHits() + 1);
        $documento->replace();
        $this->redirect("/uploads/documentos/$slug/" . $documento->getNomeArquivo());
    }

    public function executeEditarNome(sfWebRequest $request){
        $ultimaUrl = $request->getReferer();
        $idDoc = $request->getParameter('idDoc');
        $documento = Doctrine::getTable('Documentos')->getPorId($idDoc);
        $documento->setNomeDocumento($request->getParameter('nome'));
        $documento->replace();
        $this->redirect($ultimaUrl);
    }


    public function executeGravarDocumento(sfWebRequest $request) {
        $ultimaUrl = $request->getReferer();
        $slug = $request->getParameter('slug');
        $conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $arquivos = explode(Util::SEPARADOR_PARAMETRO, $request->getPostParameter('documentos_selecionados'));
        $arquivo = array_pop($arquivos);
        $extensao = explode(".", $arquivo);
        $nomeFile = $extensao[0];
        $nomeDoc = $request->getParameter('nome');
        $extensao = array_pop($extensao);
        

        $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(), Pastas::TIPO_PASTA_ANEXOS_CONJUNTO, $conteudo->getIdConjunto(), Conjuntos::TIPO_CONTEUDO);
        if (!$pasta) {

            $pasta = new Pastas();
            $pasta->setIdUsuario(UsuarioLogado::getInstancia()->getIdUsuario());
            $pasta->setNome("Anexo de " . UsuarioLogado::getInstancia()->getNome() . " no Conteudo " . $conteudo->getNome());
            $pasta->setDescricao("Arquivos anexos de " . UsuarioLogado::getInstancia()->getNome() . " no Conteudo " . $conteudo->getNome());
            $pasta->setTipoPasta(Pastas::TIPO_PASTA_ANEXOS_CONJUNTO);
            $pasta->setIdConjunto($conteudo->getIdConjunto());
            $pasta->setIdTipoConjunto(Conjuntos::TIPO_CONTEUDO);

            $pasta->save();

            $pasta = Doctrine::getTable("Pastas")->getPastaUsuario(UsuarioLogado::getInstancia()->getIdUsuario(), Pastas::TIPO_PASTA_ANEXOS_CONJUNTO, $conteudo->getIdConjunto(), Conjuntos::TIPO_CONTEUDO);
            if (!file_exists(sfConfig::get('sf_upload_dir') . "/documentos/$slug")) {
                mkdir(sfConfig::get('sf_upload_dir') . "/documentos/$slug", 0777);
            }
        }
        
        if ($arquivo != "" && file_exists(sfConfig::get('sf_upload_dir') . "/" . $arquivo)) {
            
            $idUsuarioLogado = UsuarioLogado::getInstancia()->getIdUsuario();
            
            copy(sfConfig::get('sf_upload_dir') . "/" . $arquivo, sfConfig::get('sf_upload_dir') . "/documentos/$slug/" . $nomeFile . "_" . $idUsuarioLogado . "_" . time() . "." . $extensao);

            $documento = new Documentos();
            $documento->setIdPasta($pasta->getIdPasta());
            $documento->setIdUsuario($pasta->getIdUsuario());
            $documento->setIsCodigoFonte(false);
            $documento->setNomeArquivo($nomeFile . "_" . $idUsuarioLogado . "_" . time() . "." . $extensao);
            $documento->setNomeDocumento($nomeDoc);

            $documento->save();
        }
        $this->redirect($this->generateUrl('conteudo_acao', array(
                                                            'slug' => $slug, 
                                                            'acao' => 'exibirDocumentos'
                                                            )));
    }

    public function executeAdicionarDocumentos(sfWebRequest $request) {
        $slug = $request->getParameter('slug');
        $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $this->formDocumento = new ConteudosForm($this->conteudo);
        $this->forward404Unless($this->conteudo);


        $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
        $this->quantidadeParticipantes = $arrayRetorno['quantidade'];

        $arrayDocumentos = Doctrine::getTable("Documentos")->filtroDocumentosConteudo($this->conteudo->getIdConjunto());
        $this->documentos = $arrayDocumentos['documentos'];
        $this->quantidadeDocumentos = $arrayDocumentos['quantidade'];
        $this->quantidadeTotalPaginas = $arrayDocumentos['totalPaginas'];

        $this->setTemplate("adicionarDocumentos");
    }

    public function executeExibirDocumentos(sfWebRequest $request) {
        $slug = $request->getParameter('slug');
        $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $this->forward404Unless($this->conteudo);

        $nome = $request->getParameter("nome");
        $pagina = $request->getParameter("pagina");
        $proprietario = $request->getParameter("proprietario");

        if (!isset($proprietario)) {
            $proprietario = false;
        } else {
            $proprietario = true;
        }

        if (!isset($nome) || trim($nome) == "") {
            $nome = "";
        }

        if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
            $pagina = 1;
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
            $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
        } {
            $arrayDocumentos = Doctrine::getTable("Documentos")->filtroDocumentosConteudo($this->conteudo->getIdConjunto(), $proprietario, $nome, $pagina);
            $this->documentos = $arrayDocumentos['documentos'];
            $this->quantidadeDocumentos = $arrayDocumentos['quantidade'];
            $this->quantidadeTotalPaginas = $arrayDocumentos['totalPaginas'];
            $this->nome = $nome;
            $this->pagina = $pagina;
            $this->proprietario = $proprietario;
        }

        $this->setTemplate("exibirDocumentos");
    }

    public function executeAtualizarFoto(sfWebRequest $request) {
        $slug = $request->getParameter('slug');

        $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $this->forward404Unless($this->conteudo && $this->conteudo->getPodeColaborar());
        {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
            $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
        }
        $this->formUpload = new AtualizacaoFotoForm();
        $this->setTemplate("atualizarFoto");
    }

    public function executeModificarFotoConteudo(sfWebRequest $request) {

        $slug = $request->getParameter('slug');

        $conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
        $this->forward404Unless($conteudo && $conteudo->getPodeColaborar());

        $nome_arquivo = $request->getParameter('imagem_selecionada');

        $diretorioThumbnail = Util::getDiretorioThumbnail();

        $diretorio_arquivo = sfConfig::get('sf_upload_dir') . '/' . $nome_arquivo;
        $extensao = end(explode(".", $nome_arquivo));

        $img = new sfImage($diretorio_arquivo, 'image/jpg');

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
        $img->saveAs($diretorioThumbnail . '/_avatar_con_' . $slug . '_large.' . $extensao);
        $img->thumbnail(60, 60);
        $img->setQuality(75);
        $img->saveAs($diretorioThumbnail . '/_avatar_con_' . $slug . '_60.' . $extensao);
        $img->thumbnail(20, 20);
        $img->setQuality(75);
        $img->saveAs($diretorioThumbnail . '/_avatar_con_' . $slug . '_20.' . $extensao);

//        $thumbnail = new sfThumbnail(170, 170,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_con_' . $slug . '_large.' . $extensao);
//
//        $thumbnail = new sfThumbnail(60, 60,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_con_' . $slug . '_60.' . $extensao);
//
//        $thumbnail = new sfThumbnail(20, 20,false,true);
//        $thumbnail->loadFile($diretorio_arquivo);
//        $thumbnail->save($diretorioThumbnail.'/_avatar_con_' . $slug . '_20.' . $extensao);

        $objUsuario = Doctrine::getTable("Conteudos")->atualizarImagemConteudo($conteudo->getIdConjunto(), '_avatar_con_' . $slug . '_#.' . $extensao);

        UsuarioLogado::getInstancia()->atualizaInformacoes($objUsuario);

        $this->redirect("conteudo/$slug");
    }

    public function executeExibir(sfWebRequest $request, $tipoFiltro = "") {

        $slug = $request->getParameter('slug');

        if (!isset($slug)) {
            $this->redirect('conteudos/index');
        } else {
            $this->tipoFiltro = $tipoFiltro;
            $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
            $this->forward404Unless($this->conteudo);
            $this->formPublicacao = new PublicacoesForm();
            $this->publicacoesConjunto = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($this->conteudo->getIdConjunto(), null, $tipoFiltro); //array();
            $chaves = array_keys($this->publicacoesConjunto);
            $this->dataCriacao = Util::getDataFormatada($this->conteudo->getConjunto()->getDataCriacao());
            $this->ultimaAtulizacao = Util::getDataFormatada($this->conteudo->getConjunto()->getUltimaModificacao());
            {
                $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
                $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
                shuffle($arrayRetorno['participantes']);
                $this->arrayParticipantes = array_splice($arrayRetorno['participantes'], 0, 6);
            } {
                $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosRelacionados($this->conteudo->getIdConjunto());
                $this->quantidadeConteudosRelacionados = $arrayRetorno['quantidade'];
                shuffle($arrayRetorno['conteudos']);
                $this->arrayConteudosRelacionados = array_splice($arrayRetorno['conteudos'], 0, 9);
            }
        }
    }

    public function executeExibirConteudosRelacionados(sfWebRequest $request) {
        $slug = $request->getParameter('slug');

        $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);


        $this->forward404Unless($this->conteudo);



        $nome = $request->getParameter("nome");
        $pagina = $request->getParameter("pagina");

        if (!isset($nome) || trim($nome) == "") {
            $nome = "";
        }

        if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
            $pagina = 1;
        } {
            $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
            $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
            $this->arrayParticipantes = array_splice($arrayRetorno['participantes'], 0, 6);
        }

        $arrayRetorno = Doctrine::getTable("Conteudos")->filtroConteudosRelacionadosConteudo($this->conteudo->getIdConjunto(), $nome, $pagina);
        $this->quantidadeConteudosRelacionados = $arrayRetorno['quantidade'];
        $this->arrayConteudosRelacionados = $arrayRetorno['conteudos'];
        $this->nome = $nome;
        $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
        $this->pagina = $pagina;

        $this->setTemplate("exibirConteudosRelacionados");
    }

    public function executeExibirSeguidores(sfWebRequest $request) {

        $slug = $request->getParameter('slug');

        $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);


        $this->forward404Unless($this->conteudo);



        $nome = $request->getParameter("nome");
        $pagina = $request->getParameter("pagina");

        if (!isset($nome) || trim($nome) == "") {
            $nome = "";
        }

        if (!isset($pagina) || $pagina == "" || !is_numeric($pagina)) {
            $pagina = 1;
        }

        $arrayRetorno = Doctrine::getTable("Usuarios")->filtroSeguidoresConteudo($this->conteudo->getIdConjunto(), $nome, $pagina);
        $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
        $this->participantes = $arrayRetorno['participantes'];
        $this->nome = $nome;
        $this->quantidadeTotalPaginas = $arrayRetorno['totalPaginas'];
        $this->pagina = $pagina;

        $this->setTemplate("exibirSeguidores");
    }

}
