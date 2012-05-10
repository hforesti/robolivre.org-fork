<?php

if(!isset($nome_conteudo)){
    $nomeAbaCompartilhar = "Compartilhar sobre este Conteudo";
}else{
    $nomeAbaCompartilhar = "Compartilhar sobre ".Util::getNomeReduzido($nome_conteudo, 45);
}

?>

<form id="form-status" action="<?php echo url_for('conteudos/publicar'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<ul class="nav nav-tabs">
  <li id="<?php echo Publicacoes::TIPO_NORMAL ?>" class="aba-publicacao active"><a href="#tab-status" data-toggle="tab"><?php echo $nomeAbaCompartilhar ?></a></li>
  <li id="<?php echo Publicacoes::TIPO_FOTO ?>" class="aba-publicacao"><a href="#tab-foto" data-toggle="tab" title="Adicionar Foto"><i class="icon-picture"></i></a></li>
  <li id="<?php echo Publicacoes::TIPO_VIDEO ?>" class="aba-publicacao"><a href="#tab-video" data-toggle="tab" title="Adicionar Vídeo"><i class="icon-film"></i></a></li>
  <li id="<?php echo Publicacoes::TIPO_LINK ?>" class="aba-publicacao"><a href="#tab-link" data-toggle="tab" title="Adicionar Link"><i class="icon-share-alt icon-gray-alt"></i></a></li>
</ul>

<fieldset id="fieldset-publicacao" class="tab-content ">
    	
	<div class="tab-pane active fade in" id="tab-status">
	</div>
	
	<div class="tab-pane fade in" id="tab-foto">
                <?php echo $form->getWidget('foto')->render($form->getName() . "[foto]", null, array('class'=>"input-file",'id' => 'fileInput')); ?>
	</div>
	
	<div class="tab-pane fade in" id="tab-video">
            <input type="text" name="url_video" id="url_video" class="span7" id="input02" placeholder="Endereço do vídeo do YouTube. Ex.: http://youtube.com/watch?v=Nem-KvCsODw">
	</div>
	
	<div class="tab-pane fade in" id="tab-link">
            <input type="text" name="url_link" id="url_link" class="span7" id="input03" placeholder="Endereço do link. Ex.: http://robolivre.org">
	</div>

</fieldset>

<fieldset>
        
        <?php echo $form->renderHiddenFields() ?>
        <?php if(isset ($id_conjunto)){ ?>
            <input type="hidden" name="id_conjunto" value="<?php echo $id_conjunto ?>" />
          <?php } ?>
        <?php if(isset ($nome_conteudo)){ ?>
            <input type="hidden" name="nome_conteudo" value="<?php echo $nome_conteudo ?>" />
          <?php } ?>
        <input type="hidden" id="tipo_conteudo_publicacao" name="tipo_conteudo_publicacao" value="normal" />
        <?php echo $form->getWidget('comentario')->render($form->getName() . "[comentario]", null, array('class'=>"input-xlarge span7",'id' => 'status','rows'=>"3", 'placeholder' => "O que você quer compartilhar sobre robôs?",'tabindex'=>"1")); ?>
	
</fieldset>

	<button type="submit" class="btn btn-primary" id="send" tabindex="2">Publicar</button>

		<select name="privacidade_publicacao" id="privacidade-status">
                    <option value="<?php echo Publicacoes::PRIVACIDADE_PUBLICA ?>">Público</option>
                    <option value="<?php echo Publicacoes::PRIVACIDADE_SOMENTE_AMIGOS ?>">Só para amigos</option>
                </select>

</form>

<script type="text/javascript">
    
    function adicionarErro(erro){
        var stringElementos = "<div id='error' class='alert alert-error fade in'><a class='close' data-dismiss='alert' href='#'>×</a><span>"+erro+"</span></div>";
        $("#error").remove();
        $("#fieldset-publicacao").prepend(stringElementos);            
    }
    
    
    $(".aba-publicacao").click( function(){$("#error").remove();});
    
    $('#form-status').submit(function() {
        var tipo = document.getElementById('tipo_conteudo_publicacao').value = $("#form-status .active").attr("id");

        if(tipo=="<?php echo Publicacoes::TIPO_NORMAL ?>" && document.getElementById('status').value == ""){
            adicionarErro("Digite uma publicação");
            $("#error").show();
            return false;
        }else if(tipo=="<?php echo Publicacoes::TIPO_LINK ?>" && document.getElementById('url_link').value == ""){
            adicionarErro("Digite o link da publicação");
            $("#error").show();
            return false;
        }else if(tipo=="<?php echo Publicacoes::TIPO_VIDEO ?>"){
            if(document.getElementById('url_video').value == ""){
                adicionarErro("Digite link do video do Youtube");
                $("#error").show();
                return false;
            }
            
            var matches = $('#url_video').val().match(/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
            if (matches) {
                adicionarErro("Nossos robôs não identificaram o link como sendo do YouTube. Por favor tente novamente.");
                $("#error").show();
                return false;
            }
        }else if(tipo=="<?php echo Publicacoes::TIPO_FOTO?>"){ 
            if(document.getElementById('fileInput').value == ""){
                adicionarErro("Adicione um arquivo de imagem");
                
                $("#error").show();
                return false;
            }else{
                
                var partes = document.getElementById('fileInput').value.split(".");
                
                if(partes.length<2){ 
                    adicionarErro("Adicione um arquivo de imagem");
                    $("#error").show();
                    return false;
                }else if($.inArray(partes[1], (Array('jpg', 'jpeg', 'png', 'gif'))) == -1){
                    adicionarErro("Arquivo enviado não é uma imagem");
                    $("#error").show();
                    return false;
                }
                
            }
        }

    });

    $("#error").hide();
</script>