<h1>Usuarioss List</h1>

<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Login</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarioss as $usuarios): ?>
    <tr>
      <td><?php echo $usuarios->getNome() ?></td>
      <td><?php echo $usuarios->getLogin() ?></td>
      <td><?php echo $usuarios->getEmail() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
