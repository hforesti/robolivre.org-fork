<?php
//var_dump($conteudo->getIdConteudo());
?>
<form id="form-criar-conteudo" class='tabs' action="<?php echo url_for('conteudo/' . Util::criaSlug($conteudo->getNome())) . '/gravarDocumento'; ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <!--             Modelo de campo com erro 

      <div class="control-group error">
        <div class="controls">
          <input type="text" class="span10" id="input01" placeholder="Título do documento" value="" tabindex="1">
          <span class="help-inline">Por favor informe um título para o documento</span>
        </div>
      </div>-->

    <div class="control-group" id="caixa">
        <div class="controls" id="adiciona_erro">
<!--            <input type="text" class="span10" id="input01" placeholder="Título do documento" value="" tabindex="1">-->
            <?php
            echo $form->getWidget('nome')->render('nome', '', array('id' => 'input01', 'placeholder' => "Título do documento", 'class' => 'span10', 'tabindex' => '1'));
            ?>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="fileInput2">Documento</label>
        <div class="controls">

            <div id="file-uploader-doc">       
                <noscript>          
                <input class="input-file" id="fileInput2" type="file">
                </noscript>         
            </div>
            <input type="hidden" id="documentos_selecionados" name="documentos_selecionados">

            <p class="help-block">Você pode anexar arquivo a este conteúdo. (Ex.: PDFs, Apresentações, Manuais).</p>
        </div>
    </div>
    <hr>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-large" tabindex="3">Adicionar documento</button>
    </div>

</form>
<script type="text/javascript">
    $("#input01").keyup(function(){
        if ($('#msg_erro')[0]){
            $("#caixa").removeClass('error');
            $("#msg_erro").remove();
        }
    });
    $("#input01").blur(function(){
        if(!$('#input01').val() && !($("#msg_erro")[0])){
            $("#caixa").addClass('error');
            $("#adiciona_erro").append('<span id="msg_erro" class="help-inline">Por favor informe um título para o documento</span>');
        }
        if (($('#msg_erro')[0]) && $('#input01').val()){
            $("#caixa").removeClass('error');
            $("#msg_erro").remove();
        }
    });
    $("#form-criar-conteudo").submit(function(){
        if(!$('#input01').val()){
            if ($('#msg_erro')[0]){ 
                $("#caixa").removeClass('error');
                $("#msg_erro").remove();
            }
            $("#caixa").addClass('error');
            $("#adiciona_erro").append('<span id="msg_erro" class="help-inline">Por favor informe um título para o documento</span>');
            return false;
        }
    });
</script>