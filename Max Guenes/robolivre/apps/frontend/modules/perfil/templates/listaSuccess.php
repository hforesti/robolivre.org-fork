<?php

echo "lista de usuarios";

if(isset($listaUsuario)){
    
    foreach($listaUsuario as $usuario){
?>
<br/><br/>
<a href="<?php echo url_for('perfil/index?u='.$usuario->getIdUsuario()); ?>"><?php echo $usuario->getNome() ?></a>


<?php }} ?>


