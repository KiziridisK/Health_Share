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
  <meta name="author" content="Vasilis Andritsoudis" />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/parallax.css" rel="stylesheet">
  <link href="../css/covidImpact.css" rel="stylesheet">
  <link href="../css/comments.css" rel="stylesheet">

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Custom Scripts -->
  <script src="../scripts/chartjs/dist/chart.js"></script>
  <script src="../scripts/covidChartData.js" type="text/javascript"></script>
  <script src="../scripts/covidCharts.js" type="text/javascript"></script>
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
        renderCovidCharts();
      }
    });">
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
                <a class="dropdown-item" href="./roadAccidents.php">Road Accidents</a>
              </li>
              <li>
                <a class="dropdown-item active" href="#">The Impact of Covid-19</a>
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

  <div class="parallax covid_bg">
    <div class="parallax_text">
      <h1 class="text-center parallax_header" id="article-title">THE CORONAVIRUS PANDEMIC'S IMPACT ON MENTAL AND PHYSICAL HEALTH</h1>
    </div>
  </div>

  <div class="container">

    <br>

    <h2><em>The Coronavirus Pandemic</em></h2>

    <div class="row align-items-center">
      <div class="col-sm">
        <p>
          Since the first case of novel coronavirus disease 2019 (COVID-19) was diagnosed in December 2019, it has swept
          across the world and galvanized global action. This has brought unprecedented efforts to institute the
          practice of physical distancing (called in most cases “social distancing”) in countries all over the world,
          resulting in changes in national behavioral patterns and shutdowns of usual day-to-day functioning.

          <br>
          <br>

          While these steps may be critical to mitigate the spread of this disease, they will undoubtedly have
          consequences for mental health and well-being in both the short and long term. These consequences are of
          sufficient importance that immediate efforts focused on prevention and direct intervention are needed to
          address the impact of the outbreak on individual and population levels of mental and physical health.
        </p>
      </div>

      <div class="col-sm-5">
        <img src="../img/covidImpact/covidMolecule.jpg" class="img-fluid" alt="Image depicting Coronavirus molecule.">
      </div>
    </div>
  </div>

  <br>
  <br>
  <br>

  <div class="parallax mental_health_bg">
    <div class="parallax_text">
      <h2 class="text-center parallax_header">THE IMPLICATIONS OF COVID-19 FOR MENTAL HEALTH</h2>
    </div>
  </div>

  <div class="container">

    <br>

    <h2><em>Effects On Mental Health</em></h2>

    <br>

    <div class="row align-items-center">
      <div class="col-sm-5">
        <img src="../img/covidImpact/pandemicMentalHealth.png" class="img-fluid" alt="Image depicting the mental health problems a human is facing.">
      </div>

      <div class="col-sm-5">
        <p>
          Throughout the world, the public is being informed about the physical effects of SARS‐CoV‐2 infection and
          steps to take to prevent exposure to the coronavirus and manage symptoms of COVID‐19 if they appear. However,
          the effects of this pandemic on one's mental health have not been studied at length and are still not known.
          As all efforts are focused on understanding the epidemiology, clinical features, transmission patterns, and
          management of the COVID‐19 outbreak, there has been very little concern expressed over the effects on one's
          mental health and on strategies to prevent stigmatization. People's behavior may greatly affect the pandemic's
          dynamic by altering the severity, transmission, disease flow, and repercussions.
        </p>
      </div>

      <div class="col-sm-10">
        <br>

        <p>
          A pandemic is not just a medical phenomenon; it affects individuals and society and causes disruption,
          anxiety, stress, stigma, and xenophobia. Isolation, social distancing, and closure of educational institutes,
          workplaces, and entertainment venues consigned people to stay in their homes to help break the chain of
          transmission. However, the restrictive measures undoubtedly have affected the social and mental health of
          individuals from across the board. Quarantine and self‐isolation can most likely cause a negative impact on
          one's mental health. Under the current global situation, both children and adults are experiencing a mix of
          emotions. They can be placed in a situation or an environment that may be new and can be potentially damaging
          to their health.
        </p>
      </div>
    </div>

    <br>

    <h3><em>Effects on Children and Young People</em></h3>

    <div class="row align-items-center">
      <div class="col-sm-7">
        <p>
          Children, away from their school, friends, and colleagues, staying at home can have many questions about the
          outbreak and they look toward their parents or caregivers to get the answer. Not all children and parents
          respond to stress in the same way. Kids can experience anxiety, distress, social isolation, and an abusive
          environment that can have short‐ or long‐term effects on their mental health. Some common changes in
          children's behavior can be:
        </p>

        <ul>
          <li>Excessive crying and annoying behavior</li>
          <li>Increased sadness, depression, or worry</li>
          <li>Difficulties with concentration and attention</li>
          <li>Changes in, or avoiding, activities that they enjoyed in the past</li>
          <li>Unexpected headaches and pain throughout their bodies</li>
          <li>Changes in eating habits</li>
        </ul>
      </div>

      <div class="col-sm-5">
        <img src="../img/covidImpact/closedCovid.jpg" class="img-fluid" alt="Image that depicts the lockdown due to Covid 19.">
      </div>

      <div class="col-sm-10">
        <br>

        <p>
          To help offset negative behaviors, requires parents to remain calm, deal with the situation wisely, and answer
          all of the child's questions to the best of their abilities. Parents can take some time to talk to their
          children about the COVID‐19 outbreak and share some positive facts, figures, and information. Parents can help
          to reassure them that they are safe at home and encourage them to engage in some healthy activities including
          indoor sports and some physical and mental exercises. Parents can also develop a home schedule that can help
          their children to keep up with their studies. Parents should show less stress or anxiety at their home as
          children perceive and feel negative energy from their parents. The involvement of parents in healthy
          activities with their children can help to reduce stress and anxiety and bring relief to the overall
          situation.
        </p>
      </div>
    </div>

    <br>

    <h3><em>Effects on Elders and People with Disabilities</em></h3>

    <br>

    <div class="row align-items-center">
      <div class="col-sm">
        <p>
          Physical distancing due to the COVID‐19 outbreak can have drastic negative effects on the mental health of the
          elderly and disabled individuals. Physical isolation at home among family members can put the elderly and
          disabled person at serious mental health risk. It can cause anxiety, distress, and induce a traumatic
          situation for them. Elderly people depend on young ones for their daily needs, and self‐isolation can
          critically damage a family system. The elderly and disabled people living in nursing homes can face extreme
          mental health issues. However, something as simple as a phone call during the pandemic outbreak can help to
          console elderly people. COVID‐19 can also result inincreased stress, anxiety, and depression among elderly
          people already dealing with mental health issues.

          <br>
          <br>

          Family members may witness any of the following changes to the behavior of older relatives:
        </p>

        <ul>
          <li>Irritating and shouting behavior</li>
          <li>Change in their sleeping and eating habits</li>
          <li>Emotional outbursts</li>
        </ul>
      </div>

      <div class="col-sm-5">
        <img src="../img/covidImpact/globalShutDown.jpg" class="img-fluid" alt="Image that depicts the global shutdown.">
      </div>

      <div class="col-sm-10">
        <br>

        <p>
          The World Health Organization suggests that family members should regularly check on older people living
          within their homes and at nursing facilities. Younger family members should take some time to talk to older
          members of the family and become involved in some of their daily routines if possible.
        </p>
      </div>
    </div>

    <br>

    <div class="row align-items-center">
      <div class="col-sm">
        <canvas id="chartMentalHealth"></canvas>
      </div>
    </div>

    <br>
    <br>
    <br>
    <br>
  </div>

  <div class="parallax physical_health_bg">
    <div class="parallax_text">
      <h2 class="text-center parallax_header">THE IMPLICATIONS OF COVID-19 ON PHYSICAL HEALTH</h2>
    </div>
  </div>

  <div class="container">

    <br>

    <h2><em>Effects On Physical Health</em></h2>

    <br>

    <p>
      The COVID-19 pandemic is an unprecedented time all across the world. Worldwide, extensive social distancing
      policies are put into place, restricting people’s daily activities and worldwide pleas from governments asking
      people to stay safe and stay at home. This of course means that most people will spend much of their time (if not
      all) at home.

      <br>
      <br>

      These social distancing measures mean that people have far fewer opportunities to be physically active, especially
      if activities such as walking or cycling as transportation, or taking part in a leisurely activity (e.g. jogging,
      walking the dog, going to the gym) are being restricted. Furthermore, these drastic measures also make it so much
      easier to be sedentary at home for long periods of time. The impact of this physical inactivity may very likely
      be seen in many areas such as health and social care and the mental well-being of people all across the globe.
    </p>

    <br>

    <h3><em>Definition of Physical Activity</em></h3>

    <br>

    <p>
      Physical Activity (PA) is defined as any bodily movement produced by skeletal muscles that require energy
      expenditure. There are two components to physical activity that need to considered:
    </p>

    <ul>
      <li>Aerobic fitness: this usually includes moderate to vigorous activity that makes you feel a bit warm and
        causes an increase in your breathing rate, breathing depth and your heart rate.</li>
      <li>Strength and balance: This is often the forgotten component of physical activity but it is an essential
        part and has many benefits.</li>
    </ul>

    <div class="row align-items-center">
      <div class="col-sm-6">
        <img src="../img/covidImpact/physicalActivity.png" class="img-fluid" alt="Image that depicts physical activity - people walking.">
      </div>

      <div class="col-sm-6">
        <p>
          Physical activity may include:
        </p>

        <ul>
          <li>Sports participation</li>
          <li>Cycling</li>
          <li>Walking</li>
          <li>Gardening</li>
          <li>Carrying heavy shopping</li>
        </ul>

        <p>
          During the COVID-19 pandemic it is even more important for all people to be physically active. Even if it is
          only a short break from sitting at your desk and doing some walking or stretching. Doing something as simple
          as this will:
        </p>

        <ul>
          <li>ease muscle strain</li>
          <li>relief mental tension</li>
          <li>improve blood circulation</li>
          <li>improve muscle activity</li>
          <li>create some routine to your day in these unprecedented times</li>
        </ul>
      </div>
    </div>

    <br>

    <h3><em>Physical Activity Recommendations</em></h3>

    <br>

    <div class="row align-items-center">
      <div class="col-sm-7">
        <p>
          The new WHO 2020 Guidelines stress that any amount of physical activity is better than none, even when the
          recommended thresholds are not met (this is a very positive message for much of the population who currently
          fall well short of the desirable minimum).
        </p>

        <ol>
          <li>
            Young people aged 5-17 years: Children and adolescents should do at least an average of 60 min/day of
            moderate-to-vigorous intensity, mostly aerobic, physical activity, across the week. Vigorous intensity
            aerobic activities (e.g. running), as well as activities that strengthen muscle and bone (e.g. jumping,
            lifting weights), should be incorporated at least 3 days a week. Children and adolescents should limit the
            amount of time spent being sedentary, particularly the amount of recreational screen time such as social
            media and video gaming.
          </li>
          <li>
            Adults and older adults, including people living with chronic conditions and disabilities: For substantial
            health benefits, adults should engage in 150-300 minutes of moderate-intensity aerobic physical activity
            (e.g. brisk walking), or 75-150 minutes of vigorous activity (e.g. running) throughout the week, or
            equivalent combinations of both where 1 minute of vigorous activity is roughly equivalent to 2 minutes of
            moderate activity. Examples of aerobic activities include brisk walking, stair climbing, cycling, swimming,
            or running.
          </li>
          <li><b>Any physical activity is better than none!!!</b></li>
        </ol>
      </div>

      <div class="col-sm-4">
        <img src="../img/covidImpact/physicalActivities.jpg" class="img-fluid" alt="Image that depicts the various forms of physical activities.">
      </div>
    </div>

    <br>

    <h3><em>Physical (In)Activity during Lockdown</em></h3>

    <br>

    <div class="row align-items-center">
      <div class="col-sm-6">
        <p>
          Many countries in the world are currently in some or other form of lockdown or restricted movement policy and
          practicing social distancing. Some countries have stricter measures in place with regards to exercise and only
          allow people to exercise outside/away from their homes once a day or only allow people to exercise
          outside/away from their homes within a specific time frame or even not allowing any exercise outside/away from
          home. These restrictions and constraints are specific to each country and the the extent of the COVID-19
          outbreak in that specific country. In the media it is publicised that these various measures of lock down may
          have a positive effect on people's activity levels, with reports of more people being seen outside running,
          walking, cycling etc. We should be cautious of thinking that this implies that people are now adapting a more
          active and healthy lifestyle. Physical activity is accrued over a period of 24 hours in many different ways.
          Organised or structured sport/exercise is merely a small part of physical activity. Most people accumulate
          their "active minutes" by doing various other activities such as housework, walking the dog, walking/cycling
          to and from work, walking between tube/train stations, etc. All these activities are part of people's daily
          lives and contribute to their physical activity minutes. During periods of lockdown, many of these activities
          are restricted or not even taking place and it is extremely difficult to build in these levels of activity
          when people's daily movements are restricted.
        </p>
      </div>

      <div class="col-sm-5">
        <img src="../img/covidImpact/closedGym.jpg" class="img-fluid" alt="Image that depicts the closing of gyms due to Covid 19.">
      </div>
    </div>

    <br>

    <div class="row align-items-center">
      <div class="col-sm">
        <canvas id="chartPhysicalHealth"></canvas>
      </div>
    </div>

    <br>
    <br>

    <span id="tags" style="display:none;">covid health exercise</span>
    <div id="tag-display"></div>

    <br>
    <br>

    <div class="comments" id="comments"></div>

    <br>
    <br>

    <h5>Sources</h5>
    <ul>
      <li>
        <a href="https://jamanetwork.com/journals/jamainternalmedicine/fullarticle/2764404">The Mental Health
          Consequences of COVID-19 and Physical Distancing</a>
      </li>
      <li>
        <a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC7361582/">The coronavirus (COVID‐19) pandemic's impact on
          mental health</a>
      </li>
      <li>
        <a href="https://www.physio-pedia.com/Physical_Activity_and_COVID-19">Physical Activity and COVID-19</a>
      </li>
      <li>
        <a href="https://www.researchgate.net/publication/343531448_Collateral_Health_Issues_Derived_from_the_Covid-19_Pandemic">Collateral
          Health Issues Derived from the Covid-19 Pandemic</a>
      </li>
    </ul>
  </div>

  <footer class="bg-dark text-center text-lg-start text-white">
    <div class="container p-4">
      <div class="row">
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase">About</h5>
          <p>
            This website is dedicated to presenting information about several
            matters that are disturbing the well-being of humanity in our era.
          </p>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contributors</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <p>Kiziridis Konstantinos</p>
            </li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-2">Find us on</h5>

          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/facebook.png" alt="Facebook Icon" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/insta.png" alt="Instagram Icon" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/twitter.png" alt="Twitter Icon" style="width:30px;" />
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="../index.php">Health Share</a>
    </div>
  </footer>
</body>

</html>