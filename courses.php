<?php
session_start();
// require 'connectDB.php';
$usuario=$_SESSION['usuario'];
if(!isset($usuario)){
header("Location: login.html");
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="icon" type="image/vnd.icon" href="assets/images/favicon.ico">
    <title>Cursos / Tutorías UPC-SA</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/preloader.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/meanmenu.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/animate.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/owl.carousel.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/swiper-bundle.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/backToTop.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/elegantFont.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/default.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/style.css">

 
  </head>

<body>

    <!-- pre loader area start -->
    <div id="loading" style="display: none;">
        <div id="loading-center">
           <div id="loading-center-absolute">
              <div class="loading-content">
                 <img class="loading-logo-text" src="" alt="">
                 <div class="loading-stroke">
                    <img class="loading-logo-icon" src="" alt="">
                 </div>
              </div>
           </div>
        </div>  
     </div>
     

     <!-- header area start -->
      <header class="main-header clearfix" role="header">
         <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
         <div class="logo">
            <a href="courses.php"><img src="assets/images/logo-universidad-popular-del-cesar.png " width="20%"  alt="Logo" style="color: black;"></a>
         </div>
        
         <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
               <li> 
                  <a href="cerrar_sesion.php" class="external" style="background-color: rgb(60, 155, 97, 0.9); color: bisque;" >
                     Cerrar sesión
                  </a>
               </li>
            </ul>
            <div class="bienvenido" style="padding-top: 30px;" >
               <?php
                  $usuarioMayus = strtoupper($usuario);
                  echo "<h3>BIENVENIDO  $usuarioMayus </h3>";  
               ?> 
            </div>
         </nav>
      </header>
     <!-- header area end -->

     <main>
        <!-- course area start -->
        <section class="course__area pt-120 pb-120" style="background-color: rgb(60, 155, 97, 0.9);">
           <div class="container">
              <div class="row">
                 <div class="col-xxl-12">
                    <div class="course__tab-conent">
                       <div class="tab-content" id="courseTabContent">
                          <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                             <div class="row">

                              <!-- Inicio de Curso de Fundamentos -->
                              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                 <div class="course__item white-bg mb-30 fix">
                                    <div class="course__thumb w-img p-relative fix">
                                      <a href="#">
                                         <img src="Educal – Online Learning and Education HTML5 Template_files/laptop-2620118_1920.jpg" alt="">
                                      </a>
                                      <div class="course__tag">
                                         <a href="#" style="background-color: darkorange;">1er Semestre</a>
                                      </div>
                                   </div>
                                   <div class="course__content">
                                      <div class="course__meta d-flex align-items-center justify-content-between">
                                       </div>
                                       <h3 class="course__title">
                                          <a href="#">
                                             Fundamentos de Programación
                                          </a>
                                       </h3>
                                      <div class="course__teacher d-flex align-items-center">
                                         <div class="course__teacher-thumb mr-15">
                                            <img src="./Educal – Online Learning and Education HTML5 Template_files/teacher-6.jpg" alt="">
                                         </div>
                                         <h6><a href="#">Luis Palmera</a></h6>
                                      </div>
                                   </div>
                                   <div class="course__more d-flex justify-content-between align-items-center">
                                      <div class="course__btn">
                                      </div>
                                   </div>
                                </div>
                              </div>
                              <!-- End Curso de Fundamentos -->

                              <!-- Inicio de Curso de Calculo III -->
                              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                 <div class="course__item white-bg mb-30 fix">
                                    <div class="course__thumb w-img p-relative fix">
                                       <a href="calculo_course.php">
                                          <img src="Educal – Online Learning and Education HTML5 Template_files/portada-curso-calculo-integral.jpg" alt="">
                                       </a>
                                       <div class="course__tag">
                                          <a href="calculo_course.php">4to Semestre</a>
                                       </div>
                                    </div>
                                    <div class="course__content">
                                    <div class="course__meta d-flex align-items-center justify-content-between">
                                    </div>
                                    <h3 class="course__title">
                                       <a href="calculo_course.php"> Cálculo III </a>
                                    </h3>
                                    <div class="course__teacher d-flex align-items-center">
                                       <div class="course__teacher-thumb mr-15">
                                          <img src="./Educal – Online Learning and Education HTML5 Template_files/teacher-1.jpg" alt="">
                                       </div>
                                          <h6><a href="https://weblearnbd.net/tphtml/educal/educal/instructor-details.html">Danny Rios</a></h6>
                                       </div>
                                    </div>
                                    <div class="course__more d-flex justify-content-between align-items-center">
                                       <div class="course__btn">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- End Curso de Cálculo III -->

                              
                             </div>
                          </div>
                        </div>
                    </div>
                 </div>
              </div>
           </div>
        </section>
        <!-- course area end -->

<!-- footer area start  -->
<footer style="background-color: rgb(6, 67, 10);">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <p><i class="fa fa-copyright"></i> Copyright 2023 by Universidad Popular del CesarDesign: <a href="https://templatemo.com" rel="sponsored" target="_parent">LUIS MEJÍA; CAMILO ARANGO</a></p>
     </div>
   </div>
 </div>
</footer>
<!-- footer area end  -->
</main>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>