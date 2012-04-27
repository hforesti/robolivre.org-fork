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

    
    
    public function execute($request) {
        if (UsuarioLogado::getInstancia()->isLogado()) {
            $this->redirect('perfil/index');
            return;
        }
        parent::execute($request);
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
        $form->validaDadosIniciais();
        $this->form = $form;
    }

    public function executeLogin(sfWebRequest $request) {

        $form = new UsuariosForm(null, null, null, UsuariosForm::LOGIN);

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            
            $login = $form->getValue('login');
            $senha = md5($form->getValue('senha'));

            $objUsuario = Doctrine::getTable('Usuarios')->login($login, $senha);
            
            if ($request->getParameter('lembrar') == 1) {
                //1296000 = 15 dias
                sfContext::getInstance()->getResponse()->setCookie('cooLogin', $form->getValue('login'),  time() + 1296000, '/');
                sfContext::getInstance()->getResponse()->setCookie('cooSenha', md5($form->getValue('senha')),  time() + 1296000, '/');
            }
            
            if ($objUsuario) {
                UsuarioLogado::getInstancia()->logar($objUsuario);
                $this->redirect('perfil/index');
                return;
            } else {
                $form->getErrorSchema()->addError(new sfValidatorError($form->getValidator('login'),"Senha não corresponde ao login informado. Por favor, tente novamente"));
                $this->formLogin = $form;
                $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
                
                        
                $this->setTemplate('index');
                return;
            }
        }else{
            $this->formLogin = $form;
            $this->formNovoUsuario = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
            $this->setTemplate('index');
            return;
        }

        
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind(array_merge($request->getParameter($form->getName()), array('data_criacao_perfil'=>date('Y-m-d H:i:s'))), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $usuarios = $form->save();
            if ($usuarios) {
                
                if ($request->getParameter('lembrar') == 1) {
                    //1296000 = 15 dias
                    sfContext::getInstance()->getResponse()->setCookie('cooLogin', $form->getValue('login'),  time() + 1296000, '/');
                    sfContext::getInstance()->getResponse()->setCookie('cooSenha', md5($form->getValue('senha')),  time() + 1296000, '/');
                }

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
