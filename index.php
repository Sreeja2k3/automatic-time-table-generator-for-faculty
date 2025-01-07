<?php
if (isset($_GET['generated']) && $_GET['generated'] == "false") {
    unset($_GET['generated']);
    echo '<script>alert("Timetable not generated yet!!");</script>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Automatic Time Table Generator</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div align="center">
            <h3 align="center"><img src="https://res.cloudinary.com/ds7in3gm3/image/upload/v1713366475/mrcet_logo2-removebg-preview_dl9txj.png"  style="height:50px"/> AUTOMATIC TIME TABLE GENERATOR FOR FACULTY</h3>
        </div>
    </div>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators" style="margin-bottom: 160px">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="assets/img/mech_banner.jpg" alt="CI dept">
        </div>

        <div class="item">
            <img src="assets/img/lab2.png" alt="Lab2">
        </div>

        <div class="item">
            <img src="assets/img/lab1.jpg" alt="Lab1">
        </div>

         <div class="item">
            <img src="assets/img/Aiml_img.png" alt="Lab">
        </div> 
    </div>
</div>
<script type="text/javascript">
    function genpdf() {
        var doc = new jsPDF();

        doc.addHTML(document.getElementById('TT'), function () {
            doc.save('demo timetable.pdf');
        });
        window.alert("Downloaded!");
    }
</script>
<div align="center" STYLE="margin-top: 30px">
<a href="http://localhost/tt2/admin" >
  <button>Admin Login</button>

<a href="http://localhost/scheduling" >
  <button>FACULTY</button>
  <style>
    button {
  background-color: #4CAF50;
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}
  </style>
</a>
</a>
</div>
<br>


<div id="faculty-sec">
    <div class="container set-pad">
        <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">OUR MANAGEMENT </h1>

            </div>

        </div>
        <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6" data-scroll-reveal="enter from the bottom after 0.5s">
        <div class="faculty-div">
            <img src="assets/img/faculty/founder.jpg" class="img-rounded"/>
            <h3 align="center">Sri.Ch.Malla Reddy</h3>
            <hr/>
            <h4 align="center">Founder<br/>Chairman</h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6" data-scroll-reveal="enter from the bottom after 0.5s">
        <div class="faculty-div">
            <img src="assets\img\faculty\director.jpeg" class="img-rounded"/>
            <h3 align="center">Dr.VSK Reddy</h3>
            <hr/>
            <h4 align="center">Director<br/>MRGI</h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6" data-scroll-reveal="enter from the bottom after 0.5s">
        <div class="faculty-div">
            <img src="assets/img/faculty/principal.jpg" class="img-rounded" />
            <h3 align="center">Dr. S Srinivasa Rao</h3>
            <hr/>
            <h4 align="center">Principal<br/>MRCET</h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6" data-scroll-reveal="enter from the bottom after 0.5s">
        <div class="faculty-div">
            <img src="assets/img/faculty/hod.jpg" class="img-rounded"/>
            <h3 align="center">Dr.Sujatha</h3>
            <hr/>
            <h4 align="center">HOD<br/>CI-DEPT</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="row set-row-pad">
        <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 "
             data-scroll-reveal="enter from the bottom after 0.4s">

            <h2><strong>Our Location </strong></h2>
            <hr/>
            <div>
                <h4>Maisammaguda, Secunderabad,Telangana,
                </h4>
                <h4>India - 500 100</h4>
                <h4><strong>Call:</strong> 9133555183, 9133555162  </h4>
                <h4><strong>Email: </strong>mrcet2004@gmail.com</h4>
                <h4><strong>Website: </strong><a href="https://mrcet.com/" target="_blank_">mrcet.com</a></h4>
            </div>


        </div>
        <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1"
             data-scroll-reveal="enter from the bottom after 0.4s">

            <h2><strong>Social Conectivity </strong></h2>
            <hr/>
            <div>
                <a href="https://www.facebook.com/mrcetofficial/"> <img src="assets/img/Social/facebook.png" alt=""/> </a>
                <a href="#"> <img src="assets/img/Social/google-plus.png" alt=""/></a>
                <a href="https://x.com/mrcet_official"> <img src="assets/img/Social/twitter.png" alt=""/></a>
            </div>
        </div>


    </div>
</div>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/scrollReveal.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/custom.js"></script>
</div>
</body>
</html>
