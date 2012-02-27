<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<table>
  <tbody>
    <tr>
      <th>Nome:</th>
      <td><?php echo $usuario->getNome() ?></td>
    </tr>
    <tr>
      <th>Login:</th>
      <td><?php echo $usuario->getLogin() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $usuario->getEmail() ?></td>
    </tr>
    <tr>
      <th>Endereco:</th>
      <td><?php echo $usuario->getEndereco() ?></td>
    </tr>
    <tr>
      <th>Nivel escolaridade:</th>
      <td><?php echo NiveisEscolaridade::getDescricao($usuario->getNivelEscolaridade()) ?></td>
    </tr>
    <tr>
      <th>Habilidades:</th>
      <td><?php echo $usuario->getHabilidades() ?></td>
    </tr>
    <tr>
      <th>Curso:</th>
      <td><?php echo $usuario->getCurso() ?></td>
    </tr>
    <tr>
      <th>Site:</th>
      <td><?php echo $usuario->getSite() ?></td>
    </tr>
    <tr>
      <th>Site empresa:</th>
      <td><?php echo $usuario->getSiteEmpresa() ?></td>
    </tr>
    <tr>
      <th>Data nascimento:</th>
      <td><?php echo $usuario->getDataNascimento() ?></td>
    </tr>
    <tr>
      <th>Sexo:</th>
      <td><?php echo Sexo::getDescricao($usuario->getSexo()) ?></td>
    </tr>
    <?php if($usuario->getTipoSolicitacaoAmizade() == Usuarios::PROPRIO_USUARIO){ ?>
        
        <tr>
            <th><a href="<?php echo url_for('perfil/editarPerfil?u='.$usuario->getIdUsuario()); ?>">EDITAR MINHAS INFORMACOES</a></th>
        </tr>
     <?php } ?>
  </tbody>
</table>