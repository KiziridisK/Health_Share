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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Health and well being - SDG no. 3" />
  <meta name="keywords" content="SDG,Health, Well being, United Nations, UN" />
  <meta name="author" content="Konstantinos Kiziridis,Theodoros Dougalis ,Nikolaos Diamantis, Vasilis Andritsoudis " />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/comments.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../util/javascript/handleArticle.js" type="text/javascript"></script>
  <script src="../util//javascript/handleComments.js" type="text/javascript"></script>
  <script src="../util/javascript/handleTags.js" type="text/javascript"></script>
  <script src="../util/javascript/handleSearch.js" type="text/javascript"></script>

  <!-- MDB -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script> -->
  <!--Javscript imports-->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bun"></script> -->

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
                <a class="dropdown-item active" href="#">Marketisation of Healthcare</a>
              </li>
              <li>
                <a class="dropdown-item" href="./hivAids.php">HIV/AIDS</a>
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

  <div class="container">
    <div class="row">
      <div class="col-md col-sm">
        <h2 id="article-title">The Marketisation of Health Care</h2>
        <p>
          Some years ago, major corporations realised that they needed to move beyond the traditional means of making money, the production of goods that people would buy, to the provision of services.
          The problem was that many of the key services that people depended on, such as health, education, and social care, were being provided by the state, at least in Western Europe.
          The challenge they faced was to transform these services, which for 50 years had been funded by taxes, based on the ability of citizens to pay, and received on the basis of need.
          They were owned collectively by the people through the intermediary of the state, and people remained safe in the knowledge that they would be there when needed.
          They were not seen as an opportunity for private profit.
        </p>
        <div class="row align-items-center">
          <div class="col-sm">
            <p>
              To change this, market elites first had to rewrite the rules in their favour, getting their client governments in North America and Europe to shape the General Agreement on Trade in Services to their advantage.
              Within the European Union, similar measures were adopted in relation to the provision of services.
              To get their hands on health and education services, seen as the main growth areas, the corporations needed to prise them away from government control.
              The anticipated rewards of privatisation were enormous, as they had realised in the United States where returns on investment in the health sector had been huge
              <!--(now accounting for one-fifth of GDP, the highest worldwide)-->.
              And health had another benefit.
              The demand was potentially unlimited, not least because those who supplied it could themselves stimulate demand.
            </p>
          </div>
          <div class="col-sm-5">
            <img src="../img/marketisationOfhealthCareMedia/not_for_sale.jpg" alt="'Our health is not for sale' written in a barcode" class="img-thumbnail" />
          </div>
        </div>
        <br>
        <p>
          Second, the market elites had to overcome resistance from a universal public system that had enduring popularity and public support.
          This involved creating popular discontent, drawing attention to any failings in the public system, and promoting choice as a value in itself, alongside effectiveness, efficiency, humanity and equity.
        </p>
        <div class="row align-items-center">
          <div class="col-sm-6">
            <img src="../img/marketisationOfhealthCareMedia/hands_off.jpg" alt="A woman holds a placard, in witch is written: Hands off 'our' NHS, 'No' to privatisation" class="img-thumbnail">
          </div>
          <div class="col-sm">
            <p>
              However, in seeking to unleash a market in health care they faced some fundamental problems.
              Some fifty years ago, the Nobel Laureate Kenneth Arrow described why the market in health care fails.
              The reasons include the presence of externalities, whereby one person benefits from another receiving health care, especially if they have a contagious disease or a psychosis that may cause them to be violent.
              There is also information asymmetry, where the health professional offering care knows more about what the patient needs than they do themselves.
              But above all there is the problem that those who are in most need of care are the least able to afford it.
              In contrast, those who need care least have plenty of money.
              This was recognised in the 1920s in the United States when the insurers Blue Cross and Blue Shield were created by associations of doctors and hospitals, not because they were concerned about the ability of people to obtain care, but rather to ensure that they themselves would be paid for providing it.
              Given these well-known market failures, how can the private sector make the profits it sought from health care?
            </p>
          </div>
        </div>
        <h3>Capitalism is the problem</h3>
        <p>
          Some ill-informed but perhaps well-intentioned people opine that all we need to do to solve the healthcare cost problem is unleash the free market.
          Their thinking seems to be that creative approaches and Adam Smith’s “invisible hand” will conquer the cost:quality:access conundrum.
        </p>
        <div class="row align-items-center">
          <div class="col-sm">
            <p>
              <b>No for-profit insurance company wants to “insure” a person with cancer,</b> depression, heart disease, asthma.
              Nor do they want to keep insuring someone who gets sick.
            </p>
          </div>
          <div class="col-sm-4">
            <img src="../img/marketisationOfhealthCareMedia/nhs.jpg" alt="Yellow vests protests for NHS" class="img-thumbnail">
          </div>
          <div class="col-sm">
            <p>
              There has been ample time and much experimentation with various types of “free market” solutions – yet here we are.
              Family insurance premiums are close to $20,000 and come with sky-high deductibles, medical trend continues to climb, and big insurers are not jumping into markets.
            </p>
          </div>
        </div>
        <br>
        <p>
          Insurance requires the many subsidize the few.
          If healthy people aren’t in the regular insurance pool, costs for sick folks will go up a lot – and inevitably lead to insurance market death spirals where only the wealthiest people can afford insurance.
          To be fair, free marketers will assert that this is exactly the problem – a big part of healthcare costs (e.g. maintenance drugs, child health, care for chronic conditions) shouldn’t be insured as they are not a classic “insurable risk”?
          somewhat unpredictable and random. That’s true. But it begs the question – most Americans can’t afford to pay for needed medical care without support from an insurer or third party.
        </p>
        <p>All this leads us to the real problem. <b>Healthcare is very much a profit driven business,</b> and the companies and individuals making gazillions on healthcare are going to fight to the death to keep it that way.</p>

        <span id="tags" style="display:none;">healthcare marketisation marketization</span>
        
        <br>
        <br>

        <div id="tag-display"></div>

        <br>
        <br>

        <div class="comments" id="comments"></div>

        <br>
        <br>

        <h4>Sources</h4>
        <a href="https://www.nlm.nih.gov/">National Library of Medicine</a> <br>
        <a href="https://www.joepaduda.com/">Managed Care Matters</a>
      </div>
    </div>
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