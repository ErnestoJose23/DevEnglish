const mix = require("laravel-mix");

mix.scripts(["resources/assets/js/app.js"], "public/js/app.js");

mix.styles(
    [
        "resources/assets/css/font-awesome.min5152.css",
        "resources/assets/css/style5152.css",
        "resources/assets/css/style.css"
    ],
    "public/css/app.css"
);

mix.scripts(["resources/assets/js/admin.js"], "public/js/admin.js");

mix.styles(["resources/assets/css/sb-admin-2.css"], "public/css/admin.css");
