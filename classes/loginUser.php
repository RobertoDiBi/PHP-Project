<?php 
$_SESSION['message']='';
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    //include 'classes/User.php';
    Database::initialize();
    if(preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,6}$/",$_POST['email'])){
        $email = trim(mysqli_real_escape_string(Database::$conn, $_POST['email'])); 
        $password = md5(mysqli_real_escape_string(Database::$conn,$_POST['password']));

        $results = Database::_checkUserInUsers($email, $password);
        if (mysqli_num_rows($results) === 1) {
            $row = mysqli_fetch_array($results, MYSQLI_BOTH);
            $currentUser = new User();
            $currentUser->setId($row['idusers']);
            $currentUser->setFirstName($row['firstName']);
            $currentUser->setLastName($row['lastName']);
            $currentUser->setEmail($row['email']);
            $currentUser->setPassword($row['password']);
            session_start();
            if($password === $currentUser->getPassword()){
                $username = $currentUser->getFirstName().' '.$currentUser->getLastName();
                $_SESSION['username'] = $currentUser->getFirstName().' '.$currentUser->getLastName();
                $_SESSION['userId'] = $currentUser->getId();
                $_SESSION['success'] = "You are now logged in";
                //create cookie
                $username = json_encode($username, true);
                if(isset($_POST['rememberMe'])){
                    setcookie('userLogin',$username, time()+60,"/");  //for now i set a cookie just for 1 min       
                    $_COOKIE['userLogin'] = $username;
                    $_SESSION['username'] = $currentUser->getFirstName().' '.$currentUser->getLastName();
                    $_SESSION['userId'] = $currentUser->getId();
                    header('location: index.php');
                }else{
                    setcookie('userLogin',$username,0,"/");         
                    $_COOKIE['userLogin'] = $username;
                    $_SESSION['username'] = $currentUser->getFirstName().' '.$currentUser->getLastName();
                    $_SESSION['userId'] = $currentUser->getId();
                    header('location: index.php');
                }
            }    
        }else {
            //unset($_SESSION['username']);
            $_SESSION['message'] = "Wrong email/password combination."." Please try again if you alrady have an account, otherwise go to the Registration page and create one.";
        }
    }else{
        $_SESSION['message'] = "Incorrect email format (example@domain.com).";
    }
}