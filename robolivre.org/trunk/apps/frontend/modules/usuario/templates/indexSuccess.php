<h1>Usuarioss List</h1>

<table>
  <thead>
    <tr>
      <th>Id usuario</th>
      <th>Id nivel escolaridade</th>
      <th>Nome</th>
      <th>Login</th>
      <th>Senha</th>
      <th>Email</th>
      <th>Endereco</th>
      <th>Habilidades</th>
      <th>Curso</th>
      <th>Site</th>
      <th>Site empresa</th>
      <th>Data nascimento</th>
      <th>Sexo</th>
      <th>Administrador</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarioss as $usuarios): ?>
    <tr>
      <td><a href="<?php echo url_for('usuario/show?id_usuario='.$usuarios->getIdUsuario()) ?>"><?php echo $usuarios->getIdUsuario() ?></a></td>
      <td><?php echo $usuarios->getNivelEscolaridade() ?></td>
      <td><?php echo $usuarios->getNome() ?></td>
      <td><?php echo $usuarios->getLogin() ?></td>
      <td><?php echo $usuarios->getSenha() ?></td>
      <td><?php echo $usuarios->getEmail() ?></td>
      <td><?php echo $usuarios->getEndereco() ?></td>
      <td><?php echo $usuarios->getHabilidades() ?></td>
      <td><?php echo $usuarios->getCurso() ?></td>
      <td><?php echo $usuarios->getSite() ?></td>
      <td><?php echo $usuarios->getSiteEmpresa() ?></td>
      <td><?php echo $usuarios->getDataNascimento() ?></td>
      <td><?php echo $usuarios->getSexo() ?></td>
      <td><?php echo $usuarios->getAdministrador() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('usuario/new') ?>">Novo :D</a>
