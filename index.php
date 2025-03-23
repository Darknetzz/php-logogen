<?php

    require_once("includes/_includes.php");

    # TODO:
    # - Accept inputs from user, such as text, font, background color and color, and generate the image accordingly.
?>

<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/tabler.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/tabler.min.js"></script>
    <title>Image Generator</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container p-5">

        <div class="banner">
            <div class="row">
                <div class="col">
                    <img class="m-2 p-2" src="banner.png" alt="LogoGen" class="img-fluid">
                </div>
            </div>
        </div>


        <!-- <h1 class="m-5 p-5 text-warning">LogoGen</h1> -->
        <form id="logogenform" action="index.php" method="post">

            <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th colspan="100%">Image Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="input-title">Size Presets</th>
                        <td>
                            <div class="form-selectgroup">
                                <?= $size_presets_select ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Image Size</th>
                        <td>
                            <div class="row">
                                <div class="col input-group">
                                    <input type="number" class="form-control" name="width" id="width"
                                        value="<?= $defaults["width"] ?>">
                                    <span class="input-group-text">px</span>
                                </div>
                                <div class="col input-group">
                                    <input type="number" class="form-control" name="height" id="height"
                                        value="<?= $defaults["height"] ?>">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Image Rotation</th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="image_rotation" id="image_rotation"
                                    value="<?= $defaults["image_rotation"] ?>">
                                <span class="input-group-text">°</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Background Color</th>
                        <td>
                            <div class="mb-3 input-row input-group">
                                <?= colorInput("background", $defaults["background"]) ?>
                            </div>
                        </td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th colspan="100%" class="table-secondary">Text</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="input-title">Font</th>
                        <td>
                            <div class="row">
                                <span class="col input-group">
                                    <select class="form-select" name="font" id="font">
                                        <?= $font_dropdown ?>
                                    </select>
                                </span>
                                <span class="col input-group">
                                    <input type="number" class="form-control" name="font_size" id="font_size"
                                        value="<?= $defaults["font_size"] ?>">
                                    <span class="input-group-text">px</span>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Text</th>
                        <td>
                            <textarea class="form-control" name="text" id="text"
                                placeholder="<?= $defaults["text"] ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Text Position</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <span class="input-group">
                                        <span class="input-group-text">X</span>
                                        <input type="number" class="form-control" name="text_pos_x" id="text_pos_x"
                                            value="" placeholder="Default is image_width / 2">
                                    </span>
                                </div>
                                <div class="col">
                                    <span class="input-row-input input-group">
                                        <span class="input-group-text">Y</span>
                                        <input type="number" class="form-control" name="text_pos_y" id="text_pos_y"
                                            value="" placeholder="Default is image_height / 2">
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Text Rotation</th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="text_rotation" id="text_rotation" value="<?= $defaults["text_rotation"] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="input-title">Text Color</th>
                        <td>
                            <span class="input-row-input input-group">
                                <?= colorInput("color", $defaults["color"]) ?>
                            </span>
                        </td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th colspan="100%" class="table-secondary">Border</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Border Size</td>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="border" id="border"
                                    value="<?= $defaults["border"] ?>">
                                <span class="input-group-text">px</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Border Color</td>
                        <td>
                            <span class="input-group">
                                <?= colorInput("border_color", $defaults["border_color"]) ?>
                            </span>
                        </td>
                    </tr>
                </tbody>

            </table>

    </div>
    <div class="col">

        <div class="<?= $classes['card'] ?>">
            <h3 class="<?= $classes['card-header'] ?>">Text</h3>
            <div class="<?= $classes['card-body'] ?>">
                <p class="text-muted">Enter the text you want to display on the image.</p>

                <div class="mb-3 input-row input-group">

                    <span class="input-row-input input-group">
                        <span class="input-group-text" for="text">Text</span>
                        <textarea class="form-control" name="text" id="text"
                            placeholder="<?= $defaults["text"] ?>"></textarea>
                    </span>

                    <span class="input-row-input input-group">
                        <span class="input-group-text" for="font">Font</span>
                        <select class="form-select" name="font" id="font">
                            <?= $font_dropdown ?>
                        </select>
                    </span>

                    <span class="input-row-input input-group">
                        <span class="input-group-text" for="font_size">Font size:</span>
                        <input type="number" class="form-control" name="font_size" id="font_size"
                            value="<?= $defaults["font_size"] ?>">
                        <span class="input-group-text">px</span>
                    </span>

                </div>

            </div>
        </div>

    </div>
    <div class="row">

        <div class="col">
            <div class="<?= $classes['card'] ?>">
                <h3 class="<?= $classes['card-header'] ?>">Border</h3>
                <div class="<?= $classes['card-body'] ?>">

                    <div class="mb-3 input-row">
                        <span class="input-row-name"><label class="form-label mt-3" for="border">Border
                                size:</label></span>
                        <span class="input-row-input">
                            <input type="number" class="form-control" name="border" id="border"
                                value="<?= $defaults["border"] ?>">
                            <span class="input-group-text">px</span>
                        </span>
                    </div>

                    <div class="mb-1 input-row">
                        <span class="input-row-name"><label class="form-label" for="border_color">Border
                                Color:</label></span>
                        <div class="mb-3 input-row input-group">
                            <span class="input-group-text" for="background">Border Color</span>
                            <?= colorInput("border_color", $defaults["border_color"]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="<?= $classes['card'] ?>">
                    <!-- <h3 class="<?= $classes['card-header'] ?>">Filter</h3> -->
                    <div class="<?= $classes['card-body'] ?>">
                        <span class="input-row-input">
                            <span class="input-row-name"><label class="form-label mt-3" for="format">Output
                                    Format:</label></span>
                            <div class="form-selectgroup">
                                <?= $filters_select ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="<?= $classes['card'] ?>">
                    <!-- <h3 class="<?= $classes['card-header'] ?>">Output</h3> -->
                    <div class="<?= $classes['card-body'] ?>">

                        <div class="mb-3 input-row">
                            <span class="input-row-name"><label class="form-label mt-3" for="format">Output
                                    Format:</label></span>
                            <span class="input-row-input">
                                <div class="form-selectgroup">
                                    <?= $image_formats_select ?>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

        <div class="row">
            <div class="col">
                <div class="<?= $classes['card'] ?> mt-3">
                    <h3 class="<?= $classes['card-header'] ?>">Image Preview</h3>
                    <div class="<?= $classes['card-body'] ?>">
                        <button type="button" id="generateBtn" type="submit" class="btn btn-primary">Generate</button>
                        <button type="button" class="btn btn-dark randomize-all">🎲</button>
                        <a id="openImage" class="badge bg-primary" style="display:none;" target="_blank">Open Image</a>
                        <div style="mt-2" id="generatedImage"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="<?= $classes['card'] ?> mt-3">
                    <h3 class="<?= $classes['card-header'] ?>">Debug</h3>
                    <div class="<?= $classes['card-body'] ?>">
                        <div class="p3">
                            <div id="debug"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

<script>
$(document).ready(function() {
    $(".size-presets input").change(function() {
        var preset = $(this).val();
        var width = <?= json_encode($size_presets) ?>[preset].width;
        var height = <?= json_encode($size_presets) ?>[preset].height;
        $("#width").val(width);
        $("#height").val(height);
        $("#generateBtn").click();
    });
    $("#logogenform").on("input", function() {
        $("#generateBtn").click();
    });
    $("#generateBtn").click(function() {
        const defaults = <?= json_encode($defaults) ?>;
        var width = $("#width").val() || defaults.width;
        var height = $("#height").val() || defaults.height;
        var image_rotation = $("#image_rotation").val() || defaults.image_rotation;
        var text = $("#text").val() || defaults.text;
        var text_rotation = $("#text_rotation").val() || defaults.text_rotation;
        var font = $("#font").val() || defaults.font;
        var font_size = $("#font_size").val() || defaults.font_size;
        var text_pos_x = $("#text_pos_x").val() || defaults.text_pos_x;
        var text_pos_y = $("#text_pos_y").val() || defaults.text_pos_y;
        var background = $("#background").val() || defaults.background;
        var color = $("#color").val() || defaults.color;
        var border = $("#border").val() || defaults.border;
        var border_color = $("#border_color").val() || defaults.border_color;
        var format = $("#format").val() || defaults.format;
        const data = {
            "defaults": defaults,
            "width": width,
            "height": height,
            "text": text,
            "text_rotation": text_rotation,
            "font": font,
            "font_size": font_size,
            "text_pos_x": text_pos_x,
            "text_pos_y": text_pos_y,
            "background": background,
            "color": color,
            "border": border,
            "border_color": border_color,
            "format": format
        };

        var params = $.param(data);
        var url = "gen.php?" + params;
        var debug_url = "gen.php?debug=1&" + params;

        $("#openImage").attr("href", url).show();

        $.get(url, function(data) {
            $("#generatedImage").html(`<img src="${url}" alt="${text}">`);
            console.log("Image generated successfully");
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error generating image:", errorThrown);
        });

        $.get(debug_url, function(data) {
            console.log("Debug data:", data);
            var json_data = JSON.parse(data, null, 2);
            $("#debug").html("<h3>Debug Data</h3>" + json_data);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error fetching debug data:", errorThrown);
        });
    });

    $(".randomize-color").click(function() {
        const randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
        $(this).prev("input").val(randomColor);
        $("#generateBtn").click();
    });

    $(".randomize-all").click(function() {
        $(".randomize-color").each(function() {
            const randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
            $(this).prev("input").val(randomColor);
            $("#generateBtn").click();
        });
    });

});
</script>

</html>