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

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Health and well being - SDG no. 3" />
  <meta name="keywords" content="SDG,Health, Well being, United Nations, UN" />
  <meta name="author" content="Konstantinos Kiziridis" />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!--Javscript imports-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../util/javascript/handleArticle.js" type="text/javascript"></script>
  <script src="../util//javascript/handleComments.js" type="text/javascript"></script>
  <script src="../util/javascript/handleTags.js" type="text/javascript"></script>
  <script src="../util/javascript/handleSearch.js" type="text/javascript"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="../css/comments.css" rel="stylesheet">
  
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
                <a class="dropdown-item active" href="#">HIV/AIDS</a>
              </li>
              <li>
                <a class="dropdown-item" href="./roadAccidents.php">Road Accidents</a>
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

  <span style="display:none;" id="article-title">HIV/AIDS</span>

  <!--General information-->
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <h2>About HIV/AIDS</h2>
        <p>
          HIV (human immunodeficiency virus) is a virus that attacks the body’s immune system.
          If HIV is not treated, it can lead to AIDS (acquired immunodeficiency syndrome).
          Learning the basics about HIV can keep you healthy and prevent HIV transmission.
          You can also download materials to share or watch videos on basic information about HIV.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>What is HIV?</h2>
        <p>
        <ul>
          <li>
            HIV (human immunodeficiency virus) is a virus that attacks the body’s immune system.
            If HIV is not treated, it can lead to AIDS (acquired immunodeficiency syndrome).
          </li>
          <li>
            There is currently no effective cure. Once people get HIV, they have it for life.
          </li>
          <li>
            But with proper medical care, HIV can be controlled.
            People with HIV who get effective HIV treatment can live long, healthy lives and protect their partners.
          </li>
        </ul>
        </p>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-sm">
        <img src="../img/hivAids/whatIsHIV.png" alt="what is HIV" class="img-fluid" />
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>Where did HIV come from?</h2>
        <p>
        <ul>
          <li>
            HIV infection in humans came from a type of chimpanzee in Central Africa.
          </li>
          <li>
            The chimpanzee version of the virus (called simian immunodeficiency virus, or SIV) was probably passed to humans
            when humans hunted these chimpanzees for meat and came in contact with their infected blood.
          </li>
          <li>
            Studies show that HIV may have jumped from chimpanzees to humans as far back as the late 1800s.
          </li>
          <li>
            Over decades, HIV slowly spread across Africa and later into other parts of the world.
            We know that the virus has existed in the United States since at least the mid to late 1970s.
          </li>
        </ul>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>HIV symptoms</h2>
        <p>
          Some people have flu-like symptoms within 2 to 4 weeks after infection (called acute HIV infection).
          These symptoms may last for a few days or several weeks. Possible symptoms include:
        <ul>
          <li>
            Fever,
          </li>
          <li>
            Chills,
          </li>
          <li>
            Rash,
          </li>
          <li>
            Night sweats,
          </li>
          <li>
            Muscle aches,
          </li>
          <li>
            Sore throat,
          </li>
          <li>
            Fatigue,
          </li>
          <li>
            Swollen lymph nodes, and
          </li>
          <li>
            Mouth ulcers.
          </li>
        </ul>
        </p>
        <div class="text-center">
          <img src="../img/hivAids/symptoms.jpg" alt="symptoms of HIV" class="img-fluid" width="900" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>Transmission</h2>
        <p>
        <article>
          HIV can be transmitted via the exchange of a variety of body fluids from infected people, such as blood, breast milk,
          semen and vaginal secretions. HIV can also be transmitted from a mother to her child during pregnancy and delivery.
          Individuals cannot become infected through ordinary day-to-day contact such as kissing, hugging, shaking hands, or sharing personal objects,
          food or water. It is important to note that people with HIV who are taking ART and are virally suppressed do not transmit HIV to their sexual
          partners. Early access to ART and support to remain on treatment is therefore critical not only to improve the health of people with HIV but also to prevent HIV transmission.
        </article>
        </p>
        <div class="text-center">
          <img src="../img/hivAids/transmissionOfHIV.png" alt="transmission of HIV" class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>Prevention</h2>
        <p>
          Individuals can reduce the risk of HIV infection by limiting exposure to risk factors. Key approaches for HIV prevention,
          which are often used in combination, are listed below:
        <h5>Male and female condom use.</h5>
        Correct and consistent use of male and female condoms during vaginal or anal penetration can protect against the spread of STIs,
        including HIV. Evidence shows that male latex condoms when used consistently have an 85% or greater protective effect against HIV
        and other STIs.

        <h5>Harm reduction for people who inject and use drugs</h5>
        People who inject drugs can take precautions against becoming infected with HIV by using sterile injecting equipment (including needles and syringes) for each injection,
        and not sharing drug-using equipment and drug solutions. Treatment of drug dependence, in particular, opioid substitution therapy for people dependent on opioids, also helps
        to reduce the risk of HIV transmission and supports adherence to HIV treatment.A comprehensive package of HIV prevention and treatment interventions for people who inject drugs includes:
        <ul>
          <li>
            needle and syringe programmes
          </li>
          <li>
            opioid substitution therapy for people dependent on opioids, and other evidence-based drug dependence treatment
          </li>
          <li>
            HIV testing and counselling
          </li>
          <li>
            HIV treatment and care
          </li>
          <li>
            risk-reduction information and education, and provision of naloxone to prevent opioid overdose

          </li>
          <li>
            access to condoms
          </li>
          <li>
            management of STIs, TB and viral hepatitis.
          </li>
        </ul>
        </p>
        <div class="text-center">
          <img src="../img/hivAids/prevention.png" alt="prevention" class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h2>HIV statistics today</h2>
        <p>
        <ul>
          <li>
            26 million [25.1 million–26.2 million] people were accessing antiretroviral therapy as of the end of June 2020.
          </li>
          <li>
            38.0 million [31.6 million–44.5 million] people globally were living with HIV in 2019.
          </li>
          <li>
            1.7 million [1.2 million–2.2 million] people became newly infected with HIV in 2019.
          </li>
          <li>
            690 000 [500 000–970 000] people died from AIDS-related illnesses in 2019.
          </li>
          <li>
            75.7 million [55.9 million–100 million] people have become infected with HIV since the start of the epidemic (end 2019).
          </li>
          <li>
            32.7 million [24.8 million–42.2 million] people have died from AIDS-related illnesses since the start of the epidemic (end 2019).
          </li>
        </ul>
        </p>
      </div>
    </div>

    <br>
    <br>

    <div id="tag-display"></div>

    <br>
    <br>

    <div class="comments" id="comments"></div>

    <br>
    <br>

    <div class="row">
      <div class="col-sm">
        <h2>Sources (data)</h2>
        <p>
        <ul>
          <li>
            <a href="https://www.cdc.gov/hiv/basics/whatishiv.html" target="_blank">www.cdc.gov</a>
          </li>
          <li>
            <a href="https://www.unaids.org/en/resources/fact-sheet" target="_blank">www.unaids.org</a>
          </li>
          <li>
            <a href="https://www.who.int/news-room/fact-sheets/detail/hiv-aids" target="_blank">www.who.int</a>
          </li>
        </ul>
        </p>
        <h2>Sources (pictures)</h2>
        <p>
        <ul>
          <li>
            <a href="https://www.verywellhealth.com/hiv-aids-symptoms-4014373" target="_blank">www.verywellhealth.com</a>
          </li>
          <li>
            <a href="https://www.paho.org/hq/index.php?option=com_content&view=article&id=14834:paho-urges-testing-as-the-first-step-towards-preventing-hiv-and-halting-the-aids-epidemic&Itemid=1926&lang=en" target="_blank">www.paho.org</a>
          </li>
          <li>
            <a href="https://www.avert.org/hiv-transmission-prevention" target="_blank">www.avert.org</a>
          </li>
          <li>
            <a href="https://www.womenshealth.gov/hiv-and-aids/hiv-and-aids-basics" target="_blank">www.womenshealth.gov</a>
          </li>
        </ul>
        </p>
      </div>
    </div>
  </div>

  <span id="tags" style="display:none;">AIDS HIV STD</span>

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
  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>