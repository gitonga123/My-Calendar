<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script src="/page/assets/js/jquery-1.12.3.js"></script>
        <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>

        <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" type = "text/css" href="/page/assets/css/custom.min.css"> -->
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <link rel="shortcut icon" href="/page/assets/img/favicon.ico" type="image/x-icon"/>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none};
            .loader{
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-right: 5px solid green;
                border-left: 5px solid red; 
                border-radius: 50%;
                width: 20px;
                height: 20px;
                animation: spin 2s linear infinite;

            }
            @keyframes spin{
                0% { transform: rotate(0deg); }
                100% {transform: rotate(360deg);}
            }
        </style>



