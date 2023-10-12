<?php
// Initialize the session
session_start();

$login_style = $logout_style = "";

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $logout_style = "style='display:none;'";
} else {
  $login_style = "style='display:none;'";
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Health and well being - SDG no. 3" />
  <meta name="keywords" content="SDG,Health, Well being, United Nations, UN" />
  <meta name="author" content="Theodoros Dougalis" />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/comments.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" /> -->

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bun"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../util/javascript/handleArticle.js" type="text/javascript"></script>
  <script src="../util//javascript/handleComments.js" type="text/javascript"></script>
  <script src="../util/javascript/handleTags.js" type="text/javascript"></script>
  <script src="../util/javascript/handleSearch.js" type="text/javascript"></script>

  <title>Health Share</title>
</head>

<body onload="saveArticle()
    .done(_ => {
      if (!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
      } else {
        saveTags(<?= isset($_SESSION['article_id']) ? $_SESSION['article_id'] : ''; ?>)
        handleComments(<?= isset($_SESSION['article_id']) ? $_SESSION['article_id'] : ''; ?>);
      }
    });">
  <!--Navigation bar-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="../index.php" class="navbar-brand mb-0 h1">
        <img class="d-inline-block align top rounded" src="../img/logo.png" width="30" height="30" />
        Health Share
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Contact us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Topics
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./marketisationOfHealthCare.php">Marketisation of Healthcare</a>
              </li>
              <li>
                <a class="dropdown-item" href="./hivAids.php">HIV/AIDS</a>
              </li>
              <li>
                <a class="dropdown-item active" href="#">Road Accidents</a>
              </li>
              <li>
                <a class="dropdown-item" href="./covidImpact.php">The Impact of Covid-19</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./signIn.php">Sign In</a>
          </li>
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./signUp.php">Sign Up</a>
          </li>

          <li class="nav-item dropdown" <?php echo $logout_style; ?>>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./resetPassword.php">Reset Password</a>
              </li>
              <li>
                <a class="dropdown-item" href="./signOut.php">Sign Out</a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <input class="form-control mr-lg-2" id="tag-search" type="search" placeholder="Search" aria-label="Search" onkeyup="searchTags();" />
            <div id="tags-list"></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Title -->
  <div class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white" style="
        background-image: url(../img/roadAccidentsMedia/carCrash.jpg);
        height: 40vh;
      ">
    <h1 class="mb-4" id="article-title">Road Accidents</h1>
    <p>
      A deep look on the accumulated burden humanity carries solely due to
      road traffic accidents, an analysis of the causes and the current global
      state of precautionary measures taken (or not) to drop those numbers.
    </p>
  </div>
  <!--Main Content-->
  <div class="text-center">
    <h1 class="mb-5">The impact of road traffic accidents</h1>
  </div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <div class="text-end">
          <img class="img-fluid" src="../img/roadAccidentsMedia/casualties and age.png" alt="Road crashes are the number one killer of five to twenty nine year-olds. Every year one point thirty five million people are killed and fifty million are seriously injured due to road crashes." />
        </div>
      </div>
      <div class="col-sm">
        <p>
          According to <b>World Health Organization (WHO)</b> road traffic
          crashes result in the deaths of approximately 1.35 million people
          around the world, while leaving between 20 and 50 million people
          with non-fatal injuries each year. Road traffic accidents have
          managed to reach a high ranking on the leading causes of death lists
          globally for several years now, while they are
          <b>the leading cause of death</b> of people between 5-29 years of
          age.
        </p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm">
        <div class="text-end">
          <p>
            Approximately, one person dies of a road accident
            <b>every 24 seconds</b>. To put this in perspective, the chances
            are that somebody died of a road accident, just during the time it
            took you to reach this point of this article.
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/24seconds.png" alt="Road crashes kill one person every twenty four seconds. That's nearly three thousand seven hundred killed a day." />
      </div>
    </div>
    <div class="text-center">
      <h2 class="mb-5">Let's see some more statistics!</h2>
    </div>

    <div class="row align-items-center">
      <div class="col-sm">
        <div class="text-end">
          <p>
            It is pretty clear that low/mid-income countries are the ones
            affected the most, since a frightening 93% of road casualties
            occur there, while accounting for only the 60% of vehicles
            registered worldwide.
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/vulnerable and income.png" alt="More than half of all road traffic deaths are among vulnerable road users. Ninety three percent of deaths occur in low to middle income countries, which account for only sixty percent of vehicles registered worldwide." />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm-6">
        <div class="text-end">
          <img class="img-fluid" src="../img/roadAccidentsMedia/income.png" alt="Graphs of percentages of population, road traffic fatalities and registered vehicles between low, middle and high income countries." />
        </div>
      </div>
      <div class="col-sm">
        <p>
          The variation in rates of death observed across regions and
          countries also corresponds with differences in the types of road
          users most affected. Vulnerable road users – pedestrians, cyclists
          and motorcyclists – represent
          <b> more than half of all global deaths</b>. Pedestrians and
          cyclists represent 26% of all deaths, while those using motorized
          two- and three-wheelers comprise another 28%. Car occupants make up
          29% of all deaths and the remaining 17% are unidentified road users.
        </p>
      </div>
    </div>
    <div class="text-center">
      <h3>
        The following fatalities-figures are WHO estimates for 2018 for
        different regions. Scroll through them in the gallery below:
      </h3>

      <!--Carousel-->

      <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_1.png" alt="Estimates for African region" />
          </div>
          <div class="carousel-item">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_2.png" alt="Estimates for region of the Americas" />
          </div>
          <div class="carousel-item">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_3.png" alt="Estimates for South-East Asia region" />
          </div>
          <div class="carousel-item">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_4.png" alt="Estimates for Europian region" />
          </div>
          <div class="carousel-item">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_5.png" alt="Estimates for Eastern Medditeranean region" />
          </div>
          <div class="carousel-item">
            <img class="rounded mx-auto d-block" class="d-block w-90" src="../img/roadAccidentsMedia/regional gallery/Screenshot_6.png" alt="Estimates for Western Pacific region" />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <h2 class="mb-5">
        Clearly the global burden of traffic accidents is severe. What is
        causing it in the first place?
      </h2>
    </div>
    <h3>
      There are a number of factors that increase both the risk of road
      traffic crashes and the risk of death or injury they result in.
    </h3>
    <div class="row align-items-center">
      <div class="col-sm">
        <h4 class="mb-5">Speed</h4>
        <p>
          Driving at speed significantly increases both the likelihood of a
          crash occurring, and the severity of its consequences. For every 1%
          increase in mean speed there is a 4% increase in fatal crash risk.
          The risk of death for pedestrians hit by motorized vehicles also
          rises rapidly as speed increases. A pedestrian hit by a vehicle
          travelling at 65 kilometers per hour is 4.5 times more likely to die
          than those hit by a vehicle travelling at 50 kilometers per hour.
        </p>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/speed.jpg" alt="A speedometer" />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/DDD.jpg" alt="A driver with a bottle in one hand the the driving wheel in the other." />
      </div>
      <div class="col-sm">
        <h4 class="mb-5">Drink/Drug Driving</h4>
        <p>
          Driving under the influence of alcohol or psychoactive substances
          presents significant risk factor for road traffic injuries. In the
          case of drunk driving, risk of road traffic injury increases
          significantly as the driver’s blood alcohol concentration goes up.
          In the case of drug-driving, the risk of road traffic injury
          increases to differing degrees depending on the psychoactive drug
          used.
        </p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm">
        <h4 class="mb-5">
          Lack of laws making use of motorcycle equipment, seat-belts and
          child restraints mandatory or inadequate law enforcement of existing
          laws.
        </h4>
        <h5 class="mb-5">Helmet</h5>
        <p>
          Head injuries are the leading cause of death and major trauma for
          two- and three-wheeled motor vehicle users. Correct helmet use can
          lead to a 42% reduction in the risk of fatal injuries and a 69%
          reduction in the risk of head injuries. The use of helmets is, as
          such, an increasingly important mean of preventing road traffic
          deaths. Best practice for motorcycle helmet laws includes a
          requirement for drivers and passengers to wear a helmet on all
          roads, a specification that helmets should be fastened and a
          reference to a helmet standard.
        </p>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/helmet.jpg" alt="A man wearing a helmet on his chair pretending to ride a motorcycle." />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm">
        <h5 class="mb-5">Seat-belt</h5>
        <p>
          Wearing a seat-belt reduces the risk of death among drivers and
          front seat occupants by 45–50%, and the risk of death and serious
          injuries among rear seat occupants by 25%. A requirement that both
          front and rear occupants use seat-belts is a key criterion for best
          practice.
        </p>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/seatbelt.jpg" alt="A driver with their seat-belt on." />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm">
        <h5 class="mb-5">Child restraint</h5>
        <p>
          Child restraints are highly effective in reducing injury and death
          to child occupants. The use of child restraints can lead to at least
          a 60% reduction in deaths. Best practice criteria for child
          restraint laws include a requirement to place children at least
          until ten years of age or 135 cm in height in a child restraint, a
          restriction to seating children in the front seat and a reference to
          a safety standard for child restraints.
        </p>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/child.jpg" alt="A happy child on a child restraint of a car." />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/distraction.jpg" alt="A driver talking on his phone." />
      </div>
      <div class="col-sm">
        <h4 class="mb-5">Distractions</h4>

        <p>
          There are different types of driver distraction, usually divided
          into those where the source of distraction is internal to the
          vehicle, such as tuning a radio, or using a mobile phone, and those
          external to the vehicle, such as looking at billboards or watching
          people on the side of the road. Using mobile phones can cause
          drivers to take their eyes off the road, their hands off the
          steering wheel, and their minds off the road and the surrounding
          situation. It is this type of distraction – known as cognitive
          distraction – which appears to have the biggest impact on driving
          behavior. There is a growing body of evidence that shows that the
          distraction caused by mobile phones (including hands-free) can
          impair performance in a number of ways, e.g. longer reaction times
          (notably braking reaction time, but also reaction to traffic
          signals), impaired ability to keep in the correct lane, shorter
          following distances, and an overall reduction in awareness of the
          driving situation. Use of a mobile phone for text messaging while
          driving seems to have a particularly detrimental impact on driving
          behavior.
        </p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm">
        <h4 class="mb-5">Unsafe vehicles and unsafe road infrastructure</h4>
        <p>
          Vehicle safety is increasingly critical to the prevention of crashes
          and has been shown to contribute to substantial reductions in the
          number of deaths and serious injuries resulting from road traffic
          crashes. Features such as electronic stability control and advance
          braking are examples of vehicle safety standards that can prevent a
          crash from occurring or reduce the severity of injuries. Despite
          these potential benefits, not all new and used vehicles are required
          to implement internationally recognized safety standards. Road
          infrastructure is strongly linked to fatal and serious injury
          causation in road traffic collisions, and research has shown that
          improvements to road infrastructure, particularly design standards
          that take into account the safety of all road users, are critical to
          making roads safe.
        </p>
      </div>
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/crash test.jpg" alt="A car being crash tested." />
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-sm-6">
        <img class="img-fluid" src="../img/roadAccidentsMedia/emergency.jpg" alt="The inside of an ambulance." />
      </div>
      <div class="col-sm">
        <h4 class="mb-5">Inadequate post-crash care</h4>

        <p>
          Emergency care is at the core of the post-crash response. There are
          a series of time sensitive actions that are essential to provide
          effective care for the injured, beginning with activation of the
          emergency care system and continuing with care at the scene,
          transport, and hospital-based emergency care. To activate the
          emergency care system, ideally there should be a single telephone
          number that is valid throughout the country, easy to remember and
          available as a free call.
        </p>
      </div>
    </div>

    <h2>Check the interactive map below</h2>
    <p>
      You can check what measures different countries have taken in their
      attempt to solve all the above problems in the map below.
    </p>
    <iframe src="https://extranet.who.int/roadsafety/death-on-the-roads/?embed=true" style="border: 0; width: 100%; height: 700px"></iframe>

    <span id="tags" style="display:none;">road accidents cars</span>

    <h4>
      Source: <a href="https://www.who.int/">World Health Organization</a>
    </h4>

    <br>
    <br>

    <div id="tag-display"></div>

    <br>
    <br>

    <div class="comments" id="comments"></div>

    <br>
    <br>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-center text-lg-start text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase">About</h5>

          <p>
            This website is dedicated to presenting information about several
            matters that are disturbing the well-being of humanity in our era.
          </p>
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contributors</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <p>Kiziridis Konstantinos</p>
            </li>
          </ul>
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-2">Find us on</h5>

          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/facebook.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/insta.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/twitter.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="../index.php">Health Share</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>

</html>