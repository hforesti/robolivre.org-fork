<?php

foreach(UsuarioLogado::getInstancia()->getSolicitacoesPendentes() as $solicitacao){
    
?>

<b><?php echo $solicitacao['nome'] ?></b>
<a href="<?php echo url_for('perfil/aceitarSolicitacao')."?u=".$solicitacao['id'] ?>"> Aceitar</a>- 
<a href="<?php echo url_for('perfil/recusarSolicitacao')."?u=".$solicitacao['id'] ?>">Recusar</a>
<br/>
<?php } ?>

