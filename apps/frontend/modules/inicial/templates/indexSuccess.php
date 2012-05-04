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
        <?php }else if(isset($mensagem)){ ?>
            <div class="span12">
                <div class="alert alert-success fade in">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <?php echo $mensagem ?>
                </div>
            </div>
        <?php }else if(isset($erro)){ ?>
            <div class="span12">
                <div class="alert alert-wa fade in">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <?php echo $erro ?>
                </div>
            </div>
        <?php } ?>
        <a class="brand span3" href="<?php echo url_for("inicial/index") ?>">Robô Livre</a>

        <div id="top-login" class="span4 pull-right">
            <?php include_partial('formLoginInicial', array('form' => $formLogin)) ?>
            <div class="modal fade" id="modalEsqueci">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Recuperar Senha</h3>
                </div>
                <div class="modal-body">
                    <form id="esqueci-form" method="post" class="form-inline" action="<?php echo url_for("inicial/esqueciSenha") ?>">

                        <div id="alerta-esqueci-senha" class="alert fade in">

                        </div>

                        <input id="email-esqueci" name="email" type="email" placeholder="Seu endereço de e-mail" class="span4" />

                        <input id="btn-recuperar-senha" value="Recuperar senha" type="submit" class="btn btn-primary" tabindex="4" />
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
            <?php echo Util::getNuvemTags(21, 10); ?>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#alerta-esqueci-senha").hide();
        });
        
        function getValue(id) {
            return document.getElementById(id).value;
        }
        
        $("#esqueci-form").submit(function(){
            try{
            
            $("#btn-recuperar-senha").append("<img src='<?php echo image_path('/assets/img/rl/loading.gif'); ?>' id='imagem-load' alt='Carregando'>");

            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxEsqueciSenha") . "?email='+getValue('email-esqueci')" ?>,
                success: function(resposta){
                    
                    $("#imagem-load").remove();
                    $("#alerta-esqueci-senha").show();

                    if(resposta == "false"){
                        $("#alerta-esqueci-senha").html("O endereço de email <strong>"+getValue('email-esqueci')+"</strong> não está cadastrado no nosso site. Tente novamente.");
                    }else{
                        $("#alerta-esqueci-senha").html(resposta);                        
                    }
                }
            });
            }catch(e){
                alert(e);
            }
            return false;
        });
    </script>