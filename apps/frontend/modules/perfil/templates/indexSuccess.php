<div class="row">

    <?php include_partial('sidebarUsuarioLogado') ?>

    <hr class="only-mobile">

    <div class="span7">

        <?php include_partial('formPublicacao', array('form' => $formPublicacao, 'id_usuario_referencia' => null)) ?>

        <hr>


        <div id="stream" class="tabbable">
                <div class="row">
            <div class="tab-content">
                <ul class="nav nav-tabs pull-right" id="tabs-home">
                    <li class="no-link">
                        <h6>Atualizações recentes de:</h6>
                    </li>
                    <li class="<?php echo ($iniciaTabAmigo)?"":"active" ?>">
                        <a href="#1" data-toggle="tab"><h3><i class="icon-tag icon-gray"></i> Conteúdos</h3></a>
                    </li>
                    <li class="<?php echo ($iniciaTabAmigo)?"active":"" ?>">
                        <a href="#2" data-toggle="tab"><h3><i class="icon-user icon-gray"></i> Perfil e Amigos</h3></a>
                    </li>
                </ul>

                <!-- ================================== -->
                <!-- ! TAB: Atualizações de "Conteúdos"   -->
                <!-- ================================== -->
                <div class="span7 tab-pane fade in <?php echo ($iniciaTabAmigo)?"":"active" ?>" id="1">

<!-- <a href="#" class="btn btn-primary" id="refresh"><i class="icon-refresh icon-white"></i> 6 novas atualizações. Exibir agora.</a> -->

                    <ul id="ul-steam-conteudos">
                        <?php foreach ($publicacoesHome['conteudos']['publicacoes'] as $publicacao) { ?>                    
                            <?php
                            echo $publicacao->imprimir();

                            /* 'formPublicacao',array('form' => $formPublicacao,
                              'id_publicacao_original' => $publicacao->getIdPublicacao(),
                              'id_usuario_original' => $publicacao->getIdUsuario())); */
                            ?>

<?php } ?>
                    </ul>
                    <?php if($publicacoesHome['conteudos']['quantidade']>=10){?>
                    <div id="pagination" class="btn-load-more"><a href="#pagination" onclick="atualizaDados(1)" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
                    <?php } ?>
                </div><!-- tab-pane #1 -->




                <!-- ============================================================================= -->
                <!-- ! =========================================================================   -->
                <!-- ============================================================================= -->




                <!-- ========================== -->
                <!-- ! TAB: Atualizações sociais   -->
                <!-- ========================== -->
                
                <div class="span7 tab-pane fade in <?php echo ($iniciaTabAmigo)?"active":"" ?>" id="2">
                    <?php if(count($publicacoesHome['amigos']['publicacoes'])>0){ ?>
                        <ul id="ul-steam-amigos">
                            <?php foreach ($publicacoesHome['amigos']['publicacoes'] as $publicacao) { ?>                    
                                <?php
                                echo $publicacao->imprimir();

                                /* 'formPublicacao',array('form' => $formPublicacao,
                                'id_publicacao_original' => $publicacao->getIdPublicacao(),
                                'id_usuario_original' => $publicacao->getIdUsuario())); */
                                ?>

                        <?php } ?>
                        </ul>
                        <?php if($publicacoesHome['amigos']['quantidade']>=10){?>
                        <div id="pagination2" class="btn-load-more"><a href="#pagination2" onclick="atualizaDados(2)" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
                        <?php }?>
                    <?php }else{ ?>
                        <div class="well">
                                <p>Nesta aba você sempre verá atualizações publicadas por você, pelos seus amigos e atividades como novas amizades da sua rede.</p>
                        </div>
                    <?php } ?>
                    
                </div><!-- tab-pane #2 -->

            </div><!-- tab-content -->
                </div>
        </div><!-- stream -->



    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

        <div id="grid-conteudos" class="wdgt">
            <h3><a href="<?php echo url_for('perfil/exibirConteudosHome') ?>">Conteúdos seguidos <small><?php echo $quantidadeConteudoSeguido; ?></small></a></h3>
            <?php if(count($arrayConteudoSeguido)==0 || (count($arrayConteudoSeguido)==1 && $arrayConteudoSeguido[0]->getIdConjunto()==0)){ ?>
            <div class="alert"><a href="<?php echo url_for("conteudos/index") ?>">Descubra conteúdos para seguir</a></div>
            <?php } ?>
            <ul class="thumbnails">
                <?php foreach ($arrayConteudoSeguido as $conteudo): ?>
                    <?php $innerHTML = "<img src='" . image_path($conteudo->getImagemPerfil()) . "' alt='" . $conteudo->getNome() . "' title='" . $conteudo->getNome() . "'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudo->getNome(), "thumbnail") ?></li>
            <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('perfil/exibirConteudosHome') ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
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
                </div> grid-comunidades */?>

        <hr>

        <div id="grid-amigos" class="wdgt">
            <h3><a href="<?php echo url_for('perfil/exibirAmigosHome') ?>" title="Ver tudo">Amigos <small><?php echo $quantidadeAmigos ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayAmigos as $amigo): ?>
                <li ><a href="<?php echo url_for('perfil/exibir?u='.$amigo->getIdUsuario()) ?>"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada()) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo url_for('perfil/exibirAmigosHome') ?>" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->

<div class="modal fade" id="modalDelete">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Excluir atualização</h3>
  </div>
  <div class="modal-body">
  <p>Tem certeza de que deseja excluir a atualização?</p>
  </div>
  <div class="modal-footer">
      <a href="<?php echo url_for('publicacao/remover?u=') ?>" class="btn btn-danger">Sim, excluir agora</a>
    <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
  </div>
</div>

<div class="modal fade" id="modalAbuse">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Reportar abuso</h3>
  </div>
  <div class="modal-body">
  <p>Tem certeza de que deseja reportar a atualização para nossa equipe?</p>
  <p><small>Reporte caso ache que essa atualização apresenta conteúdo ofensivo, inadequado ou propaganda indesejada (spam).</small></p>
  
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-danger">Reportar</a> <a href="#" class="btn" data-dismiss="modal">Deixa pra lá</a> 
  </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function getUltimoIdConteudos(){
        t=document.getElementById('1').getElementsByClassName('input-id-ultima-publicacao');
        return t[t.length-1].value;
    }
    
    function getUltimoIdAmigos(){
        t=document.getElementById('2').getElementsByClassName('input-id-ultima-publicacao');
        return t[t.length-1].value;
    }
    
    function getPublicacoesAntigasAmigos() {        
        $.ajax({
            url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoAmigosHome") . "?ultimo_id_publicacao='+getUltimoIdAmigos()" ?>,
            success: function(resposta){
                if(resposta!=""){
                    $("#ul-steam-amigos").append(resposta);
                    $('.visivel-para i').tooltip();
                }else{
                    $("#pagination2").remove();
                }
            }
        });
        
    }//END getPublicacoesAntigas
    
    function getPublicacoesAntigasConteudos() {      
        $.ajax({
            url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoConteudosHome") . "?ultimo_id_publicacao='+getUltimoIdConteudos()" ?>,
            success: function(resposta){
                if(resposta!=""){
                    $("#ul-steam-conteudos").append(resposta);
                    $('.visivel-para i').tooltip();
                }else{
                    $("#pagination").remove();
                }
            }
        });
    }//END getPublicacoesAntigas
    
    
    function atualizaDados(tipo){
        if(tipo==1){
            getPublicacoesAntigasConteudos();
        }else if(tipo==2){
            getPublicacoesAntigasAmigos();
        }
    }
    
    //]]>   
</script>