<?php

require_once("functions.php");

/* ========================== NOTE: Prechecks ========================== */
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

/* =========================== NOTE: Classes =========================== */
$classes = [
    "card"        => "card text-bg-dark border border-secondary mb-3",
    "card-header" => "card-header text-bg-secondary",
    "card-body"   => "card-body border border-secondary text-bg-dark",
];

/* ======================== NOTE: Image formats ======================== */
$image_formats = [
    "png",
    "jpg",
    "jpeg",
    "gif",
    "webp",
    "bmp",
    "wbmp",
    "xbm",
    "tiff",
    "gd",
    "gd2",
];
$image_formats_select = "";
foreach ($image_formats as $format) {
    $image_formats_select .= '
        <label class="form-selectgroup-item">
            <input type="radio" name="name" value="'.$format.'" class="form-selectgroup-input" />
            <span class="form-selectgroup-label">'.$format.'</span>
        </label>
    ';
}

/* =========================== NOTE: Filters =========================== */
$filters = [
    "none"        => "No filter",
    "grayscale"   => "Grayscale",
    "invert"      => "Invert",
    "brightness"  => "Brightness",
    "contrast"    => "Contrast",
    "colorize"    => "Colorize",
    "emboss"      => "Emboss",
    "edge"        => "Edge",
    "gaussian"    => "Gaussian blur",
    "pixelate"    => "Pixelate",
];
$filters_select = "";
foreach ($filters as $filter => $description) {
    $filters_select .= '
        <label class="form-selectgroup-item">
            <input type="radio" name="name" value="'.$filter.'" class="form-selectgroup-input" />
            <span class="form-selectgroup-label">'.$description.'</span>
        </label>
    ';
}

/* ========================== NOTE: Size units ========================= */
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

/* ============================ NOTE: Fonts ============================ */
$font_path = "fonts";
$fonts     = recursiveScan($font_path);
if (empty($fonts)) {
    die("No fonts found in $font_path");
}
$font_dropdown = "";
foreach ($fonts as $font) {
    if ($defaults['font'] == $font) {
        $font_dropdown .= "<option value=\"$font\" selected>$font</option>";
        continue;
    }
    $font_name = str_replace(".ttf", "", basename($font));
    $font_dropdown .= "<option value=\"$font\">$font_name</option>";
}

/* =========================== NOTE: Defaults ========================== */
$defaults = [
        "width"        => 250,
        "width_units"  => "px",
        "height"       => 250,
        "height_units" => "px",
        "text"         => "Insert text here...",
        "text_pos_x"   => 0,
        "text_pos_y"   => 0,
        "angle"        => 0,
        "background"   => "#".sprintf('%06X', mt_rand(0, 0xFFFFFF)),
        "color"        => ($default_color = "#".sprintf('%06X', mt_rand(0, 0xFFFFFF))),
        "border"       => 0,
        "border_color" => $default_color,
        "font"         => $fonts[mt_rand(0, count($fonts) - 1)],
        "font_size"    => 30,
        "format"       => "png",
];

$width        = isset($_GET['width']) ? $_GET['width'] : $defaults['width'];
$height       = isset($_GET['height']) ? $_GET['height'] : $defaults['height'];
$text         = isset($_GET['text']) ? $_GET['text'] : $defaults['text'];
$angle        = isset($_GET['angle']) ? $_GET['angle'] : $defaults['angle'];
$font         = isset($_GET['font']) ? $_GET['font'] : $defaults['font'];
$font_size    = isset($_GET['font_size']) ? $_GET['font_size'] : $defaults['font_size'];
$text_pos_x   = isset($_GET['text_pos_x']) ? $_GET['text_pos_x'] : $defaults['text_pos_x'];
$text_pos_y   = isset($_GET['text_pos_y']) ? $_GET['text_pos_y'] : $defaults['text_pos_y'];
$background   = isset($_GET['background']) ? $_GET['background'] : $defaults['background'];
$color        = isset($_GET['color']) ? $_GET['color'] : $defaults['color'];
$border       = isset($_GET['border']) ? $_GET['border'] : $defaults['border'];
$border_color = isset($_GET['border_color']) ? $_GET['border_color'] : $defaults['border_color'];
$format       = isset($_GET['format']) ? $_GET['format'] : $defaults['format'];