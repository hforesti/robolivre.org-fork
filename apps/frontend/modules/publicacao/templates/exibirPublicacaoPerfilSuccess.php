<div class="row">

    <?php include_partial('perfil/sidebarUsuario',array('usuario'=>$usuario,'opcao'=>'0')) ?>

    <hr class="only-mobile">

    <div class="span7">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url_for("perfil/index") ?>">Início</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo url_for("perfil/exibir?u=".$usuario->getIdUsuario()) ?>"><?php echo Util::getNomeSimplificado($usuario->getNome()); ?></a> <span class="divider">/</span>
            </li>
            <li class="active">
                <a href="<?php echo url_for("publicacao/exibir?u=".$publicacao->getIdPublicacao() ) ?>">Post</a>
            </li>
        </ul>

        <div id="stream">

            <ul>
                <?php echo $publicacao->getImpressao(); ?>
            </ul>

        </div><!-- stream -->


    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

                
        <div id="grid-conteudos" class="wdgt">
            <h3><a href="<?php echo url_for('perfil/exibirConteudos?u=' . $usuario->getIdUsuario()) ?>">Conteúdos seguidos <small><?php echo $quantidadeConteudoSeguido; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayConteudoSeguido as $conteudo): ?>
                    <?php $innerHTML = "<img src='".image_path($conteudo->getImagemPerfil())."' alt='". $conteudo->getNome() ."' title='".$conteudo->getNome()."'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudo->getNome(), "thumbnail") ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('perfil/exibirConteudos?u=' . $usuario->getIdUsuario()) ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-conteudos -->

        <?php /*<hr>

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
         */ ?>

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="<?php echo url_for('perfil/exibirAmigos?u=' . $usuario->getIdUsuario()) ?>" title="Ver tudo">Amigos <small><?php echo $quantidadeAmigos ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayAmigos as $amigo): ?>
                <li ><a href="<?php echo url_for('perfil/exibir?u='.$amigo->getIdUsuario()) ?>"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada()) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('perfil/exibirAmigos?u=' . $usuario->getIdUsuario()) ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->