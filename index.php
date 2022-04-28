<?php 


//Incluindo a conexão com o banco de dados com o require_once.
require_once 'db_connect.php';
//Iniciando uma sessão.
session_start();

// !isset =(se o btn_logar foi clicado e existe) executa o código abaixo.
if(isset($_POST['btn-logar'])):
    $log      = mysqli_escape_string($connect, $_POST['login']);
    $password = mysqli_escape_string($connect, $_POST['password']);

        if(empty($log) or empty($password)):
            echo "<script>
            alert('Os campos login e senha prescisam estar preenchidos!');
            window.location.href='index.php';
            </script>";
        else:

            $sql    = "SELECT login FROM usuarios WHERE login='$log' ";
            $result = mysqli_query($connect, $sql);

                if(mysqli_num_rows($result) > 0):
                        
                   // $password = md5($password);
                    $sql      = "SELECT * FROM usuarios WHERE senha='$password' and login='$log' ";    
                    $result   = mysqli_query($connect, $sql);
              
                    if(mysqli_num_rows($result) == 1):
                        $dados = mysqli_fetch_array($result);
                        mysqli_close($connect);// Fechando a conexão com o banco de dados após a consulta.
                        $_SESSION['logado'] = true;
                        $_SESSION['id_usuario'] = $dados['id'];
                         header('Location: home.php');
                     else:
                        echo "<script>
                        alert('Usúario e senha não conferem!');
                        window.location.href='index.php';
                        </script>";
                     endif;   
                else:
                    echo "<script>
                    alert('Usúario não cadastrado');
                    window.location.href='index.php';
                    </script>"; 
                endif;      
     endif;
endif;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
        <div class="main">
            <div class="card">
            <div class="left-img-container">
                <img src="img/logo-responsivo.png" alt="logo-fecap">
            </div>

                <form class="textfield" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h1>Portal</h1>
                    <input type="text" name="login" id="login" placeholder="Usuário" required>
                    <input type="password" name="password" id="password" placeholder="Senha" required>
                    <button class="btn-login" type="submit" name="btn-logar">LOGIN</button>
                    <a href="">Esqueceu sua senha?</a>
                </form>
            </div>
        </div>
    
</body>
</html>