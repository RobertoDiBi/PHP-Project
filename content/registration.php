<?php include 'classes/register.php';
?>
<main class="page registration-page">
    
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="header">Registration</h2>
                <p>Create an account to have early access to your favorite movie's tickets and post reviews.</p>
            </div>
            <form action="index.php?content=registration" method="post" style="border-top-color: #8bb393; ">
                <div class="form-group"><?php if(!empty($_SESSION['message'])){echo "<div class='alert alert-danger'>".htmlentities($_SESSION['message'])."</div>";} ?></div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input class="form-control item" type="text" id="firstName" name="firstName" value="<?php if(isset($_POST['reg_user'])){echo htmlentities($_POST['firstName']);}?>"required maxlength="50"/>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input class="form-control item" type="text" id="lastName" name="lastName" value="<?php if(isset($_POST['reg_user'])){echo htmlentities($_POST['lastName']);}?>" required maxlength="50"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control item" type="email" id="email" name="email" value="<?php if(isset($_POST['reg_user'])){echo htmlentities($_POST['email']);}?>" required maxlength="50"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control item" type="password" id="password" name="password" required/>
                </div>
                <div class="form-group">
                    <label for="confirmPass">Confirm Password</label>
                    <input class="form-control item" type="password" id="confirmPass" name="confirmPass" />
                </div>
                <button class="btn btn-outline-success btn-block" type="submit" name="reg_user" value="register">Sign Up</button>
                <br/>
                <div class="form-group">
  		Already a member? <a href="index.php?content=login">Login</a>
                </div>
            </form>
        </div>
    </section>
</main>
