<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

    
    <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
    <link rel="stylesheet" type="text/css" href="/page/assets/css/animate.css"></link>
    <link rel="stylesheet" type="text/css" href="/page/assets/css/style.css"></link>

    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
        .myLink {display: none}
    </style>
</head>

<body class="red-bg">
<?php echo "$error_message;"?>
<div class="lock-word animated fadeInDown">
    <span class="first-word">LOCKED</span><span>SCREEN</span>
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="/page/assets/img/a4.jpg">
            </div>
            <h3>John Smith</h3>
            <p>Your are in lock screen. Main app was shut down and you need to enter your passwor to go back to app.</p>
            <form class="m-t" role="form" action="/page/mark/login" method="post">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="******" required="required" name='password'>
                </div>
                <button type="submit" class="btn btn-primary block full-width">Unlock</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/page/assets/js/jquery-1.12.3.js"></script>
    <script src="/page/assets/js/bootstrap.min.js"></script>

</body>

</html>
