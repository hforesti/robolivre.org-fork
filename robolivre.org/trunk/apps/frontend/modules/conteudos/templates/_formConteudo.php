<?php 
$valoresInciais = $form->getTaintedValues();

if(!isset($conteudo)){
    $evento = 'conteudos/gravar';
}else{
    $nomeConteudo = $conteudo->getNome();
    $evento = 'conteudos/gravarEdicao';
}
?>
<?php // Util::pre($valoresInciais) ?>

<form id="form-criar-conteudo" action="<?php echo url_for($evento); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <fieldset>
                <div class="control-group">
                    <div class="controls">
                    <?php
                    if(!isset($nomeConteudo)){
                        $nomeConteudo = array_key_exists('nome',$valoresInciais)?$valoresInciais['nome']:"";
                    }
                    ?>
                    <?php echo $form->getWidget('nome')->render($form->getName() . "[nome]", $nomeConteudo, array('id' => 'nome', 'placeholder' => "Título do contúdo", 'class' => 'span7')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <?php  echo $form->getWidget('descricao')->render($form->getName() . "[descricao]",array_key_exists('descricao',$valoresInciais)?$valoresInciais['descicao']:"", array('id' => 'textarea','rows' => 9, 'placeholder' => "O que você tem para compartilhar?", 'class' => 'span7 wysiwyg')); ?>
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

                                    <div class="span3">
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox1" value="option1"> Robótica Definições e História - Robô na Ficção
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox2" value="option2"> Robótica Classificação dos Robôs
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox3" value="option3"> Controle de Robôs - Protocolos de comunicação
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox4" value="option3"> Design - Levantamento de requisitos e Funcionalidades
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox5" value="option3"> Eletrônica Componentes eletrônicos
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox6" value="option3"> Eletrônica Soldagem
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox7" value="option3"> Arduino
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox8" value="option3"> Programação Logo Turtle, Schetch, Arduino
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox9" value="option3"> Programação IDE Arduino
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox10" value="option1"> Desenho Técnico - Cads, Programas de geometria
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox11" value="option2"> Mecânica - Materiais e Processos de fabricação
                                        </label>
                                    </div>
                                    <div class="span3 offset1">
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox12" value="option3"> Usinagem de Nylon - Corte, Furo, Rosca
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox14" value="option3"> Sensores magnéticos (Red Switch)
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox15" value="option3"> Sensores Infra Vermelho
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox16" value="option3"> Motores , Caixa de Redução
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox17" value="option3"> Motores Contínuos
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox18" value="option3"> Ponte H - com relés - com transistores, com chips
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox19" value="option3"> Encoder
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox20" value="option3"> Servo Motores
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox21" value="option3"> Motores de Passo
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox22" value="option3"> Motores Brush Less
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="inlineCheckbox23" value="option3"> Transmissão de Dados
                                        </label>
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
                                <img src="<?php echo image_path("/assets/img/rl/170.gif"); ?>" alt="140" id="thumb" class="thumbnail" />
                                <input type="hidden" value="" id="imagem_selecionada" name="imagem_selecionada">
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
                    <hr>
                    <div class="control-group">
                        <label class="control-label" for="fileInput2">Documentos</label>
                        <div class="controls">

                            <div id="file-uploader">       
                                <noscript>          
                                <input class="input-file" id="fileInput2" type="file">
                                </noscript>         
                            </div>

                            <p class="help-block">Você pode anexar arquivos a este conteúdo. (Ex.: PDFs, Apresentações, Manuais).</p>
                        </div>
                    </div>
                    <hr>
                    <div class="control-group">
                        <label class="control-label" for="optionsCheckbox">Notificações</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $form->getWidget('enviar_email_criador')->render($form->getName() . "[enviar_email_criador]", array_key_exists('enviar_email_criador',$valoresInciais)?$valoresInciais['enviar_email_criador']:"", array('id' => 'optionsCheckbox','value' => 'on','checked'=>'checked')); ?>
                                Receber e-mail quando um novo conteúdo relacionado a este for criado ou quando este for modificado por seus amigos
                            </label>
                        </div>
                    </div>
                    <?php echo $form->renderHiddenFields() ?>
                    <input type="hidden" id="tags" name="tags">
                </fieldset>          


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">Publicar</button>
                    <!--             <button type="submit" class="btn btn-primary btn-large">Atualizar conteúdo</button> -->
                </div>
            </fieldset>

        </form>
<script src="<?php echo javascript_path("/assets/js/autoSuggestv14/jquery.autoSuggest.minified.js") ?>"></script>
<script type="text/javascript">
        
        var carregar = [
        <?php 
        if(isset($tags)){
        foreach(array_keys($tags) as $valueTag){ ?>
                {value: "<?php echo $valueTag ?>", name: "<?php echo $tags[$valueTag]->getNomeConteudo() ?>"},
        <?php }}?>
        ];
    
        
	//autosuggest tags data
        $("#input-marcadores").autoSuggest("<?php echo url_for('ajax/ajaxAutoSuggestConteudo'); ?>", 
        {
            minChars: 2, 
            preFill:carregar,
            matchCase: false,
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