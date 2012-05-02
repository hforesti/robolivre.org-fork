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

            case 'exibirSeguidores' : $this->executeExibirSeguidores($request);
                return;
            case 'exibirConteudosRelacionados' : $this->executeExibirConteudosRelacionados($request);
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

    public function executeExibir(sfWebRequest $request) {

        $slug = $request->getParameter('slug');

        if (!isset($slug)) {
            $this->redirect('conteudos/index');
        } else {
            $this->conteudo = Doctrine::getTable("Conteudos")->buscaPorSlug($slug);
            $this->formPublicacao = new PublicacoesForm();
            $this->publicacoesConjunto = Doctrine::getTable("Publicacoes")->getPublicacoesDoConjunto($this->conteudo->getIdConjunto()); //array();
            $chaves = array_keys($this->publicacoesConjunto);
            $this->ultimaAtulizacao = Util::getDataFormatada($this->publicacoesConjunto[$chaves[0]]->getDataPublicacao()); 
            {
                $arrayRetorno = Doctrine::getTable("Usuarios")->getParticipantesConjunto($this->conteudo->getIdConjunto());
                $this->quantidadeParticipantes = $arrayRetorno['quantidade'];
                $this->arrayParticipantes = array_splice($arrayRetorno['participantes'], 0, 6);
            } {
                $arrayRetorno = Doctrine::getTable("Conteudos")->getConteudosRelacionados($this->conteudo->getIdConjunto());
                $this->quantidadeConteudosRelacionados = $arrayRetorno['quantidade'];
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
        }

        {
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
