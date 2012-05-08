<div class="row">

  <?php include_partial('sidebarUsuarioLogado',array('opcao'=>'none')) ?>


  <hr class="only-mobile">

  <div class="span7">

    <ul class="breadcrumb">
      <li>
        <a href="<?php echo url_for("perfil/index") ?>">Início</a> <span class="divider">/</span>
      </li>
      <li>
        <a href="<?php echo url_for("perfil/configuracoes") ?>">Configurações</a> <span class="divider">/</span>
      </li>
      <li class="active">
        Alterar foto
      </li>
    </ul>


    <div class="page-header">
      <h1>Alterar foto</h1>
    </div>

      <form action="<?php echo url_for("perfil/confirmarFotoPerfil") ?>" method="post" id="form-upload-avatar">
          <div class="control-group clearfix">
            <label class="control-label" for="fileInput">Sua imagem (Até 8MB)</label>
            <div class="row">
              <div class="preview span2" id="img-preview">
                  <img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)) ?>" alt="Sua imagem" id="thumb" class="thumbnail" />
                <img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_MEDIA)) ?>" alt="Sua imagem menos" id="i-medium" class="thumbnail" /> 
                <img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_MINIATURA)) ?>" alt="Sua imagem em miniatura" id="i-small" class="thumbnail" />
                <input type="hidden" value="<?php echo $nomeArquivoImagem; ?>" id="imagem_selecionada" name="imagem_selecionada">
              </div>

              <div class="span5">				
                <div class="controls">				
                  <p class="help-block">Escolha uma imagem para o seu perfil</p>
                  <div id="file-uploader-img">       
                    <noscript>          
                      <input class="input-file" id="fileInput" type="file">
                    </noscript>         
                  </div>
                  <p class="help-block">Dica: você pode arrastar e soltar o arquivo (jpg, jpeg, png ou gif) aqui na página</p>
                </div>
              </div>
            </div><!-- row -->

          </div><!-- control-group -->
        </fieldset>          

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Salvar alterações</button> 
        </div>
      </fieldset>

    </form>


  </div><!-- /miolo -->


  <div class="span3" id="sidebar-wdgt">

    <div class="alert">
      <h6>Notas:</h6>
      <ol>
        <li>Somos amigos, porém o uso de imagens pornográficas e material sexualmente explícito está proibido. Isto pode causar <strong>exclusão</strong> do seu perfil.</li>
        <li>Não seja um pirata de conteúdo, respeite os direitos autorais. Ou seja, não publique material que você não tem autorização explícita do dono/criador para usar.</li>
      </ol>
    </div>

  </div><!-- /aside -->

</div><!-- /row -->