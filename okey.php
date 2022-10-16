<?php
session_start();

require_once 'database.php';
if(!isset($_SESSION['logged_id'])){


    if(isset($_POST['login'])){

        $login=filter_input(INPUT_POST,'login');
        $password=filter_input(INPUT_POST,'pass');
       
        $userQuery2=$db->prepare('SELECT id,pass FROM admins WHERE login=:login');
        $userQuery2->bindValue(':login',$login,PDO::PARAM_STR);
        $userQuery2->execute();
        $user2 = $userQuery2->fetch();
        if($user2 && ($password==$user2['pass'])){
            $_SESSION['logged_id']=$user2['pass'];
            unset( $_SESSION['bad_attemtp2']);

        }else{
            $_SESSION['bad_attemtp2']=true;
            
            header('Location: index.php');
            exit();
        }
    }
    else{
        header('Location: index.php');
        exit();

    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logowanie</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container  ">
        <div class="row">
            <div class="col-md-3 col-1 cards1"></div>
            <div class="col-md-6  col-10 cards1"></div>     
            <div class="col-md-3  col-1 cards1"></div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-1 cards3"></div>
            <div class="col-md-4 col-10 cards2 text-center">
                <img src="./user-g2d312be5c_640.png" alt="user" >
                <h2 >Witaj!</h2>
              
               
              <p>Zalogowano</p>
                  <a href="./logout.php">
                      <div class="floor">Wyloguj się!</div>
                  </a>
            </div>
            <div class="col-md-4 cards3 col-1" ></div>
        </div>
       
    </div>
    <div class="madeBy"><p>Made by Michał Bebłociński</p></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>