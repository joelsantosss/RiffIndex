<?php

require "top.php";
require "nav.php";

?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">

<!-- left container -->
<div class="side-container left-side">
  <img src="images/aboutimg2.jgp.jpg" alt="Rock Band 2">
  <img src="images/abuotimg3.jpg" alt="Rock Band 3">
</div>



<!-- about content -->
<div class="about-page">
  <h2 class="about-title">Rock Out with RiffIndex!</h2>
  <p class="about-subtitle">
    Welcome to RiffIndex — your gateway to all things rock! We’re here to fuel your passion for rock music, one riff at a time.
  </p>

  <div class="about-content">
    <section class="about-section">
      <h3>Explore Your Favorite Bands</h3>
      <p>Dive into our extensive database, where you can find in-depth profiles on classic rock legends and the latest emerging bands.</p>
    </section>

    <section class="about-section">
      <h3>Learn Iconic Riffs & Tabs</h3>
      <p>Discover guitar tabs for your favorite rock songs and start playing iconic riffs yourself. Perfect for both new and experienced players!</p>
    </section>

    <section class="about-section">
      <h3>Stay Informed & Inspired</h3>
      <p>Get the latest updates on rock history, news, and trivia, and keep your knowledge sharp with our curated content.</p>
    </section>
  </div>

  <div class="about-cta">
    <h3>Ready to rock? Join us at RiffIndex!</h3>
    <p>Whether you're here to learn, listen, or just love rock ‘n’ roll, we’re here to keep the spirit of rock alive!</p>
    <a href="signup.php" class="cta-button">Join the Rock Community</a>
  </div>
</div>

<!-- right container -->
<div class="side-container right-side">
  <img src="images/aboutimg4.jpg" alt="Rock Concert 1">
  <img src="images/aboutimg1.jpg" alt="Rock Band 1">
</div>

<?php
require "foot.php";
?>