<?php
session_start();
require_once 'config.php';

if(isset($_POST["username"])&&isset($_POST["senha"])){
    
    $username = $mysqli->real_escape_string($_POST['username']);
    $senha = $mysqli->real_escape_string($_POST['senha']);


    #verifica os usuarios já validados
    $sql_code = "SELECT * FROM usuario WHERE username = '$username' AND senha = '$senha'";
    $sql_query = $mysqli-> query($sql_code) or die("Falha ao executar cod sql: ".$mysqli->error);
        
    $quantidade_validado = $sql_query->num_rows;


    #verifica os usuario não validados
    $sql_analise = "SELECT * FROM cadastro_em_analise WHERE username = '$username' AND senha = '$senha'";
    $sql_query_analise = $mysqli-> query($sql_analise) or die("Falha ao executar cod sql: ".$mysqli->error);
        
    $quantidade_nao_validado = $sql_query_analise->num_rows;

    #usuario root
    $sql_root = "SELECT * FROM `root` WHERE username = '$username' AND senha = '$senha'";
    $sql_query_root = $mysqli-> query($sql_root) or die("Falha ao executar cod sql: ".$mysqli->error);
        
    $quantidade_root = $sql_query_root->num_rows;



    #realiza login com o tipo do usuario
    if($quantidade_validado ==1){
        $usuario = $sql_query->fetch_assoc();
        if(!isset($_SESSION)){session_start();}
            

        $_SESSION["id"] = $usuario["id"];

        header("Location:painel.php");
    }else if($quantidade_nao_validado == 1){
        $usuario = $sql_query_analise->fetch_assoc();
        if(!isset($_SESSION)){session_start();}

        $_SESSION["nome"] = $usuario["nome"];

        header("Location:painel_nao_validado.php");
    }else if($quantidade_root == 1){
        $usuario = $sql_query_root->fetch_assoc();
        if(!isset($_SESSION)){session_start();}

        $_SESSION["username"] = $usuario["username"];

        header("Location:painel_root.php");

    }else{
        echo"Falha ao logar, senha ou username incorretos";
    }
    
    
}
?>