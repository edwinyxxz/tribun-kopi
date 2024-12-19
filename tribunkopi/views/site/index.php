<?php
/* @var $this yii\web\View */
$this->title = 'Tribun Coffee';  // Set the page title dynamically
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title> <!-- Use Yii2 dynamic title -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/assets/645dcd55/css/main.css">
    </head>
<body>

<!-- Header -->
<header class="header">
    <div class="container">
        <h1>Welcome to Tribun Coffee</h1>
        <p>Experience luxury in every sip.</p>
    </div>
</header>

<!-- About Section -->
<section id="about" class="about">
    <div class="container">
        <div class="text">
            <h2>ABOUT US</h2>
            <p>Tribun Coffee is a premium coffee shop dedicated to serving the finest coffee with a touch of elegance and warmth. Founded with a passion for coffee, we aim to create memorable experiences for every guest.</p>
        </div>
        <div class="image">
            <!-- Using Yii's alias system to get the correct image path -->
            <img src="<?= Yii::getAlias('@web') ?>/images/about1.jpg" alt="About Tribun Coffee">
            </div>
    </div>
</section>


<!-- Menu Section -->
<section id="menu" class="menu">
    <div class="container">
        <h2>Our Menu</h2>
        <div class="menu-grid">
            <div class="menu-item">
            <img src="<?= Yii::getAlias('@web') ?>/images/coffee1.png" alt="espresso">
            <h3>Espresso</h3>
                <p>Rich and bold flavor</p>
                <a href="https://gojek.com" target="_blank" class="btn">Order Now</a>
            </div>
            <div class="menu-item">
            <img src="<?= Yii::getAlias('@web') ?>/images/coffee2.png" alt="latte">
                <h3>Latte</h3>
                <p>Creamy and smooth</p>
                <a href="https://gojek.com" target="_blank" class="btn">Order Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Address Section -->
<section id="address" class="address">
    <div class="container">
        <h2>Find Us</h2>
        <p>Jl. Parikesit, Klegen, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63117</p>
        <div id="map"></div>
        <iframe width="800" height="450" src="https://www.openstreetmap.org/export/embed.html?bbox=111.53370738029481%2C-7.636349715529742%2C111.54192566871644%2C-7.630203400444936&amp;layer=mapnik&amp;marker=-7.633276569032845%2C111.53781652450562" style="border: 0.5px solid rgb(0, 0, 0)"></iframe><br/><small></small>
        <a href="https://maps.app.goo.gl/UDCJg9G9fa95N2CA6" target="_blank" class="btn">View on Google Maps</a>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <p>Get in touch for any inquiries or feedback.</p>
        <form id="contact-form">
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" required></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</section>

</body>
</html>
