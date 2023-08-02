const vite = require('vite');
const lodash = require("lodash");
const folder = {
    src: "resources/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/" //build assets files
};
import laravel from 'laravel-vite-plugin';


var third_party_assets = {
    css_js: [
        {"name": "jquery", "assets": ["./node_modules/jquery/dist/jquery.min.js"]},

    ]
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type == "css_js") {
        lodash(assets).forEach(function (plugins) {
            var name = plugins['name'],
                assetlist = plugins['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if(ass[i].substr(ass[i].length - 3)  == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                };
            });

        });
    }
});

export default vite.defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/style.css', 'resources/scss/main.scss', 'resources/js/script.js'],
            refresh: true,

        }),
    ],
});
