<!--#include virtual="includes/header.html" -->

<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="profile-home.shtml"><img src="<?php echo image_path("/assets/img/rl/_avatar-default-140.png"); ?>" alt="Rodrigo Medeiros" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="settings.shtml">Atualizar foto</a>
                    </li>
                    <li>
                        <a href="inbox.shtml">Editar perfil</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo $usuario->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="conteudos.shtml"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
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
        <hr>


        <div id="stream" class="tabbable">

            <div class="tab-content">
                <?php
                foreach (UsuarioLogado::getInstancia()->getSolicitacoesPendentes() as $solicitacao) {
                    ?>

                    <b><?php echo $solicitacao['nome'] ?></b>
                    <a href="<?php echo url_for('perfil/aceitarSolicitacao') . "?u=" . $solicitacao['id'] ?>"> Aceitar</a>- 
                    <a href="<?php echo url_for('perfil/recusarSolicitacao') . "?u=" . $solicitacao['id'] ?>">Recusar</a>
                    <br/>
<?php } ?>

            </div><!-- tab-content -->

        </div><!-- stream -->
    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="conteudos.shtml">Conteúdos seguidos <small>150</small></a></h3>
            <ul class="thumbnails">
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

        <div id="grid-comunidades" class="wdgt">
            <h3><a href="comunidades.shtml" title="Ver tudo">Comunidades <small>15</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="assets/img/rl/60.gif" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
            </ul>
            <a href="comunidades.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-comunidades -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Amigos <small>150</small></a></h3>
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


<!--#include virtual="includes/footer.html" -->
