<?php
    session_start();
    require_once("variaveis.php");
    require_once("conexao.php");
    
    $IdAluno   = $_POST["txtIdAluno"];
    $Matricula   = $_POST["txtMatricula"];
    $NomeAluno = $_POST["txtAluno"];
    $Nascimento        = $_POST["txtDtNascimento"];
    $DtCadastro  = $_POST["DtCadastro"];

    if(strlen($IdAluno) > 0){
        if($IdAluno == 0){
            //novo usuário
            $sql = "INSERT INTO alunos(matricula, nome, dt_nascimento, dt_cadastro) 
                    VALUES('$Matricula', '$NomeAluno', '$Nascimento', '$DtCadastro')";
                    
        }else{
            //editar usuário
            $sql = "UPDATE alunos SET 
                        nome  = '$NomeAluno',
                        matricula = '$Matricula', 
                        dt_nascimento = '$Nascimento',
                        dt_cadastro  = '$DtCadastro'
                    WHERE idalunos = $IdAluno";
                    
        }
        mysqli_query($conexao_bd, $sql);
    }
    mysqli_close($conexao_bd);
    header("location:alunos_list.php");
/*
    echo $IdUsuario . "<Br>" .
     $NomeUsuario . "<Br>" .
     $Email . "<Br>" .
     $Senha . "<Br>" .
     $Dica . "<Br>" .
     $TipoAcesso;
*/
?>