<?php
session_start();
require_once("variaveis.php");
require_once("conexao.php");

//recuperar os dados da sessão:

$tipoAcesso = $_SESSION["tipo_acesso"];

//recuperar id de usuário
$IdAluno = $_GET["idAluno"];

//validar se o código do usuário está na sessão:


//nome do usuário:
$nome_aluno = "";
$sql          = "SELECT nome FROM alunos";
$resp         = mysqli_query($conexao_bd, $sql);
if ($rows = mysqli_fetch_row($resp)) {
    $nome_aluno = $rows[0];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gerenciamento de alunos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>
    <link rel="shortcut icon" href="img/studentmeets_4873.ico" />
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/studentmeets_4873.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    SysAlunos
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 50px;">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin.php">Home</a>
                        </li>
                        <?php
$mnuCadastro   = "<li class='nva-item dropdown active'>
                                <a class='nav-link dropdown-toggle' href='#' id='mnuCadastroDown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                Cadastros
                                </a>
                                <ul class='dropdown-menu aria-labelledby='mnuCadastroDown'>
                                <li><a class='dropdown-item' href='usuarios_list.php'>Cadastro de usuários</a></li>
                                <li><a class='dropdown-item' href='alunos_list.php'>Cadastro de alunos</a></li>
                                <li><a class='dropdown-item' href='materias_list.php'>Cadastro de matérias</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='alunomateria_list.php'>Cadastro de materias por alunos</a></li>
                                </ul>
                            </li>";
$mnuConsultas  = "<li class='nav-item'><a class='nav-link' href='#'>Consultas</a></li>";
$mnuRelatorios = "<li class='nav-item'><a class='nav-link' href='#'>Relatórios</a></li>";

if ($tipoAcesso == 0) {
    echo $mnuCadastro;
}
if ($tipoAcesso == 0 || $tipoAcesso == 1) {
    echo $mnuConsultas;
}
if ($tipoAcesso == 0 || $tipoAcesso == 2) {
    echo $mnuRelatorios;
}
?>
                       <li class="nav-item">
                            <a class="nav-link" href="logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        
//Variáveis
$id_alunos = "";
$matricula = "";
$nome_aluno = "";
$Nascimento = "";
$DtCadastro= "";


if ($IdAluno == 0) {
    //novo usuario
    echo "<h1>Novo aluno:</h1>";
} else {
    //editar usuario
    echo "<h1>Editar aluno:</h1>";
    $sql  = "SELECT idalunos, matricula, nome, dt_nascimento, dt_cadastro 
                        FROM alunos WHERE idalunos = $IdAluno";
                        
    $resp = mysqli_query($conexao_bd, $sql);
    if ($rows = mysqli_fetch_row($resp)) {
        $id_alunos     = $rows[0];
        $matricula     = $rows[1];
        $nome_aluno    = $rows[2];
        $Nascimento    = $rows[3];
        $DtCadastro    = $rows[4];
    }
    mysqli_close($conexao_bd);
}
?>
       <form class="row g-3" method="post" action="alunos_gravar.php">
            <?php
echo "<input type='hidden' id='txtIdAluno' name='txtIdAluno'
                        value='$IdAluno'>";
?>
           <div class="col-12">
                <label for="txtMatricula" class="form-label">Número da matrícula</label>
                <input type="text" class="form-control" id="txtMatricula" name="txtMatricula" 
                placeholder="Número da matrícula" value="<?php
echo $matricula;
?>">
            </div>
            <div class="col-md-6">
                <label for="txtAluno" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="txtAluno" name="txtAluno"
                placeholder="" value="<?php
echo $nome_aluno;
?>">
            </div>
            <div class="col-md-3">
                <label for="txtDtNascimento" class="form-label">Data de nascimento:</label>
                <input type="date" class="form-control" id="txtDtNascimento" name="txtDtNascimento"
                placeholder="" value="<?php
echo $Nascimento;
?>">
            </div>        
            <div class="col-3">
                <label for="DtCadastro" class="form-label">Data de cadastro:</label>
                <input type="date" class="form-control" id="DtCadastro" name="DtCadastro"
                value="<?php
                    
echo $DtCadastro;
?>">
                          
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <a class="btn btn-warning" href="alunos_list.php" 
                    role="button">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>