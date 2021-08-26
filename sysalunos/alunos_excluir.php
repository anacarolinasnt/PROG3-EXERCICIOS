<?php
    session_start();
    require_once("variaveis.php");
    require_once("conexao.php");

    $IdAluno = $_GET["IdAluno"];
    if(strlen($IdAluno) > 0){
        $sql = "DELETE FROM alunos WHERE idalunos = $IdAluno";
        mysqli_query($conexao_bd, $sql);
    }
    mysqli_close($conexao_bd);
    header("location:alunos_list.php");
?>