<?php

/* ===================================================================== */
/*                           FUNCTION: hex2rgb                           */
/* ===================================================================== */
function hex2rgb($hex) {

    try {
        if (strlen($hex) != 7 || $hex[0] != '#') {
            throw new Exception("Invalid hex color format");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $hex = str_replace('#', '', $hex);
    return [
        hexdec(substr($hex, 0, 2)),
        hexdec(substr($hex, 2, 2)),
        hexdec(substr($hex, 4, 2))
    ];
}

/* ===================================================================== */
/*                         FUNCTION: createImage                         */
/* ===================================================================== */
function createImage($height = 100, $width = 100, $background = '#000000') {

    try {
        if (!is_numeric($height) || !is_numeric($width)) {
            throw new Exception("Height and width must be numeric");
        }
        if ($height <= 0 || $width <= 0) {
            throw new Exception("Height and width must be greater than zero");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }

    // Create a blank image
    $image = imagecreatetruecolor($width, $height);

    // Set background color
    $bg_rgb = hex2rgb($background);
    $bg     = imagecolorallocate($image, $bg_rgb[0], $bg_rgb[1], $bg_rgb[2]);
    imagefill($image, 0, 0, $bg);

    return $image;
}

/* ===================================================================== */
/*                          FUNCTION: addBorder                          */
/* ===================================================================== */
function addBorder(&$image, $border, $border_color) {

    try {
        if (!is_numeric($border)) {
            throw new Exception("Border must be numeric");
        }
        if ($border < 0) {
            throw new Exception("Border must be greater than or equal to zero");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }

    // Get image dimensions
    $image_size   = getImageDimensions($image);
    $width        = $image_size['width'];
    $height       = $image_size['height'];

    // Add border if specified
    if ($border > 0) {
        $border_rgb = hex2rgb($border_color);
        $border_color_allocated = imagecolorallocate($image, $border_rgb[0], $border_rgb[1], $border_rgb[2]);
        
        // Draw border rectangle
        for ($i = 0; $i < $border; $i++) {
            imagerectangle($image, $i, $i, $width - 1 - $i, $height - 1 - $i, $border_color_allocated);
        }
    }
    return $image;
}

/* ===================================================================== */
/*                           FUNCTION: addText                           */
/* ===================================================================== */
function addText(&$image, $font, $text, $font_size, $color) {

    try {
        if (!is_numeric($font_size)) {
            throw new Exception("Font size must be numeric");
        }
        if ($font_size <= 0) {
            throw new Exception("Font size must be greater than zero");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }

    // Get image dimensions
    $image_size   = getImageDimensions($image);
    $image_width  = $image_size['width'];
    $image_height = $image_size['height'];

    // Get text dimensions
    $text_size   = getTextDimensions($font, $text, $font_size);
    $text_width  = $text_size['width'];
    $text_height = $text_size['height'];

    // Calculate text position (center)
    $text_pos   = calculateTextPos($image, $font, $text, $font_size);
    $text_pos_x = $text_pos['text_pos_x'];
    $text_pos_y = $text_pos['text_pos_y'];

    // Allocate text color
    $text_rgb   = hex2rgb($color);
    $text_color = imagecolorallocate($image, $text_rgb[0], $text_rgb[1], $text_rgb[2]);

    // Add text to image
    imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font, $text);

    return $image;
}

/* ===================================================================== */
/*                         FUNCTION: outputImage                         */
/* ===================================================================== */
function showImage(&$image) {
    // Output image
    imagepng($image);

    // Free memory
    imagedestroy($image);
}

/* ===================================================================== */
/*                      FUNCTION: getImageDimensions                     */
/* ===================================================================== */
function getImageDimensions(&$image) {
    // Return image dimensions
    return [
        'width' => imagesx($image),
        'height' => imagesy($image)
    ];
}

/* ===================================================================== */
/*                      FUNCTION: getTextDimensions                      */
/* ===================================================================== */
function getTextDimensions($font, $text, $font_size) {
    // Use provided font size instead of calculating it
    $bbox        = imagettfbbox($font_size, 0, $font, $text);
    $text_width  = $bbox[2] - $bbox[0];
    $text_height = $bbox[1] - $bbox[7];

    return [
        'width' => $text_width,
        'height' => $text_height
    ];
}

/* ===================================================================== */
/*                           FUNCTION: textFits                          */
/* ===================================================================== */
function textFits(&$image, $font, $text, $font_size, $border = 0) {
    // Get image dimensions
    $image_size   = getImageDimensions($image);
    $image_width  = $image_size['width'];
    $image_height = $image_size['height'];

    // Get text dimensions
    $text_size    = getTextDimensions($font, $text, $font_size);
    $text_width   = $text_size['width'];
    $text_height  = $text_size['height'];

    // Check if text fits within image boundaries
    if ($text_width > $image_width - 2 * $border || $text_height > $image_height - 2 * $border) {
        return false; // Text does not fit
    }
    return true; // Text fits
}

/* ===================================================================== */
/*                       FUNCTION: calculateTextPos                      */
/* ===================================================================== */
function calculateTextPos(&$image, $font, $text, $font_size) {
    // Get image dimensions
    $image_size   = getImageDimensions($image);
    $image_width  = $image_size['width'];
    $image_height = $image_size['height'];

    // Get text dimensions
    $text_size    = getTextDimensions($font, $text, $font_size);
    $text_width   = $text_size['width'];
    $text_height  = $text_size['height'];

    // Calculate text position (center)
    $x = ($image_width - $text_width) / 2;
    $y = ($image_height + $text_height) / 2;

    return ['text_pos_x' => $x, 'text_pos_y' => $y];
}

/* ===================================================================== */
/*                        FUNCTION: recursiveScan                        */
/* ===================================================================== */
function recursiveScan($dir) {
        $fonts = [];
        foreach (scandir($dir) as $item) {
            if ($item == "." || $item == "..") {
                continue;
            }
            $path = $dir . "/" . $item;
            if (is_dir($path)) {
                $fonts = array_merge($fonts, recursiveScan($path));
            } elseif (preg_match("/\.ttf$/", $item)) {
                $fonts[] = $path;
            }
        }
        return $fonts;
}

/* ===================================================================== */
/*                          FUNCTION: colorInput                         */
/* ===================================================================== */
function colorInput($input_name = "color", $color = "#000000") {
    $colorinput = '
    <div class="input-group colorInput" style="max-width:250px;">
        <input type="color" class="form-control form-control-color"
        name="' . $input_name . '" 
        id="' . $input_name . '" 
        value="' . $color . '" required>
        <button type="button" class="btn btn-dark randomize-color" data-input="' . $input_name . '">🎲</button>
     </div>
     ';
     return $colorinput;
}