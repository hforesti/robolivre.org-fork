<div class="row">

    <?php include_partial('sidebarUsuario',array('usuario'=>$usuario)) ?>

    <hr class="only-mobile">

    <div class="span10">

        <div class="list-mgmt">

            <div class="row">
                <h2 class="span7">Conteúdos seguidos por você ‧ <small><?php echo $quantidadeConteudoSeguido ?></small></h2>	
            </div>

            <div class="row">
                <div class="span6">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="profile-conteudos.shtml">Atualizados recentemente</a>
                        </li>
                        <li><a href="profile-conteudos-meus.shtml">Criados por você</a></li>
                    </ul>
                </div>

                <form class="list-filter">
                    <input type="text" class="span4 search-query" placeholder="Buscar na lista de conteúdos">
                </form>
            </div>

            <ul>

                <!-- ================================================ -->
                <!-- ! class "mine" para indicar "Criada por você"   -->
                <!-- !  ‧ <small>Criado por você</small> dentro do titulo   -->
                <!-- ================================================ -->
                <li class="row mine">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a> ‧ <small>Criado por você</small></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>
                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

                <li class="row">
                    <div class="span8">
                        <a href="conteudo.shtml" class="photo"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo" class="thumbnail"></a> <h3><a href="conteudo.shtml">Nome do conteúdo</a></h3>
                        <p class="meta">Última atualização 21/01/2012 às 21:50<br>
                            <a href="conteudo-imagens.shtml">15 imagens</a> ‧ <a href="conteudo-videos.shtml">5 vídeos</a> ‧ <a href="conteudo-links.shtml">40 links</a> ‧ <a href="conteudo-docs.shtml">5 documentos</a> ‧ <a href="conteudo-projetos.shtml">5 projetos relacionados</a> ‧ <a href="conteudo-seguidores.shtml">150 seguidores</a></p>
                    </div>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                            <span class="icon-cog icon-gray"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="conteudo-criar.shtml">Colaborar/Editar conteúdo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a data-toggle="modal" href="#modalRemoveContent">Parar de seguir</a>
                            </li>
                        </ul>
                    </div><!-- btn-group -->
                </li>

            </ul>

            <hr>

            <div class="pagination">
                <ul>
              <!--     <li><a href="#"><i class="icon-chevron-left icon-gray"></i> Anterior</a></li> -->
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Próxima <i class="icon-chevron-right icon-gray"></i></a></li>
                </ul>

                <p class="pull-right">Exibindo de 1 a 10</p>

            </div>

        </div>

    </div><!-- /miolo -->


</div><!-- /row -->


<!-- ====================== -->
<!-- ! Caixas de mensagem   -->
<!-- ====================== -->
<div class="modal fade" id="modalRemoveContent">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Parar de seguir</h3>
    </div>
    <div class="modal-body">
        <p>Deseja parar de seguir o conteúdo <strong>Arduíno</strong>?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger">Parar de seguir</a> 

        <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
    </div>
</div>