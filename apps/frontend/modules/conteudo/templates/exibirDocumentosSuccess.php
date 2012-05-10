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
<!--                <div class="span3">
                    <a href="comunidade-docs-criar.shtml" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar documento</a>
                </div>-->
            </div>

            <div class="row">
                <div class="span6">
                    <ul class="nav nav-pills">
                        <li <?php echo ($proprietario)?"":"class=\"active\"" ?>>
                            <a href="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos") ; ?>">Atualizados recentemente</a>
                        </li>
                        <li <?php echo ($proprietario)?"class=\"active\"":"" ?>>
                            <a href="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos&proprietario=1") ; ?>">Criados por você</a>
                        </li>
                    </ul>
                </div>

                <form action="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos".(($proprietario) ? "&proprietario=1" : "")) ; ?>" class="list-filter">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>"  class="span4 search-query" placeholder="Buscar na lista de documentos">
                </form>
            </div>


            <div id="docs-intro">

                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Arquivo</th>
                            <th class="col-sec">Formato</th>
<!--                            <th class="col-sec">Downloads</th>-->
                            <?php if($proprietario){ ?>
                                <th class="col-sec">Opções</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($documentos as $documento){ ?>
                        
                        <tr>
                            <td><a href="<?php echo image_path("/uploads/documentos/$slug/".$documento->getNomeArquivo()) ?>"><i class="icon-file icon-gray"></i> <?php echo $documento->getNomeDocumento() ?> <small class="time" title="Sexta, 24 de fevereiro de 2012 às 8:00">39 minutos atrás</small></a></td>
                            <td><?php echo strtoupper($documento->getExtensaoArquivo()) ?></td>
<!--                            <td><a href="#"><span class="label label-info">100</span></a></td>-->
                            <?php if($proprietario){ ?>
                            <td>
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                        <span class="icon-cog icon-gray"></span>
                                    </a>
                                    <?php if ($proprietario && $conteudo->getPodeColaborar() || UsuarioLogado::getInstancia()->getIdUsuario()==$documento->getIdUsuario()) { ?>
                                    <ul class="dropdown-menu">
<!--                                        <li>
                                            <a data-toggle="modal" href="#modalEditName">Editar título</a>
                                        </li>-->
<!--                                        <li class="divider"></li>-->
                                        <li>
                                            <a class="send-msg" href="<?php echo url_for("conteudos/removerDocumento?slug=$slug&u=".$documento->getIdDocumento()) ?>"><i class="icon-remove-circle icon-gray"></i> Excluir arquivo</a>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                </div><!-- btn-group -->
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div><!-- lista docs -->

            <div class="pagination">
                <ul>
                    <?php if($pagina>1){ ?>
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos&pagina=".($pagina-1).((trim($nome)=="")?"":"&nome=$nome").(($proprietario) ? "&proprietario=1" : "")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for($i=1;$i<=$quantidadeTotalPaginas;++$i){ ?>
                        <li <?php echo ($i==$pagina)?"class=\"active\"":""; ?>><a href="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos&pagina=$i".((trim($nome)=="")?"":"&nome=$nome").(($proprietario) ? "&proprietario=1" : "")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if($pagina<$quantidadeTotalPaginas){ ?>    
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. $slug."&acao=exibirDocumentos&pagina=".($pagina+1).((trim($nome)=="")?"":"&nome=$nome").(($proprietario) ? "&proprietario=1" : "")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>
                <?php if($quantidadeTotalPaginas>0){ ?>
                <p class="pull-right">Exibindo de <?php echo ((($pagina-1)*Util::QUANTIDADE_PAGINACAO)+1) ?> a <?php echo ($pagina==$quantidadeTotalPaginas)? $quantidadeParticipantes:$pagina*Util::QUANTIDADE_PAGINACAO ?></p>
                <?php } ?>
            </div>


            <hr class="only-mobile">

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->
