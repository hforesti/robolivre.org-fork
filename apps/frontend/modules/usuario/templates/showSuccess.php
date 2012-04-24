<table>
  <tbody>
    <tr>
      <th>Id usuario:</th>
      <td><?php echo $usuarios->getIdUsuario() ?></td>
    </tr>
    <tr>
      <th>Id nivel escolaridade:</th>
      <td><?php echo $usuarios->getNivelEscolaridade() ?></td>
    </tr>
    <tr>
      <th>Nome:</th>
      <td><?php echo $usuarios->getNome() ?></td>
    </tr>
    <tr>
      <th>Login:</th>
      <td><?php echo $usuarios->getLogin() ?></td>
    </tr>
    <tr>
      <th>Senha:</th>
      <td><?php echo $usuarios->getSenha() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $usuarios->getEmail() ?></td>
    </tr>
    <tr>
      <th>Endereco:</th>
      <td><?php echo $usuarios->getEndereco() ?></td>
    </tr>
    <tr>
      <th>Habilidades:</th>
      <td><?php echo $usuarios->getHabilidades() ?></td>
    </tr>
    <tr>
      <th>Curso:</th>
      <td><?php echo $usuarios->getCurso() ?></td>
    </tr>
    <tr>
      <th>Site:</th>
      <td><?php echo $usuarios->getSite() ?></td>
    </tr>
    <tr>
      <th>Site empresa:</th>
      <td><?php echo $usuarios->getSiteEmpresa() ?></td>
    </tr>
    <tr>
      <th>Data nascimento:</th>
      <td><?php echo $usuarios->getDataNascimento() ?></td>
    </tr>
    <tr>
      <th>Sexo:</th>
      <td><?php echo $usuarios->getSexo() ?></td>
    </tr>
    <tr>
      <th>Administrador:</th>
      <td><?php echo $usuarios->getAdministrador() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('usuario/edit?id_usuario='.$usuarios->getIdUsuario()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('usuario/index') ?>">List</a>
