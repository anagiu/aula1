<?php

require('twig_carregar.php');
require('pdo.inc.php');
require('mailer.inc.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? false;
    


    $sql = $pdo->prepare('SELECT * FROM usuarios
    WHERE username = ?');
    $sql->execute([$username]);

   if ($sql->rowCount()){

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
       $token = uniqid(null, true) . bin2hex (random_bytes(16));
      
       $sql = $pdo->prepare('UPDATE usuarios SET recupera_token = :token WHERE id = :id_usr');
       $sql->execute([
        ':token' => $token,
        ':id_usr' => $usuario['id'],



       ]);
       $msg = 'olha o email!!';
       
       echo $twig->render('email_recupera_senha.html', [
           'token' => $token
       ]);
       die;

   } else {

    $msg = 'Usuário não encontrado. Tu bebeu?';

   }
}


echo $twig->render('recuperar_senha.html', [
    'msg' => $msg,
]);