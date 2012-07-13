<?php

/**
 * usuario actions.
 *
 * @package    robolivre
 * @subpackage usuario
 * * @author     Max Guenes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->usuarioss = Doctrine_Core::getTable('Usuarios')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->usuarios = Doctrine_Core::getTable('Usuarios')->find(array($request->getParameter('id_usuario')));
        $this->forward404Unless($this->usuarios);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new UsuariosForm(null, null, null, UsuariosForm::SIMPLES);
    }

    public function executeMigrar(sfWebRequest $request) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Url'));
        $this->cont = 0;
        $usuarios = Doctrine::getTable('Usuarios')->usuariosSemSenha();
        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                if ($usuario) {
                    var_dump($usuario->getIdUsuario());die;
                    $this->cont++;
                    $link = url_for("perfil/novaSenha?token=" . $usuario->getToken() . "&u=" . $usuario->getIdUsuario(), true);

                    Util::enviarEmail("[robolivre.org] Por favor, migre seu cadastro para a nova rede", Util::getTextoEmailMigracao($link, $usuario->getNome()), $usuario->getEmail());

                    $this->mensagem = "$link <strong>Tudo bem!</strong> Um link para recuperar sua senha foi enviado para o seu email <em>" . $usuario->getEmail() . "</em>.";
                }
            }
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UsuariosForm(null, null, null, $request->getParameter('tp_frm'));

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($request->getParameter('id_usuario'))), sprintf('Object usuarios does not exist (%s).', $request->getParameter('id_usuario')));
        $this->form = new UsuariosForm($usuarios);
    }

    public function executeTesteajax(sfWebRequest $request) {
        $this->teste = "testeFeito";
        $this->setTemplate('_form');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($request->getParameter('id_usuario'))), sprintf('Object usuarios does not exist (%s).', $request->getParameter('id_usuario')));
        $this->form = new UsuariosForm($usuarios);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($usuarios = Doctrine_Core::getTable('Usuarios')->find(array($request->getParameter('id_usuario'))), sprintf('Object usuarios does not exist (%s).', $request->getParameter('id_usuario')));
        $usuarios->delete();

        $this->redirect('usuario/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $usuarios = $form->save();

            $this->redirect('usuario/edit?id_usuario=' . $usuarios->getIdUsuario());
        }
    }

}
