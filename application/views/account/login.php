<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login And SignUp Modal Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/login_form.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/tether.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="<?php echo base_url(); ?>Account/Login" method="post" role="form">
                <div class="col-md-offset-4 col-md-5">
                    <div class="form-login">
                        <h4>Justiça Já - Login</h4>
                        <input type="text" name="username" id="userName" class="form-control input-sm chat-input" placeholder="username" />
                        </br>
                        <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
                        </br>
                        <div class="wrapper">
                            <span class="group-btn">     
                                <button class="btn btn-primary btn-md" type="submit">login <i class="fa fa-sign-in"></i></button>
                            </span>
                        </div>

                        <?php if(isset($errorMessage)) { ?>
                        <div class="text-center">
                            <label id="errorMessage" style="margin-top: 7px; color: red; font-variant: all-petite-caps;"><?php echo $errorMessage;?></label>
                        </div>

                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-offset-4 col-md-5">
                <div class="col-md-6">
                    <h5>
                        <a href="account/forgotPassword">esqueceu a senha?</a>
                    </h5>
                </div>
                <div class="col-md-6 text-right">
                    <h5>
                        <a href="account/create">criar meu login</a>
                    </h5>
                </div>
            </div>
    </div>
</body>
</html>