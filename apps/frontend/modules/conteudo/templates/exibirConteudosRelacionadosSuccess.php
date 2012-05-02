<div class="row">

    <?php include_partial('sidebarConteudo',array('conteudo'=>$conteudo,'opcao'=>'conteudos','quantidadeParticipantes'=>$quantidadeParticipantes)) ?>

    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Conteúdos seguidos por você ‧ <small><?php echo $quantidadeConteudosRelacionados ?></small></h2>	
            
                <form action="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudosRelacionados") ?>" class="list-filter">
                    <input type="text" id="nome" value="<?php echo $nome; ?>" name="nome" class="span3 search-query" placeholder="Buscar na lista de conteúdos">
                </form>
            </div>

            <ul>

                <?php foreach ($arrayConteudosRelacionados as $conteudoRelacionado) { ?>
                    <li class="row <?php echo ($conteudoRelacionado->getTipoUsuario() == Conteudos::PROPRIETARIO) ? "mine" : "" ?>">
                        <div class="span8">
                            <a href="conteudo.shtml" class="photo"><img src="<?php echo image_path($conteudoRelacionado->getImagemPerfil()) ?>" alt="<?php echo $conteudoRelacionado->getNome() ?>" title="<?php $conteudoRelacionado->getNome() ?>" class="thumbnail"></a> 
                            <h3><?php echo Util::getTagConteudoSlug($conteudoRelacionado->getNome(), $conteudoRelacionado->getNome()) ?> ‧ <?php echo ($conteudoRelacionado->getTipoUsuario() == Conteudos::PROPRIETARIO) ? "<small>Criado por você</small>" : "" ?></h3>
                            <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                                <a href="conteudo-imagens.shtml"><?php echo $conteudoRelacionado->getQuantidadeImagens() ?> imagens</a> ‧ <a href="conteudo-videos.shtml"><?php echo $conteudoRelacionado->getQuantidadeVideos() ?> vídeos</a> ‧ <a href="conteudo-links.shtml"><?php echo $conteudoRelacionado->getQuantidadeLinks() ?> links</a> ‧ <a href="conteudo-docs.shtml">0 documentos</a> ‧<a href="conteudo-seguidores.shtml"><?php echo $conteudoRelacionado->getQuantidadeSeguidores() ?> seguidores</a></p>
                        </div>
                        <div class="btn-group">
                            <?php if ($conteudoRelacionado->getConjunto()->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) { ?>
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                    <span class="icon-cog icon-gray"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo url_for('conteudos/editar?u=' . $conteudoRelacionado->getIdConjunto()) ?>">Colaborar/Editar conteúdo</a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" href="#modalRemoveContent<?php echo $conteudoRelacionado->getIdConjunto() ?>">Parar de seguir</a>
                                    </li>
                                </ul>
                            <div class="modal fade" id="modalRemoveContent<?php echo $conteudoRelacionado->getIdConjunto() ?>">
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>
                                    <h3>Parar de seguir</h3>
                                </div>
                                <div class="modal-body">
                                    <p>Deseja parar de seguir o conteúdo <strong><?php echo $conteudoRelacionado->getNome() ?></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo url_for("conteudos/pararSeguir?u=".$conteudoRelacionado->getIdConjunto()) ?>" class="btn btn-danger">Parar de seguir</a> 

                                    <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
                                </div>
                            </div>
                            <?php } ?>
                        </div>    
                    </li>
                <?php } ?>

            </ul>

            <hr>

            <div class="pagination">
                <ul>
                    <?php if($pagina>1){ ?>
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudosRelacionados"."&pagina=".($pagina-1).((trim($nome)=="")?"":"&nome=$nome")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for($i=1;$i<=$quantidadeTotalPaginas;++$i){ ?>
                        <li <?php echo ($i==$pagina)?"class=\"active\"":""; ?>><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudosRelacionados"."&pagina=$i".((trim($nome)=="")?"":"&nome=$nome")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if($pagina<$quantidadeTotalPaginas){ ?>    
                        <li><a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirConteudosRelacionados"."&pagina=".($pagina+1).((trim($nome)=="")?"":"&nome=$nome")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>

                <p class="pull-right">Exibindo de <?php echo ((($pagina-1)*Util::QUANTIDADE_PAGINACAO)+1) ?> a <?php echo ($pagina==$quantidadeTotalPaginas)? $quantidadeConteudosRelacionados:$pagina*Util::QUANTIDADE_PAGINACAO ?></p>

            </div>

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#nome").focus();
    });
</script>