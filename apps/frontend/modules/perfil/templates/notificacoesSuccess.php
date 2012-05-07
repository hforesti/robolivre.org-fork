<?php
$arrayNotificacoes = UsuarioLogado::getInstancia()->getSolicitacoesPendentes();
//Util::pre(array_keys($arrayNotificacoes));
?>

<div class="row">

    <?php include_partial('sidebarUsuarioLogado', array('opcao' => 'noficicacoes')) ?>


    <hr class="only-mobile">

    <div class="span10">

        <div id="stream">

            <div class="page-header">
                <h1>Notificações ‧ <small><span class="notf-num">2</span> <span class="notf-txt-num">não lidas</span></small> </h1>
            </div>
            <?php foreach (array_keys($arrayNotificacoes) as $data) { ?>
                <?php $notificacoes = $arrayNotificacoes[$data]; ?>                    
                <h4>Recebido <?php echo $data ?></h4>
                <ul class="notifications">
                    <?php foreach ($notificacoes as $notificacao) { ?>    
                        <?php if ($notificacao instanceof Amigos) { ?>

                            <li class="vcard activity">
                                <div class="notf">
                                    <a href="<?php echo url_for('perfil/exibir') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="photo"><img src="<?php echo Util::validaImagem($notificacao->getImagemPerfilUsuarioSolicitacao(), Util::IMAGEM_MINIATURA, Util::TIPO_IMAGEM_USUARIO) ?>" alt="<?php echo $notificacao->getNomeUsuarioSolicitacao() ?>" title="<?php echo $notificacao->getNomeUsuarioSolicitacao() ?>"></a>
                                    <a href="<?php echo url_for('perfil/exibir') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="fn"><?php echo $notificacao->getNomeUsuarioSolicitacao() ?></a> enviou uma solicitação de amizade <span class="time" title="<?php echo Util::getDataFormatada($notificacao->getDataSolicitacao()) ?>"><?php echo Util::getDataSimplificada($notificacao->getDataSolicitacao()) ?></span>
                                </div>

                                <div class="actions">
                                    <a href="<?php echo url_for('perfil/aceitarSolicitacao') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="btn btn-mini btn-primary">Aceitar</a> 
                                    <a href="<?php echo url_for('perfil/recusarSolicitacao') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="btn btn-mini btn-danger">Rejeitar</a> 
                                </div>
                            </li>    
                        <?php } /* end if instance of Amigos */ ?>
                    <?php } /* end foreach notificacoes */ ?>
                </ul>
                <?php } /* end foreach arrayNotificacoes */ ?>
       

</div><!-- stream -->
</div><!-- /miolo -->