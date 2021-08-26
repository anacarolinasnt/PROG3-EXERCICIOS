<?php
session_start();
require_once("variaveis.php");
require_once("conexao.php");

$IdAluno = $_GET["IdAluno"];
$IdMateria = $_GET["IdMateria"];

if (strlen($IdAluno) > 0) {
    $sql = "DELETE FROM materiasporalunos WHERE idalunos = $IdAluno AND idmaterias = $IdMateria";

    mysqli_query($conexao_bd, $sql);
}
mysqli_close($conexao_bd);
header("location:alunomateria_list.php");