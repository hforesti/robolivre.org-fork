<div class="row">

    <div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('perfil/exibir?u='.$usuario->getIdUsuario()) ?>"><img src="<?php echo image_path('/assets/img/rl/_avatar-default-140.png') ?>" alt="<?php echo $usuario->getNome(); ?>" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a data-toggle="modal" href="#modalAdd">Adicionar como amigo</a>
                    </li>
                    <li>
                        <a href="enviar-msg.shtml">Enviar mensagem privada</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a data-toggle="modal" href="#modalIgnore"><i class="icon-ban-circle icon-gray"></i> Ignorar usuário</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo $usuario->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="#"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
            <li><a href="#"><span class="icon-gray icon-comment"></span> Comunidades</a></li>
            <li><a href="#"><span class="icon-gray icon-user"></span> Amigos</a></li>
            <li><a href="#"><span class="icon-gray icon-calendar"></span> Eventos</a></li>
            <li><a href="#"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
        </ul>
    </div><!-- /sidebar -->


    <div class="span7">

        <h3>Atualizações recentes</h3>

        <div id="stream">

            <ul>
               
                <?php foreach ($publicacoesPerfil as $publicacao) { ?>                    
                        <?php $publicacao->imprimir();
                                
                            /*'formPublicacao',array('form' => $formPublicacao,
                            'id_publicacao_original' => $publicacao->getIdPublicacao(),
                            'id_usuario_original' => $publicacao->getIdUsuario()));*/ ?>
                        
                <?php } ?>
                
            </ul>


        </div><!-- stream -->

<!--        <div id="pagination"><a href="#" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>-->

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-comunidades" class="wdgt">
            <h3><a href="comunidades.shtml" title="Ver tudo">Comunidades <small>15</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
            </ul>
            <a href="comunidades.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-comunidades -->

        <hr>

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="conteudos.shtml">Conteúdos seguidos <small>150</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
                <li class="span1"><a href="conteudo.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do conteúdo" title="Nome do conteúdo"></a></li>
            </ul>
            <a href="conteudos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Amigos <small>150</small></a></h3>
            <ul class="thumbnails">
                <li class="span1"><a href="perfil.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li class="span1"><a href="perfil.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do amigo" title="Nome do amigo"></a></li>
                <li class="span1"><a href="perfil.shtml" class="thumbnail"><img src="<?php echo image_path('/assets/img/rl/60.gif') ?>" alt="Nome do amigo" title="Nome do amigo"></a></li>
            </ul>
            <a href="amigos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->


<!-- ====================== -->
<!-- ! Caixas de mensagem   -->
<!-- ====================== -->
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Adicionar amigo</h3>
    </div>
    <div class="modal-body">
        <p>Tem certeza de que deseja adicionar <strong><?php echo $usuario->getNome(); ?></strong> como amigo?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary">Adicionar</a> <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 
    </div>
</div>

<div class="modal fade" id="modalIgnore">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Ignorar</h3>
    </div>
    <div class="modal-body">
        <p>Você não verá mais as atualizações de <strong><?php echo $usuario->getNome(); ?></strong>. Tem certeza de que deseja ignorar seu conteúdo?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger">Ignorar <?php echo $usuario->getNome(); ?></a> <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 
    </div>
</div>
