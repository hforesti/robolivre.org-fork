<?php

echo "lista de Conteudos";

if(isset($conteudos)){
    
    foreach($conteudos as $conteudo){
?>
<br/><br/>

<?php echo Util::getTagConteudo($conteudo->getNome(), $conteudo->getIdConjunto()) ?>

<?php }} ?>
<br/><br/>
<input type="button" value="Criar Conteúdo" onclick="window.location = '<?php echo url_for('conteudo/criar') ?>'" />