<div class="row">

    <?php include_partial('sidebarUsuario', array('usuario' => $usuario, 'opcao' => 'amigos')) ?>


    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Amigos de <?php echo Util::getNomeSimplificado($usuario->getNome()) ?> ‧ <small><?php echo $quantidadeAmigos ?></small></h2>

                <form action="<?php echo url_for("perfil/exibirAmigos?u=" . $usuario->getIdUsuario()) ?>" class="list-filter">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" class="span3 search-query" placeholder="Buscar na lista de amigos">
                </form>
            </div>

            <ul>

                <?php foreach ($amigos as $amigo) { ?>

                    <li class="row <?php
                if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::AMIGO || $amigo->getTipoSolicitacaoAmizade() == Usuarios::PROPRIO_USUARIO) {
                    echo "mine";
                }
                    ?>">
                        <div class="span8">
                            <a href="<?php echo url_for('perfil/exibir?u=' . $amigo->getIdUsuario()) ?>" class="photo"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada(Util::IMAGEM_MEDIA)) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>" class="thumbnail"></a> <h3><a href="<?php echo url_for('perfil/exibir?u=' . $amigo->getIdUsuario()) ?>"><?php
                    echo $amigo->getNome(); ?> </a> <?php
                    if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::PROPRIO_USUARIO) {
                        echo " ‧ <small>Olha só você!</small>";
                    } else if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::AMIGO) {
                        echo " ‧ <small>Seu amigo</small>";
                    }
                    ?></h3>
                            <p class="meta"><?php if ($amigo->getProfissao() != "") { ?>
                                    <strong><?php echo $amigo->getProfissao() ?></strong>
                                    <?php if ($amigo->getEmpresa() != "") { ?>
                                        em <?php echo $amigo->getEmpresa() ?>
                                    <?php } ?>
                                <?php } ?><br>
                        </div>

                        <?php
                        if ($amigo->getTipoSolicitacaoAmizade() != Usuarios::PROPRIO_USUARIO) {
                            ?>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                    <span class="icon-cog icon-gray"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <?php
                                    if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::AMIGO) {
                                        ?>
                                        <li>
                                            <a data-toggle="modal"href="#modalRemoveContent<?php echo $amigo->getIdUsuario(); ?>">Remover dos amigos</a>
                                        </li>
                                        <?php
                                    } else if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO) {
                                        ?>
                                        <li>
                                            <a data-toggle="modal" href="#modalAddContent<?php echo $amigo->getIdUsuario(); ?>">Adicionar como amigos</a>
                                        </li>
                                        <?php
                                    } else if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::SOLICITADA_AMIZADE) {
                                        ?>
                                        <li>
                                            <a href="<?php echo url_for('perfil/exibir?u=' . $amigo->getIdUsuario()) ?>">Aguardando solicitação</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="divider"></li>
                                    <li>
                                        <a data-toggle="modal" href="#modalIgnore<?php echo $amigo->getIdUsuario(); ?>"><i class="icon-ban-circle icon-gray"></i> Ignorar usuário</a>
                                    </li>
                                </ul>

                            </div><!-- btn-group -->
                            <?php
                            if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::AMIGO) {
                                ?>
                                <div class="modal fade" id="modalRemoveContent<?php echo $amigo->getIdUsuario() ?>">
                                    <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3>Remover Amigo</h3>
                                    </div>                    


                                    <div class="modal-body">
                                        <p>Deseja remover <strong><?php echo $amigo->getNome() ?></strong> dos seus amigos?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo url_for("perfil/removerAmigo?u=" . $amigo->getIdUsuario()) ?>" class="btn btn-danger">Remover</a> 

                                        <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
                                    </div>

                                </div>
                                <?php
                            } else if ($amigo->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO) {
                                ?>
                                <div class="modal fade" id="modalAddContent<?php echo $amigo->getIdUsuario() ?>">
                                    <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3>Adicionar amigo</h3>
                                    </div>                    


                                    <div class="modal-body">
                                        <p>Tem certeza de que deseja adicionar <strong><?php echo $amigo->getNome() ?></strong> como amigo?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo url_for("perfil/solicitarAmizade?u=" . $amigo->getIdUsuario()) ?>" class="btn btn btn-primary">Adicionar</a> 

                                        <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
                                    </div>

                                </div>
                                <?php
                            }
                            ?>
                            <div class="modal fade" id="modalIgnore<?php echo $amigo->getIdUsuario() ?>">
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>
                                    <h3>Ignorar</h3>
                                </div>                    


                                <div class="modal-body">
                                    <p>Você não verá mais as atualizações de <strong><?php echo $amigo->getNome() ?></strong>. Tem certeza de que deseja ignorar seu conteúdo?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo url_for("perfil/ignorar?u=" . $amigo->getIdUsuario()) ?>" class="btn btn btn-danger">Ignorar</a> 

                                    <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </li>
                <?php } ?>

            </ul>

            <hr>

            <div class="pagination">
                <ul>
                    <?php if ($pagina > 1) { ?>
                        <li><a href="<?php echo url_for("perfil/exibirAmigos?u=" . $usuario->getIdUsuario() . "&pagina=" . ($pagina - 1) . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $quantidadeTotalPaginas; ++$i) { ?>
                        <li <?php echo ($i == $pagina) ? "class=\"active\"" : ""; ?>><a href="<?php echo url_for("perfil/exibirAmigos?u=" . $usuario->getIdUsuario() . "&pagina=$i" . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if ($pagina < $quantidadeTotalPaginas) { ?>    
                        <li><a href="<?php echo url_for("perfil/exibirAmigos?u=" . $usuario->getIdUsuario() . "&pagina=" . ($pagina + 1) . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>

                <?php if ($quantidadeTotalPaginas > 0) { ?>
                    <p class="pull-right">Exibindo de <?php echo ((($pagina - 1) * Util::QUANTIDADE_PAGINACAO) + 1) ?> a <?php echo ($pagina == $quantidadeTotalPaginas) ? $quantidadeAmigos : $pagina * Util::QUANTIDADE_PAGINACAO ?></p>
                <?php } ?>


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

<div class="modal fade" id="modalIgnore">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Ignorar</h3>
    </div>
    <div class="modal-body">
        <p>Você não verá mais as atualizações de <strong id="nomeUsuario"></strong>. Tem certeza de que deseja ignorar seu conteúdo?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php url_for('perfil/ignorarUsuario') ?>" id="btn_ignorar" class="btn btn-danger">Ignorar</a> <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#nome").focus();
    });
    
</script>