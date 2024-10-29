<?php
session_start();
//mensajes

$usuario = $_SESSION['usuario'] ?? null;
if (!isset($usuario)) {
    header("Location: login.html");
    exit();
}

// Incluir el archivo de conexión
require_once('../conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener los cursos
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);

$courses = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/vnd.icon" href="assets/images/favicon.ico">
    <title>Cursos / Tutorías UPC-SA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
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

    <style>
        .btn-create {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #000; 
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease; 
            cursor: pointer;
            margin-bottom: 20px; 
        }

        .btn-create:hover {
            color: black;
            background-color: #fff; 
            transform: translateY(-3px); 
        }

        .btn-create:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <header class="main-header clearfix" role="header">
        <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
        
        <div class="logo">
            <a href="../admin/home-admin.php"><img src="../assets/images/logo-universidad-popular-del-cesar.png " width="20%"  alt="Logo" style="color: black;"></a>
        </div>
        
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <li> 
                    <a href="../cerrar_sesion.php" class="external" style="background-color: rgb(60, 155, 97, 0.9); color: bisque;" >
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

    <main>
        <section class="course__area pt-120 pb-120" style="background-color: rgb(60, 155, 97, 0.9);">
            <div class="container text-center">
                <a href="create_course.php" class="btn-create">Crear curso</a>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="course__tab-conent">
                            <div class="tab-content" id="courseTabContent">
                                <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                                    <div class="row">
                                        <?php if (!empty($courses)): ?>
                                            <?php foreach ($courses as $course): ?>
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                    <div class="course__item white-bg mb-30 fix">
                                                        <div class="course__thumb w-img p-relative fix">
                                                            <a href="../calculo_course.php">
                                                                <?php if (empty($course['imagen'])): ?>
                                                                    <p>No tiene imagen</p>
                                                                <?php else: ?>
                                                                    <img src="<?php echo htmlspecialchars($course['imagen']); ?>" alt="">
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="course__tag">
                                                                <a href="../calculo_course.php"><?php echo htmlspecialchars($course['semestre']); ?> Semestre</a>
                                                            </div>
                                                        </div>
                                                        <div class="course__content">
                                                            <h3 class="course__title">
                                                                <a href="../calculo_course.php"><?php echo htmlspecialchars($course['descripcion']); ?></a>
                                                            </h3>
                                                            <div class="course__teacher d-flex align-items-center">
                                                                <div class="course__teacher-thumb mr-15">
                                                                    <img src="./Educal – Online Learning and Education HTML5 Template_files/teacher-1.jpg" alt="">
                                                                </div>
                                                                <h6><a href="#">Danny Rios</a></h6>
                                                            </div>
                                                        </div>
                                                        <div class="course__more d-flex justify-content-between align-items-center">
                                                            <div class="course__btn">
                                                                <a href="show_course.php?code=<?php echo $course['code']; ?>" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="edit_course.php?code=<?php echo $course['code']; ?>" class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button class="btn btn-sm btn-danger delete-course" data-code="<?php echo $course['code']; ?>">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <style>
                                                body{
                                                    background-color: green;
                                                }
                                            </style>
                                            <p style="color: black;" class="h5">No se encontraron cursos.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar clics en los botones de eliminar
        document.querySelectorAll('.delete-course').forEach(button => {
            button.addEventListener('click', function() {
                const courseCode = this.getAttribute('data-code');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, redirige a delete_course.php
                        window.location.href = `delete_course.php?code=${courseCode}`;
                    }
                });
            });
        });

        // Mostrar alerta de éxito si existe en la sesión
        <?php if (isset($_SESSION['success'])): ?>
        Swal.fire({
            title: 'Éxito!',
            text: '<?php echo $_SESSION['success']; ?>',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        // Mostrar alerta de error si existe en la sesión
        <?php if (isset($_SESSION['error'])): ?>
        Swal.fire({
            title: 'Error!',
            text: '<?php echo $_SESSION['error']; ?>',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
    </script>
</body>
</html>