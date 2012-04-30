<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome()); ?>"><img src="<?php echo image_path($conteudo->getImagemPerfil(Util::IMAGEM_GRANDE)) ?>" alt="Arduino" class="photo"></a>
            <div class="btn-group">
                <?php if ($conteudo->getTipoUsuario()== Conteudos::PROPRIETARIO) { ?>
                    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                        <span class="icon-cog icon-gray"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="settings.shtml">Atualizar imagem</a>
                        </li>
                        <li>
                            <a href="<?php echo url_for('conteudos/editar?u=' . $conteudo->getIdConjunto()) ?>">Editar conteúdo</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>

        </div><!-- /avatar -->
        <ul class="nav nav-pills nav-stacked">
            <li><a href="<?php echo url_for('conteudo/') . Util::criaSlug($conteudo->getNome()); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li class="active"><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>"><span class="icon-gray icon-user"></span> Seguidores <span class="label label-info"><?php echo $quantidadeParticipantes ?></span></a></li>
            <li><a href="imagens.shtml"><span class="icon-gray icon-picture"></span> Imagens <span class="label label-info"></span></a></li>
            <li><a href="videos.shtml"><span class="icon-gray icon-film"></span> Vídeos <span class="label label-info"></span></a></li>
            <li><a href="links.shtml"><span class="icon-gray icon-share-alt"></span> Links <span class="label label-info"></span></a></li>
            <li><a href="docs.shtml"><span class="icon-gray icon-file"></span> Documentos <span class="label label-info"></span></a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos relacionados <span class="label label-info"></span></a></li>
        </ul>
    </div><!-- /sidebar -->

    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Seus amigos ‧ <small><?php echo $quantidadeParticipantes ?></small></h2>

                <form action="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>" class="list-filter">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" class="span3 search-query" placeholder="Buscar na lista de amigos">
                </form>
            </div>

            <!-- ========================================================== -->
            <!-- ! Modelo de alerta quando tiver solicitação de amizade   -->
            <!-- ========================================================== -->
            <!--<div class="alert">
                    Você possui <strong>2 solicitações de amizade</strong> sem resposta. <a href="inbox.shtml">Confira nas suas notificações</a>.
            </div>-->

            <ul>
                
                <?php foreach ($participantes as $participante) { ?>
                    <li class="row">
                        <div class="span8">
                            <a href="<?php echo url_for('perfil/exibir?u=' . $participante->getIdUsuario()) ?>" class="photo"><img src="<?php echo image_path($participante->getImagemPerfilFormatada(Util::IMAGEM_MEDIA)) ?>" alt="<?php echo $participante->getNome() ?>" title="<?php echo $participante->getNome() ?>" class="thumbnail"></a> <h3><a href="<?php echo url_for('perfil/exibir?u=' . $participante->getIdUsuario()) ?>"><?php echo $participante->getNome() ?></a></h3>
                            <p class="meta"><?php if($participante->getProfissao()!=""){?>
                                <strong><?php echo $participante->getProfissao() ?></strong>
                                <?php if($participante->getEmpresa()!=""){ ?>
                                    em <?php echo $participante->getEmpresa() ?>
                                <?php } ?>
                            <?php } ?><br>
                        </div>
                        
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                <span class="icon-cog icon-gray"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="send-msg" data-toggle="modal" href="#modalSendMsg">Enviar mensagem privada</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a data-toggle="modal" href="#modalRemoveFriend">Remover dos amigos</a>
                                </li>
                            </ul>
                        </div><!-- btn-group -->
                    </li>
                <?php } ?>

            </ul>

            <hr>

            <div class="pagination">
                <ul>
                    <?php if($pagina>1){ ?>
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores&pagina=".($pagina-1).((trim($nome)=="")?"":"&nome=$nome")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for($i=1;$i<=$quantidadeTotalPaginas;++$i){ ?>
                        <li <?php echo ($i==$pagina)?"class=\"active\"":""; ?>><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores&pagina=$i".((trim($nome)=="")?"":"&nome=$nome")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if($pagina<$quantidadeTotalPaginas){ ?>    
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores&pagina=".($pagina+1).((trim($nome)=="")?"":"&nome=$nome")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>

                <p class="pull-right">Exibindo de <?php echo ((($pagina-1)*Util::QUANTIDADE_PAGINACAO)+1) ?> a <?php echo ($pagina==$quantidadeTotalPaginas)? $quantidadeParticipantes:$pagina*Util::QUANTIDADE_PAGINACAO ?></p>

            </div>

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->


<!-- ====================== -->
<!-- ! Caixas de mensagem   -->
<!-- ====================== -->
<div class="modal fade" id="modalSendMsg">
    <form action="#" id="form-enviar" class="form-horizontal">

        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Enviar mensagem</h3>
        </div>

        <div class="modal-body">

            <!--   <div class="alert alert-success">Mensagem enviada com sucesso.</div> -->

            <div class="control-group">
                <label class="control-label">Para</label>
                <div class="controls">
                    <div class="input-prepend" id="fromField">
                        <span class="add-on"><img src="assets/img/rl/_avatar-default-20.png" alt="Rodrigo Medeiros" class="photo"></span><span class="input-medium uneditable-input"></span>
                    </div>

                </div>

                <div class="control-group">
                    <label class="control-label" for="msgCompose">Mensagem</label>
                    <div class="controls">
                        <textarea id="msgCompose" class="input-xlarge" rows="8" placeholder="Escreva sua mensagem privada"></textarea>
                    </div>
                </div>
            </div>

        </div><!-- modal-body -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#nome").focus();
    });
</script>