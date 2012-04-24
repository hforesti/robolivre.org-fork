<?php 
$valoresInciais = $form->getDefaults();
//Util::pre($valoresInciais);

$dia = "";
$mes = "";
$ano = "";
if($valoresInciais['data_nascimento']!=null && $valoresInciais['data_nascimento']!=""){
    $arrayData = explode("-", $valoresInciais['data_nascimento']);
//    Util::pre($arrayData);
    $dia = $arrayData[2];
    $mes = "".$arrayData[1];
    $ano = $arrayData[0];
    
}
//echo "data: $dia/$mes/$ano<br/>";
?>

<div class="row">

	<div class="span2" id="sidebar">
        <div class="avatar">
            <a href="<?php url_for('perfil/index'); ?>"><img src="<?php echo image_path(UsuarioLogado::getInstancia()->getImagemPerfilFormatada(Util::IMAGEM_GRANDE)); ?>" alt="<?php echo UsuarioLogado::getInstancia()->getNome(); ?>" class="photo"></a>
            <div class="btn-group">
                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Opções">
                    <span class="icon-cog icon-gray"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo url_for('perfil/atualizarFoto') ?>">Atualizar foto</a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('perfil/editarPerfil?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>">Editar perfil</a>
                    </li>
                </ul>
            </div>

            <h1><?php echo UsuarioLogado::getInstancia()->getNome(); ?></h1>

        </div><!-- /avatar -->

        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="<?php url_for('perfil/index'); ?>"><span class="icon-gray icon-refresh"></span> Atualizações</a></li>
            <li><a href="<?php echo url_for('perfil/exibirConteudos?u='.UsuarioLogado::getInstancia()->getIdUsuario()) ?>"><span class="icon-gray icon-file"></span> Conteúdos</a></li>
            <li><a href="comunidades.shtml"><span class="icon-gray icon-comment"></span> Comunidades</a></li>
            <li><a href="<?php echo url_for('perfil/solicitacoes') ?>"><?php if (UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() > 0) { ?><span class="label label-warning" title="<?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?> nova(s) solicitações de amizade"><?php echo UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes() ?></span><?php } ?><span class="icon-gray icon-user"></span> Amigos</a></li>
            <li><a href="eventos.shtml"><span class="icon-gray icon-calendar"></span> Eventos</a></li>
            <li><a href="projetos.shtml"><span class="icon-gray icon-folder-open"></span> Projetos</a></li>
            <li><hr></li>
            <li><a href="inbox.shtml"><span class="label label-warning" title="0 mensagens não lidas"></span> <span class="icon-gray icon-envelope"></span> Mensagens</a></li>
        </ul>
    </div><!-- /sidebar -->

	<hr class="only-mobile">

	<div class="span10">

		<ul class="breadcrumb">
			<li>
				<a href="profile-home.shtml">Início</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="perfil.shtml">Rodrigo Medeiros</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="perfil-info.shtml">Informações sobre Rodrigo</a> <span class="divider">/</span>
			</li>
			<li class="active">
				Editar perfil
			</li>
		</ul>

                <form id="form-editar-info" class="form-horizontal" action="<?php echo url_for('perfil/editarRegistro'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
                        <?php if (!$form->getObject()->isNew()): ?>
                            <input type="hidden" name="sf_method" value="put" />
                        <?php endif; ?>
			<fieldset>
				<legend>Configurações e imagem</legend>
				<div class="control-group">

					<a href="settings.shtml" class="btn btn-mini"><i class="icon-cog icon-gray"></i> Alterar senha, nome e configurações</a> 
					<a href="settings-avatar.shtml" class="btn btn-mini"><i class="icon-picture icon-gray"></i> Alterar minha imagem</a>
				</div>

			</fieldset>

			<fieldset>
				<legend>Pessoais</legend>

				<div class="control-group">
					<label class="control-label" for="dresciption">Sobre você</label>
					<div class="controls">
                                            <?php echo $form->getWidget('sobre_mim')->render($form->getName() . "[sobre_mim]", $valoresInciais['sobre_mim'], array('class'=>"span6",'id' => 'dresciption','rows'=>"5", 'placeholder' => "Descreva suas atividades e seus interesses em poucas palavras")); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="genero">Gênero</label>
					<div class="controls">
                                            <?php echo $form->getWidget('sexo')->render($form->getName() . "[sexo]", $valoresInciais['sexo'], array('class'=>"span2",'id' => 'genero')); ?>
					</div>
				</div>
                                
				<div class="control-group">
					<label class="control-label">Data de nascimento</label>
					<div class="controls">
                                                <select class="span1" name="<?php echo $form->getName() ?>[data_nascimento][day]" id="dia">
                                                    <option <?php echo ($dia=="")?"selected='selected'":"" ?> value="">Dia</option>
                                                    <?php for($i =  1; $i<=31;++$i){ ?>
                                                    <option <?php echo ($dia==$i)?"selected='selected'":"" ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
						</select>
						<select class="span2" name="<?php echo $form->getName() ?>[data_nascimento][month]" id="mes">
                                                    <option <?php echo ($mes=="")?"selected='selected'":"" ?> value="">Mês</option>
                                                    <option <?php echo ($mes=="01")?"selected='selected'":"" ?> value="1">Janeiro</option>
                                                    <option <?php echo ($mes=="02")?"selected='selected'":"" ?> value="2">Fevereiro</option>
                                                    <option <?php echo ($mes=="03")?"selected='selected'":"" ?> value="3">Março</option>
                                                    <option <?php echo ($mes=="04")?"selected='selected'":"" ?> value="4">Abril</option>
                                                    <option <?php echo ($mes=="05")?"selected='selected'":"" ?> value="5">Maio</option>
                                                    <option <?php echo ($mes=="06")?"selected='selected'":"" ?> value="6">Junho</option>
                                                    <option <?php echo ($mes=="07")?"selected='selected'":"" ?> value="7">Julho</option>
                                                    <option <?php echo ($mes=="08")?"selected='selected'":"" ?> value="8">Agosto</option>
                                                    <option <?php echo ($mes=="09")?"selected='selected'":"" ?> value="9">Setembro</option>
                                                    <option <?php echo ($mes=="10")?"selected='selected'":"" ?> value="10">Outubro</option>
                                                    <option <?php echo ($mes=="11")?"selected='selected'":"" ?> value="11">Novembro</option>
                                                    <option <?php echo ($mes=="12")?"selected='selected'":"" ?> value="12">Dezembro</option>
						</select>

						<select id="ano" name="<?php echo $form->getName() ?>[data_nascimento][year]" class="span2">
                                                    <option value="">Ano</option>
                                                    <?php for($i =  date('Y'); $i>=1900;--$i){ ?>
                                                    <option <?php echo ($ano==$i)?"selected='selected'":"" ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
						</select>

					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Contatos</legend>
				<div class="control-group">
					<label class="control-label" for="email">E-mail <i class="icon-user icon-gray singletip" title="Apenas amigos podem ver"></i></label>

					<div class="controls">
						<div class="input-append">
                                                        <?php echo $form->getWidget('email')->render($form->getName() . "[email]", $valoresInciais['email'], array('class'=>"span4",'id' => 'email', 'placeholder' => "Ex: voce@email.com",'type'=>"email")); ?>
                                                        <span class="add-on"><i class="icon-ok icon-gray"></i> Confirmado</span>
						</div>
						<p class="help-block">
							Atualizando seu email você receberá um link para confirmação no novo endereço informado.</p>
						</div>
					</div>

					
			<div class="control-group">
				<label class="control-label" for="site">Seu site ou blog</label>
				<div class="controls">
                                        <?php echo $form->getWidget('site')->render($form->getName() . "[site]", $valoresInciais['site'], array('class'=>"span5",'id' => 'site', 'placeholder' => "Ex: http://www.meusite.com",'type'=>"url")); ?>
				</div>
			</div>
		</fieldset>


		<fieldset>
			<legend>Educação</legend>
			<div class="control-group">
				<label class="control-label" for="escolaridade">Nível de Escolaridade</label>
				<div class="controls">
                                        <?php echo $form->getWidget('nivel_escolaridade')->render($form->getName() . "[nivel_escolaridade]", null, array('class'=>"span3",'id' => 'escolaridade')); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="escola">Escola/Instituição</label>
				<div class="controls">
					<input type="text" id="escola" value="UFPE" placeholder="Nome" class="span5">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="curso">Curso (Opcional)</label>
				<div class="controls">
                                        <?php echo $form->getWidget('curso')->render($form->getName() . "[curso]", $valoresInciais['curso'], array('class'=>"span4",'id' => 'curso', 'placeholder' => "Nome do curso",'type'=>'text')); ?>
					<p class="help-block">Exemplo: Direito, Engenharia, Tecnologia e Arte...</p>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="optionsCheckbox">Aulas Robô Livre <i class="icon-star-empty icon-gray"></i></label>
				<div class="controls">
					<label class="checkbox">
                                                <?php echo $form->getWidget('aula_robolivre')->render($form->getName() . "[aula_robolivre]", ($valoresInciais['aula_robolivre']!=0)?$valoresInciais['aula_robolivre']:false, array('id' => 'optionsCheckbox')); ?>
						Sim, participo das aulas presenciais da Robô Livre <a href="sobre.shtml" title="Mais informações sobre nossas aulas" class="singletip"><i class="icon-info-sign"></i></a>
					</label> 
				</div>
			</div>

			<fieldset>
				<legend>Profissional</legend>
				<div class="control-group">
					<label class="control-label" for="profissao">Profissão ou cargo</label>
					<div class="controls">
                                                <?php echo $form->getWidget('profissao')->render($form->getName() . "[profissao]", $valoresInciais['profissao'], array('class'=>"span5",'id' => 'profissao', 'placeholder' => "Ex: Estudante ou Gerente",'type'=>'text')); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="empresa">Empresa</label>
					<div class="controls">
                                                <?php echo $form->getWidget('empresa')->render($form->getName() . "[empresa]", $valoresInciais['empresa'], array('class'=>"span5",'id' => 'profissao', 'placeholder' => "Nome da Empresa",'type'=>'text')); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="site-corp">Site da empresa</label>
					<div class="controls">
                                            <?php echo $form->getWidget('site_empresa')->render($form->getName() . "[site_empresa]", $valoresInciais['site_empresa'], array('class'=>"span5",'id' => 'site-corp', 'placeholder' => "Ex: http://www.sitedaempresa.com",'type'=>"url")); ?>
					</div>
				</div>

			</fieldset>
                        <input type="hidden" name="tp_frm" value="<?php $form->getTipoFormulario(); ?>" />
                        <?php echo $form->renderHiddenFields() ?>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary" id="update-info">Salvar informações</button>
			</div>

		</fieldset>

	</form>


</div><!-- /miolo -->


</div><!-- /row -->