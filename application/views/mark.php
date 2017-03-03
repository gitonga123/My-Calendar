<?php
require_once('header.php');
?>
    <link rel="stylesheet" type="text/css" href="/page/assets/css/w3.css">
</head>
<body>
    <div class=" container container-fluid">
        <div style="padding-bottom: 2%"></div>
        <a href="/page/mark/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/search_area" class="btn btn-warning"><i class="fa fa-search"></i> Search</a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>

        <span style="margin-left: 5%"></span>
        <a href="/page/mark/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>

        <span style="margin-left: 5%"></span>
        <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
        <span style="margin-left: 5%"></span>

        <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>

        <div style="padding-bottom: 2%"></div>
        
        <a href="/page/mark/post" class="btn btn-default" ><i class="fa fa-lock"></i> Postponed</a>
        <span style="margin-left: 5%"></span>  
        <a href="#" id="timeClock" class="btn btn-default"></a>
        <span style="margin-left: 5%"></span>
        <a href="#" class="btn btn-danger" id="upload_data"><i class="fa fa-upload"> </i> Uploads</a>
       <span> <?php echo "<p style='font-weight: bold; color: red'>Total Records=: " . $count . "</p>"; ?></span>
       <div class="user_error"></div>
       <div style="padding-bottom: 2%"></div>
        <div class="w3-content w3-display-container">
            <div class="w3-display-container mySlides">
                <img src="/page/assets/img/img_fjords.jpg" style="width:100%" />
                <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
                    Trolltunga, Norway
                </div>
            </div>

            <div class="w3-display-container mySlides">
              <img src="/page/assets/img/img_lights.jpg" style="width:100%" />
              <div class="w3-display-bottomright w3-large w3-container w3-padding-16 w3-black" >
                Northern Lights, Norway
              </div>
            </div>

            <div class="w3-display-container mySlides">
              <img src="/page/assets/img/img_mountains.jpg" style="width:100%" />
              <div class="w3-display-topleft w3-large w3-container w3-padding-16 w3-black" >
                Beautiful Mountains
              </div>
            </div>

            <div class="w3-display-container mySlides">
              <img src="/page/assets/img/img_forest.jpg" style="width:100%" />
              <div class="w3-display-topright w3-large w3-container w3-padding-16 w3-black" >
                The Rain Forest
              </div>
            </div>

            <div class="w3-display-container mySlides">
              <img src="/page/assets/img/img_mountains.jpg" style="width:100%" />
              <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black" >
                Mountains!
              </div>
            </div>

            <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
            
        </div>
    </div>
    <script src="/page/assets/js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
    <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
    <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>

    <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
    <script src="/page/assets/js/bootstrap.min.js"></script>
     <script src="/page/assets/js/customer.js"></script>

    <script type="text/javascript">
        $('#upload_data').click(function(){
            
            var time = prompt("Please enter the time");

            var srvRqst = $.ajax({
                url: '/page/mark/transafer',
                type: 'post',
                data: {time: time},
                datatype: 'text',

             });

            srvRqst.done(function (response) {
                document.getElementById("upload_data").className = "btn btn-danger disabled";
                $('div.user_error').html(response);
            }); 
        });
    
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      x[slideIndex-1].style.display = "block";  
    }
    </script>
</body>
</html>