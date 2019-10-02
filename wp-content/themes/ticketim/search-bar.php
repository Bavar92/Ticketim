<?php

$countryCityList = getCountryCityList();
$artistsList     = getArtists();

?>

<script type="application/javascript">

var countryCityList = <?=json_encode($countryCityList)?>;
var artistsList     = <?=json_encode($artistsList)?>;

</script>

<div class="main-banner-wrapper <?= $bannerSize == 'big' ? '' : 'small' ?>">
    <img src="<?=$searchBarBanner?>" class="main-banner" alt="">
    <h1 class="main-banner-title"><?=$searchBarTitle?></h1>
    <p class="main-banner-description"><?=$searchBarSubtitle?></p>
    <div class="form-header" id="searchForm">
        <div class="submit-container mobile">
            <input type="submit" class="submit" id="extend-form" value="">
            <img src="assets/search.svg" class="submit-icon " alt="">
        </div>
        <div class="icon-input">
            <input type="text" name="" class="text-input" placeholder="אמן/קבוצה" id="search-bar-artist">
            <img src="assets/people.svg" class="icon" alt="">
            <ul class="autocomplete-container" id="artists-autocomplete-container"></ul>
        </div>
        <div class="icon-input">
            <input type="text" name="" class="text-input" placeholder="עיר/מדינה" id="search-bar-location">
            <img src="assets/location.svg" class="icon" alt="">
            <ul class="autocomplete-container" id="countries-autocomplete-container"></ul>
        </div>
        <!-- https://flatpickr.js.org/examples/#range-calendar -->
        <div class=" icon-input">
            <div id="date-input" class="date-picker">תאריך</div>
            <img src="assets/calendar.svg" class="icon" alt="">
        </div>
        <div class=" icon-input">
            <select name="" class="text-input">
                <option value="" disabled selected>סוג האירוע </option>
                <option value="">הופעה</option>
                <option value="">ספורט</option>
                <option value="">אטרקציות ומחזות זמר</option>
                <option value="">פסטיבלים</option>
            </select>
            <img src="assets/type.svg" class="icon" alt="">
        </div>
        <!-- 2 submit down here 1 for desktop and other for mobile -->
        <div class="submit-container desktop">
            <input type="submit" class="submit" value="">
            <img src="assets/search.svg" class="submit-icon" alt="">
        </div>
        <div class="submit-container mobile" id="close-form">
            <input type="submit" class="submit" value="">
            <img src="assets/search.svg" class="submit-icon" alt="">
        </div>
    </div>
</div>