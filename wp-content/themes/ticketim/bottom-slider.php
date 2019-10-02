<?php
function sliders($events)
{

    foreach ($events as $key => $event) {
        echo '<div class="event-card">
            <div class="event-card-image-container">
                <img class="event-card-image" src="assets/placeholder-image.jpg" alt="">
                <div class="icon-contianer">
                    <img src="assets/view-icon.svg" alt="" class="icon">
                    <span class="view-count">120</span>
                </div>
            </div>
            <div class="event-card-details-container">
                <div class="right-column">
                    <h2 class="event-title">שם של מופע</h2>
                    <p class="event-sub-title">טיסה + 3 לילות במלון 4* + כרטיס </p>
                    <span class="event-date">מתאריך: 06/06/2019 עד 09/06/2019</span>

                </div>
                <div class="left-column">
                    <span class="starting-price">החל מ-</span>
                    <span class="price">586 €</span>
                </div>
            </div>
        </div>';
    }
}
?>

<div class="banner">
    <img src="assets/placeholder-image.jpg" class="banner-image" alt="">
    <span class="banner-title">הוא פשוט טקסט גולמי</span>
    <span class="banner-caption">12/11/2019</span>
</div>

<div class="desktop">
    <div class="slider-container">
        <h1 class="slider-container-title">חבילות או אירועים שמשתמשים צפו לאחרונה</h1>
        <div class="glider-wrapper">
            <div class="glider">
                <?php sliders([1, 2, 3, 4, 5]) ?>
            </div>
            <button class="glider-next"><img class="arrow-next" src="assets/arrow.png" alt=""></button>
            <button class="glider-prev"><img class="arrow-prev" src="assets/arrow.png" alt=""></button>
        </div>
    </div>
</div>

<div class="mobile">
    <div class="mobile-event-cards">
        <h1 class="mobile-event-cards-title">חבילות או אירועים
            שמשתמשים צפו לאחרונה</h1>
        <?php sliders([1, 2, 3, 4, 5]) ?>
    </div>
</div>
<script type="application/javascript" src="js/bottom-slider.js"></script>