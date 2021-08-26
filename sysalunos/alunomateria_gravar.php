<?php
session_start();
require_once("variaveis.php");
require_once("conexao.php");

$Aluno   = $_POST["txtIdAluno"];
$Materia   = $_POST["txtIdMateria"];
$IdAluno = $_POST["selAluno"];
$IdMateria        = $_POST["selMateria"];
$Ano  = $_POST["txtAno"];

if (strlen($Aluno) > 0 && strlen($Materia) > 0) {
    if ($Aluno == 0 && $Materia == 0) {
        //novo usuário
        $sql = "INSERT INTO materiasporalunos(idalunos, idmaterias, ano) 
                    VALUES('$IdAluno', '$IdMateria', '$Ano')";
    } else {
        //editar usuário
        $sql = "UPDATE materiasporalunos SET 
                        idalunos  = '$IdAluno',
                        idmaterias = '$IdMateria', 
                        ano = '$Ano'
                    WHERE idalunos = $Aluno AND idmaterias = $Materia";
    }
    mysqli_query($conexao_bd, $sql);
}
mysqli_close($conexao_bd);
header("location:alunomateria_list.php");