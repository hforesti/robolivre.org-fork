<?php

echo "lista de usuarios";

if(isset($listaUsuario)){
    
    foreach($listaUsuario as $usuario){
?>
<br/><br/>
<?php echo Util::getTagUsuario($usuario->getNome(), $usuario->getIdUsuario()) ?>


<?php }} ?>


