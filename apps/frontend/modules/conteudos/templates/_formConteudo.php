<?php
$valoresInciais = $form->getDefaults();
$taintedValues = $form->getTaintedValues();
if (!empty($taintedValues)) {
    $valoresInciais = array_merge($valoresInciais, $taintedValues);
}

if (!isset($conteudo)) {
    $evento = 'conteudos/gravar';
    $imagem = Util::BASE_SITE . "/assets/img/rl/_conteudo-default-large.png";
    $nomeArquivoImagem = "";
    $idConteudo = "";
} else {
    $nomeConteudo = $conteudo->getNome();
    $idConteudo = $conteudo->getIdConteudo();
    $imagem = $conteudo->getImagemPerfil(Util::IMAGEM_GRANDE);
    $nomeArquivoImagem = $conteudo->getNomeArquivoImagemPerfil();

    $evento = 'conteudos/gravarEdicao';
}
?>

<form id="form-criar-conteudo" action="<?php echo url_for($evento); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <fieldset>
        <div class="control-group">
            <div id="nomeConteudo"></div> <!-- div de erro -->
            <div class="controls">
                <?php
                if (!isset($nomeConteudo)) {
                    $nomeConteudo = array_key_exists('nome', $valoresInciais) ? $valoresInciais['nome'] : "";
                }
                ?>
                <?php echo $form->getWidget('nome')->render($form->getName() . "[nome]", $nomeConteudo, array('id' => 'nome', 'placeholder' => "Nome do conteúdo", 'class' => 'span7')); ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?php echo $form->getWidget('descricao')->render($form->getName() . "[descricao]", $valoresInciais['descricao'], array('id' => 'textarea', 'rows' => 9, 'placeholder' => "O que você tem para compartilhar?", 'class' => 'span7 wysiwyg')); ?>
            </div>
        </div>

        <hr>

        <fieldset class="control-group">
            <h3>Classificar conteúdo</h3>

            <p class="alert alert-info"><i class="icon-info-sign icon-gray"></i> Classifique este conteúdo com Marcadores e relacione com nossos <strong>Temas de aula</strong>, assim ele ficará mais fácil de ser encontrado aqui no site.</p>



            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#1" data-toggle="tab"><i class="icon-tag icon-gray"></i> Marcadores</a></li>
                    <li><a href="#2" data-toggle="tab"><i class="icon-book icon-gray"></i> Temas de aula</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="1">

                        <div class="control-group">
                            <div class="controls">
                                <input type="text" id="input-marcadores" title="Ex.: Open Source, Gambiarra, UNIX etc">
                                <p class="help-block">Separados por vírgula. Ex.: Open Source, Gambiarra, UNIX</p>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade in" id="2">
                        <div class="controls row" id="temas-aula-list">
                            <?php $temas = Util::getCheckboxesTemaAula($idConteudo); ?>
                            <?php $qtdTemas = count($temas); ?>
                            <div class="span3">
                                <?php for ($i = 0; $i <= ($qtdTemas / 2) - 1; ++$i) { ?>
                                    <label class="checkbox">
                                        <?php echo $temas[$i]; ?>
                                    </label>
                                <?php } ?>

                            </div>
                            <div class="span3 offset1">
                                <?php for ($i = ($qtdTemas / 2); $i < $qtdTemas; ++$i) { ?>
                                    <label class="checkbox">
                                        <?php echo $temas[$i]; ?>
                                    </label>
                                <?php } ?>
                            </div>

                        </div><!-- controls row -->
                    </div><!-- tab-content -->


                </div><!-- tab-content -->

            </div><!-- tabbable -->

            <hr>

            <div class="control-group clearfix">
                <label class="control-label" for="fileInput">Imagem principal</label>


                <div class="row">
                    <div class="preview span2" id="img-preview">
                        <img src="<?php echo image_path($imagem); ?>" alt="140" id="thumb" class="thumbnail" />
                        <input type="hidden" value="<?php echo $nomeArquivoImagem; ?>" id="imagem_selecionada" name="imagem_selecionada">
                    </div>

                    <div class="span5">				
                        <div class="controls">				
                            <p class="help-block">Escolha uma imagem que represente este conteúdo</p>
                            <div id="file-uploader-img">       
                                <noscript>          
                                <input class="input-file" id="fileInput" type="file">
                                </noscript>         
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

            </div><!-- control-group -->
            <?php if (!isset($conteudo)) { ?>
                <hr>
                <div class="control-group">
                    <label class="control-label" for="fileInput2">Documentos</label>
                    <div class="controls">

                        <div id="file-uploader">       
                            <noscript>          
                            <input class="input-file" id="fileInput2" type="file">
                            </noscript>         
                        </div>
                        <input type="hidden" id="documentos_selecionados" name="documentos_selecionados">

                        <p class="help-block">Você pode anexar arquivos a este conteúdo. (Ex.: PDFs, Apresentações, Manuais).</p>
                    </div>
                </div>
            <?php } ?>
            <!--            <hr>
                        <div class="control-group">
                            <label class="control-label" for="optionsCheckbox">Notificações</label>
                            <div class="controls">
                                <label class="checkbox">
            <?php echo $form->getWidget('enviar_email_criador')->render($form->getName() . "[enviar_email_criador]", (!array_key_exists('enviar_email_criador', $valoresInciais) || $valoresInciais['enviar_email_criador'] == null) || (array_key_exists('enviar_email_criador', $valoresInciais) && $valoresInciais['enviar_email_criador'] == 1), array('id' => 'optionsCheckbox')); ?>
                                    Receber e-mail quando um novo conteúdo relacionado a este for criado ou quando este for modificado por seus amigos
                                </label>
                            </div>
                        </div>-->
            <?php echo $form->renderHiddenFields() ?>
            <input type="hidden" id="tags" name="tags">
        </fieldset>          


        <div class="form-actions">
            <?php if (!isset($conteudo)) { ?>
                <button type="submit" id="enviarForm" class="btn btn-primary btn-large">Publicar</button>
            <?php } else { ?>
                <button type="button" onclick="validaForm()" id="enviarForm" class="btn btn-primary btn-large">Atualizar conteúdo</button> 
            <?php } ?>
        </div>
    </fieldset>

</form>
<script src="<?php echo javascript_path("/assets/js/autoSuggestv14/jquery.autoSuggest.minified.js") ?>"></script>
<script type="text/javascript">
    function getValue(id) {
        return document.getElementById(id).value;
    }
        
    function validaForm() {        
        $("#alert-modalEditarConteudo").remove();
        
        if(getValue('nome') != ""){
            //            $("#enviarForm").prepend("<img src='<?php echo image_path('/assets/img/rl/loading.gif'); ?>' id='imagem-load' alt='Carregando'>");
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxValidaNomeConteudo") . "?editando={$nomeConteudo}&nome='+getValue('nome')" ?>,
                success: function(resposta){
                    $("#imagem-load").remove();
                    if(resposta == "ok"){
                        $("#form-criar-conteudo").submit();
                    }else{
                        var erros = resposta.split('<?php echo Util::SEPARADOR_PARAMETRO ?>');
                        idConjunto = erros[0].split('=')[1];
                        nomeConteudo = erros[1].split('=')[1];
                        slugConteudo = erros[2].split('=')[1];
                        url_conteudo = "<?php echo url_for('conteudo/'); ?>"+slugConteudo;
                        $("#nomeConteudo").append("<div id='alert-modalEditarConteudo' class='alert'><a href='"+url_conteudo+"'>"+nomeConteudo+"</a> é um conteúdo que já existe na nossa rede. <br>Deseja colaborar com ele? <a href='"+url_conteudo+"'><strong>Acesse agora</strong></a></div>");
                        $('html, body').animate({scrollTop:0}, 'slow');
                    }
                }
            });
        }else{ //END if getValue
            $("#nomeConteudo").append("<div id='alert-modalNovoConteudo' class='alert-error'>Digite um nome</div><br />");
            $('html, body').animate({scrollTop:0}, 'slow');
        }
        
    }
        
    var carregar = [
<?php
if (isset($tags)) {
    foreach (array_keys($tags) as $valueTag) {
        ?>
                        {value: "<?php echo $valueTag ?>", name: "<?php echo $tags[$valueTag]->getNomeConteudo() ?>"},
    <?php }
}
?>
    ];
    
        
    //autosuggest tags data
    $("#input-marcadores").autoSuggest("<?php echo url_for('ajax/ajaxAutoSuggestConteudo'); ?>", 
    {
        minChars: 2, 
        preFill:carregar,
        matchCase: false,
        resultsHighlight: true,
        selectedItemProp: "name",
        searchObjProps: "name",
        startText: "Ex.: Open Source, UNIX",
        emptyText: "Nenhuma sugestão encontrada",
        formatList: function(data, elem){
            var new_elem = elem.html("<i class='icon-tag icon-gray'></i>"+ data.name);
            return new_elem;
        }
    });
        
    $("#form-criar-conteudo").submit(function() {
        document.getElementById('tags').value = $('.as-values')[0].value;
    });

</script>