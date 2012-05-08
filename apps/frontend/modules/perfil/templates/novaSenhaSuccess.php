<div class="row">

    <hr class="only-mobile">

    <div class="span8 offset2">

        <div class="page-header">
            <h1>Redefinir a sua senha</h1>
        </div>
        <?php if (!$resultado) { ?>
        <form id="login-form-standalone" method="post" action="<?php echo url_for("perfil/processarNovaSenha"); ?>" class="form-horizontal">

                <fieldset>
                    <div id="div-nova-senha" class="control-group">
                        <label class="control-label" for="login-pass"><strong>Nova</strong> senha</label>
                        <div class="controls">
                            <?php echo $formSenha->getWidget('senhaNova')->render($formSenha->getName() . "[senhaNova]", null , array('class'=>"span4",'id' => 'login-pass', 'tabindex'=>"1")); ?>                            
                            <div id="help-forca-senha" class="help-block">Pelo menos 6 caracteres</div>
                        </div>
                    </div>

                    <div id="div-confirmacao-senha" class="control-group">
                        <label class="control-label" for="login-pass-confirm">Confirmar nova senha</label>
                        <div class="controls">
                            <?php echo $formSenha->getWidget('confirmacaoSenhaNova')->render($formSenha->getName() . "[confirmacaoSenhaNova]", null , array('class'=>"span4",'id' => 'login-pass-confirm', 'placeholder' => "Repita a nova senha para confirmar",'tabindex'=>"2")); ?>                            
                            <div id="help-confirmacao-senha" class="help-block"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <?php echo $formSenha->renderHiddenFields() ?>
                        <input type="hidden" name="token" value="<?php echo $token ?>" tabindex="3" />
                        <input type="hidden" name="u"  value="<?php echo $id ?>" tabindex="3" />
                        <input value="Redefinir senha" type="submit" class="btn btn-primary btn-large" tabindex="3" />
                    </div>

                </fieldset>

            </form>
        <?php } else { ?>
            <p class="alert alert-success">Senha redefinida com sucesso pelos nossos robôs.</p>
            <div class="well">
                <a href="<?php echo url_for('perfil/index') ?>" class="btn btn-primary">Entrar</a> ou <a href="<?php echo url_for('inicial/index') ?>" class="btn">Ir para o início</a>
            </div>
        <?php } ?>


    </div><!-- /miolo -->

</div><!-- /row -->

<script type="text/javascript">
    //<![CDATA[
    
    function atualizaForcaSenha(){
        try{
        var forca = getForcaSenha(document.getElementById('login-pass'),document.getElementById('help-forca-senha'));
        if(forca == 1){
            document.getElementById('div-nova-senha').className = "control-group";
            document.getElementById('help-forca-senha').innerHTML = "Pelo menos 6 caracteres";
        }else if(forca){
            document.getElementById('div-nova-senha').className = "control-group error";
        }else{
            document.getElementById('div-nova-senha').className = "control-group success";
        }
        
        validaConfirmacaoSenhaEmail();
        }catch(e){alert(e);}
    }
    
    function verificaFormValidado(){
        if($("#login-form-standalone .control-group").hasClass('error') || $("#login-form-standalone .control-group").hasClass('warning')){
            return false;
        }
    }
    
    function validaConfirmacaoSenhaEmail(){

        var isValido = true;
        if(document.getElementById('login-pass').value.length==0){
            document.getElementById('div-confirmacao-senha').className = "control-group";
            document.getElementById('help-confirmacao-senha').innerHTML = "Pelo menos 6 caracteres";
            isValido = false;
        }else if(document.getElementById('login-pass').value == document.getElementById('login-pass-confirm').value){
            document.getElementById('div-confirmacao-senha').className = "control-group success";
            document.getElementById('help-confirmacao-senha').innerHTML = "";
        }else{
            document.getElementById('div-confirmacao-senha').className = "control-group error";
            document.getElementById('help-confirmacao-senha').innerHTML = "Repita a mesma senha acima!";
            
            isValido = false;
        }
        
        return isValido;
    }
    
    $('#login-pass').keyup(function() {
       atualizaForcaSenha();
    });
    $('#login-pass-confirm').keyup(function() {
       validaConfirmacaoSenhaEmail();
    });
    
     $("#login-form-standalone").submit(function() {
        return validaConfirmacaoSenhaEmail() && verificaFormValidado();
    }); 

    //]]>   
</script>