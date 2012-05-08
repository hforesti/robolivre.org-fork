<div class="row">

    <?php include_partial('sidebarUsuarioLogado',array('opcao'=>'solicitacoes')) ?>


    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Seus amigos ‧ <small><?php echo $quantidadeAmigos ?></small></h2>

                <form action="<?php echo url_for("perfil/exibirAmigosHome") ?>" class="list-filter">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" class="span3 search-query" placeholder="Buscar na lista de amigos">
                </form>
            </div>

            <ul>
                
                <?php foreach ($amigos as $amigo) { ?>
                    <li class="row">
                        <div class="span8">
                            <a href="<?php echo url_for('perfil/exibir?u=' . $amigo->getIdUsuario()) ?>" class="photo"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada(Util::IMAGEM_MEDIA)) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>" class="thumbnail"></a> <h3><a href="<?php echo url_for('perfil/exibir?u=' . $amigo->getIdUsuario()) ?>"><?php echo $amigo->getNome() ?></a></h3>
                            <p class="meta"><?php if($amigo->getProfissao()!=""){?>
                                <strong><?php echo $amigo->getProfissao() ?></strong>
                                <?php if($amigo->getEmpresa()!=""){ ?>
                                    em <?php echo $amigo->getEmpresa() ?>
                                <?php } ?>
                            <?php } ?><br>
                        </div>
                        
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                <span class="icon-cog icon-gray"></span>
                            </a>
                            <ul class="dropdown-menu">
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
                        <li><a href="<?php echo url_for("perfil/exibirAmigosHome?pagina=".($pagina-1).((trim($nome)=="")?"":"&nome=$nome")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for($i=1;$i<=$quantidadeTotalPaginas;++$i){ ?>
                        <li <?php echo ($i==$pagina)?"class=\"active\"":""; ?>><a href="<?php echo url_for("perfil/exibirAmigosHome?pagina=$i".((trim($nome)=="")?"":"&nome=$nome")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if($pagina<$quantidadeTotalPaginas){ ?>    
                        <li><a href="<?php echo url_for("perfil/exibirAmigosHome?pagina=".($pagina+1).((trim($nome)=="")?"":"&nome=$nome")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>

                <p class="pull-right">Exibindo de <?php echo ((($pagina-1)*Util::QUANTIDADE_PAGINACAO)+1) ?> a <?php echo ($pagina==$quantidadeTotalPaginas)? $quantidadeAmigos:$pagina*Util::QUANTIDADE_PAGINACAO ?></p>

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