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
    <div class="container">
        <div class="row">
            <form action="<?php echo base_url(); ?>Account/UpdatePassword" method="post" role="form">

                <input type="hidden" name="AccountId" value="<?php echo $dataPost['pessoa']['AccountId']; ?>">
                <input type="hidden" name="PessoaId" value="<?php echo $dataPost['pessoa']['PessoaId']; ?>">

                <div class="col-md-offset-4 col-md-5 form-group">
                    <div class="form-login">
                        <h4>Justiça Já - Atualize sua senha</h4>
                        <?php if(!isset($dataPost['errorMessage'])) { 
                            echo '<p>'.$dataPost['pessoa']['Nome'].',<br>';
                            echo "Informe sua nova senha e a confirme.</p>";
                        } ?>
                        <p>
                        <label>Nova senha</label>
                        <input type="password" id="userPassword" name="Password" class="form-control input-sm chat-input" placeholder="password" />
                        </p>

                        <p>
                        <label class="text-sm">Confirme a nova senha</label>
                        <input type="password" id="userPassword" name="ConfirmPassword" class="form-control input-sm chat-input" placeholder="password" />
                        </p>
                        <div class="wrapper">
                            <span class="group-btn">     
                                <button class="btn btn-primary btn-md" type="submit">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                     Atualizar
                                </button>
                            </span>
                        </div>

                        <?php if(isset($dataPost['errorMessage'])) { ?>
                        <div class="text-center">
                            <label id="errorMessage" style="margin-top: 7px; color: red; font-variant: all-petite-caps;"><?php echo $dataPost['errorMessage'];?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>

        <?php 
            if(isset($dataPost['FormValidation'])){
                if(!$dataPost['FormValidation']){
                    echo "<div class='row'><div class='col-lg-12 text-center'>".validation_errors()."</div></div>";
                }
            }
        ?>
    </div>
</body>
</html>
