<?php

echo "lista de Conteudos";

if(isset($conteudos)){
    
    foreach($conteudos as $conteudo){
?>
<br/><br/>
<a href="<?php echo url_for('conteudo/exibir?u='.$conteudo->getIdConteudo()); ?>"><?php echo $conteudo->getNome() ?></a>


<?php }} ?>
<br/><br/>
<input type="button" value="Criar Conteúdo" onclick="window.location = '<?php echo url_for('conteudo/criar') ?>'" />