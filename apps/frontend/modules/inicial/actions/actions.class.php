<?php

/**
 * inicial actions.
 *
 * @package    robolivre
 * @subpackage inicial
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inicialActions extends robolivreAction {

    public function execute($request) {
        if (UsuarioLogado::getInstancia()->isLogado() && sfContext::getInstance()->getActionName() == "index") {
            $this->redirect('perfil/index');
            return;
        }
        parent::execute($request, false);
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
        $this->formLogin = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
    }

    public function executeEsqueciSenha(sfWebRequest $request) {

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Url'));

        $email = $request->getParameter("email");

        $usuario = Doctrine::getTable('Usuarios')->esqueciSenha($email);

        if ($usuario) {
            $link = url_for("perfil/novaSenha?token=" . $usuario->getToken() . "&u=" . $usuario->getIdUsuario(), true);

            Util::enviarEmail("[robolivre.org] Redefinir senha", Util::getTextoEmailEsqueciSenha($link, $usuario->getNome(), $usuario->getLogin()), $usuario->getEmail());

            $this->mensagem = "$link <strong>Tudo bem!</strong> Um link para recuperar sua senha foi enviado para o seu email <em>" . $usuario->getEmail() . "</em>.";
        } else {
            $this->erro = "O endereço de email <strong>$email</strong> não está cadastrado no nosso site. Tente novamente.";
        }

        $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
        $this->formLogin = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
        $this->setTemplate("index");
    }

    public function executeCreate(sfWebRequest $request) {

        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $form = new UsuariosForm(null, null, null, UsuariosForm::SOMENTE_INFO_CADASTRO);
        //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $this->processForm($request, $form);

        $this->form = $form;
    }

    public function executeCadastro(sfWebRequest $request) {
        $form = new UsuariosForm(null, null, null, UsuariosForm::SOMENTE_INFO_CADASTRO);
        $campos = $request->getParameter($form->getName());

        if (isset($campos['nome']) || isset($campos['login']) || isset($campos['email'])) {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        }

        $form->validaDadosIniciais();

        $this->form = $form;
    }

    public function executeTelaLogin(sfWebRequest $request) {
        $this->ultimaPagina = $request->getAttribute('ultima_pagina');
        $this->formLogin = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
    }

    public function executeLogin(sfWebRequest $request) {
        $form = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
        if ($request->hasParameter('ultima_pagina') && $request->getParameter('ultima_pagina') != "") {
            $ultimaPagina = $request->getParameter('ultima_pagina');
        } else {
            $ultimaPagina = "perfil/index";
        }
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $senha = false;
            $login = $form->getValue('login');
            if(strpos($login, '@') !== false){
                
                $u = Doctrine::getTable('Usuarios')->buscarPorEmail($login);
                $senha = Util::gerarSenha($form->getValue('senha'), $u->getLogin());
            }else{
                $senha = Util::gerarSenha($form->getValue('senha'), $login);
            }

            $objUsuario = Doctrine::getTable('Usuarios')->login($login, $senha);

            if ($request->getParameter('lembrar') == 1) {
                //1296000 = 15 dias
                sfContext::getInstance()->getResponse()->setCookie('cooLogin', $form->getValue('login'), time() + Util::TEMPO_COOKIE, '/');
                sfContext::getInstance()->getResponse()->setCookie('cooSenha', md5($form->getValue('senha')), time() + Util::TEMPO_COOKIE, '/');
            }

            if ($objUsuario) {
                UsuarioLogado::getInstancia()->logar($objUsuario);
                $this->redirect($ultimaPagina);
                return;
            } else {
                $form->getErrorSchema()->addError(new sfValidatorError($form->getValidator('login'), "Senha não corresponde ao login informado. Por favor, tente novamente"));
                $this->formLogin = $form;
                $this->setTemplate('telaLogin');
                return;
            }
        } else {
            $this->formLogin = $form;
            $this->setTemplate('telaLogin');
            return;
        }
    }

    public function executeLoginInicial(sfWebRequest $request) {

        $form = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $login = $form->getValue('login');
            if(strpos($login, '@') !== false){
                
                $u = Doctrine::getTable('Usuarios')->buscarPorEmail($login);
                $senha = Util::gerarSenha($form->getValue('senha'), $u->getLogin());
            }else{
                $senha = Util::gerarSenha($form->getValue('senha'), $login);
            }

            $objUsuario = Doctrine::getTable('Usuarios')->login($login, $senha);

            if ($request->getParameter('lembrar') == 1) {
                //1296000 = 15 dias
                sfContext::getInstance()->getResponse()->setCookie('cooLogin', $form->getValue('login'), time() + 1296000, '/');
                sfContext::getInstance()->getResponse()->setCookie('cooSenha', md5($form->getValue('senha')), time() + 1296000, '/');
            }

            if ($objUsuario) {
                UsuarioLogado::getInstancia()->logar($objUsuario);
                $this->redirect('perfil/index');
                return;
            } else {
                $form->getErrorSchema()->addError(new sfValidatorError($form->getValidator('login'), "Senha não corresponde ao login informado. Por favor, tente novamente"));
                $this->formLogin = $form;
                $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);


                $this->setTemplate('telaLogin');
                return;
            }
        } else {
            $this->formLogin = $form;
            $this->setTemplate('telaLogin');
            return;
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $arrayValores = $request->getParameter($form->getName());

        $arrayValores['nome'] = Util::getHtmlPurificado($arrayValores['nome']);

        $form->bind($arrayValores, $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $usuarios = $form->save();
            if ($usuarios) {

                if ($request->getParameter('lembrar') == 1) {
                    //1296000 = 15 dias
                    sfContext::getInstance()->getResponse()->setCookie('cooLogin', $form->getValue('login'), time() + 1296000, '/');
                    sfContext::getInstance()->getResponse()->setCookie('cooSenha', md5($form->getValue('senha')), time() + 1296000, '/');
                }

                $logSistema = new LogsSistema();
                $logSistema->setIdUsuario($usuarios->getIdUsuario());
                $logSistema->setTipoLog(LogsSistema::CADASTRO_SISTEMA);
                $logSistema->setDescricao(LogsSistema::getDescricaoPeloTipo(LogsSistema::CADASTRO_SISTEMA));
                $logSistema->setDataPublicacao(date('Y-m-d H:i:s'));
                $logSistema->setParametros("IP:" . $_SERVER['REMOTE_ADDR']);
                $logSistema->save();


                UsuarioLogado::getInstancia()->logar($usuarios);

                $participacao = new ParticipantesConjuntos();
                $participacao->solicitarParticipacao(0);
                Doctrine::getTable("ParticipantesConjuntos")->solicitarParticipacao($participacao, false);

                $this->redirect('perfil/index');
                return;
            }
        } else {
            $this->setTemplate("cadastro");
        }
    }

}
