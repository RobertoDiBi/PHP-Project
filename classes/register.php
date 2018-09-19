<?php

$_SESSION['message'] = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reg_user'])) {
        //include 'classes/User.php';
        Database::initialize();
        if (strlen($_POST['firstName']) >= 2 && !strlen($_POST['firstName']) <= 50) {
            if (strlen($_POST['lastName']) >= 2 && strlen($_POST['lastName']) <= 50) {
                if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,6}$/", $_POST['email'])) {
                    if (preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $_POST['password'])) {
                        if ($_POST['password'] == $_POST['confirmPass']) {
                            $firstName = trim(mysqli_real_escape_string(Database::$conn, $_POST['firstName']));
                            $lastName = trim(mysqli_real_escape_string(Database::$conn, $_POST['lastName']));
                            $email = trim(mysqli_real_escape_string(Database::$conn, $_POST['email']));
                            $password = md5(mysqli_real_escape_string(Database::$conn, $_POST['password']));

                            if (!Database::_checkUserExists($firstName, $lastName, $email)) {
                                $passwordEncript = md5($password);
                                $user = new User();
                                $user->setFirstName($firstName);
                                $user->setLastName($lastName);
                                $user->setEmail($email);
                                $user->setPassword($password);
                                if (Database::_registerUser($user)) {
                                    $username = $firstName . ' ' . $lastName;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['success'] = "You are now logged in";
                                    header('location: index.php?content=login');
                                } else {
                                    $_SESSION['message'] = "Sql insert error." . "<br/>" . "Please try again or contact the website administrator.";
                                }
                            }
                        } else {
                            $_SESSION['message'] = "The two passwords do not match.";
                        }
                    } else {
                        $_SESSION['message'] = "Weak password. Must contain:" . "<br/>" . "- 8 Characters or more." . "<br/>" . "-1 or more uppercase characters." . "<br/>" . "- 1 or more numeric characters.";
                    }
                } else {
                    $_SESSION['message'] = "Incorrect email format. Must be like (example@domain.com)";
                }
            } else {
                $_SESSION['message'] = "The Last Name must be between 2 and 50 characters";
            }
        } else {
            $_SESSION['message'] = "The First Name must be between 2 and 50 characters";
        }
    }
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* If the values are posted, insert them into the database.
    if (isset($_POST['reg_user'])){
        $firstName = mysqli_real_escape_string($db::$conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($db::$conn, $_POST['lastName']);
	$email = mysqli_real_escape_string($db::$conn, $_POST['email']);
        $password = mysqli_real_escape_string($db::$conn, $_POST['password']);
        $confirmPass = mysqli_real_escape_string($db::$conn, $_POST['confirmPass']);
        
        
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($firstName)) { $_SESSION['message'] = "First name is required";}
        if (empty($lastName)) { $_SESSION['message'] = "Last name is required"; }
        if (empty($email)) { $_SESSION['message'] = "Email is required"; }
        if (empty($password)) { $_SESSION['message'] =  "Password is required"; }
        if ($password != $confirmPass) {
            $_SESSION['message'] = "The two passwords do not match";
        }
        
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        /*$user_check_query = "SELECT * FROM alexphp.users WHERE firstName='$firstName' AND lastName='$lastName' OR email='$email' LIMIT 1";
        $result = mysqli_query($db::$conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
  
        if ($user) { // if user exists
            
            if ($user['firstName'] === $firstName and $user['lastName'] === $lastName) {
                array_push($errors, "User already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }
        
        
        /*if (count($errors) == 0) {
            $query = "INSERT INTO alexphp.users (firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$password')";
            if (mysqli_query($db::$conn, $query)) {
              $username = $firstName.' '.$lastName;
              $_SESSION['username'] = $username;
              $_SESSION['success'] = "You are now logged in";
              header('location: index.php');
            }else {
                    echo 'error';
            }
        }else{
            foreach ($errors as $error ){
                echo $error;
            }
        }*/




