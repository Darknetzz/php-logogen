<?php

require_once("functions.php");

// Set content type to image
if (!extension_loaded('gd')) {
    die('GD extension is not loaded.');
}
if (!function_exists('imagepng')) {
    die('GD imagepng function is not available.');
}
if (!function_exists('imagettftext')) {
    die('GD imagettftext function is not available.');
}
if (!function_exists('imagettftext')) {
    die('GD imagettftext function is not available.');
}

$image_formats = [
    "png",
    "jpg",
    "jpeg",
    "gif",
    "webp",
    "bmp",
    "wbmp",
    "xbm",
];

$size_units = [
    "px",
    "em",
    "rem",
    "%",
    "vw",
    "vh",
    "vmin",
    "vmax",
    "cm",
    "mm",
    "in",
    "pt",
    "pc",
    "ex",
    "ch"
];
$units_dropdown = "";
foreach ($size_units as $unit) {
    $units_dropdown .= "<option value=\"$unit\">$unit</option>";
}

$font_path = "fonts";
$fonts     = recursiveScan($font_path);
if (empty($fonts)) {
    die("No fonts found in $font_path");
}

$defaults = [
        "width"        => 250,
        "width_units"  => "px",
        "height"       => 250,
        "height_units" => "px",
        "text"         => "Insert text here...",
        "angle"        => 0,
        "background"   => "#".sprintf('%06X', mt_rand(0, 0xFFFFFF)),
        "color"        => ($default_color = "#".sprintf('%06X', mt_rand(0, 0xFFFFFF))),
        "border"       => 0,
        "border_color" => $default_color,
        "font"         => $fonts[mt_rand(0, count($fonts) - 1)],
        "font_size"    => 30,
        "format"       => "png",
];
$font_dropdown = "";
foreach ($fonts as $font) {
    if ($defaults['font'] == $font) {
        $font_dropdown .= "<option value=\"$font\" selected>$font</option>";
        continue;
    }
    $font_name = str_replace(".ttf", "", basename($font));
    $font_dropdown .= "<option value=\"$font\">$font_name</option>";
}
$image_formats_dropdown = "";
foreach ($image_formats as $format) {
    if ($format == $defaults['format']) {
        $image_formats_dropdown .= "<option value=\"$format\" selected>$format</option>";
    } else {
        $image_formats_dropdown .= "<option value=\"$format\">$format</option>";
    }
}

$width        = isset($_GET['width']) ? $_GET['width'] : $defaults['width'];
$height       = isset($_GET['height']) ? $_GET['height'] : $defaults['height'];
$text         = isset($_GET['text']) ? $_GET['text'] : $defaults['text'];
$angle        = isset($_GET['angle']) ? $_GET['angle'] : $defaults['angle'];
$font         = isset($_GET['font']) ? $_GET['font'] : $defaults['font'];
$font_size    = isset($_GET['font_size']) ? $_GET['font_size'] : $defaults['font_size'];
$background   = isset($_GET['background']) ? $_GET['background'] : $defaults['background'];
$color        = isset($_GET['color']) ? $_GET['color'] : $defaults['color'];
$border       = isset($_GET['border']) ? $_GET['border'] : $defaults['border'];
$border_color = isset($_GET['border_color']) ? $_GET['border_color'] : $defaults['border_color'];
$format       = isset($_GET['format']) ? $_GET['format'] : $defaults['format'];