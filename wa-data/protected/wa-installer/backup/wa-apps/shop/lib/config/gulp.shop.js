/**
 * Shop Sources
 */

var gulp = require('gulp'),
    //css
    stylus = require('gulp-stylus'),
    nib = require('nib'),
    //js
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps');

var app_id = "shop",
    task_name = app_id + "-sources";

var css_sources = {
    "front-checkout-cart": {
        "directory": "./wa-apps/shop/css/frontend/order/",
        "sources": "./wa-apps/shop/css/frontend/order/cart/*",
        "result": "./wa-apps/shop/css/frontend/order/cart/cart.styl"
    },
    "front-checkout-cross_selling": {
        "directory": "./wa-apps/shop/css/frontend/order/",
        "sources": "./wa-apps/shop/css/frontend/order/cross_selling/*",
        "result": "./wa-apps/shop/css/frontend/order/cross_selling/cross_selling.styl"
    },
    "front-checkout-form": {
        "directory": "./wa-apps/shop/css/frontend/order/",
        "sources": "./wa-apps/shop/css/frontend/order/form/*",
        "result": "./wa-apps/shop/css/frontend/order/form/form.styl"
    },
    "front-checkout-ui": {
        "directory": "./wa-apps/shop/css/frontend/order/",
        "sources": "./wa-apps/shop/css/frontend/order/ui/*",
        "result": "./wa-apps/shop/css/frontend/order/ui/ui.styl"
    },
    "front-checkout-layout": {
        "directory": "./wa-apps/shop/css/frontend/order/",
        "sources": "./wa-apps/shop/css/frontend/order/layout/*",
        "result": "./wa-apps/shop/css/frontend/order/layout/layout.styl"
    },
    "backend-products-reviews": {
        "directory": "./wa-apps/shop/css/backend/products/",
        "sources": "./wa-apps/shop/css/backend/products/reviews/*",
        "result": "./wa-apps/shop/css/backend/products/reviews/reviews.styl"
    },
    "backend-orders-refund": {
        "directory": "./wa-apps/shop/css/backend/orders/",
        "sources": "./wa-apps/shop/css/backend/orders/refund/*",
        "result": "./wa-apps/shop/css/backend/orders/refund/refund.styl"
    },
    "backend-tutorial": {
        "directory": "./wa-apps/shop/css/backend/",
        "sources": "./wa-apps/shop/css/backend/tutorial/*",
        "result": "./wa-apps/shop/css/backend/tutorial/tutorial.styl"
    },
    "backend-marketing": {
        "directory": "./wa-apps/shop/css/backend/",
        "sources": "./wa-apps/shop/css/backend/marketing/*",
        "result": "./wa-apps/shop/css/backend/marketing/marketing.styl"
    },

    // PLUGINS
    "plugin-yandexmarket": {
        "directory": "./wa-apps/shop/plugins/yandexmarket/css/",
        "sources": "./wa-apps/shop/plugins/yandexmarket/css/backend/*",
        "result": "./wa-apps/shop/plugins/yandexmarket/css/backend/yandexmarket.styl"
    }
};

var js_sources = {
    // "front-checkout-cart": {
    //     "directory": "./wa-apps/shop/js/frontend/order/",
    //     "sources": "./wa-apps/shop/js/frontend/order/cart.js",
    //     "result_name": "cart.min.js"
    // },
    // "front-checkout-product": {
    //     "directory": "./wa-apps/shop/js/frontend/order/",
    //     "sources": "./wa-apps/shop/js/frontend/order/product.js",
    //     "result_name": "product.min.js"
    // },
    // "front-checkout-cross_selling": {
    //     "directory": "./wa-apps/shop/js/frontend/order/",
    //     "sources": "./wa-apps/shop/js/frontend/order/cross_selling.js",
    //     "result_name": "cross_selling.min.js"
    // },
    // "front-checkout-form": {
    //     "directory": "./wa-apps/shop/js/frontend/order/",
    //     "sources": "./wa-apps/shop/js/frontend/order/form.js",
    //     "result_name": "form.min.js"
    // },
    // "front-checkout-ui": {
    //     "directory": "./wa-apps/shop/js/frontend/order/",
    //     "sources": "./wa-apps/shop/js/frontend/order/ui.js",
    //     "result_name": "ui.min.js"
    // }
};

gulp.task(task_name, function () {
    // CSS
    for (var css_source_id in css_sources) {
        if (css_sources.hasOwnProperty(css_source_id)) {
            var css_source = css_sources[css_source_id];
            setCSSWatcher(css_source.directory, css_source.sources, css_source.result, app_id + "-" + css_source_id + "-css");
        }
    }

    function setCSSWatcher(directory, sources, result_file, task_name) {
        gulp.watch(sources, [task_name]);
        gulp.task(task_name, function() {
            //process.stdout.write(source_file);
            gulp.src(result_file)
                .pipe(stylus({
                    use: nib(),
                    compress: true
                }))
                .pipe(gulp.dest(directory));
        });
    }

    // JS
    for (var js_source_id in js_sources) {
        if (js_sources.hasOwnProperty(js_source_id)) {
            var js_source = js_sources[js_source_id];
            setJSWatcher(js_source.directory, js_source.sources, js_source.result_name, app_id + "-" + js_source_id + "-js");
        }
    }

    function setJSWatcher(directory, sources, result_name, task_name) {
        gulp.watch(sources, [task_name]);
        gulp.task(task_name, function() {
            gulp.src(sources)
                .pipe(sourcemaps.init())
                .pipe(concat(directory + result_name))
                .pipe(uglify())
                .pipe(sourcemaps.write("./", {
                    includeContent: false,
                    sourceRoot: directory
                }))
                .pipe(gulp.dest("./"));
        });
    }
});

module.exports = {
    "task_name": task_name
};