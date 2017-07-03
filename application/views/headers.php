
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
    <link rel="shortcut icon" href="/page/assets/img/favicon.ico" type="image/x-icon"/>
    <style>
            /*body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}*/
            /*.myLink {display: none};*/
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

  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/page/mark" class="navbar-brand">Mark</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Adding Content <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/page//mark/add_result">Default</a></li>
                <li class="divider"></li>
                <li><a href="/page//mark/add_halftime/null/null/null">Add Half Time Content</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Update Details <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="/page/mark/update_result">Update Results</a></li>
                <li class="divider"></li>                
                <li><a href="/page/mark/exact_search">Update Team/League</a></li>
                <li><a href="/page/mark/update_halftime">Update Inner Details</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Search <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="/page/mark/search_area">Search Area</a></li>
                <li class="divider"></li>                
                <li><a href="/page/mark/exact_search">Exact Search</a></li>
                <li><a href="/page/mark/search_area">Mass Search</a></li>
                <li class="divider"></li>
                <li><a href="/page/mark/inner_details">Inner Details</a></li>
                
                <li class="divider"></li>
                <li><a href="/page/mark/search_area">Point Search</a></li>
                <li><a href="/page/mark/search_area">Team Search</a></li>
              </ul>
            </li>
            <li>
              <a href="/page/mark/summary">Summary</a>
            </li>
            <li>
              <a href="/page/mark/post">Postponed</a>
            </li>
            <li>
              <a href="/page/make">New Site</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" id="timeClock"></a></li>
            <li><a href="/page/mark/lock" target="_blank">Lock</a></li>
          </ul>

        </div>
      </div>
    </div>


    <div class="container">
     


    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://bootswatch.com/assets/js/custom.js"></script>
</body>
</html>
