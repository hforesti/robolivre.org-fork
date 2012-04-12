<?php 

$dia = "";
$mes = "";
$ano = "";


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
                        <input type="hidden" name="sf_method" value="put" />
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
                                            <?php echo $form->getWidget('sobre_mim')->render($form->getName() . "[sobre_mim]", null, array('class'=>"span6",'id' => 'dresciption','rows'=>"5", 'placeholder' => "Descreva suas atividades e seus interesses em poucas palavras")); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="genero">Gênero</label>
					<div class="controls">
                                            <?php echo $form->getWidget('sexo')->render($form->getName() . "[sexo]", null, array('class'=>"span2",'id' => 'genero')); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Data de nascimento</label>
					<div class="controls">
						<select class="span1" id="dia">
                                                    <option <?php echo ($dia=="")?"selected='selected'":"" ?> value="">Dia</option>
                                                    <?php for($i =  1; $i<=31;++$i){ ?>
                                                    <option <?php echo ($dia==$i)?"selected='selected'":"" ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
						</select>
						<select class="span2" id="mes">
                                                    <option <?php echo ($mes=="")?"selected='selected'":"" ?> value="">Mês</option>
                                                    <option <?php echo ($mes=="1")?"selected='selected'":"" ?> value="1">Janeiro</option>
                                                    <option <?php echo ($mes=="2")?"selected='selected'":"" ?> value="2">Fevereiro</option>
                                                    <option <?php echo ($mes=="3")?"selected='selected'":"" ?> value="3">Março</option>
                                                    <option <?php echo ($mes=="4")?"selected='selected'":"" ?> value="4">Abril</option>
                                                    <option <?php echo ($mes=="5")?"selected='selected'":"" ?> value="5">Maio</option>
                                                    <option <?php echo ($mes=="6")?"selected='selected'":"" ?> value="6">Junho</option>
                                                    <option <?php echo ($mes=="7")?"selected='selected'":"" ?> value="7">Julho</option>
                                                    <option <?php echo ($mes=="8")?"selected='selected'":"" ?> value="8">Agosto</option>
                                                    <option <?php echo ($mes=="9")?"selected='selected'":"" ?> value="9">Setembro</option>
                                                    <option <?php echo ($mes=="10")?"selected='selected'":"" ?> value="10">Outubro</option>
                                                    <option <?php echo ($mes=="11")?"selected='selected'":"" ?> value="11">Novembro</option>
                                                    <option <?php echo ($mes=="12")?"selected='selected'":"" ?> value="12">Dezembro</option>
						</select>

						<select id="ano" class="span2">
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
							<input type="email" id="email" value="rodrigo@robolivre.org" placeholder="Ex: voce@email.com" class="span4"><span class="add-on"><i class="icon-ok icon-gray"></i> Confirmado</span>
						</div>
						<p class="help-block">
							Atualizando seu email você receberá um link para confirmação no novo endereço informado.</p>
						</div>
					</div>

					<!-- modelo para email não confirmado ainda -->
			<!-- <div class="control-group warning">
			<label class="control-label" for="email">E-mail <i class="icon-user icon-gray singletip" title="Apenas amigos podem ver"></i></label>
	            <div class="controls">
	            
	            <div class="input-append">
                	<input type="email" id="email" value="rodrigo@robolivre.org" placeholder="Ex: voce@email.com" class="span4"><span class="add-on"><i class="icon-exclamation-sign icon-gray"></i> Confirmação pendente</span>
                </div>
				<p class="help-block">É importante confirmarmos seu email. Verifique sua caixa de entrada e também de spam.<br><strong>Não recebeu nosso email de confirmação? <a href="#">Reenviar agora</a></strong></p>
				</div>

			</div> -->
			<div class="control-group">
				<label class="control-label" for="site">Seu site ou blog</label>
				<div class="controls">
					<input type="url" id="site" value="" placeholder="Ex: http://www.meusite.com" class="span5">
				</div>
			</div>
		</fieldset>


		<fieldset>
			<legend>Educação</legend>
			<div class="control-group">
				<label class="control-label" for="escolaridade">Nível de Escolaridade</label>
				<div class="controls">
					<select class="span3" id="escolaridade">
						<option value="">Nível</option>
						<option value="1">Ensino fundamental</option>
						<option value="2">Ensino fundamental incompleto</option>
						<option value="3">Ensino médio</option>
						<option value="4">Ensino médio incompleto</option>
						<option value="5">Ensino superior</option>
						<option value="6">Ensino superior incompleto</option>
						<optgroup label="Pós-graduação">
							<option value="7">Especialização</option>
							<option value="8">Mestrado</option>
							<option value="9">Doutorado</option>
							<option value="10">Pós-doutorado</option>
						</optgroup>
						<option value="11">Outro</option>
					</select>
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
					<input type="text" id="curso" value="Tecnologia e Arte Digital" placeholder="Nome do curso" class="span4">
					<p class="help-block">Exemplo: Direito, Engenharia, Tecnologia e Arte...</p>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="optionsCheckbox">Aulas Robô Livre <i class="icon-star-empty icon-gray"></i></label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" id="optionsCheckbox" value="option1">
						Sim, participo das aulas presenciais da Robô Livre <a href="sobre.shtml" title="Mais informações sobre nossas aulas" class="singletip"><i class="icon-info-sign"></i></a>
					</label> 
				</div>
			</div>

			<fieldset>
				<legend>Profissional</legend>
				<div class="control-group">
					<label class="control-label" for="profissao">Profissão ou cargo</label>
					<div class="controls">
						<input type="text" id="profissao" value="Interaction Designer" placeholder="Ex: Estudante ou Gerente" class="span5">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="empresa">Empresa</label>
					<div class="controls">
						<input type="text" id="empresa" value="Robô Livre" placeholder="Nome da Empresa" class="span5">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="site-corp">Site da empresa</label>
					<div class="controls">
						<input type="url" id="site-corp" value="" placeholder="Ex: http://www.sitedaempresa.com" class="span5">
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


<!--#include virtual="includes/footer.html" -->