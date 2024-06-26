<?php
include("admin/bd.php");

//lista del equipo
$sql=$conn->prepare("SELECT * FROM `tbl_config`");
$sql->execute();
$list_config=$sql->fetchAll(PDO::FETCH_ASSOC);

//lista de servicios
$sql=$conn->prepare("SELECT * FROM `tbl_services`");
$sql->execute();
$list_services=$sql->fetchAll(PDO::FETCH_ASSOC);

//lista del portafolio
$sql=$conn->prepare("SELECT * FROM `tbl_portfolio`");
$sql->execute();
$list_portfolio=$sql->fetchAll(PDO::FETCH_ASSOC);

//lista de la line del tiempo
$sql=$conn->prepare("SELECT * FROM `tbl_aboutline`");
$sql->execute();
$list_aboutline=$sql->fetchAll(PDO::FETCH_ASSOC);

//lista del equipo
$sql=$conn->prepare("SELECT * FROM `tbl_team`");
$sql->execute();
$list_team=$sql->fetchAll(PDO::FETCH_ASSOC);

function SearchIndex($name, $list){
    foreach ($list as $index => $value) {
        if ($value['name'] == $name) {
            return $index;
        }
    }
    return false;
}

?>

</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">
                <?php echo $list_config[SearchIndex('welcome_text', $list_config)]['value']; ?></div>
            <div class="masthead-heading text-uppercase">
                <?php echo $list_config[SearchIndex('welcome_subtext', $list_config)]['value']; ?>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase"
                href="<?php echo $list_config[SearchIndex('welcome_button_link', $list_config)]['value']; ?>"><?php echo $list_config[SearchIndex('welcome_button', $list_config)]['value']; ?></a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">
                    <?php echo $list_config[SearchIndex('welcome_button', $list_config)]['value']; ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php echo $list_config[SearchIndex('welcome_button_link', $list_config)]['value']; ?></h3>
            </div>
            <div class="row text-center">
                <?php foreach($list_services as $regis){ ?>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas <?php echo $regis['icon']; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3"><?php echo $regis['title']; ?></h4>
                    <p class="text-muted">
                        <?php echo $regis['description']; ?>
                    </p>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">
                    <?php echo $list_config[SearchIndex('portfolio_title', $list_config)]['value']; ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php echo $list_config[SearchIndex('portfolio_descrip', $list_config)]['value']; ?></h3>
            </div>
            <div class="row">
                <?php foreach($list_portfolio as $regis){ ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Portfolio item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal"
                            href="#portfolioModal<?php echo $regis['id'];?>">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/<?php echo $regis['image']; ?>"
                                alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading"><?php echo $regis['title'] ?></div>
                            <div class="portfolio-caption-subheading text-muted"><?php echo $regis['category']; ?></div>
                        </div>
                    </div>
                </div>


                <!-- Portfolio modal popup-->
                <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $regis['id']?>" tabindex="-1"
                    role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                                    alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project details-->
                                            <h2 class="text-uppercase"><?php echo $regis['title'] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $regis['subtitle']; ?></p>
                                            <img class="img-fluid d-block mx-auto"
                                                src="assets/img/portfolio/<?php echo $regis['image']; ?>" alt="..." />
                                            <p><?php echo $regis['description'] ?></p>
                                            <ul class="list-inline">
                                                <li>
                                                    <strong>Client:</strong>
                                                    <?php echo $regis['client']; ?>
                                                </li>
                                                <li>
                                                    <strong>Category:</strong>
                                                    <?php echo $regis['category']; ?>
                                                </li>
                                                <li>
                                                    <strong>URL:</strong>
                                                    <a href="<?php echo $regis['url']; ?>"> <?php echo $regis['url']; ?>
                                                    </a>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary btn-xl text-uppercase"
                                                data-bs-dismiss="modal" type="button">
                                                <i class="fas fa-xmark me-1"></i>
                                                Close Project
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">
                    <?php echo $list_config[SearchIndex('about_title', $list_config)]['value']; ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php echo $list_config[SearchIndex('about_descrip', $list_config)]['value']; ?></h3>
            </div>
            <ul class="timeline">

                <?php
                $timeline_inv="";
                foreach($list_aboutline as $regis){ ?>
                <li class="<?php echo $timeline_inv; ?>">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets/img/about/<?php echo $regis["image"]; ?>" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4><?php
                            $deta="";
                            $dates=explode(',', $regis['date']);
                            if (count($dates)>1) {
                                $date_start=explode('-', $dates['0']);
                                $date_end=explode('-', $dates['1']);
                                $date=$date_start['0']." - ".$date_end['0'];
                            }else{
                                $date_start=explode('-', $dates['0']);
                                $date=$date_start['0']." - ".$date_start['1'];
                            }
                            echo $date; ?></h4>
                            <h4 class="subheading"><?php echo $regis['title']; ?></h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted"><?php echo $regis['description']; ?></p>
                        </div>
                    </div>
                </li>
                <?php
                      if ($timeline_inv=="") { $timeline_inv="timeline-inverted";
                    }else { $timeline_inv="";} 
                 } ?>

                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            <br />
                            <?php echo $list_config['10']['value']; ?>
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">
                    <?php echo $list_config[SearchIndex('team_title', $list_config)]['value']; ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php echo $list_config[SearchIndex('team_descrip', $list_config)]['value']; ?></h3>
            </div>
            <div class="row">

                <?php foreach($list_team as $regis){ ?>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $regis['image']; ?>"
                            alt="..." />
                        <h4><?php echo $regis['fullname'] ?></h4>
                        <p class="text-muted"><?php echo $regis['job'] ?></p>
                        <?php
                        $networks = $regis['networks'];
                        $list_networks=array();

                        if ($networks) $list_networks=explode(",", $networks);
                     
                        foreach ($list_networks as $index => $network) {
                            $network_p=explode("->", $network);             
                            switch($network_p['0']){
                                case"facebook":?>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $network_p['1']; ?>"
                            aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                        <?php
                                    break;
                                case"twitter":?>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $network_p['1']; ?>"
                            aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                        <?php
                                    break;
                                case"linkedin":?>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $network_p['1']; ?>"
                            aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        <?php
                                    break;
                                default:
                                    echo "no hay redes";

                            }                            
                        } ?>

                    </div>
                </div>
                <?php } ?>

            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque,
                        laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->
    <div class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg"
                            alt="..." aria-label="Microsoft Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg"
                            alt="..." aria-label="Google Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg"
                            alt="..." aria-label="Facebook Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg"
                            alt="..." aria-label="IBM Logo" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">
                    <?php echo $list_config[SearchIndex('contact_title', $list_config)]['value']; ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php echo $list_config[SearchIndex('contact_descrip', $list_config)]['value']; ?></h3>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control" id="name" type="text" placeholder="Your Name *"
                                data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Your Email *"
                                data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <!-- Phone number input-->
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *"
                                data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Message input-->
                            <textarea class="form-control" id="message" placeholder="Your Message *"
                                data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a
                            href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Error sending message!</div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled"
                        id="submitButton" type="submit">Send Message</button></div>
            </form>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2"
                        href="<?php echo $list_config[SearchIndex('twitter_link_button', $list_config)]['value']; ?>"
                        aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2"
                        href="<?php echo $list_config[SearchIndex('facebook_link_button', $list_config)]['value']; ?>"
                        aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2"
                        href="<?php echo $list_config[SearchIndex('linkedin_link_button', $list_config)]['value']; ?>"
                        aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>