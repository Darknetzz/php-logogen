<?php
require_once("includes/_includes.php");

$image = createImage($height, $width, $background, $border);
$image = addBorder($image, $border, $border_color);
$image = addText($image, $font, $text, $font_size, $color, $angle, $text_pos_x, $text_pos_y);

if (isset($_GET['debug'])) {
    $debug = True;
    if ($debug) {

        echo "Image format: " . $format . "<br>";
    
        if (textFits($image, $font, $text, $font_size, $border = 0) === True) {
            echo "<h3 class='alert alert-success alert-important'>Text fits</h3>";
        } else {
            echo "<h3 class='alert alert-warning alert-important'>Text does not fit</h3>";
        }


        echo "<h3>Defaults</h3>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>Key</th><th>Value</th></tr>";
        foreach ($defaults as $key => $value) {
            if (is_array($value)) {
            echo "<tr><td>$key</td><td>";
            foreach ($value as $subkey => $subvalue) {
                echo "$subkey: $subvalue<br>";
            }
            echo "</td></tr>";
            } else {
            echo "<tr><td>$key</td><td>$value</td></tr>";
            }
        }
        echo "</table>";
        
        echo "<h3>GET</h3>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>Key</th><th>Value</th></tr>";
        foreach ($_GET as $key => $value) {
            if ($key == 'defaults') {
            continue;
            }
            echo "<tr><td>$key</td><td>";
            if (is_array($value)) {
            foreach ($value as $subkey => $subvalue) {
                echo "$subkey: $subvalue<br>";
            }
            } else {
            echo "$value";
            }
            echo "</td></tr>";
        }
        echo "</table>";
    
        die();
    }
}

showImage($image, $format);
