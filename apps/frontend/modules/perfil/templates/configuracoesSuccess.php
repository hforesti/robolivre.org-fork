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

        <form id="form-editar-conf" class="form-horizontal" action="#">

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
                            
                            <?php // foreach(){ ?>
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" id="optionsCheckbox1" value="option1" checked="checked">
                                    Receber email quando alguém lhe adicionar como amigo
                                </label>
                            </div>
                            <?php // } ?>
                        </div>
                        <hr>

                        <div class="control-group">
                            <label class="control-label">Conteúdos</label>
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" id="optionsCheckbox2" value="option2" checked="checked">
                                    Receber email quando alguém lhe convidar para colaborar com um conteúdo
                                </label> 
                            </div>
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">Informativo Robô livre</label>
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" id="optionsCheckbox4" value="option4" checked="checked">
                                    Receber nossa super newsletter com super novidades da rede e dos nossos super projetos :-)
                                </label> 
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="tab-pane fade in" id="senha">

                    <div class="control-group">
                        <label class="control-label" for="pass">Nova senha</label>
                        <div class="controls">
                            <input id="pass" type="password" placeholder="Nova senha" value="senha1234" />
                            <span class="help-inline">informe a nova senha</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pass-conf">Confirme a nova senha</label>
                        <div class="controls">
                            <input id="pass-conf" type="password" placeholder="Repetir a senha" />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="tab-pane fade in" id="nomecomp">
                    <div class="control-group">
                        <label class="control-label" for="pass">Nome e sobrenome</label>
                        <div class="controls">
                            <input type="text" class="span5" id="realname" placeholder="Informe seu nome Completo" value="Rodrigo Medeiros">
                        </div>
                    </div>
                </fieldset>

            </div><!-- /tab-content -->

            <hr>

            <div class="control-group">
                <label class="control-label" for="pass">Senha atual</label>
                <div class="controls">
                    <input id="pass" type="password" placeholder="Sua senha" value="" />
                    <span class="help-inline">Para alterar informe a sua senha atual</span>
                </div>
            </div>

            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" id="update-info">Salvar alterações</button>
            </div>
            </fieldset>

        </form>


    </div><!-- /miolo -->


</div><!-- /row -->