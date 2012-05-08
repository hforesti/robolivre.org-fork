<?php
$valoresInciais = $formUsuario->getDefaults();
$taintedValues = $formUsuario->getTaintedValues();
if(!empty($taintedValues)){
    $valoresInciais = array_merge($valoresInciais, $taintedValues);
}

$erros = $formUsuario->getErrorSchema()->getErrors();

?>

<div class="row">

    <?php include_partial('sidebarUsuarioLogado') ?>


    <hr class="only-mobile">

    <div class="span10">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for('perfil/index') ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('perfil/exibir?u=' . UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><?php echo UsuarioLogado::getInstancia()->getNome(); ?></a> <span class="divider">/</span>
            </li>
            <li class="active">
                    Configurações
            </li>
        </ul>

        <form id="form-editar-conf" class="form-horizontal" method="post" action="<?php echo url_for("perfil/gravarConfiguracoes") ?>">

            <ul class="nav nav-tabs" id="tabs-home">
                <li class="active">
                    <a href="#notific" data-toggle="tab"><i class="icon-inbox icon-gray"></i> Notificações por email</a>
                </li>
                <li>
                    <a href="#senha" data-toggle="tab"><i class="icon-asterisk icon-gray"></i> Alterar Senha</a>
                </li>
                <li>
                    <a href="#nomecomp" data-toggle="tab"><i class="icon-user icon-gray"></i> Nome e sobrenome</a>
                </li>
            </ul>

            <div class="tab-content">
                <fieldset class="tab-pane active fade in" id="notific">
                    <div class="control-group" id="turnEmailOff">
                        <label class="control-label">Desligar tudo</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" id="optionTurnEmailOff" value="optionOffAll">
                                <strong>Parar de receber qualquer tipo de notificação por email</strong>
                            </label>
                            <span class="help-inline">Se está recebendo muitas mensagens da nossa rede, marque esta opção para desligar todas as notificações por email.</span> 
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">Amigos</label>
                            <?php $parametrosGrupo = ConfiguracoesEmailUsario::getParametrosDoGrupo(ConfiguracoesEmailUsario::GRUPO_AMIGO, $valoresInciais['parametros_email'])?>
                            <?php foreach(ConfiguracoesEmailUsario::getChavesConfiguracoesAmigo() as $chave){ ?>
                            <?php $widget = $formUsuario->getWidget("amigo_$chave")?>
                            <div class="controls">
                                <label class="checkbox">
                                    <?php echo $widget->render($formUsuario->getName() ."[amigo_$chave]",  strstr($parametrosGrupo, $chave)) ?>
                                    <?php echo $widget->getLabel() ?>
                                </label>
                            </div>
                            <?php  } ?>
                        </div>
                        <hr>

                        <div class="control-group">
                            <label class="control-label">Conteúdos</label>
                            <?php $parametrosGrupo = ConfiguracoesEmailUsario::getParametrosDoGrupo(ConfiguracoesEmailUsario::GRUPO_CONTEUDO, $valoresInciais['parametros_email'])?>
                            <?php foreach(ConfiguracoesEmailUsario::getChavesConfiguracoesConteudo() as $chave){ ?>
                            <?php $widget = $formUsuario->getWidget("conteudo_$chave")?>
                            <div class="controls">
                                <label class="checkbox">
                                    <?php echo $widget->render($formUsuario->getName() ."[conteudo_$chave]",  strstr($parametrosGrupo, $chave)) ?>
                                    <?php echo $widget->getLabel() ?>
                                </label>
                            </div>
                            <?php  } ?>
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">Informativo Robô livre</label>
                            <?php $parametrosGrupo = ConfiguracoesEmailUsario::getParametrosDoGrupo(ConfiguracoesEmailUsario::GRUPO_INFORMATIVO, $valoresInciais['parametros_email'])?>
                            <?php foreach(ConfiguracoesEmailUsario::getChavesConfiguracoesInformativo() as $chave){ ?>
                            <?php $widget = $formUsuario->getWidget("informativo_$chave")?>
                            <div class="controls">
                                <label class="checkbox">
                                    <?php echo $widget->render($formUsuario->getName() ."[informativo_$chave]",  strstr($parametrosGrupo, $chave)) ?>
                                    <?php echo $widget->getLabel() ?>
                                </label>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="tab-pane fade in" id="senha">
                    
                    <div id="div-nova-senha" class="control-group">
                        <label class="control-label" for="pass">Nova senha</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('senhaNova')->render($formUsuario->getName() . "[senhaNova]", null , array('id' => 'pass-new', 'placeholder' => "Nova senha")); ?>                            
                            <span id="help-forca-senha" class="help-inline">informe a nova senha</span>
                        </div>
                    </div>
                    <?php 
                    $class = "";
                    $descricao = "";
                    if (isset($erros['confirmacaoSenhaNova'])) {
                        $class = "error";
                        $descricao = $erros['confirmacaoSenhaNova'];
                    }
                    ?>
                    <div id="div-confirmacao-senha" class="control-group <?php echo $class ?>">
                        <label class="control-label" for="pass-conf">Confirme a nova senha</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('confirmacaoSenhaNova')->render($formUsuario->getName() . "[confirmacaoSenhaNova]", null , array('id' => 'pass-conf', 'placeholder' => "Repetir a senha")); ?>                            
                            <span id="help-confirmacao-senha" class="help-inline"><?php echo $descricao ?></span>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="tab-pane fade in" id="nomecomp">
                    <?php 
                    $class = "";
                    $descricao = "";
                    if (isset($erros['nome'])) {
                        $class = "error";
                        $descricao = $erros['nome'];
                    }
                    ?>
                    
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="pass">Nome e sobrenome</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('nome')->render($formUsuario->getName() . "[nome]", $valoresInciais['nome'] , array('class'=>"span5",'id' => 'realname', 'placeholder' => "Informe seu nome Completo")); ?>                            
                            <span class="help-inline"><?php echo $descricao ?></span>
                        </div>
                    </div>
                </fieldset>

            </div><!-- /tab-content -->

            <hr>
            
            <?php 
            $class = "";
            $descricao = "Para alterar informe a sua senha atual";
            if (isset($erros['senha'])) {
                $class = "error";
                $descricao = $erros['senha'];
            }
            ?>
            <div class="control-group <?php echo $class ?>">
                <label class="control-label" for="pass">Senha atual</label>
                <div class="controls">
                    <?php echo $formUsuario->getWidget('senha')->render($formUsuario->getName() . "[senha]", null , array('id' => 'pass', 'placeholder' => "Sua senha")); ?>                            
                    <span class="help-inline"><?php echo $descricao ?></span>
                </div>
            </div>

            </fieldset>
            <div class="form-actions">
                <?php echo $formUsuario->renderHiddenFields() ?>
                <button type="submit" class="btn btn-primary" id="update-info">Salvar alterações</button>
            </div>
            </fieldset>

        </form>


    </div><!-- /miolo -->


</div><!-- /row -->
<script type="text/javascript">
    //<![CDATA[
    
    function atualizaForcaSenha(){

        var forca = getForcaSenha(document.getElementById('pass-new'),document.getElementById('help-forca-senha'));
        if(forca == 1){
            document.getElementById('div-nova-senha').className = "control-group";
            document.getElementById('help-forca-senha').innerHTML = "informe a nova senha";
        }else if(forca){
            document.getElementById('div-nova-senha').className = "control-group error";
        }else{
            document.getElementById('div-nova-senha').className = "control-group success";
        }
        
        validaConfirmacaoSenhaEmail();
    }
    
    function verificaFormValidado(){
        if($("#form-editar-conf .control-group").hasClass('error') || $("#form-editar-conf .control-group").hasClass('warning')){
            return false;
        }
    }
    
    function validaConfirmacaoSenhaEmail(){

        var isValido = true;
       
        if(document.getElementById('pass-new').value == document.getElementById('pass-conf').value){
            document.getElementById('div-confirmacao-senha').className = "control-group success";
            document.getElementById('help-confirmacao-senha').innerHTML = "";
        }else{
            document.getElementById('div-confirmacao-senha').className = "control-group error";
            document.getElementById('help-confirmacao-senha').innerHTML = "Repita a mesma senha acima!";
            
            isValido = false;
        }
        
        return isValido;
    }
    
    $('#pass-new').keyup(function() {
       atualizaForcaSenha();
    });
    $('#pass-conf').keyup(function() {
       validaConfirmacaoSenhaEmail();
    });
    
     $("#form-editar-conf").submit(function() {
        return validaConfirmacaoSenhaEmail() && verificaFormValidado();
    }); 

    //]]>   
</script>