<?php

/**
 * inicial actions.
 *
 * @package    robolivre
 * @subpackage inicial
 * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inicialActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        if (UsuarioLogado::getInstancia()->isLogado()) {
            $this->redirect('perfil/index');
            return;
        }
        $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
        $this->formLogin = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);
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
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $form->getWidget('senha')->setDefault("");
        $this->form = $form;
    }

    public function executeLogin(sfWebRequest $request) {

        $form = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $login = $form->getValue('login');
            $senha = md5($form->getValue('senha'));

            $objUsuario = Doctrine::getTable('Usuarios')->login($login, $senha);
            if ($objUsuario) {
                UsuarioLogado::getInstancia()->logar($objUsuario);
                $this->redirect('perfil/index');
                return;
            } else {
                die("não conectado!");
            }
        }

        $this->redirect('inicial/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $usuarios = $form->save();
            if ($usuarios) {

                $logSistema = new LogsSistema();
                $logSistema->setIdUsuario($usuarios->getIdUsuario());
                $logSistema->setTipoLog(LogsSistema::CADASTRO_SISTEMA);
                $logSistema->setDescricao(LogsSistema::getDescricaoPeloTipo(LogsSistema::CADASTRO_SISTEMA));
                $logSistema->setDataPublicacao(date('Y-m-d H:i:s'));
                $logSistema->setParametros("IP:" . $_SERVER['REMOTE_ADDR']);
                $logSistema->save();

                UsuarioLogado::getInstancia()->logar($usuarios);

                $this->redirect('perfil/index');
                return;
            }
        } else {
            $this->setTemplate("cadastro");
        }
    }

}
