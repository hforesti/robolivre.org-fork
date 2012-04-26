<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Robô Livre</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo image_path('/assets/img/rl/robo-icon.png') ?>" />
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le styles -->
        <?php include_stylesheets() ?>
        
        <!-- Le JQuery
        ================================================== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    </head>
        <?php if (!UsuarioLogado::getInstancia()->isLogado()) { ?>
        <body class="home">
        <?php } ?>
        <?php if (UsuarioLogado::getInstancia()->isLogado()) { ?>
        <body>
            <!-- Navbar
    ================================================== -->
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="<?php echo url_for("perfil/index") ?>">Robô Livre</a>
                        <div class="nav-collapse">
                            <ul class="nav">
                                <?php $class = ($sf_context->getModuleName()=="perfil"&& $sf_context->getActionName()=="index" )? "active" : "" ?>
                                <li class="<?php echo $class ?>">
                                    <a href="<?php echo url_for("perfil/index") ?>">Início</a>
                                </li>
                                
                                <?php $class = ($sf_context->getModuleName()=="conteudos"||$sf_context->getModuleName()=="conteudo")? "active" : "" ?>
                                <li class="<?php echo $class ?>">
                                    <a href="<?php echo url_for("conteudos/index") ?>">Conteúdos</a>
                                </li>
                                
                                <?php $class = $sf_context->getModuleName()=="comunidade"? "active" : "" ?>
                                <?php /*<li class="<?php echo $class ?>">
                                    <a href="<?php echo url_for("comunidades/index") ?>">Comunidades</a>
                                </li>*/ ?>
                                <li class="divider-vertical"></li>
                            </ul>
                            <?php /*<form id="form_busca_navbar" class="navbar-search pull-left" action="<?php echo url_for('perfil/lista') ?>">
                                <input type="text" class="search-query span4" placeholder="Buscar robôs, comunidades, amigos…">
                                <input id="searchsubmit" alt="Buscar" type="image" onclick="document.getElementById('form_busca_navbar').submit()" src="<?php echo image_path('/assets/img/rl/btn-search.png') ?>">
                            </form> */?>

                            <ul class="nav" id="user-menu">
                                <li class="dropdown">
                                    <?php $qtdMensagem = 5; ?>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-warning" title="<?php echo $qtdMensagem ?> mensagens não lidas"><?php echo $qtdMensagem ?></span> <img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_MINIATURA)) ?>" alt="<?php echo UsuarioLogado::getInstancia()->getNome(); ?>"> <?php echo Util::getNomeSimplificado(UsuarioLogado::getInstancia()->getNome());?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="inbox.shtml"><i class="icon-inbox icon-gray"></i> (<?php echo $qtdMensagem ?>) Minhas mensagens</a>
                                        </li>
                                        <li>

                                            <a href="<?php echo url_for('perfil/exibir?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><i class="icon-user icon-gray"></i> Ver meu perfil</a>

                                        </li>

                                        <li class="divider"></li>
                                        <li>
                                            <a href="settings.shtml"><i class="icon-cog icon-gray"></i> Configurações</a>
                                        </li>
                                        <li>
                                            <a href="help.shtml"><i class="icon-question-sign icon-gray"></i> Ajuda</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="logout-link">
                                            <a href="<?php echo url_for('perfil/logout'); ?>">Sair</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div id="conteudoPagina" class="container">
        <?php echo $sf_content ?>
        <hr>
        <div class="row" id="footer-utility">

            <div class="span3">
                <h4><a href="<?php echo url_for("institucional/index") ?>">Insitucional</a></h4>
                <ul>
                    <li><a href="<?php echo url_for("institucional/sobre") ?>">Sobre a Robô Livre</a></li>
                    <li><a href="<?php echo url_for("institucional/instituicoesParceiras") ?>">Instituições parceiras</a></li>
                    <li><a href="<?php echo url_for("institucional/clipping") ?>">Clipping</a></li>
                    <li><a href="<?php echo url_for("institucional/apresentacoes") ?>">Apresentações</a></li>
                    <li><a href="<?php echo url_for("institucional/publicacoesCientificas") ?>">Publicações científicas</a></li>
                </ul>
            </div>


            <div class="span3">
                <h4><a href="<?php echo url_for("termos/index") ?>">Termos legais</a></h4>
                <ul>
                    <li><a href="<?php echo url_for("termos/index") ?>">Termos de uso</a></li>
                    <li><a href="<?php echo url_for("termos/politica") ?>">Política de privacidade</a></li>
                </ul>
            </div>

            <div class="span3">
                <h4><a href="<?php echo url_for("ajuda/index") ?>">Ajuda</a></h4>
                <ul>
                    <li><a href="<?php echo url_for("ajuda/index") ?>">Iniciando no Robô Livre</a></li>
                    <li><a href="<?php echo url_for("ajuda/perguntas") ?>">Perguntas frequentes</a></li>
                </ul>
            </div>

            <?php /*<div class="span1">
                <h4><a href="loja.shtml">Loja</a></h4>
            </div>*/ ?>

            <div class="span2">
                <h4><a href="<?php echo url_for("contato/index") ?>">Contato</a></h4>
                <ul>
                    <li><a href="<?php echo url_for("contato/index") ?>">Fale Conosco</a></li>
                </ul>
            </div>


        </div>

        <!-- Footer
      ================================================== -->
      <footer class="footer">
		<hr>
		<div class="pull-left">
        <p>Esta obra está sob a licença <a href="http://creativecommons.org/licenses/by/3.0/br/deed.pt_BR">Creative Commons Atribuição 3.0 Brasil</a>
        </p>
        <p id="other-links"><a href="sobre.shtml">Créditos</a> / <a href="sobre.shtml">Reportar um erro</a>
        </p>
    	</div>
      <div id="co-workers" class="pull-right">
      	<ul>
      		<li class="heading"><h6>Financiado por</h6></li>
      		<li id="a-capes"><a href="http://www.capes.gov.br/" rel="co-worker" title="CAPES">CAPES</a></li>
      		<li id="a-cnpq"><a href="http://www.cnpq.br/" rel="co-worker" title="CNPq">CNPq</a></li>
      		<li id="a-facepe"><a href="http://www.facepe.br/" rel="co-worker" title="FACEPE">FACEPE</a></li>
      		<?php /* <li class="heading"><h6>Realização</h6></li>
      		<li id="a-mix"><a href="http://www.facepe.br/" rel="co-worker" title="Mix Tecnologia">Mix Tecnologia</a></li> */ ?>
      	</ul>
      </div>
      </footer>
    </div><!-- /container -->

    <script type="text/javascript">
        function url_for(path){
            return '<?php echo url_for('') ?>'+path;
        }
    </script>
    <!-- Le javascript
    ================================================== -->    
    <?php include_javascripts() ?>
    
    <div class="fade-rl"></div>
</body>
</html>