<!--#include virtual="includes/header-home.html" -->

<div class="container">
    <!-- Topo
      ================================================== -->
    <div class="row">
        <?php if ($formLogin->hasErrors()) { ?>
            <div class="span12">
                <div class="alert alert-error fade in">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <?php foreach ($formLogin->getErrorSchema() as $error): ?>
                        <?php echo $error ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php } ?>
        <a class="brand span3" href="<?php echo url_for("inicial/index") ?>">Robô Livre</a>

        <div id="top-login" class="span4 pull-right">
            <?php include_partial('formLogin', array('form' => $formLogin)) ?>
            <div class="modal fade" id="modalEsqueci">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Recuperar Senha</h3>
                </div>
                <div class="modal-body">
                    <form id="esqueci-form" class="form-inline" action="#">
                        <div class="alert fade in">
                            <strong>Tudo bem!</strong> Um link para recuperar sua senha foi enviado para o seu email <em>rodrigo@robolivre.org</em>.
                        </div>

                        <input id="email-esqueci" type="email" placeholder="Seu endereço de e-mail ou nome de usuário" class="span4" />

                        <input value="Recuperar senha" type="submit" class="btn btn-primary" tabindex="4" />


                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Fechar</a>
                </div>
            </div>
        </div>


    </div>

    <div class="row" id="intro">

        <div class="span6">
            <h1>É fácil fazer...</h1>
            <p>A robolivre.org é uma plataforma de desenvolvimento colaborativo e está disponível desde 2005 para ajudar a mostrar, que a robótica pode e deve ser desenvolvida por qualquer pessoa que tenha interesse. <a href="sobre.shtml">Mais sobre…</a></p>
        </div>


        <div class="span4 offset2">
            <?php include_partial('formNovoUsuario', array('form' => $formNovoUsuario)) ?>
        </div>

    </div><!-- /row -->

    <hr>

    <div class="row">

        <div class="span8">
            <h3>Conteúdos mais relevantes</h3>
            <a href="#" title="4 tópicos" style="font-size: 11.7006369427px;">Animação</a>
            <a href="#" title="5 tópicos" style="font-size: 12.2611464968px;">Bípede</a>
            <a href="#" title="4 tópicos" style="font-size: 11.7006369427px;">cattec</a>
            <a href="#" title="96 tópicos" style="font-size: 20.7388535032px;">Circuitos</a>
            <a href="#" title="42 tópicos" style="font-size: 18.2165605096px;">Código Fonte</a>
            <a href="#" title="6 tópicos" style="font-size: 12.7515923567px;">Com rodas</a>
            <a href="#" title="82 tópicos" style="font-size: 20.2484076433px;">Documento</a>
            <a href="#" title="7 tópicos" style="font-size: 13.101910828px;">GGBR4</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">GVTT3</a>
            <a href="#" title="147 tópicos" style="font-size: 22px;">Ibov</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">ITAU4</a>
            <a href="#" title="5 tópicos" style="font-size: 12.2611464968px;">ITUB4</a>
            <a href="#" title="18 tópicos" style="font-size: 15.7643312102px;">Evento</a>
            <a href="#" title="36 tópicos" style="font-size: 17.7961783439px;">LAD</a>
            <a href="#" title="5 tópicos" style="font-size: 12.2611464968px;">LAME4</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">Nasdaq</a>
            <a href="#" title="14 tópicos" style="font-size: 15.0636942675px;">New Highs New Lows</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">Programa</a>
            <a href="#" title="82 tópicos" style="font-size: 20.2484076433px;">Programação</a>
            <a href="#" title="5 tópicos" style="font-size: 12.2611464968px;">LAME4</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">Nasdaq</a>
            <a href="#" title="14 tópicos" style="font-size: 15.0636942675px;">New Highs New Lows</a>
            <a href="#" title="3 tópicos" style="font-size: 11px;">Programa</a>
            <a href="#" title="82 tópicos" style="font-size: 20.2484076433px;">Projeto</a>
        </div>

<!--        <div class="span4" id="grid-comunidades">
            <h3>Comunidades</h3>
            <ul class="thumbnails">
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
                <li class="span1"><a href="comunidade.shtml" class="thumbnail"><img src="http://placehold.it/60x60" alt="Nome da comunidade" title="Nome da comunidade"></a></li>
            </ul>
        </div>-->

        

        
        <div class="span4">

            <h3>Twitter @robolivre</h3>
            <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
            <script>new TWTR.Widget({  version: 2,  type: 'profile',  rpp: 2,  interval: 30000,  width: 'auto',  height: 300,  theme: {    shell: {      background: '#ffffff',      color: '#000000'    },    tweets: {      background: '#ffffff',      color: '#000000',      links: '#5aaffa'    }  },  features: {    scrollbar: false,    loop: false,    live: false,    behavior: 'all'  }}).render().setUser('robolivre').start();</script>
            <script type="txt/javascript">
                
            </script>
            <hr>

            <h3>Facebook</h3>
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Frobolivre&amp;send=false&amp;layout=standard&amp;width=300&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80&amp;appId=183003458415333" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:80px;" allowTransparency="true"></iframe>
        </div>

    </div><!-- /row -->

    <!--#include virtual="includes/footer.html" -->
