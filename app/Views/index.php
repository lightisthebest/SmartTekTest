<?php

use App\App;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test - Main page</title>
    <meta name="description" content="Test - Main page">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<p class="center-box js-selected-file">Select some csv file</p>
<form id="file-form" class="center-box">
    <input id="file-input" type="file" accept=".csv" hidden>
    <a class="button js-select-file">Select file</a>
    <input class="button" type="submit" value="Send Request">
</form>
<div class="loader" style="display: none">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<div id="data-table"></div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/DefaultController.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof $ !== "function") {
            alert('jQuery is not found');
        }
        if (typeof DefaultController !== 'function') {
            alert('Scripts are not loaded. Page will not work correctly. Please, reload page and try again');
        } else {
            new DefaultController(`<?=App::API_LINK?>`);
        }
    });
</script>
</body>
</html>
