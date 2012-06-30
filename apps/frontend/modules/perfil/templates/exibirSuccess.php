<div class="row">

<?php 
if ($usuario->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()){
    include_partial('sidebarUsuarioLogado');
}else{
    include_partial('sidebarUsuario',array('usuario'=>$usuario)); 
}
?>

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
            <?php if(count($publicacoesPerfil['publicacoes'] )>0){  ?>
            <ul id="ul-steam">
               
                <?php foreach ($publicacoesPerfil['publicacoes'] as $publicacao) { ?>                    
                        <?php print_r( $publicacao->imprimir());
                                
                            /*'formPublicacao',array('form' => $formPublicacao,
                            'id_publicacao_original' => $publicacao->getIdPublicacao(),
                            'id_usuario_original' => $publicacao->getIdUsuario()));*/ ?>
                        
                <?php } ?>
                
            </ul>
            <?php }else{ ?>
            <div class="well">
                Usuário ainda não publicou em seu perfil
            </div>
            <?php } ?>

        </div><!-- stream -->
        <?php if($publicacoesPerfil['quantidade']>=10){ ?>
        <div class="btn-load-more" id="pagination"><a href="#pagination" onclick="getPublicacoesAntigas()" class="btn"><i class="icon-chevron-down"></i> Carregar atualizações mais antigas</a></div>
        <?php } ?>
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


<!-- ====================== -->
<!-- ! Caixas de mensagem   -->
<!-- ====================== -->

<div class="modal fade" id="modalDelete">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Excluir atualização</h3>
  </div>
  <div class="modal-body">
  <p>Tem certeza de que deseja excluir a atualização?</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-danger">Sim, excluir agora</a> <a href="#" class="btn" data-dismiss="modal">Decidir mais tarde</a> 
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
                        $('.visivel-para i').tooltip();
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