<div class="row">

    <hr class="only-mobile">

    <div class="span8 offset2">

        <div class="page-header">

            <a href="<?php echo url_for("inicial/cadastro"); ?>" class="btn btn-mini pull-right"><i class="icon-user icon-gray"></i> Novo por aqui? Crie uma conta!</a>

            <h1>Entrar</h1>
        </div>

        
            <!-- modelo de alert com link para modal de esqueceu senha -->
            <?php if ($formLogin->hasErrors()) { ?>
                <div class="alert fade in">
                    <strong>Vixe!</strong> Os dados informados não conferem. <a data-toggle="modal" href="#modalEsqueci">Esqueceu sua senha</a>?
                </div>
            <?php } ?>  

            <?php include_partial('formLogin', array('form' => $formLogin,'ultimaPagina'=> $ultimaPagina)) ?>

            </fieldset>

        

    </div><!-- /miolo -->

</div><!-- /row -->
<div class="modal fade" id="modalEsqueci">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Recuperar Senha</h3>
    </div>
    <div class="modal-body">
        <form id="esqueci-form" method="post" class="form-inline" action="<?php echo url_for("inicial/esqueciSenha") ?>">

            <div id="alerta-esqueci-senha" class="alert fade in">

            </div>

            <input id="email-esqueci" name="email" type="email" placeholder="Seu endereço de e-mail" class="span4" />

            <input id="btn-recuperar-senha" value="Recuperar senha" type="submit" class="btn btn-primary" tabindex="4" />
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Fechar</a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#alerta-esqueci-senha").hide();
    });

    function getValue(id) {
        return document.getElementById(id).value;
    }

    $("#esqueci-form").submit(function(){
        try{

        $("#btn-recuperar-senha").append("<img src='<?php echo image_path('/assets/img/rl/loading.gif'); ?>' id='imagem-load' alt='Carregando'>");

        $.ajax({
            url: <?php echo "'" . url_for("ajax/ajaxEsqueciSenha") . "?email='+getValue('email-esqueci')" ?>,
            success: function(resposta){

                $("#imagem-load").remove();
                $("#alerta-esqueci-senha").show();

                if(resposta == "false"){
                    $("#alerta-esqueci-senha").html("O endereço de email <strong>"+getValue('email-esqueci')+"</strong> não está cadastrado no nosso site. Tente novamente.");
                }else{
                    $("#alerta-esqueci-senha").html(resposta);                        
                }
            }
        });
        }catch(e){
            alert(e);
        }
        return false;
    });
</script>