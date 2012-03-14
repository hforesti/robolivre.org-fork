<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('perfil/index'); ?>"><img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)); ?>" alt="<?php echo UsuarioLogado::getInstancia()->getNome(); ?>" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo url_for('perfil/atualizarFoto') ?>">Atualizar foto</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('perfil/editarPerfil?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Editar perfil</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo UsuarioLogado::getInstancia()->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="<?php url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="<?php echo url_for('perfil/exibirConteudos?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
            <li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li>
            <li><a href="<?php echo url_for('perfil/solicitacoes') ?>"><?php if (UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() > 0) { ?><span class="label label-warning" title="<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?> nova(s) solicitações de amizade"><?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
            <li><a href="eventos.shtml"><span class="icon-gray icon-calendar"></span> Eventos</a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
            <li><hr></li>
            <li><a href="inbox.shtml"><span class="label label-warning" title="2 mensagens não lidas">2</span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li>
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
                Criar conteúdo
                <!--     Editar conteúdo -->
            </li>
        </ul>


        <div class="page-header">
            <h1>Criar conteúdo</h1>
            <!-- <h1>Editar conteúdo</h1> -->
        </div>

        <?php if(isset($nomeConteudoErro)){ ?>
        <div class="alert">
            <?php echo Util::getTagConteudo($nomeConteudoErro) ?> é um conteúdo que já existe na nossa rede. <br>Deseja colaborar com ele? <?php echo Util::getTagConteudoSlug("<strong>Acesse agora</strong>",$nomeConteudoErro) ?>.
        </div>
        <?php } ?>

        <?php include_partial('formConteudo', array('form' => $formConteudo,'nomeConteudo' => $nomeConteudo)); ?>

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div class="alert">
            <h6>Notas:</h6>
            <ol>
                <li>Seus amigos poderão editar este conteúdo para colaborar e agregar conhecimento.</li>

                <li>O conteúdo aqui postado estará sob a licença: <a href="http://creativecommons.org/licenses/by-sa/3.0/deed.pt">Atribuição-Partilha nos Mesmos Termos 3.0 não Adaptada (CC BY-SA 3.0)</a>.</li>
            </ol>
        </div>

    </div><!-- /aside -->

</div><!-- /row -->
