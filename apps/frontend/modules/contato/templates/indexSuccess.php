<div class="row">

    <div class="span4">
        <h6>Contato</h6>
        <ul class="nav nav-tabs nav-stacked">
            <li class="active"><a href="<?php echo url_for("contato/index"); ?>">Fale Conosco</a></li>
        </ul>
        <a href="<?php echo url_for("inicial/index"); ?>" class="btn"><i class="icon-chevron-left icon-gray"></i> Início</a>
    </div>


    <div class="span8">

        <div class="page-header">
            <h1>Fale Conosco</h1>
        </div>


        <?php if (isset($formContato)) { ?>
            <div class="alert alert-info">
                Está com alguma dúvida? Verificou se ela já foi respondida no <strong><a href="<?php echo url_for("ajuda/perguntas") ?>">nosso FAQ</a></strong>?
            </div>
            <?php
            $erros = $formContato->getErrorSchema()->getErrors();
            $valoresInciais = $formContato->getTaintedValues();
            
            $flagMostrarValEmail = true;
            if(isset($erros['nome']) || isset($erros['mensagem'])){
                $flagMostrarValEmail = false;
            }
            
            ?>


            <?php if (isset($erros) && !empty($erros)) { ?>
                <div class="alert alert-danger">
                    <?php if($erros['email'] == "Required."){ ?>
                    Os campos de mensagem, nome e email são necessários para o envio. Por favor, verifique os campos.
                    <?php }else { ?>
                    <?php echo $erros['email']; ?>
                    <?php }?>
                </div>
            <?php } ?>

            <p>Entre em contato com nossos robôs, quer dizer… com a nossa equipe :)</p>

            <form action="<?php echo url_for("contato/enviarEmailContato") ?>" class="form-horizontal">
                <fieldset>

                    <?php
                    $class = "";
                    if (isset($erros['mensagem'])) {
                        $class = "error";
                    }
                    ?>
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="mensagem">Mensagem</label>
                        <div class="controls">
                            <?php echo $formContato->getWidget('mensagem')->render($formContato->getName() . "[mensagem]", (isset($valoresInciais['mensagem']) ? $valoresInciais['mensagem'] : null), array('class' => "input-xlarge", 'id' => 'mensagem', 'rows' => 8)); ?>
                        </div>
                    </div>

                    <?php
                    $class = "";
                    if (isset($erros['nome'])) {
                        $class = "error";
                    }
                    ?>
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="nome">Seu Nome</label>
                        <div class="controls">
                            <?php echo $formContato->getWidget('nome')->render($formContato->getName() . "[nome]", (isset($valoresInciais['nome']) ? $valoresInciais['nome'] : null), array('class' => "input-xlarge", 'id' => 'nome')); ?>
                        </div>
                    </div>

                    <?php
                    $class = "";
                    if (isset($erros['email'])) {
                        $class = "error";
                    }
                    ?>
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="email">Seu E-mail</label>
                        <div class="controls">
                            <?php echo $formContato->getWidget('email')->render($formContato->getName() . "[email]", (isset($valoresInciais['email']) ? $valoresInciais['email'] : null), array('class' => "input-xlarge", 'id' => 'email')); ?>
                            <p class="help-block">Responderemos sua mensagem para este e-mail informado</p>
                        </div>
                    </div>

                    <?php
                    $class = "";
                    if (isset($erros['telefone'])) {
                        $class = "error";
                    }
                    ?>
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="telefone">Telefone</label>
                        <div class="controls">
                            <?php echo $formContato->getWidget('telefone')->render($formContato->getName() . "[telefone]", (isset($valoresInciais['telefone']) ? $valoresInciais['telefone'] : null), array('class' => "input-xlarge", 'id' => 'telefone')); ?>
                            <p class="help-block">Opcional</p>
                        </div>
                    </div>
                    <?php echo $formContato->renderHiddenFields() ?>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </fieldset>
            </form>
        <?php } else { //END if(isset($formContato))  ?>
            <div class="alert alert-success">
                Mensagem enviada com sucesso. Caso seja necessário, retornaremos em breve.
            </div>
        <?php } ?>

    </div>


</div><!-- /row -->