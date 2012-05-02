<div class="row">

    <hr class="only-mobile">

    <div class="span8 offset2">

        <div class="page-header">

            <a href="<?php echo url_for("inicial/cadastro"); ?>" class="btn btn-mini pull-right"><i class="icon-user icon-gray"></i> Novo por aqui? Crie uma conta!</a>

            <h1>Entrar</h1>
        </div>

        <form id="login-form-standalone" action="#" class="form-horizontal">

            <!-- modelo de alert com link para modal de esqueceu senha -->
            <?php if ($formLogin->hasErrors()) { ?>
                <div class="alert fade in">
                    <strong>Vixe!</strong> Os dados informados não conferem. <a data-toggle="modal" href="#modalEsqueci">Esqueceu sua senha</a>?
                </div>
            <?php } ?>  

            <div class="modal fade" id="modalEsqueci">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Recuperar Senha</h3>
                </div>
                <div class="modal-body">
                    <form id="esqueci-form" class="form-inline" action="#">
                        <div class="alert fade in">
                            <strong>Tudo bem!</strong> Um link para recuperar sua senha foi enviado para o seu email <em>rodrigo@robolivre.org</em>.
                        </div>

                        <input id="email-esqueci" type="email" placeholder="Seu endereço de e-mail ou nome de usuário" class="span4" />

                        <input value="Recuperar senha" type="submit" class="btn btn-primary" tabindex="4" />


                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Fechar</a>
                </div>
            </div>

            <fieldset>
                <?php include_partial('formLogin', array('form' => $formLogin)) ?>

            </fieldset>

        </form>


    </div><!-- /miolo -->

</div><!-- /row -->