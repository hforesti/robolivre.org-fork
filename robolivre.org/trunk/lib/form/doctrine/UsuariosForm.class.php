<?php

/**
 * Usuarios form.
 *
 * @package    robolivre
 * @subpackage form
 * * @author     Max Guenes
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuariosForm extends BaseUsuariosForm {

    const COMPLETO = 0;
    const SIMPLES = 1;
    const SOMENTE_INFO_CADASTRO = 2;
    const SOMENTE_INFO = 3;
    const LOGIN = 4;

    public $tipoFormulario = 0;

    public function __construct($object = null, $options = array(), $CSRFSecret = null, $tipoFormulario = 0) {
        $this->setTipoFormulario($tipoFormulario);
        parent::__construct($object, $options, $CSRFSecret);
    }

    public function getTipoFormulario() {
        return $this->tipoFormulario;
    }

    public function setTipoFormulario($tipoFormulario) {
        $this->tipoFormulario = $tipoFormulario;
    }

    public function configure() {
        switch ($this->tipoFormulario) {


            case self::LOGIN:
                $this->setWidgets(array(
                    'id_usuario' => new sfWidgetFormInputHidden(),
                    'login' => new sfWidgetFormInputText(array(), array('id' => 'login', 'placeholder' => "e-mail ou usuário", 'tabindex' => "1")),
                    'senha' => new sfWidgetFormInputPassword(),
                    'tp_frm' => new sfWidgetFormInputHidden(array(), array('value' => $this->tipoFormulario))
                ));

                $this->setValidators(array(
                    'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
                    'login' => new sfValidatorString(array('max_length' => 45)),
                    'senha' => new sfValidatorString(array('max_length' => 100)),
                    'tp_frm' => new sfValidatorString(array('max_length' => 100))
                ));
                break;


            case self::SIMPLES:
                $this->setWidgets(array(
                    'id_usuario' => new sfWidgetFormInputHidden(),
                    'nome' => new sfWidgetFormInputText(),
                    'login' => new sfWidgetFormInputText(),
                    'email' => new sfWidgetFormInputText(),
                    'tp_frm' => new sfWidgetFormInputHidden(array(), array('value' => $this->tipoFormulario))
                ));

                $this->setValidators(array(
                    'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
                    'nome' => new sfValidatorString(array('max_length' => 255)),
                    'login' => new sfValidatorString(array('max_length' => 45)),
                    'email' => new sfValidatorEmail(array('max_length' => 100, 'required' => false)),
                    'tp_frm' => new sfValidatorString(array('max_length' => 100))
                ));
                break;


            case self::SOMENTE_INFO_CADASTRO:
                $this->setWidgets(array(
                    'id_usuario' => new sfWidgetFormInputHidden(),
                    'nome' => new sfWidgetFormInputText(),
                    'login' => new sfWidgetFormInputText(),
                    'email' => new sfWidgetFormInputText(),
                    'senha' => new sfWidgetFormInputPassword(),
                    'confirmacao_senha' => new sfWidgetFormInputPassword(),
                    'confirmacao_email' => new sfWidgetFormInputText(),
                    'tp_frm' => new sfWidgetFormInputHidden(array(), array('value' => $this->tipoFormulario))
                ));

                $this->setValidators(array(
                    'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
                    'nome' => new sfValidatorString(array('max_length' => 255)),
                    'login' => new sfValidatorString(array('max_length' => 45)),
                    'email' => new sfValidatorEmail(array('max_length' => 100)),
                    'senha' => new sfValidatorString(array('max_length' => 100)),
                    'confirmacao_senha' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
                    'confirmacao_email' => new sfValidatorEmail(array('max_length' => 100, 'required' => false)),
                    'tp_frm' => new sfValidatorString(array('max_length' => 100))
                ));
                break;
            case self::SOMENTE_INFO:
                $this->setWidgets(array(
                    'id_usuario' => $this->widgetSchema['id_usuario'],
                    'nivel_escolaridade' => $this->widgetSchema['nivel_escolaridade'],
                    //'nome' => $this->widgetSchema['nome'],
                    'email' => $this->widgetSchema['email'],
                    'endereco' => $this->widgetSchema['endereco'],
                    'habilidades' => $this->widgetSchema['habilidades'],
                    'curso' => $this->widgetSchema['curso'],
                    'site' => $this->widgetSchema['site'],
                    'site_empresa' => $this->widgetSchema['site_empresa'],
                    'data_nascimento' => $this->widgetSchema['data_nascimento'],
                    'sexo' => $this->widgetSchema['sexo'],
                    'sobre_mim' => $this->widgetSchema['sobre_mim'],
                    'aula_robolivre' => new sfWidgetFormInputCheckbox(array('value_attribute_value'=>1)),
                    'profissao' => $this->widgetSchema['profissao'],
                    'escola' => $this->widgetSchema['escola'],
                    'empresa' => $this->widgetSchema['empresa'],
                ));
                $this->setValidators(array(
                    'id_usuario' => $this->validatorSchema['id_usuario'],
                    'nivel_escolaridade' => $this->validatorSchema['nivel_escolaridade'],
                    //'nome' => $this->validatorSchema['nome'],
                    'email' => $this->validatorSchema['email'],
                    'endereco' => $this->validatorSchema['endereco'],
                    'habilidades' => $this->validatorSchema['habilidades'],
                    'curso' => $this->validatorSchema['curso'],
                    'site' => $this->validatorSchema['site'],
                    'site_empresa' => $this->validatorSchema['site_empresa'],
                    'data_nascimento' => $this->validatorSchema['data_nascimento'],
                    'sexo' => $this->validatorSchema['sexo'],
                    'sobre_mim' => $this->validatorSchema['sobre_mim'],
                    'aula_robolivre' => $this->validatorSchema['aula_robolivre'],
                    'profissao' => $this->validatorSchema['profissao'],
                    'escola' => $this->validatorSchema['escola'],
                    'empresa' => $this->validatorSchema['empresa'],
                ));
                break;
        }

        if ($this->getTipoFormulario() == self::LOGIN) {
            $this->widgetSchema->setNameFormat('usuariosLogin[%s]');
        } else {
            $this->widgetSchema->setNameFormat('usuarios[%s]');
        }

        if (isset($this->widgetSchema['nivel_escolaridade'])) {
            $this->widgetSchema['nivel_escolaridade'] = new sfWidgetFormSelect(array(
                        'choices' => NiveisEscolaridade::getDescricoes(),
                    ));
        }
        if (isset($this->widgetSchema['data_nascimento'])) {
            $anos = range(1900, date('Y'));
            //$meses = array(01=>'Janeiro',02=>'Fevereiro',03=>'Março',04=>'Abril',05=>'Maio');
            $this->widgetSchema['data_nascimento'] = new sfWidgetFormI18nDate(array(
                        'format' => '%day%/%month%/%year%',
                        'years' => array_reverse(array_combine($anos,$anos)),
                        'month_format' => 'name',
                        'culture' => "pt",
                        'empty_values'=> array('year' => 'Ano', 'month' => 'Mês', 'day' => 'Dia')
                    ));
        }
        if (isset($this->widgetSchema['sexo'])) {
            $this->widgetSchema['sexo'] = new sfWidgetFormSelect(array(
                        'choices' => Sexo::getDescricoes()
                    ));
        }
    }

    public function validaDadosIniciais() {

        if ($this->getTipoFormulario() != self::LOGIN) {

            $valores = $this->getTaintedValues();
            $email = $valores['email'];
            $login = $valores['login'];
            try {
                if (Doctrine::getTable('Usuarios')->jaExiste($login, $email)) {
                    return false;
                }
             } catch (ExceptionEmailELoginExistente $e){
                    $error = new sfValidatorError($this->validatorSchema['email'], 'Email já existe');
                    $this->errorSchema->addError($error, 'email');
                    
                    $error = new sfValidatorError($this->validatorSchema['login'], 'Login já existe');
                    $this->errorSchema->addError($error, 'login');
                    return false;
            } catch (ExceptionEmailExistente $e) {
                $error = new sfValidatorError($this->validatorSchema['email'], 'Email já existe');
                $this->errorSchema->addError($error, 'email');
                return false;
            } catch (ExceptionLoginExitente $e) {
                $error = new sfValidatorError($this->validatorSchema['login'], 'Login já existe');
                $this->errorSchema->addError($error, 'login');
                return false;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

    public function isValid() {
        $valido = true;
        if (!parent::isValid()){
            $valido = false;
        }
        
        if ($this->isNew()) {
            
            if ($this->getTipoFormulario() != self::LOGIN) {

                $valores = $this->getTaintedValues();
                $email = $valores['email'];
                $login = $valores['login'];
                
                try {
                    if (Doctrine::getTable('Usuarios')->jaExiste($login, $email)) {
                        $valido =  false;
                    }
                }  catch (ExceptionEmailELoginExistente $e){
                    $error = new sfValidatorError($this->validatorSchema['email'], 'Email já existe');
                    $this->errorSchema->addError($error, 'email');
                    
                    $error = new sfValidatorError($this->validatorSchema['login'], 'Login já existe');
                    $this->errorSchema->addError($error, 'login');
                    $valido = false;
                } catch (ExceptionEmailExistente $e) {
                    $error = new sfValidatorError($this->validatorSchema['email'], 'Email já existe');
                    $this->errorSchema->addError($error, 'email');
                    $valido = false;
                } catch (ExceptionLoginExitente $e) {
                    $error = new sfValidatorError($this->validatorSchema['login'], 'Login já existe');
                    $this->errorSchema->addError($error, 'login');
                    $valido = false;
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        }
        
        return $valido;
    }

}
