<div class="row">

    <div class="span4">
        <h6>Contato</h6>
        <ul class="nav nav-tabs nav-stacked">
            <li><a href="<?php echo url_for("contato/index"); ?>">Fale Conosco</a></li>
            <li class="active"><a href="<?php echo url_for("contato/reportarErro"); ?>">Reportar problema</a></li>
        </ul>
        <a href="<?php echo url_for("inicial/index"); ?>" class="btn"><i class="icon-chevron-left icon-gray"></i> Início</a>
    </div>


    <div class="span8">

        <div class="page-header">
            <h1>Reportar problema</h1>
        </div>

        <p>Encontrou algum problema? Decreva-o para nossa equipe e encaminharemos para o robô responsável :)</p>

        <?php if (isset($formContato)) { ?>
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

            <form action="<?php echo url_for("contato/enviarEmailReportarErro") ?>" class="form-horizontal">
                <fieldset>

                    <?php
                    $class = "";
                    if (isset($erros['mensagem'])) {
                        $class = "error";
                    }
                    ?>
                    <div class="control-group <?php echo $class ?>">
                        <label class="control-label" for="mensagem">Descreva o problema</label>
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
                            <p class="help-block">Caso seja necessário, responderemos sua mensagem para este e-mail informado</p>
                        </div>
                    </div>

                   
                    <?php echo $formContato->renderHiddenFields() ?>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Reportar agora</button>
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