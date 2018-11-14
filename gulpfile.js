const gulp = require("gulp"),
    php = require("gulp-connect-php"),
    babel = require("gulp-babel"),
    sass = require("gulp-sass"),
    include = require("gulp-include"),
    autoprefixer = require("gulp-autoprefixer"),
    browserSync = require("browser-sync"),
    uglify = require("gulp-uglify"),
    cleanCSS = require("gulp-clean-css"),
    plumber = require("gulp-plumber"),
    concat = require("gulp-concat"),
    notify = require("gulp-notify"),
    sourcemaps = require("gulp-sourcemaps");

gulp.task("css", () => {
    return gulp
        .src("./resources/sass/**/*.scss")
        .pipe(
            plumber({
                errorHandler: function(err) {
                    notify.onError({
                        title: "Gulp error in " + err.plugin,
                        message: err.toString()
                    })(err);
                }
            })
        )
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS({ compatibility: "ie8" }))
        .pipe(plumber.stop())
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest("./public/css/"))
        .pipe(notify("CSS updated!"));
});

gulp.task("javascript", () => {
    return gulp
        .src("./resources/js/app.js")
        .pipe(include())
        .pipe(
            plumber({
                errorHandler: function(err) {
                    notify.onError({
                        title: "Gulp error in " + err.plugin,
                        message: err.toString()
                    })(err);
                }
            })
        )
        .pipe(
            babel({
                presets: ["env"]
            })
        )
        .pipe(uglify({ mangle: false }))
        .pipe(concat("app.js"))
        .pipe(plumber.stop())
        .pipe(gulp.dest("./public/js/"))
        .pipe(notify("JS updated!"));
});

gulp.task("php", function() {
    php.server({ base: "./public", port: 8000, keepalive: true });
});

gulp.task("browser-sync", ["php"], function() {
    browserSync({
        proxy: "127.0.0.1:8000",
        port: 8000,
        open: true,
        notify: false,
        ghostMode: false,
        online: false
    });
});

gulp.task("serve", ["browser-sync"], () => {
    gulp.watch("./resources/sass/**/*.scss", ["css"]);
    gulp.watch("./resources/sass/**/*.css", ["css"]);
    gulp.watch("./resources/js/**/*.js", ["javascript"]);

    gulp.watch("./public/css/*.css").on("change", browserSync.reload);
    gulp.watch("./public/js/*.js").on("change", browserSync.reload);
    gulp.watch("./resources/views/**/*.blade.php").on(
        "change",
        browserSync.reload
    );
});
