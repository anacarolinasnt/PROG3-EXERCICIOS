<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teste PHP</title>
</head>
<body>
  <h1>Array PHP para HTML </h1>
  <?php
  function html_table($data = array())
  {
    $rows = array();
    foreach ($data as $row)
    {
      $cells = array();
      foreach ($row as $cell) 
      {
        $cells[] = "<td>{$cell}</td>";
      }
      $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
  return "<table class='hci-table'>" . implode('', $rows) . "</table>";
  }
  
  $data = array(
    array('Aluno 1 Materia 1'),
    array('Aluno 2 Materia 2'),
    array('Aluno 3 Materia 3'),
    array('Aluno 4 Materia 4'),
    array('Aluno 5 Materia 5'),
    );

  echo html_table($data);
  ?>
  </body>
</html>