<div class="row">

<?php include_partial('sidebarUsuario',array('usuario'=>$usuario)) ?>

<hr class="only-mobile">
    
    <div class="span7">
        <?php if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::SOLICITADA_AMIZADE) { ?>
            <span class="alert pull-right">Aguardando resposta da sua solicitação de amizade.</span>
        <?php } ?>
<!--            <span class="alert alert-error pull-right">Usuário ignorado</span>-->
        
        <div class="well">
            <p>
                <?php if($usuario->getProfissao()!=""){?>
                    <strong><?php echo $usuario->getProfissao() ?></strong>
                    <?php if($usuario->getEmpresa()!=""){ ?>
                        em <?php echo $usuario->getEmpresa() ?>
                    <?php } ?>
                     ‧ 
                <?php } ?>
                <?php if($usuario->getSexo()!=""){ ?>
                    <strong>Sexo:</strong> <?php echo Sexo::getDescricao($usuario->getSexo()) ?> ‧ 
                <?php } ?>
                <?php if($usuario->getDataNascimento()!=""){ ?>
                    <strong>Idade:</strong> <?php echo Util::getIdadeUsuario($usuario->getDataNascimento())." anos" ?> 
                <?php } ?>
            </p>
            
            <a href="<?php echo url_for('perfil/informacao?u='.$usuario->getIdUsuario()) ?>" class="btn btn-primary btn-mini pull-right"><i class="icon-info-sign icon-white"></i> Mais sobre <?php echo Util::getNomeSimplificado($usuario->getNome()); ?></a>

            <p>
                <i class="icon-user icon-gray"></i> <small>Membro desde <?php echo Util::getDataInformacao($usuario->getDataCriacaoPerfil()) ?></small>
            </p>
        </div>
            
        <h3>Atualizações recentes</h3>

        <div id="stream">

            <ul id="ul-steam">
               
                <?php foreach ($publicacoesPerfil as $publicacao) { ?>                    
                        <?php print_r( $publicacao->imprimir());
                                
                            /*'formPublicacao',array('form' => $formPublicacao,
                            'id_publicacao_original' => $publicacao->getIdPublicacao(),
                            'id_usuario_original' => $publicacao->getIdUsuario()));*/ ?>
                        
                <?php } ?>
                
            </ul>


        </div><!-- stream -->

        <div class="btn-load-more" id="pagination"><a href="#pagination" onclick="getPublicacoesAntigas()" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>

    </div><!-- /miolo -->


    <div class="span3" id="sidebar-wdgt">

                
        <div id="grid-conteudos" class="wdgt">
            <h3><a href="conteudos.shtml">Conteúdos seguidos <small><?php echo $quantidadeConteudoSeguido; ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayConteudoSeguido as $conteudo): ?>
                    <?php $innerHTML = "<img src='".image_path($conteudo->getImagemPerfil())."' alt='". $conteudo->getNome() ."' title='".$conteudo->getNome()."'>"; ?>
                    <li class="span1"><?php echo Util::getTagConteudoSlug($innerHTML, $conteudo->getNome(), "thumbnail") ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="conteudos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
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
            <h3><a href="amigos.shtml" title="Ver tudo">Amigos <small><?php echo $quantidadeAmigos ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayAmigos as $amigo): ?>
                <li ><a href="<?php echo url_for('perfil/exibir?u='.$amigo->getIdUsuario()) ?>"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada()) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="amigos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

        <hr>

    </div><!-- /aside -->

</div><!-- /row -->


<!-- ====================== -->
<!-- ! Caixas de mensagem   -->
<!-- ====================== -->
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

<?php if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::SEM_SOLICITACAO) { ?>
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Adicionar amigo</h3>
    </div>
    <div class="modal-body">
        <p>Tem certeza de que deseja adicionar <strong><?php echo $usuario->getNome(); ?></strong> como amigo?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for('perfil/solicitarAmizade?u='.$usuario->getIdUsuario()) ?>" class="btn btn-primary">Adicionar</a> <a href="#" class="btn" data-dismiss="modal">Cancelar</a> 
    </div>
</div>
<?php } else if ($usuario->getTipoSolicitacaoAmizade() == Usuarios::AGUARDANDO_CONFIRMACAO) { ?>
<div class="modal fade" id="modalAdd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Responder solicitação</h3>
    </div>
    <div class="modal-body">
        <p>Deseja aceitar a solicitação de amizade de <strong><?php echo $usuario->getNome(); ?></strong>?</p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo url_for('perfil/aceitarSolicitacao') . "?u=" . $usuario->getIdUsuario() ?>" class="btn btn-primary">Aceitar</a> 
        <a href="<?php echo url_for('perfil/recusarSolicitacao') . "?u=" . $usuario->getIdUsuario() ?>" class="btn btn-danger">Rejeitar</a> 
        <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
    </div>
</div>
<?php } ?>

<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function getUltimoId(){
        t=document.getElementsByName('id_ultima_publicacao');
        return t[t.length-1].value;
    }
    
    function getPublicacoesAntigas() {        
        
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxReceberMaisPublicacaoPerfil") . "?id_usuario=".$usuario->getIdUsuario()."&ultimo_id_publicacao='+getUltimoId()" ?>,
                success: function(resposta){
                    if(resposta!=""){
                        $("#ul-steam").append(resposta);
                    }else{
                        $("#pagination").remove();
                    }
                }
            });
        
    }//END getPublicacoesAntigas
    
    
    $('#form-criar').submit(function(){
        validaForm();
        return false;
    });
    
    
    
    //]]>   
</script>