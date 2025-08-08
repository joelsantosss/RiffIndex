<?php
session_start();
include('auth_check.php');
require "top.php";
require "nav.php";
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">

<!-- main container -->
<main class="container my-5 d-flex justify-content-center">
  <!-- carousel card container with text on top -->
  <div class="card shadow-lg rounded-lg" style="max-width: 1000px;">
    <!-- description section on top -->
    <div class="card-header text-center bg-white border-0">
      <h2 class="display-4">Rock out!</h2>
      <p class="lead">Enjoy a look at some of our favorite bands right now and their live performances!</p>
    </div>

    <!-- carousel body with padding and rounded corners -->
    <div class="card-body p-0">
      <!-- carousel component -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner rounded">
          <div class="carousel-item active">
            <img src="images/nirvana1.jpg" class="d-block w-100 carousel-image" alt="Nirvana">
            <div class="carousel-caption d-none d-md-block">
              <div class="text-container">
                <h3>Nirvana</h3>
                <p>Debatably the Best Grunge Band of the 90's!</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/qotsa2.jpg" class="d-block w-100 carousel-image" alt="Qotsa">
            <div class="carousel-caption d-none d-md-block">
              <div class="text-container">
                <h3>Queens of the Stone Age</h3>
                <p>QOTSA touring for their newest 2023 album, "In Times New Roman..."!</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/stokes1.jpg" class="d-block w-100 carousel-image" alt="strokes">
            <div class="carousel-caption d-none d-md-block">
              <div class="text-container">
                <h3>The Strokes</h3>
                <p>The Famous 2 Dollar MTV Strokes Performance which Revived Garage Rock in the Early 2000's!</p>
              </div>
            </div>
          </div>
        </div>
        <!-- controls for carousel -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</main>

<!-- The Band Section -->
<div class="band-container band-content band-center band-padding-64" id="band">
  <h2 class="band-wide">RIFFINDEX</h2>
  <p class="band-opacity"><i>Your Gateway to Rock and Alternative Music</i></p>
  <p class="band-justify">
    Welcome to RiffIndex, the ultimate destination for rock and alternative music lovers. Explore our comprehensive rock database filled with classic anthems and modern hits, and discover the tabs to your favorite songs. Whether you're a seasoned musician or simply passionate about the genre, RiffIndex offers the tools and resources to deepen your connection to the music that moves you. From timeless riffs to cutting-edge tracks, RiffIndex is your go-to platform for diving into the world of rock. Start exploring and let the music inspire you.
  </p>
</div>

<!-- The Tour Section -->
<div class="w3-black" id="tour">
  <div class="w3-container">
    <h2 class="w3-wide w3-center">LATEST NEWS</h2>
    <p class="w3-opacity w3-center">
      <i>Get the latest updates in rock and alternative music, from new album releases to concert tours and band interviews. Stay tuned for all the exciting news and trends in the world of rock!</i>
    </p>
    <br>
    <div class="w3-row-padding">
      <div class="album-card">
        <img src="images/hang.jpeg" alt="Steve Hill" class="album-image">
        <div class="w3-container w3-white">
          <p class="w3-opacity">Steve Hill - Hanging On A String</p>
          <p>Blues Rock | Hard Rock</p>
          <p>Steve Hill's new album, *Hanging On A String*, is a raw, dystopian-infused blues-rock masterpiece that showcases the one-man band's relentless artistry and perseverance in today’s challenging music industry.</p>
          <a href="https://www.newreleasesnow.com/album/steve-hill-hanging-on-a-string" target="_blank" class="w3-button w3-black w3-margin-bottom">READ MORE</a>
        </div>
      </div>
      <div class="album-card">
        <img src="images/americang.jpeg" alt="Tinkertown" class="album-image">
        <div class="w3-container w3-white">
          <p class="w3-opacity">Tinkertown - American Gothic</p>
          <p>Americana | Indie Rock</p>
          <p>Tinkertown’s American Gothic is a portrait of life and love, painted with the many colors of rock n’ roll for a sound that’s heartfelt, adventurous, and most importantly, unafraid.</p>
          <a href="https://www.newreleasesnow.com/album/tinkertown-american-gothic" target="_blank" class="w3-button w3-black w3-margin-bottom">READ MORE</a>
        </div>
      </div>
      <div class="album-card">
        <img src="images/linkedinpark.jpeg" alt="Linkin Park" class="album-image">
        <div class="w3-container w3-white">
          <p class="w3-opacity">Linkin Park - From Zero</p>
          <p>Alt Metal | Alternative</p>
          <p>With new singer Emily Armstrong, Linkin Park is a band reborn on From Zero, the beginning of a new era but still rooted in old bonds.</p>
          <a href="https://www.newreleasesnow.com/album/linkin-park-from-zero" target="_blank" class="w3-button w3-black w3-margin-bottom">READ MORE</a>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- The Contact Section -->
<div class="w3-container w3-content w3-padding-64" id="contact">
  <h2 class="w3-wide w3-center">CONTACT</h2>
  <p class="w3-opacity w3-center"><i>Fan? Drop a note!</i></p>
  <div class="w3-row w3-padding-32">
    <div class="w3-col m6 w3-large w3-margin-bottom contact-info">
      <i class="fa fa-map-marker"></i> New Britain, CT<br>
      <i class="fa fa-phone"></i> Phone: +00 151515<br>
      <i class="fa fa-envelope"></i> Email: RiffIndex@gmail.com<br>
    </div>
    <br>
    <div class="w3-col m6">
      <!-- Form that sends to send_email.php -->
      <form action="send_email.php" method="post">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Name" required name="Name">
        </div>
        <div class="form-group">
          <input class="form-control" type="email" placeholder="Email" required name="Email">
        </div>
        <div class="form-group">
          <textarea class="form-control" placeholder="Message" required name="Message"></textarea>
        </div>
        <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
      </form>
    </div>
  </div>
</div>




<?php require "foot.php"; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>