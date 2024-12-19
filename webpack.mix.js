const mix = require("laravel-mix");

mix.js("resources/js/date.js", "public/js")
    .js("resources/js/formatter.js", "public/js")
    .js("resources/js/message.js", "public/js")
    .js("resources/js/print.js", "public/js")
    .postCss("resources/css/main.css", "public/css")
    .postCss("resources/css/navbar.css", "public/css")
    .copy("resources/images", "public/images");
