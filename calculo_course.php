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

      <main style="background-color:rgb(60, 155, 97, 0.9) ;">

         <!-- page title area start -->
         <section class="page__title-area pt-120 pb-90">
            <div class="container" style="background-color: rgb(239, 239, 239); border-radius: 20px;">
               <div class="row">
                  <div class="col-xxl-8 col-xl-8 col-lg-8">
                     <div class="course__wrapper">
                        <div class="page__title-content mb-25">
                           <div class="page__title-breadcrumb">                            
                               <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb" style="background-color: transparent;">
                                   <li ><a href="courses.html">Cursos / </a></li>
                                   <li  aria-current="page"> Cálculo I</li>
                                 </ol>
                               </nav>
                           </div>
                           <!-- <span class="page__title-pre">Development</span> -->
                           <h5 class="page__title-3"><u>Cálculo III</u></h5>
                        </div>
                        <div class="course__meta-2 d-sm-flex mb-30">
                           <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                              <div class="course__teacher-thumb-3 mr-15">
                                 <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/teacher-1.jpg" alt="">
                              </div>
                              <div class="course__teacher-info-3">
                                 <h5 style="color: rgb(74, 71, 71);"><strong>Docente</strong></h5>
                                 <p><a href="#" style="color: brown;"> --------- </a></p>
                              </div>
                           </div>
                        </div>
                        <div class="course__img w-img mb-30">
                           <img src="assets/images/Ing.-Sistemas-scaled.jpg" alt="">
                        </div>
                        <div class="course__tab-2 mb-45">
                           <ul class="nav nav-tabs" id="courseTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> 
                                    <img src="Educal – Online Learning and Education HTML5 Template_files/boton-de-informacion.png" alt="" style="width: 20px;"><span>  Descripción</span> 
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link " id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false"> 
                                 <img src="Educal – Online Learning and Education HTML5 Template_files/contenido-digital.png" alt="" style="width: 20px;"> <span>Contenido</span> </button>
                              </li>
                              <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false"> 
                                 <img src="" alt="" style="width: 20px;"> <span>Reviews</span> </button>
                              </li> -->
                              <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> 
                                 <img src="" alt="" style="width: 20px;">  <span>Members</span> </button>
                              </li> -->
                            </ul>
                        </div>
                        <div class="course__tab-content mb-95">
                           <div class="tab-content" id="courseTabContent">
                              <!-- Descripción -->
                              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                 <div class="course__description">
                                    <h3>Cálculo III</h3>
                                    <p> 
                                       <strong style="color: brown;">{ Sipnosis del Curso }</strong>
                                    </p>
                                    <hr>
                                    <div class="course__description-list mb-45">
                                       <h4>¿A quien va dirigido?</h4>
                                       <ul>
                                          <li> <i class="icon_check"></i> Estudiantes de Ing. de Sistemas</li>
                                          <li> <i class="icon_check"></i> Estudiantes que aprobaron satisfactoriamente Cáculo II</li>
                                       </ul>
                                    </div>
                                    <hr>
                                    <div class="course__instructor mb-45">
                                       <h3>Docente</h3>
                                       <div class="course__instructor-wrapper d-md-flex align-items-center">
                                          <div class="course__instructor-item d-flex align-items-center mr-70">
                                             <div class="course__instructor-content">
                                                <h3 style="color: brown;">---------</h3>
                                                <p>Ingeniero en Sistemas</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Contenido -->
                              <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                 <div class="course__curriculum">
                                    <div class="accordion" id="course__accordion">
                                       <div class="accordion-item mb-50">
                                         <h2 class="accordion-header" id="week-01">
                                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-01-content" aria-expanded="true" aria-controls="week-01-content">
                                             Primer Corte 
                                           </button>
                                         </h2>
                                         <div id="week-01-content" class="accordion-collapse collapse show" aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                           <div class="accordion-body">
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Teoría :</span> {Titulo de temas}</h3>
                                                </div>
                                             </div>
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg viewBox="0 0 24 24">
                                                      <polygon class="st0" points="23,7 16,12 23,17 "></polygon>
                                                      <path class="st0" d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z"></path>
                                                      </svg>
                                                   <h3> <span>Material Multimedia: </span> </h3>
                                                </div>
                                             </div>                                            
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Ejecicios de apoyo: </span> </h3>
                                                </div>
                                               
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                    </div>
                                    <div class="accordion" id="course__accordion-2">
                                       <div class="accordion-item mb-50">
                                         <h2 class="accordion-header" id="week-02">
                                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-02-content" aria-expanded="true" aria-controls="week-02-content">
                                             Segundo Corte 
                                           </button>
                                         </h2>
                                         <div id="week-02-content" class="accordion-collapse  collapse show" aria-labelledby="week-02" data-bs-parent="#course__accordion-2">
                                           <div class="accordion-body">
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Teoría:</span> {Título de temas}</h3>
                                                </div>
                                             </div>
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg viewBox="0 0 24 24">
                                                      <polygon class="st0" points="23,7 16,12 23,17 "></polygon>
                                                      <path class="st0" d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z"></path>
                                                      </svg>
                                                   <h3> <span>Material Multimedia:</span></h3>
                                                </div>
                                             </div>
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Ejercicios de Apoyo: </span></h3>
                                                </div>
                                             </div>
                                           </div>
                                         </div>
                                       </div>

                                       
                                    </div>
                                    <div class="accordion" id="course__accordion-3">
                                       <div class="accordion-item mb-50">
                                         <h2 class="accordion-header" id="week-03">
                                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-03-content" aria-expanded="true" aria-controls="week-03-content">
                                             Tercer Corte 
                                           </button>
                                         </h2>
                                         <div id="week-03-content" class="accordion-collapse  collapse show" aria-labelledby="week-03" data-bs-parent="#course__accordion-3">
                                           <div class="accordion-body">
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Teoría:</span> {Título de temas}</h3>
                                                </div>
                                             </div>
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg viewBox="0 0 24 24">
                                                      <polygon class="st0" points="23,7 16,12 23,17 "></polygon>
                                                      <path class="st0" d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z"></path>
                                                      </svg>
                                                   <h3> <span>Material Multimedia:</span></h3>
                                                </div>
                                             </div>
                                             <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                <div class="course__curriculum-info">
                                                   <svg class="document" viewBox="0 0 24 24">
                                                      <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z"></path>
                                                      <polyline class="st0" points="14,2 14,8 20,8 "></polyline>
                                                      <line class="st0" x1="16" y1="13" x2="8" y2="13"></line>
                                                      <line class="st0" x1="16" y1="17" x2="8" y2="17"></line>
                                                      <polyline class="st0" points="10,9 9,9 8,9 "></polyline>
                                                   </svg>
                                                   <h3> <span>Ejercicios de Apoyo: </span></h3>
                                                </div>
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Review -->
                              <!-- <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                 <div class="course__review">
                                    <h3>Reviews</h3>
                                    <p>Gosh william I'm telling crikey 
burke I don't want no agro A bit of how's your father bugger all mate 
off his nut that, what a plonker cuppa owt to do</p>

                                    <div class="course__review-rating mb-50">
                                       <div class="row g-0">
                                          <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                             <div class="course__review-rating-info grey-bg text-center">
                                                <h5>5</h5>
                                                <ul>
                                                   <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                   <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                   <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                   <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                   <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                </ul>
                                                <p>4 Ratings</p>
                                             </div>
                                          </div>
                                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                             <div class="course__review-details grey-bg">
                                                <h5>Detailed Rating</h5>
                                                <div class="course__review-content mb-20">
                                                   <div class="course__review-item d-flex align-items-center justify-content-between">
                                                      <div class="course__review-text">
                                                         <span>5 stars</span>
                                                      </div>
                                                      <div class="course__review-progress">
                                                         <div class="single-progress" data-width="100%" style="width: 100%;"></div>
                                                      </div>
                                                      <div class="course__review-percent">
                                                         <h5>100%</h5>
                                                      </div>
                                                   </div>
                                                   <div class="course__review-item d-flex align-items-center justify-content-between">
                                                      <div class="course__review-text">
                                                         <span>4 stars</span>
                                                      </div>
                                                      <div class="course__review-progress">
                                                         <div class="single-progress" data-width="30%" style="width: 30%;"></div>
                                                      </div>
                                                      <div class="course__review-percent">
                                                         <h5>30%</h5>
                                                      </div>
                                                   </div>
                                                   <div class="course__review-item d-flex align-items-center justify-content-between">
                                                      <div class="course__review-text">
                                                         <span>3 stars</span>
                                                      </div>
                                                      <div class="course__review-progress">
                                                         <div class="single-progress" data-width="0%" style="width: 0%;"></div>
                                                      </div>
                                                      <div class="course__review-percent">
                                                         <h5>0%</h5>
                                                      </div>
                                                   </div>
                                                   <div class="course__review-item d-flex align-items-center justify-content-between">
                                                      <div class="course__review-text">
                                                         <span>2 stars</span>
                                                      </div>
                                                      <div class="course__review-progress">
                                                         <div class="single-progress" data-width="0%" style="width: 0%;"></div>
                                                      </div>
                                                      <div class="course__review-percent">
                                                         <h5>0%</h5>
                                                      </div>
                                                   </div>
                                                   <div class="course__review-item d-flex align-items-center justify-content-between">
                                                      <div class="course__review-text">
                                                         <span>1 stars</span>
                                                      </div>
                                                      <div class="course__review-progress">
                                                         <div class="single-progress" data-width="0%" style="width: 0%;"></div>
                                                      </div>
                                                      <div class="course__review-percent">
                                                         <h5>0%</h5>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="course__comment mb-75">
                                       <h3>2 Comments</h3>

                                       <ul>
                                          <li>
                                             <div class="course__comment-box ">
                                                <div class="course__comment-thumb float-start">
                                                   <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/course-comment-1.jpg" alt="">
                                                </div>
                                                <div class="course__comment-content">
                                                   <div class="course__comment-wrapper ml-70 fix">
                                                      <div class="course__comment-info float-start">
                                                         <h4>Eleanor Fant</h4>
                                                         <span>July 14, 2022</span>
                                                      </div>
                                                      <div class="course__comment-rating float-start float-sm-end">
                                                         <ul>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                   <div class="course__comment-text ml-70">
                                                      <p>So I said lurgy
 dropped a clanger Jeffrey bugger cuppa gosh David blatant have it, 
standard A bit of how's your father my lady absolutely.</p>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li>
                                             <div class="course__comment-box ">
                                                <div class="course__comment-thumb float-start">
                                                   <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/course-comment-2.jpg" alt="">
                                                </div>
                                                <div class="course__comment-content">
                                                   <div class="course__comment-wrapper ml-70 fix">
                                                      <div class="course__comment-info float-start">
                                                         <h4>Shahnewaz Sakil</h4>
                                                         <span>July 17, 2022</span>
                                                      </div>
                                                      <div class="course__comment-rating float-start float-sm-end">
                                                         <ul>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#" class="no-rating"> <i class="icon_star"></i> </a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                   <div class="course__comment-text ml-70">
                                                      <p>David blatant have it, standard A bit of how's your father my lady absolutely.</p>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                    <div class="course__form">
                                       <h3>Write a Review</h3>
                                       <div class="course__form-inner">
                                          <form action="#">
                                             <div class="row">
                                                <div class="col-xxl-6">
                                                   <div class="course__form-input">
                                                      <input type="text" placeholder="Your Name">
                                                   </div>
                                                </div>
                                                <div class="col-xxl-6">
                                                   <div class="course__form-input">
                                                      <input type="email" placeholder="Your Email">
                                                   </div>
                                                </div>
                                                <div class="col-xxl-12">
                                                   <div class="course__form-input">
                                                      <input type="text" placeholder="Review Title">
                                                   </div>
                                                </div>
                                                <div class="col-xxl-12">
                                                   <div class="course__form-input">
                                                      <div class="course__form-rating">
                                                         <span>Rating : </span>
                                                         <ul>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#" class="no-rating"> <i class="icon_star"></i> </a></li>
                                                            <li><a href="#" class="no-rating"> <i class="icon_star"></i> </a></li>
                                                         </ul>
                                                      </div>
                                                      <textarea placeholder="Review Summary"></textarea>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-xxl-12">
                                                   <div class="course__form-btn mt-10 mb-55">
                                                      <button type="submit" class="e-btn">Submit Review</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div> -->
                              <!-- Members -->
                              <!-- <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                                 <div class="course__member mb-45">
                                    <div class="course__member-item">
                                       <div class="row align-items-center">
                                          <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                             <div class="course__member-thumb d-flex align-items-center">
                                                <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/course-instructor-1.jpg" alt="">
                                                <div class="course__member-name ml-20">
                                                   <h5>Shahnewaz Sakil</h5>
                                                   <span>Engineer</span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-45">
                                                <h5>07</h5>
                                                <span>Courses</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-70">
                                                <h5>05</h5>
                                                <span>Reviw</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-85">
                                                <h5>3.00</h5>
                                                <span>Rating</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="course__member-item">
                                       <div class="row align-items-center">
                                          <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                             <div class="course__member-thumb d-flex align-items-center">
                                                <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/course-instructor-2.jpg" alt="">
                                                <div class="course__member-name ml-20">
                                                   <h5>Lauren Stamps</h5>
                                                   <span>Teacher</span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-45">
                                                <h5>05</h5>
                                                <span>Courses</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-70">
                                                <h5>03</h5>
                                                <span>Reviw</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-85">
                                                <h5>3.00</h5>
                                                <span>Rating</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="course__member-item">
                                       <div class="row align-items-center">
                                          <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6 ">
                                             <div class="course__member-thumb d-flex align-items-center">
                                                <img src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/course-instructor-3.jpg" alt="">
                                                <div class="course__member-name ml-20">
                                                   <h5>Jonquil Von</h5>
                                                   <span>Associate</span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-45">
                                                <h5>09</h5>
                                                <span>Courses</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-70">
                                                <h5>07</h5>
                                                <span>Reviw</span>
                                             </div>
                                          </div>
                                          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                             <div class="course__member-info pl-85">
                                                <h5>4.00</h5>
                                                <span>Rating</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div> -->
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- page title area end -->

      </main>

         <!-- footer area start -->
         <footer style="background-color: rgb(6, 67, 10);">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <p><i class="fa fa-copyright"></i> Copyright 2023 by Universidad Popular del CesarDesign: <a href="https://templatemo.com" rel="sponsored" target="_parent">LUIS MEJÍA; CAMILO ARANGO</a></p>
                </div>
              </div>
            </div>
           </footer>
         <!-- footer area end -->
      <!-- JS here -->
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/jquery-3.5.1.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/waypoints.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/bootstrap.bundle.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/jquery.meanmenu.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/swiper-bundle.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/owl.carousel.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/jquery.fancybox.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/isotope.pkgd.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/parallax.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/backToTop.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/purecounter.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/ajax-form.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/wow.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/imagesloaded.pkgd.min.js"></script>
      <script src="Educal%20%E2%80%93%20Online%20Learning%20and%20Education%20HTML5%20Template_files/main.js"></script>
   


</body></html>