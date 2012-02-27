<?php
$erros = $form->getErrorSchema()->getErrors();
$valoresInciais = $form->getTaintedValues();
?>
<form id="cadastro-form" class="form-horizontal" action="<?php echo url_for('inicial/create'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>


    <h1>Criar uma conta <small>último passo</small></h1>


    <fieldset>
        
        <?php
        $class = "success";
        $descricao = "Bonito nome!";
        if (isset($erros['nome'])) {
            if($erros['nome']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['nome'];
            }
        }
        ?>
        <div class="control-group <?php echo $class ?>">
            <label class="control-label" for="nome">Nome e Sobrenome</label>
            <div class="controls">
                <?php echo $form->getWidget('nome')->render($form->getName() . "[nome]", null, array('id' => 'nome', 'placeholder' => "Nome e Sobrenome", 'class' => 'span5', 'value' => $valoresInciais['nome'])); ?>
                <?php if ($descricao != "") { ?>
                    <span class="help-inline"><?php echo $descricao ?></span>
                <?php } ?>
            </div>
        </div>


        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['login'])) {
            if($erros['login']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['login'];
            }
        }
        ?>
        <div class="control-group <?php echo $class ?>">
            <label class="control-label" for="username">Nome de usuário</label>
            <div class="controls">
                <?php echo $form->getWidget('login')->render($form->getName() . "[login]", null, array('id' => 'username', 'placeholder' => "Nome de usuário", 'value' => $valoresInciais['login'])); ?>
                <?php if ($descricao != "") { ?>
                    <span class="help-inline"><?php echo $descricao ?></span>
                <?php } ?>
            </div>
        </div>
        
        
        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['email'])) {
            if($erros['email']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
            $class = "warning";
            $descricao = $erros['email'];
            }
        }
        ?>
        <div class="control-group <?php echo $class ?>">
            <label class="control-label" for="email">Seu e-mail</label>
            <div class="controls">
                <?php echo $form->getWidget('email')->render($form->getName() . "[email]", null, array('id' => 'email', 'placeholder' => "E-mail", 'value' => $valoresInciais['email'])); ?>
                <?php if ($descricao != "") { ?>
                <span class="help-inline"><?php echo $descricao ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email-conf">Confirmar seu e-mail</label>
            <div class="controls">
                <input id="email-conf" type="email" placeholder="Repetir e-mail" value="" />
            </div>
        </div>
        
        
        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['senha'])) {
            if($erros['senha']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['senha'];
            }
        }
        ?>
        <div class="control-group <?php echo $class ?>">
            <label class="control-label" for="pass">Senha</label>
            <div class="controls">
                <?php echo $form->getWidget('senha')->render($form->getName() . "[senha]", null, array('id' => 'pass', 'placeholder' => "Senha")); ?>
                <?php if ($descricao != "") { ?>
                <span class="help-inline"><?php echo $descricao ?></span>
                <?php } ?>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="pass-conf">Confirme a senha</label>
            <div class="controls">
                <input id="pass-conf" type="password" placeholder="Repetir senha" />
            </div>
        </div>
        
        <?php echo $form->renderHiddenFields() ?>
        <div class="control-group">
            <label class="control-label" for="optionsCheckbox">Lembrar dados</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" id="optionsCheckbox" value="option1">
                    Não estou em um computador público e quero me manter conectado
                </label>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <textarea class="input-xlarge" id="textarea" rows="5" readonly="readonly">
                    Ao clicar no botão, você concordará com os termos abaixo:
                    ----------------------------------------------------------------------------------------
                    Estes Termos de Serviço ("Termos") regem seu acesso e uso dos serviços e 
                </textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Concluir Cadastro</button>
            <a href="<?php echo url_for('inicial/index') ?>" class="btn">Cancelar</a>

            <p class="help-block"><strong>Nota:</strong> Outros usuários poderão encontrá-lo pelo nome, nome de usuário ou e-mail. Seu e-mail não será exibido publicamente. Você pode alterar suas configurações de privacidade a qualquer momento.</p>

        </div>

    </fieldset>    
</form>
