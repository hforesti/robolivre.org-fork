<?php
$slug = Util::criaSlug($conteudo->getNome());
?>
<div class="row">

    <?php include_partial('sidebarConteudo', array('conteudo' => $conteudo, 'quantidadeParticipantes' => $quantidadeParticipantes, 'opcao' => "documentos")) ?>


    <hr class="only-mobile">

    <div class="span10">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for("perfil/index") ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for("conteudos/index") ?>">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for('conteudo/') . $slug; ?>"><?php echo $conteudo->getNome() ?></a> <span class="divider">/</span>
            </li>
            <li class="active">
                Documentos
            </li>
        </ul>


        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Documentos ‧ <small><?php echo $quantidadeDocumentos ?></small></h2>	

                <?php
                if ($conteudo->getTipoSolicitacao() == Conteudos::PARTICIPANTE) {
                    ?>
                    <div class="span3">
                        <a href="<?php echo url_for('conteudo/') . $slug . "/adicionarDoc"; ?>" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar documento</a>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="row">
                <div class="span6">
                    <ul class="nav nav-pills">
                        <li <?php echo ($proprietario) ? "" : "class=\"active\"" ?>>
                            <a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos"); ?>">Atualizados recentemente</a>
                        </li>
                        <li <?php echo ($proprietario) ? "class=\"active\"" : "" ?>>
                            <a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos&proprietario=1"); ?>">Criados por você</a>
                        </li>
                    </ul>
                </div>

                <form action="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos" . (($proprietario) ? "&proprietario=1" : "")); ?>" class="list-filter">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>"  class="span4 search-query" placeholder="Buscar na lista de documentos">
                </form>
            </div>


            <div id="docs-intro">

                <?php if ($quantidadeDocumentos) { ?>

                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Arquivo</th>
                                <th class="col-sec">Formato</th>
                                <th class="col-sec">Downloads</th>
                                <th class="col-sec">Tamanho</th>
                                <th class="col-sec">Opções</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($documentos as $documento) {
                                $caminho_arquivo = sfConfig::get('sf_upload_dir') . "/documentos/$slug/" . $documento->getNomeArquivo();
                                ?>

                                <tr>
                                    <td class="<?php
                        if ($documento->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) {
                            echo "mine";
                        }
                                ?>"><a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=download&idDoc=" . $documento->getIdDocumento()) ?>" class="reload" target="_blank"><i class="icon-file icon-gray"></i> <?php echo ($documento->getNomeDocumento()) ?> <small class="time" title="<?php echo Util::getTempoDocumento($caminho_arquivo); ?>"><?php
                                if ($documento->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) {
                                    echo "Criado por você ‧ ";
                                } echo Util::getTempoDocumento($caminho_arquivo);
                                ?></small></a></td>
                                    <td><?php echo strtoupper($documento->getExtensaoArquivo()) ?></td>
                                    <td><a href="#"><span class="label label-info"><?php echo $documento->getHits(); ?></span></a></td>
                                    <td><?php echo Util::getTamanhoArquivo($caminho_arquivo); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                                <span class="icon-cog icon-gray"></span>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=download&idDoc=" . $documento->getIdDocumento()) ?>" class="reload" target="_blank">Baixar</a>
                                                </li>
                                                <?php if (true && $conteudo->getPodeColaborar() || UsuarioLogado::getInstancia()->getIdUsuario() == $documento->getIdUsuario()) { ?>

                                                    <li>
                                                        <a data-toggle="modal" href="#modalEditName<?php echo $documento->getIdDocumento(); ?>">Editar título</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a class="send-msg" data-toggle="modal" href="#modalDelete<?php echo $documento->getIdDocumento(); ?>"><i class="icon-remove-circle icon-gray"></i> Excluir arquivo</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div><!-- btn-group -->
                                    </td>
                                </tr>


                            <div class="modal fade" id="modalDelete<?php echo $documento->getIdDocumento(); ?>">
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>
                                    <h3>Excluir documento</h3>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza de que deseja excluir o documento <strong><?php echo $documento->getNomeDocumento(); ?></strong>? <br>Essa ação não pode ser revertida.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> <a href="<?php echo url_for("conteudos/removerDocumento?slug=$slug&u=" . $documento->getIdDocumento()) ?>" class="btn btn-danger">Sim, excluir agora</a> 
                                </div>
                            </div>
                            <div class="modal fade" id="modalEditName<?php echo $documento->getIdDocumento(); ?>">
                                <form action="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=editarNome") ?>" id="form-editar" method="post">

                                    <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3>Editar título do documento</h3>
                                    </div>

                                    <div class="modal-body">

                                        <div class="control-group row-fluid" id="caixa">
                                            <div class="controls" id="adiciona_erro">
                                                <input type="text" name="nome" class="span12" id="input01" placeholder="Título do documento" value="<?php echo $documento->getNomeDocumento(); ?>" tabindex="1">
                                                <input type="hidden" name="idDoc" value="<?php echo $documento->getIdDocumento(); ?>" />
                                            </div>
                                        </div>

                                        <!--                                                        <div class="alert">
                                                                                                      O título não pode ser vazio.
                                                                                                      </div>-->

                                    </div><!-- modal-body -->
                                    <div class="modal-footer">

                                        <div id="div-botao-criar">
                                            <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 

                                            <button id="enviar" type="submit" class="btn btn-primary pull-right">Atualizar título</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        <?php } ?>
                        </tbody>
                    </table>

                    <?php
                } else {
                    if ($proprietario) {
                        ?>
                        <div class="well">
                            <p>Você ainda não adicionou um <strong>documento</strong> neste projeto. <a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=adicionarDoc") ?>">Adicionar agora</a>?</p>
                            <p>
                                ou<br>
                                <a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos") ?>" class="btn">Ver lista de todos os documentos</a>
                            </p>
                        </div>
                        <?php
                    }
                }
                ?>

            </div><!-- lista docs -->

            <div class="pagination">
                <ul>
                    <?php if ($pagina > 1) { ?>
                        <li><a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos&pagina=" . ($pagina - 1) . ((trim($nome) == "") ? "" : "&nome=$nome") . (($proprietario) ? "&proprietario=1" : "")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $quantidadeTotalPaginas; ++$i) { ?>
                        <li <?php echo ($i == $pagina) ? "class=\"active\"" : ""; ?>><a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos&pagina=$i" . ((trim($nome) == "") ? "" : "&nome=$nome") . (($proprietario) ? "&proprietario=1" : "")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if ($pagina < $quantidadeTotalPaginas) { ?>    
                        <li><a href="<?php echo url_for('@conteudo_acao?slug=' . $slug . "&acao=exibirDocumentos&pagina=" . ($pagina + 1) . ((trim($nome) == "") ? "" : "&nome=$nome") . (($proprietario) ? "&proprietario=1" : "")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>
                <?php if ($quantidadeTotalPaginas > 0) { ?>
                    <p class="pull-right">Exibindo de <?php echo ((($pagina - 1) * Util::QUANTIDADE_PAGINACAO) + 1) ?> a <?php echo ($pagina == $quantidadeTotalPaginas) ? $quantidadeDocumentos : $pagina * Util::QUANTIDADE_PAGINACAO ?></p>
                <?php } ?>
            </div>


            <hr class="only-mobile">

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->
<script type="text/javascript">
    $('.reload').click(function(){
        document.location.reload();
    })
      
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
      
    $('#enviar').click(function(){
        if(!($('#input01').val())){
            if (!$('#msg_erro')[0]){ 
                $('#caixa').addClass('error');
                $("#adiciona_erro").append('<span id="msg_erro" class="help-inline">Por favor informe um título para o documento</span>');
            }
       
            return false;
        } 
    
    });
</script>