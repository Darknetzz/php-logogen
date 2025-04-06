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

        <img src="banner.png" alt="LogoGen" class="img-fluid m-2" style="width: 100%; height: auto;">

        <form id="logogenform" action="index.php" method="post">

            <table class="table table-default">


                <thead <?= $classes['thead'] ?>>
                    <tr>
                        <th <?= $classes['table-title'] ?>>Image Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Size Presets</th>
                        <td>
                            <div class="form-selectgroup">
                                <?= $size_presets_select ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Image Size</th>
                        <td class="row">
                            <div class="col input-group">
                                <input type="number" class="form-control" name="width" id="width" value="<?= $defaults["width"] ?>">
                                <span class="input-group-text">px</span>
                            </div>
                            <div class="col input-group">
                                <input type="number" class="form-control" name="height" id="height" value="<?= $defaults["height"] ?>">
                                <span class="input-group-text">px</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Image Rotation</th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="image_rotation" id="image_rotation"
                                    value="<?= $defaults["image_rotation"] ?>">
                                <span class="input-group-text">°</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Background Color</th>
                        <td>
                            <div class="mb-3 input-row input-group">
                                <?= colorInput("background", $defaults["background"]) ?>
                            </div>
                        </td>
                    </tr>
                </tbody>

                <thead <?= $classes['thead'] ?>>
                    <tr>
                        <th <?= $classes['table-title'] ?>>Text</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Font</th>
                        <td>
                            <div class="row">
                                <span class="col input-group">
                                    <select class="form-select" name="font" id="font">
                                        <?= $font_dropdown ?>
                                    </select>
                                </span>
                                <span class="col input-group">
                                    <input type="number" class="form-control" name="font_size" id="font_size" value="<?= $defaults["font_size"] ?>">
                                    <span class="input-group-text">px</span>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Text</th>
                        <td>
                            <textarea class="form-control" name="text" id="text"
                                placeholder="<?= $defaults["text"] ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Text Position</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text">X</span>
                                        <input type="number" class="form-control" name="text_pos_x" id="text_pos_x" value="" placeholder="Default is image_width / 2">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text">Y</span>
                                        <input type="number" class="form-control" name="text_pos_y" id="text_pos_y" value="" placeholder="Default is image_height / 2">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Text Rotation</th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="text_rotation" id="text_rotation" value="<?= $defaults["text_rotation"] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Text Color</th>
                        <td>
                            <span class="input-group">
                                <?= colorInput("color", $defaults["color"]) ?>
                            </span>
                        </td>
                    </tr>
                </tbody>


                <thead <?= $classes['thead'] ?>>
                    <tr>
                        <th <?= $classes['table-title'] ?>>
                            <label for="enablebordercheckbox" class="form-check form-switch form-switch-3">
                                Border 
                                <input class="form-check-input toggleInput" type="checkbox" name="enableborder" id="enablebordercheckbox" data-target=".border-inputs">
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody class="border-inputs" style="display: none;">
                    <tr>
                        <th <?= $classes['input-title'] ?>>Border Size</th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="border" id="border"
                                    value="<?= $defaults["border"] ?>">
                                <span class="input-group-text">px</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Border Color</th>
                        <td>
                            <span class="input-group">
                                <?= colorInput("border_color", $defaults["border_color"]) ?>
                            </span>
                        </td>
                    </tr>
                </tbody>


                <thead <?= $classes['thead'] ?>>
                    <tr>
                        <th <?= $classes['table-title'] ?>>
                            <label for="enablebordercheckbox" class="form-check form-switch form-switch-3">
                                Filters 
                                <input class="form-check-input toggleInput" type="checkbox" name="enablefilters" id="enablefilterscheckbox" data-target=".filters-inputs">
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody class="filters-inputs" style="display: none;">
                    <tr>
                        <th <?= $classes['input-title'] ?>>Filters</th>
                        <td>
                            <div class="form-selectgroup">
                                <?= $filters_select ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Filter arguments</th>
                        <td><?= $filters_args ?></td>
                    </tr>
                </tbody>


                <thead <?= $classes['thead'] ?>>
                    <tr><th <?= $classes['table-title'] ?>>Output</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <th <?= $classes['input-title'] ?>>Output Format</th>
                        <td>
                            <div class="form-selectgroup">
                                <?= $image_formats_select ?>
                            </div>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th <?= $classes['input-title'] ?>>
                            Output
                            <!--
                            <br>
                            <div class="btn-group">
                                <button type="button" id="generateBtn" type="submit" class="btn btn-primary">Generate</button>
                                <button type="button" class="btn btn-dark randomize-all">🎲</button>
                            </div>
                            -->
                        </th>
                        <td>
                            <a id="openImage" target="_blank">
                                <div style="mt-2" id="generatedImage" style="display: none;">Image will appear here.</div>
                            </a>
                            <!-- <a id="openImage" target="_blank" class="m-2 badge text-bg-info" style="display: none;">Open in new tab</a> -->
                        </td>
                    </tr>
                </tbody>
                <thead <?= $classes['thead'] ?>>
                    <th <?= $classes['table-title'] ?>>
                        <label for="enabledebugcheckbox" class="form-check form-switch form-switch-3">
                            Debug 
                            <input class="form-check-input toggleInput" type="checkbox" name="enabledebug" id="enabledebugcheckbox" data-target=".debug">
                        </label>
                    </th></tr>
                </thead>
                <tbody style="display: none;" class="debug">
                    <tr>
                        <th <?= $classes['input-title'] ?>>Debug</th>
                        <td>
                            <div id="debug">Debug info will appear here.</div>
                        </td>
                    </tr>
                </tbody>

            </table>
    </div>
</form>

</body>

<script>
$(document).ready(function() {

        /* ===================================================================== */
        /*                             generateImage                             */
        /* ===================================================================== */
        function generateImage() {
            const defaults       = <?= json_encode($defaults) ?>;
            var   width          = $("#width").val() || defaults.width;
            var   height         = $("#height").val() || defaults.height;
            var   image_rotation = $("#image_rotation").val() || defaults.image_rotation;
            var   text           = $("#text").val() || defaults.text;
            var   text_rotation  = $("#text_rotation").val() || defaults.text_rotation;
            var   font           = $("#font").val() || defaults.font;
            var   font_size      = $("#font_size").val() || defaults.font_size;
            var   text_pos_x     = $("#text_pos_x").val() || defaults.text_pos_x;
            var   text_pos_y     = $("#text_pos_y").val() || defaults.text_pos_y;
            var   background     = $("#background").val() || defaults.background;
            var   color          = $("#color").val() || defaults.color;
            var   border         = $("#border").val() || defaults.border;
            var   border_color   = $("#border_color").val() || defaults.border_color;
            var   format         = $("#format").val() || defaults.format;
            var   filter         = $("#filter").val() || defaults.filter;
            var   filter_args    = $("#filter_args").val() || defaults.filter_args;
            const data           = {
                "defaults"      : defaults,
                "width"         : width,
                "height"        : height,
                "text"          : text,
                "text_rotation" : text_rotation,
                "font"          : font,
                "font_size"     : font_size,
                "text_pos_x"    : text_pos_x,
                "text_pos_y"    : text_pos_y,
                "background"    : background,
                "color"         : color,
                "border"        : border,
                "border_color"  : border_color,
                "format"        : format,
                "filter"        : filter,
                "filter_args"   : filter_args,
                "image_rotation": image_rotation
            };

            var params    = $.param(data);
            var url       = "gen.php?" + params;
            var debug_url = "gen.php?debug=1&" + params;

            $("#openImage").attr("href", url).show();

            $.get(url, function(data) {
                $("#generatedImage").html(`<img src="${url}" alt="${text}">`);
                console.log("Image generated successfully");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error generating image:", errorThrown);
            });

            $.get(debug_url, function(data) {
                // console.log("Debug data:", data);
                $("#debug").html("<h3>Debug Data</h3>" + data);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching debug data:", errorThrown);
            });
    }

    /* ============================ filter-check =========================== */
    $(".filter-check").on('click', function() {
        var filter = $(this).val();
        if ($(this).is(':checked')) {
            $(".args-table[data-filter='" + filter + "']").show();
            return;
        }
        $(".args-table[data-filter='" + filter + "']").hide();
    });

    /* ============================ size-preset ============================ */
    $(".size-preset").on('click', function() {
        var preset = $(this).val();
        var width = $(this).data("width");
        var height = $(this).data("height");
        $("#width").val(width);
        $("#height").val(height);
        generateImage();
    });
    $("#logogenform").on("input", function() {
        generateImage();
    });
    // $("#generateBtn").click(function() {
    //     generateImage();
    // });

    /* ========================== randomize-color ========================== */
    $(".randomize-color").click(function() {
        const randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
        $(this).prev("input").val(randomColor);
        generateImage();
    });

    /* =========================== randomize-all =========================== */
    $(".randomize-all").click(function() {
        $(".randomize-color").each(function() {
            const randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
            $(this).prev("input").val(randomColor);
            generateImage();
        });
    });

    /* ============================ toggleInput ============================ */
    $(".toggleInput").click(function() {
        const targetSelector = $(this).data("target");
        const targetObj      = $(targetSelector);
        targetObj.toggle();
    });

    /* ============================= toggleBtn ============================= */
    $(".toggleBtn").click(function() {
        const targetSelector = $(this).data("target");
        const targetObj      = $(targetSelector);
        targetObj.toggle();
        if (targetObj.is(":visible")) {
            $(this).text("Hide");
            return;
        }
        $(this).text("Show");
    });

    generateImage();

});
</script>

</html>