<?php
$valoresInciais = $form->getDefaults();
//Util::pre($valoresInciais);

$dia = "";
$mes = "";
$ano = "";
if ($valoresInciais['data_nascimento'] != null && $valoresInciais['data_nascimento'] != "") {
    $arrayData = explode("-", $valoresInciais['data_nascimento']);
//    Util::pre($arrayData);
    $dia = $arrayData[2];
    $mes = "" . $arrayData[1];
    $ano = $arrayData[0];
}
//echo "data: $dia/$mes/$ano<br/>";
?>




<form id="form-editar-info" class="form-horizontal" action="<?php echo url_for('perfil/editarRegistro'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <fieldset>
        <legend>Pessoais</legend>

        <div class="control-group">
            <label class="control-label" for="dresciption">Sobre você</label>
            <div class="controls">
                <?php echo $form->getWidget('sobre_mim')->render($form->getName() . "[sobre_mim]", $valoresInciais['sobre_mim'], array('class' => "span6", 'id' => 'dresciption', 'rows' => "5", 'placeholder' => "Descreva suas atividades e seus interesses em poucas palavras")); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="genero">Gênero</label>
            <div class="controls">
                <?php echo $form->getWidget('sexo')->render($form->getName() . "[sexo]", $valoresInciais['sexo'], array('class' => "span2", 'id' => 'genero')); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Data de nascimento</label>
            <div class="controls">
                <select class="span1" name="<?php echo $form->getName() ?>[data_nascimento][day]" id="dia">
                    <option <?php echo ($dia == "") ? "selected='selected'" : "" ?> value="">Dia</option>
                    <?php for ($i = 1; $i <= 31; ++$i) { ?>
                        <option <?php echo ($dia == $i) ? "selected='selected'" : "" ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
                <select class="span2" name="<?php echo $form->getName() ?>[data_nascimento][month]" id="mes">
                    <option <?php echo ($mes == "") ? "selected='selected'" : "" ?> value="">Mês</option>
                    <option <?php echo ($mes == "01") ? "selected='selected'" : "" ?> value="1">Janeiro</option>
                    <option <?php echo ($mes == "02") ? "selected='selected'" : "" ?> value="2">Fevereiro</option>
                    <option <?php echo ($mes == "03") ? "selected='selected'" : "" ?> value="3">Março</option>
                    <option <?php echo ($mes == "04") ? "selected='selected'" : "" ?> value="4">Abril</option>
                    <option <?php echo ($mes == "05") ? "selected='selected'" : "" ?> value="5">Maio</option>
                    <option <?php echo ($mes == "06") ? "selected='selected'" : "" ?> value="6">Junho</option>
                    <option <?php echo ($mes == "07") ? "selected='selected'" : "" ?> value="7">Julho</option>
                    <option <?php echo ($mes == "08") ? "selected='selected'" : "" ?> value="8">Agosto</option>
                    <option <?php echo ($mes == "09") ? "selected='selected'" : "" ?> value="9">Setembro</option>
                    <option <?php echo ($mes == "10") ? "selected='selected'" : "" ?> value="10">Outubro</option>
                    <option <?php echo ($mes == "11") ? "selected='selected'" : "" ?> value="11">Novembro</option>
                    <option <?php echo ($mes == "12") ? "selected='selected'" : "" ?> value="12">Dezembro</option>
                </select>

                <select id="ano" name="<?php echo $form->getName() ?>[data_nascimento][year]" class="span2">
                    <option value="">Ano</option>
                    <?php for ($i = date('Y'); $i >= 1900; --$i) { ?>
                        <option <?php echo ($ano == $i) ? "selected='selected'" : "" ?> value="<?php echo $i ?>"><?php echo $i ?></option>
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
                    <?php echo $form->getWidget('email')->render($form->getName() . "[email]", $valoresInciais['email'], array('class' => "span4", 'id' => 'email', 'placeholder' => "Ex: voce@email.com", 'type' => "email")); ?>
                    <span class="add-on">
                        <i class="icon-exclamation-sign icon-gray"></i>
                        Confirmado
                    </span>
                </div>
                <p class="help-block">
                    Atualizando seu email você receberá um link para confirmação no novo endereço informado.</p>
            </div>
            
            <?php /*<div class="control-group warning">
                <label class="control-label" for="email">E-mail <i class="icon-user icon-gray singletip" title="Apenas amigos podem ver"></i></label>
                <div class="controls">

                    <div class="input-append">
                        <input type="email" id="email" value="rodrigo@robolivre.org" placeholder="Ex: voce@email.com" class="span4"><span class="add-on"><i class="icon-exclamation-sign icon-gray"></i> Confirmação pendente</span>
                    </div>
                    <p class="help-block">É importante confirmarmos seu email. Verifique sua caixa de entrada e também de spam.<br><strong>Não recebeu nosso email de confirmação? <a href="#">Reenviar agora</a></strong></p>
                </div>

            </div>*/ ?>
        </div>


        <div class="control-group">
            <label class="control-label" for="site">Seu site ou blog</label>
            <div class="controls">
                <?php echo $form->getWidget('site')->render($form->getName() . "[site]", $valoresInciais['site'], array('class' => "span5", 'id' => 'site', 'placeholder' => "Ex: http://www.meusite.com", 'type' => "url")); ?>
            </div>
        </div>
    </fieldset>


    <fieldset>
        <legend>Educação</legend>
        <div class="control-group">
            <label class="control-label" for="escolaridade">Nível de Escolaridade</label>
            <div class="controls">
                <?php echo $form->getWidget('nivel_escolaridade')->render($form->getName() . "[nivel_escolaridade]", null, array('class' => "span3", 'id' => 'escolaridade')); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="escola">Escola/Instituição</label>
            <div class="controls">
                <?php echo $form->getWidget('escola')->render($form->getName() . "[escola]", $valoresInciais['escola'], array('class' => "span4", 'id' => 'escola', 'placeholder' => "Nome da escola ou instituição de ensino", 'type' => 'text')); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="curso">Curso (Opcional)</label>
            <div class="controls">
                <?php echo $form->getWidget('curso')->render($form->getName() . "[curso]", $valoresInciais['curso'], array('class' => "span4", 'id' => 'curso', 'placeholder' => "Nome do curso", 'type' => 'text')); ?>
                <p class="help-block">Exemplo: Direito, Engenharia, Tecnologia e Arte...</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="optionsCheckbox">Aulas Robô Livre <i class="icon-star-empty icon-gray"></i></label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $form->getWidget('aula_robolivre')->render($form->getName() . "[aula_robolivre]", ($valoresInciais['aula_robolivre'] != 0) ? $valoresInciais['aula_robolivre'] : false, array('id' => 'optionsCheckbox')); ?>
                    Sim, participo das aulas presenciais da Robô Livre <a href="sobre.shtml" title="Mais informações sobre nossas aulas" class="singletip"><i class="icon-info-sign"></i></a>
                </label> 
            </div>
        </div>

        <fieldset>
            <legend>Profissional</legend>
            <div class="control-group">
                <label class="control-label" for="profissao">Profissão ou cargo</label>
                <div class="controls">
                    <?php echo $form->getWidget('profissao')->render($form->getName() . "[profissao]", $valoresInciais['profissao'], array('class' => "span5", 'id' => 'profissao', 'placeholder' => "Ex: Estudante ou Gerente", 'type' => 'text')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="empresa">Empresa</label>
                <div class="controls">
                    <?php echo $form->getWidget('empresa')->render($form->getName() . "[empresa]", $valoresInciais['empresa'], array('class' => "span5", 'id' => 'profissao', 'placeholder' => "Nome da Empresa", 'type' => 'text')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="site-corp">Site da empresa</label>
                <div class="controls">
                    <?php echo $form->getWidget('site_empresa')->render($form->getName() . "[site_empresa]", $valoresInciais['site_empresa'], array('class' => "span5", 'id' => 'site-corp', 'placeholder' => "Ex: http://www.sitedaempresa.com", 'type' => "url")); ?>
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

