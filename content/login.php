<?php include 'classes/loginUser.php';?>
<main class="page login-page">
    <section class="clean-block clean-form dark" >
        <div class="container">
            <div class="row justify-content-center block-heading">
            <h2 class="header">Login</h2>
            </div>
            <form action="index.php?content=login" method="post" style="border-top-color: #8bb393; ">
                <div class="form-group"><?php if(!empty($_SESSION['message'])){echo "<div class='alert alert-danger'>".htmlentities($_SESSION['message'])."</div>";} ?></div>
                <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email" id="email" name="email"></div>
                <div class="form-group"><label for="password">Password</label><input class="form-control" type="password" id="password" name="password"></div>
                <div class="form-group">
                <div class="form-check"><input class="form-check-input " type="checkbox" id="rememberMe" name="rememberMe"><label class="form-check-label" for="checkbox">Remember me</label></div>
                </div><button class="btn btn-outline-success btn-block" type="submit" name="login_user">Login</button>
                <br/>
                <div class="form-group">
                    Not a member yet? <a href="index.php?content=registration">Sign up</a>
                </div>
            </form>
        </div>
    </section>
</main>
