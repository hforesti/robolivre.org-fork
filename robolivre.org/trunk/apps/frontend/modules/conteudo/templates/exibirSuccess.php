<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('conteudo/exibir?u='.$conteudo->getIdConjunto()); ?>"><img src="<?php echo image_path($conteudo->getImagemPerfil(Util::IMAGEM_GRANDE)) ?>" alt="Arduino" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="settings.shtml">Atualizar imagem</a>
                    </li>
                    <li>
                        <a href="inbox.shtml">Editar conteúdo</a>
                    </li>
                </ul>
            </div>

        </div><!-- /avatar -->
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="amigos.shtml"><span class="icon-gray icon-user"></span> Seguidores <span class="label label-info">150</span></a></li>
            <li><a href="imagens.shtml"><span class="icon-gray icon-picture"></span> Imagens <span class="label label-info">15</span></a></li>
            <li><a href="videos.shtml"><span class="icon-gray icon-film"></span> Vídeos <span class="label label-info">9</span></a></li>
            <li><a href="links.shtml"><span class="icon-gray icon-share-alt"></span> Links <span class="label label-info">5</span></a></li>
            <li><a href="docs.shtml"><span class="icon-gray icon-file"></span> Documentos <span class="label label-info">5</span></a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos relacionados <span class="label label-info">15</span></a></li>
        </ul>
    </div><!-- /sidebar -->

    <hr class="only-mobile">

    <div class="span7">

        <ul class="breadcrumb">
            <li>
                <a href="profile-home.shtml">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="conteudos.shtml">Conteúdos</a> <span class="divider">/</span>
            </li>
            <li class="active">
                <a href="conteudo.shtml"><?php echo $conteudo->getNome(); ?></a>
            </li>
        </ul>

        <p><small>Adicionado por <?php echo Util::getTagUsuario($conteudo->getNomeProprietario(), $conteudo->getConjunto()->getIdUsuario()) ?>. Última atualização <?php echo $ultimaAtulizacao; ?></small></p>

        <div class="page-header">
            <a href="#" class="btn btn-success pull-right"><i class="icon-ok icon-white"></i> Seguir conteúdo</a>
            <!-- <a href="#" class="btn pull-right"><i class="icon-remove"></i> Parar de seguir</a> -->

            <h1><?php echo $conteudo->getNome(); ?></h1>

        </div>

        <p><?php echo $conteudo->getDescricao(); ?></p>

        <hr>

        <?php include_partial('formPublicacao', array('form' => $formPublicacao,'id_conjunto' => $conteudo->getIdConjunto())) ?>

        <hr>


        <div id="stream">
            <h3>Atualizações recentes</h3>
            <ul>
                <?php foreach ($publicacoesConjunto as $publicacao) { ?>
                    <?php $publicacao->imprimir(); ?>
                <?php } ?>
            </ul>


        </div><!-- stream -->

        <div id="pagination"><a href="#" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="conteudos.shtml">Conteúdos relacionados <small>150</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
            </ul>
            <a href="conteudos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <hr>


        <div id="grid-projetos" class="wdgt">
            <h3><a href="projetos.shtml" title="Ver tudo">Projetos relacionados <small>15</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
                <li class="span1"><a href="projeto.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome do projeto" title="Nome do projeto"></a></li>
            </ul>
            <a href="projetos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-comunidades -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Seguidores <small>150</small></a></h3>
            <ul class="thumbnails">
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li><a href="perfil.shtml"><img src="assets/img/rl/20.gif" alt="Nome do amigo" title="Nome do amigo"></a></li>
            </ul>
            <a href="amigos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->