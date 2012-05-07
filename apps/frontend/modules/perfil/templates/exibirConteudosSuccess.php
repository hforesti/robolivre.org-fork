<div class="row">

    <?php include_partial('sidebarUsuario', array('usuario' => $usuario, 'opcao' => 'conteudos')) ?>

    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Conteúdos seguidos por <?php echo Util::getNomeSimplificado($usuario->getNome()) ?> ‧ <small><?php echo $quantidadeConteudoSeguido ?></small></h2>	
            </div>

            <div class="row">
                <div class="span6">
                    <ul class="nav nav-pills">
                        <li <?php echo ($proprietario) ? "" : "class=\"active\"" ?>>
                            <a href="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>">Atualizados recentemente</a>
                        </li>
                        <li <?php echo ($proprietario) ? "class=\"active\"" : "" ?>>
                            <a href="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . "&proprietario=1" . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>">Criados por <?php echo ($usuario->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()) ? "você" : Util::getNomeSimplificado($usuario->getNome()) ?></a>
                        </li>
                    </ul>
                </div>

                <form action="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . (($proprietario) ? "&proprietario=1" : "")) ?>" class="list-filter">
                    <input type="text" id="nome" value="<?php echo $nome; ?>" name="nome" class="span4 search-query" placeholder="Buscar na lista de conteúdos">
                </form>
            </div>

            <ul>

                <?php foreach ($arrayConteudoSeguido as $conteudo) { ?>
                    <li class="row <?php echo ($conteudo->getTipoUsuario() == Conteudos::PROPRIETARIO) ? "mine" : "" ?>">
                        <div class="span8">
                            <a href="<?php echo url_for("conteudo/" . Util::criaSlug($conteudo->getNome())) ?>" class="photo"><img src="<?php echo image_path($conteudo->getImagemPerfil()) ?>" alt="<?php echo $conteudo->getNome() ?>" title="<?php $conteudo->getNome() ?>" class="thumbnail"></a> 
                            <h3><?php echo Util::getTagConteudoSlug($conteudo->getNome(), $conteudo->getNome()) ?> ‧ <?php echo ($conteudo->getTipoUsuario() == Conteudos::PROPRIETARIO) ? "<small>Criado por você</small>" : "" ?></h3>
                            <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                                <a href="<?php echo url_for("conteudo/".Util::criaSlug($conteudo->getNome()))."/imagem" ?>"><?php echo $conteudo->getQuantidadeImagens() ?> imagens</a> ‧ <a href="<?php echo url_for("conteudo/".Util::criaSlug($conteudo->getNome()))."/video" ?>"><?php echo $conteudo->getQuantidadeVideos() ?> vídeos</a> ‧ <a href="<?php echo url_for("conteudo/".Util::criaSlug($conteudo->getNome()))."/link" ?>"><?php echo $conteudo->getQuantidadeLinks() ?> links</a> ‧ <a href="<?php echo url_for("conteudo/".Util::criaSlug($conteudo->getNome()))."/documento" ?>">0 documentos</a> ‧<a href="<?php echo url_for('@conteudo_acao?slug='. Util::criaSlug($conteudo->getNome())."&acao=exibirSeguidores") ; ?>"><?php echo $conteudo->getQuantidadeSeguidores() ?> seguidores</a></p>
                        </div>

                        <?php if ($conteudo->getPodeColaborar() || $conteudo->getTipoUsuario() != Conteudos::PROPRIETARIO && $conteudo->getTipoSolicitacao()==Conteudos::PARTICIPANTE) { ?>
                            <div class="btn-group">
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                                    <span class="icon-cog icon-gray"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if ($conteudo->getPodeColaborar()) { ?>
                                        <li>
                                            <a href="<?php echo url_for('conteudos/editar?u=' . $conteudo->getIdConjunto()) ?>">Colaborar/Editar conteúdo</a>
                                        </li>
                                    <?php } ?>
                                        
                                    <?php if ($conteudo->getTipoUsuario() != Conteudos::PROPRIETARIO && $conteudo->getTipoSolicitacao()==Conteudos::PARTICIPANTE) { ?>
                                        <li>
                                            <a data-toggle="modal" href="#modalRemoveContent<?php echo $conteudo->getIdConjunto() ?>">Parar de seguir</a>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <?php if ($conteudo->getTipoUsuario() != Conteudos::PROPRIETARIO) { ?>
                                    <div class="modal fade" id="modalRemoveContent<?php echo $conteudo->getIdConjunto() ?>">
                                        <div class="modal-header">
                                            <a class="close" data-dismiss="modal">×</a>
                                            <h3>Parar de seguir</h3>
                                        </div>                    


                                        <div class="modal-body">
                                            <p>Deseja parar de seguir o conteúdo <strong><?php echo $conteudo->getNome() ?></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo url_for("conteudos/pararSeguir?u=" . $conteudo->getIdConjunto()) ?>" class="btn btn-danger">Parar de seguir</a> 

                                            <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>     
                        <?php } ?>


                    </li>
                <?php } ?>

            </ul>

            <hr>

            <div class="pagination">
                <ul>
                    <?php if ($pagina > 1) { ?>
                        <li><a href="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . (($proprietario) ? "&proprietario=1" : "") . "&pagina=" . ($pagina - 1) . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $quantidadeTotalPaginas; ++$i) { ?>
                        <li <?php echo ($i == $pagina) ? "class=\"active\"" : ""; ?>><a href="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . (($proprietario) ? "&proprietario=1" : "") . "&pagina=$i" . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <?php if ($pagina < $quantidadeTotalPaginas) { ?>    
                        <li><a href="<?php echo url_for("perfil/exibirConteudos?u=" . $usuario->getIdUsuario() . (($proprietario) ? "&proprietario=1" : "") . "&pagina=" . ($pagina + 1) . ((trim($nome) == "") ? "" : "&nome=$nome")) ?>">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                    <?php } ?>
                </ul>

                <p class="pull-right">Exibindo de <?php echo ((($pagina - 1) * Util::QUANTIDADE_PAGINACAO) + 1) ?> a <?php echo ($pagina == $quantidadeTotalPaginas) ? $quantidadeConteudoSeguido : $pagina * Util::QUANTIDADE_PAGINACAO ?></p>

            </div>

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#nome").focus();
    });
</script>