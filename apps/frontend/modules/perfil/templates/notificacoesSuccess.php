<?php
$arrayNotificacoes = UsuarioLogado::getInstancia()->getSolicitacoesPendentes();
$quantidadeSolicitacoes = UsuarioLogado::getInstancia()->getQuantidadeSolicitacoesPendentes();
?>

<div class="row">

    <?php include_partial('sidebarUsuarioLogado', array('opcao' => 'notificacoes')) ?>


    <hr class="only-mobile">

    <div class="span10">

        <div id="stream">

            <div class="page-header">
                <h1>Solicitações de amizade ‧ <small><span class="notf-num"><?php echo $quantidadeSolicitacoes ?></span> <span class="notf-txt-num">pendentes</span></small> </h1>
            </div>
            <?php
            if ($quantidadeSolicitacoes == 0) {
                ?>
                <div class="well">
                    As solicitações de amizade recebidas por você aqui na rede serão exibidas pelos nossos robôs nesta área. Você poderá aceitar ou rejeitar cada uma.
                </div>
                <?php
            } else {
                ?>
                <h4>Enviou uma solicitação de amizade:</h4>
                <ul class="requests">
                    <?php foreach (array_keys($arrayNotificacoes) as $data) { ?>
                        <?php $notificacoes = $arrayNotificacoes[$data]; ?>                    
                        <?php foreach ($notificacoes as $notificacao) { ?>    
                            <?php if ($notificacao instanceof Amigos) { ?>
                                <li class="vcard activity">
                                    <div class="notf">
                                        <a href="<?php echo url_for('perfil/exibir') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="photo"><img src="<?php echo Util::validaImagem($notificacao->getImagemPerfilUsuarioSolicitacao(), Util::IMAGEM_MEDIA, Util::TIPO_IMAGEM_USUARIO) ?>" alt="<?php echo $notificacao->getNomeUsuarioSolicitacao() ?>" title="<?php echo $notificacao->getNomeUsuarioSolicitacao() ?>"></a>
                                        <a href="<?php echo url_for('perfil/exibir') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="fn"><?php echo $notificacao->getNomeUsuarioSolicitacao() ?></a> <span class="time" title="<?php echo Util::getDataFormatada($notificacao->getDataSolicitacao()) ?>"><?php echo Util::getDataSimplificada($notificacao->getDataSolicitacao()) ?></span>
                                    </div>

                                    <div class="actions">
                                        <a href="<?php echo url_for('perfil/aceitarSolicitacao') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="btn btn-primary">Aceitar</a> 
                                        <a href="<?php echo url_for('perfil/recusarSolicitacao') . "?u=" . $notificacao->getIdUsuarioA() ?>" class="btn btn-danger">Rejeitar</a> 
                                    </div>
                                </li>    
                            <?php } /* end if instance of Amigos */ ?>
                        <?php } /* end foreach notificacoes */ ?>

                        <?php
                    } /* end foreach arrayNotificacoes */
                    ?>
                </ul>
                <?php
            }
            ?>


        </div><!-- stream -->
    </div><!-- /miolo -->
</div>