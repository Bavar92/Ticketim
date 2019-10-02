
<div class="mobile">
    <div class="footer-main">
        <h1 class="footer-title">לקבלת דיוור על אירועים ומבצעים שווים</h1>
        <input type="text" name="" class="mail-input" placeholder="רשום כתובת מייל" id="">
        <input type="submit" value="שלח" class="mail-submit">
        <img class="logo" src="assets/logo.png" alt="">
        <div class="social-media-container">
            <img src="assets/facebook.png" class="social-media" alt="">
            <img src="assets/twitter.png" class="social-media" alt="">
            <img src="assets/instagram.png" class="social-media" alt="">
            <img src="assets/trip-advisor.png" class="social-media" alt="">
            <img src="assets/youtube.png" class="social-media" alt="">
        </div>
    </div>
</div>

<div class="desktop">
    <div class="footer-main">
        <div class="top-footer">
            <div class="mail-input-container">
                <h1 class="footer-title">לקבלת דיוור על אירועים ומבצעים שווים</h1>
                <div class="form">
                    <input type="text" name="" class="mail-input" placeholder="רשום כתובת מייל" id="">
                    <input type="submit" value="שלח" class="mail-submit">
                </div>
            </div>
            <div class="social-media-container">
                <?= some() ?>
            </div>
        </div>
        <div class="footer-bottom flex">

            <nav id="footerMenu">
                <?php wp_nav_menu(array('container' => false, 'items_wrap' => '<ul id="%1$s">%3$s</ul>', 'theme_location' => 'footer_menu')); ?>
            </nav>
            <div class="payment-section">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aperiam cum cumque delectus dolores eaque ex harum inventore ipsam iure iusto libero, numquam perspiciatis ratione sed sunt, velit! Dolorum, pariatur.
                <img src="<?= theme() ?>/assets/Ticketim.png" alt="payment">
            </div>
        </div>
    </div>
</div>

</body>

</html>