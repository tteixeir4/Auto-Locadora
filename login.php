<?php
    session_start();
    include "conecta.php";
    
    if(isset($_POST['botao'])){
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha'];
        
        $sql = "SELECT * FROM tbfuncionario WHERE funcionario_matricula ='$matricula' AND funcionario_senha = '$senha'";
        $resultado = mysqli_query($conexao, $sql);

    
    if(mysqli_num_rows($resultado) == 1){
        $registro = mysqli_fetch_array($resultado);

        $_SESSION['matricula'] = $registro['funcionario_matricula'];
        $_SESSION['nome'] = $registro['funcionario_nome'];
        $_SESSION['senha'] = $senha;

        header("Location: home.php");
    } else{
        echo "<script>
            alert('Matrícula ou senha incorretos!');
            window.location.href = 'login.html';
          </script>";  
    }
}
?>