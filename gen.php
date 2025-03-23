<?php
require_once("includes/_includes.php");

$image = createImage($height, $width, $background, $border);
$image = addBorder($image, $border, $border_color);
$image = addText($image, $font, $text, $font_size, $color, $image_rotation, $text_pos_x, $text_pos_y);

if (isset($_GET['debug'])) {
    $debug = True;
    if ($debug) {
    
        if (textFits($image, $font, $text, $font_size, $border = 0) === True) {
            echo "<h3 class='alert alert-success alert-important'>Text fits</h3>";
        } else {
            echo "<h3 class='alert alert-warning alert-important'>Text does not fit</h3>";
        }

        echo "Image format: " . $format . "<br>";



        echo "<table class='table table-sm'>";
        echo "<tr><th colspan='100%' class='text-bg-secondary'><h3>Defaults</h3></th></tr>";
        echo "<tr class='text-bg-secondary'><th>Key</th><th>Value</th></tr>";
        foreach ($defaults as $key => $value) {
            if (is_array($value)) {
            echo "<tr><td>$key</td><td>";
            foreach ($value as $subkey => $subvalue) {
                echo "$subkey: $subvalue<br>";
            }
            echo "</td></tr>";
            } else {
            echo "<tr><td>$key</td><td><code>$value</code></td></tr>";
            }
        }
        echo "</table>";
        
        echo "<table class='table table-sm'>";
        echo "<tr><th colspan='100%' class='text-bg-secondary'><h3>GET</h3></th></tr>";
        echo "<tr class='text-bg-secondary'><th>Key</th><th>Value</th></tr>";
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
            echo "<code>$value</code>";
            }
            echo "</td></tr>";
        }
        echo "</table>";
    
        die();
    }
}

showImage($image, $format);
