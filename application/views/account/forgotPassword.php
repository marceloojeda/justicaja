<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Justica Ja</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?php echo base_url(); ?>assets/css/login_form.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

    <div id="forgot-main">
        <h1>
        Informe seu e-mail
        </h1>
        <p class="text-muted">Você receberá um e-mail com as informações necessárias para criar uma nova senha</p>
        <hr>
        <form action="<?php echo base_url(); ?>account/forgotPassword" method="post">
            <div class="row">
            <div class="col-md-offset-3 col-md-6 form-group">
                <input type="text" name="Email" class="form-control text-lg text-center">
                <button class="btn btn-primary btn-lg mt-2" type="submit">Resetar Senha</button>
            </div>
            </div>
        </form>

        <div class="col-md-offset-3 col-md-6 form-group">
            <?php echo validation_errors(); ?>
        </div>
    </div>

</body>

</html>
