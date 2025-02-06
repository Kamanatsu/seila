<?php

function volta_login(){
    session_start();
    if (isset($_SESSION['id'])) {
        header("Location: painel.php");
    }elseif (isset($_SESSION["nome"])) {
        header("Location: painel_nao_validado.php");
    }elseif(isset($_SESSION["username"])) {
        header("Location:painel_root.php");
    }
}

function protect_acess() {
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }
}

?>