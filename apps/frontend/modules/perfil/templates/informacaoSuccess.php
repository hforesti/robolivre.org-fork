
<div class="row">

        <?php include_partial('sidebarUsuario',array('usuario'=>$usuario,'opcao'=>'informacao')) ?>


	<hr class="only-mobile">

	<div class="span7">

		<ul class="breadcrumb">
			<li>
                            <a href="<?php echo url_for('perfil/index');?>">Início</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="<?php echo url_for('perfil/exibir?u='.$usuario->getIdUsuario());?>"><?php echo Util::getNomeSimplificado($usuario->getNome()); ?></a> <span class="divider">/</span>
                        </li>
                        <li class="active">
                            <a href="<?php echo url_for('perfil/informacao?u='.$usuario->getIdUsuario()); ?>">Informações sobre <?php echo Util::getNomeSimplificado($usuario->getNome()); ?></a>
                        </li>
		</ul>

		<div clas="entry">
			<h6><i class="icon-user icon-gray"></i> Sobre <?php echo Util::getNomeSimplificado($usuario->getNome()); ?></h6>
			<!-- modelo de mensagens -->
			<!-- 
			<p class="alert alert-error"><i class="icon-exclamation-sign icon-gray"></i> Usuário ignorado</p>
			<p class="alert pull-right"><i class="icon-exclamation-sign icon-gray"></i> Aguardando resposta da sua solicitação de amizade.</p>
			<a href="profile-info-editar.shtml" class="btn btn-primary pull-right"><i class="icon-edit icon-white"></i> Editar perfil</a> -->

			<!-- modelo de botao para editar perfil caso seja o perfil dele -->
			<!-- <a href="profile-info-editar.shtml" class="btn btn-primary pull-right"><i class="icon-edit icon-white"></i> Editar perfil</a> -->

			<?php echo Util::getTextoFormatado($usuario->getSobreMim()) ?>

		<p class="row">
                        <?php if($usuario->getSexo()!=""){ ?>
                            <span class="span3"><strong>Sexo:</strong> <?php echo Sexo::getDescricao($usuario->getSexo()) ?></span> 
                        <?php } ?>
                        <?php if($usuario->getDataNascimento()!=""){ ?>
                            <span class="span3"><strong>Idade:</strong> <?php echo Util::getIdadeUsuario($usuario->getDataNascimento())." anos" ?> </span>
                        <?php } ?>
		</p>
                <p><small>Membro desde <?php echo Util::getDataInformacao($usuario->getDataCriacaoPerfil()) ?></small></p>

		<hr>

                
                <?php if($usuario->getSite()!="" || $usuario->getEmail()!=""){ ?>
		<h6><i class="icon-envelope icon-gray"></i> Contatos</h6>
		<p class="row">
                        <?php if($usuario->getSite()!=""){ ?>
                            <span class="span3"><strong>Website:</strong> <a href="<?php echo $usuario->getSite();?>"><?php echo $usuario->getSite();?></a></span>
                        <?php } ?>
                            
                        <?php if($usuario->getEmail()!="" && ($usuario->getTipoSolicitacaoAmizade()== Usuarios::PROPRIO_USUARIO || $usuario->getTipoSolicitacaoAmizade()== Usuarios::AMIGO)){ ?>
                            <span class="span3"><strong>Email:</strong> <i class="icon-user icon-gray singletip" title="Apenas amigos"></i><?php echo $usuario->getEmail();?></span>
                        <?php } ?>
		</p>

		<hr>
                <?php } ?>
                
                <?php if($usuario->getProfissao() !="" || $usuario->getSiteEmpresa()!=""){ ?>
                    <h6><i class="icon-folder-close icon-gray"></i> Profissional</h6>
                    <p class="row">
                           <?php if($usuario->getProfissao()!=""){?>
                            <span class="span3">
                                <strong><?php echo $usuario->getProfissao() ?></strong>
                                <?php if($usuario->getEmpresa()!=""){ ?>
                                    em <?php echo $usuario->getEmpresa() ?>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <?php if($usuario->getSiteEmpresa ()!=""){?>
                            <span class="span3"><strong>Site da Empresa:</strong> <a href="<?php echo $usuario->getSiteEmpresa(); ?>"><?php echo $usuario->getSiteEmpresa(); ?></a></span>
                            <?php } ?>
                    </p>

                    <hr>
                <?php } ?>
                    
                <?php if($usuario->getNivelEscolaridade() !="" || $usuario->getEscola()!="" || $usuario->getCurso()!=""){ ?>   
		<h6><i class="icon-book icon-gray"></i> Escolaridade</h6>
		<p class="row">
                        <?php if($usuario->getNivelEscolaridade() !=""){ ?>
                            <span class="span3"><strong>Escolaridade:</strong> <?php echo NiveisEscolaridade::getDescricao($usuario->getNivelEscolaridade()) ?></span>
                        <?php } ?>
                        <?php if($usuario->getEscola() !=""){ ?>
        			<span class="span3"><strong>Escola / Instituição:</strong> <?php echo $usuario->getEscola() ?></span>
                        <?php } ?>
                        <?php if($usuario->getCurso() !=""){ ?>
                            <span class="span7"><strong>Curso:</strong> <?php echo $usuario->getCurso() ?></span>
                        <?php } ?>
		</p>
                <?php } ?>    

	</div><!-- /entry -->

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

        <hr>

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

        <div id="grid-amigos" class="wdgt">
            <h3><a href="amigos.shtml" title="Ver tudo">Amigos <small><?php echo $quantidadeAmigos ?></small></a></h3>
            <ul class="thumbnails">
                <?php foreach($arrayAmigos as $amigo): ?>
                <li ><a href="<?php echo url_for('perfil/exibir?u='.$amigo->getIdUsuario()) ?>"><img src="<?php echo image_path($amigo->getImagemPerfilFormatada()) ?>" alt="<?php echo $amigo->getNome() ?>" title="<?php echo $amigo->getNome() ?>"></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="amigos.shtml" class="more" title="Ver tudo"><i class="icon-chevron-right"></i></a>
        </div><!-- grid-amigos -->

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