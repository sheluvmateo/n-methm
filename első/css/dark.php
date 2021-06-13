<?php
    header("Content-type: text/css");
    require_once('../includes/config.php');

    function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));
    
        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }
    
        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';
    
        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }
    
        return $return;
    }
?>

body {
    background-color: #141c1f;
    padding: 0px; 
    margin: 0px;
    margin-bottom: 15px;
    margin-top: 50px;
}

@media (min-width: 992px) { 
    .margin {margin-top: 25px;}
}

    .menu {
        background-color: <?=$config['color']?>; 
        height: 50px;
    }

.container {
    background-color: #242424;
    color: #fff;
}

.navbar-default {border: none; border-radius: 0px; padding: 0px; margin-left: 0px;}
.navbar-default {background-color: transparent;}
.navbar-right {margin-right: 5px;}
.navbar-toggle {background-color: #8A3316;}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    background-color: transparent;
    color: #000;
}

.menu-logo {
    margin-top: 10px;
    height: 30px;
}

.navbar-default .navbar-nav > li > a {
    color: <?=adjustBrightness($config['color'], -100)?>;
}

.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
    color: #000;
    transition: color 0.6s ease;
}
.welcome-text {
    color: #cd3737;
    transition: color 0.6s ease;
}
.welcome-text:hover {color: #af3131;text-decoration: none;}

.panel-footer {background-color: transparent;}
.panel-footer p {margin: 0 0 0;}

.footer {
        background-color: #2f2f2f; 
        height: 40px;
        color: #fff;
}

.img-rounded {width: 140px; height: 140px;}
.char-data .progress-bar {height: 10px;}
.char-data .progress {height: 10px;}


/* LOGIN */
.login {
    background-color: transparent; 
    box-shadow: none;
}
.login .input-group input[type=text] {
    border-radius: 0px; 
    border: 0px; 
    width: 300px; 
    height: 50px;
}
.login .input-group input[type=password] {
    border-radius: 
    0px; border: 0px; 
    width: 300px; 
    height: 50px;
}
.login .input-group-addon {
    border-radius: 0px; 
    border: 0px; 
    width: 50px; 
    height: 50px;
    background-color: #2f2f2f;
} 

.form-control {
    color: inherit;
    background-color: #242424;
}

.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: <?=$config['color']?>;
}

.login .button {
    width: 100%; 
    margin-top: 5px;
}
.g-recaptcha {
    margin-left: 20px; 
    margin-top: 5px;
}
.login .header {
    color: #fff
}

.panel {
    background-color: #2f2f2f;
    border: none;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}

.panel-heading {
    border-color: transparent !important; 
    background-color: <?=$config['color']?> !important;
    border-top-left-radius: 0px; 
    border-top-right-radius: 0px;
}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border-top: 1px solid #4e4e4e;
}

.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #222;
}