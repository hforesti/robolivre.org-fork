<?php
$valoresInciais = $formUsuario->getDefaults();
$taintedValues = $formUsuario->getTaintedValues();
if(!empty($taintedValues)){
    $valoresInciais = array_merge($valoresInciais, $taintedValues);
}

//Util::pre($valoresInciais);

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

                    <div class="control-group">
                        <label class="control-label" for="pass">Nova senha</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('senhaNova')->render($formUsuario->getName() . "[senhaNova]", null , array('id' => 'pass-new', 'placeholder' => "Nova senha")); ?>                            
                            <span class="help-inline">informe a nova senha</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pass-conf">Confirme a nova senha</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('confirmacaoSenhaNova')->render($formUsuario->getName() . "[confirmacaoSenhaNova]", null , array('id' => 'pass-conf', 'placeholder' => "Repetir a senha")); ?>                            
                        </div>
                    </div>
                </fieldset>

                <fieldset class="tab-pane fade in" id="nomecomp">
                    <div class="control-group">
                        <label class="control-label" for="pass">Nome e sobrenome</label>
                        <div class="controls">
                            <?php echo $formUsuario->getWidget('nome')->render($formUsuario->getName() . "[nome]", $valoresInciais['nome'] , array('class'=>"span5",'id' => 'realname', 'placeholder' => "Informe seu Nome e sobrenome")); ?>                            
                        </div>
                    </div>
                </fieldset>

            </div><!-- /tab-content -->

            <hr>

            <div class="control-group">
                <label class="control-label" for="pass">Senha atual</label>
                <div class="controls">
                    <?php echo $formUsuario->getWidget('senha')->render($formUsuario->getName() . "[senha]", null , array('id' => 'pass', 'placeholder' => "Sua senha")); ?>                            
                    <span class="help-inline">Para alterar informe a sua senha atual</span>
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