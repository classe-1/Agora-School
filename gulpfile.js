var gulp = require("gulp"),
    sass = require("gulp-sass"),
    myth = require('gulp-myth'),
    uglifycss = require('gulp-uglifycss'),
    jshint = require('gulp-jshint'),
    imagemin = require('gulp-imagemin'),
    connect = require('gulp-connect'),
    htmlmin = require('gulp-htmlmin');
    

gulp.task("html", () => {
    return gulp.src('./app/*.html')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest("./dist"))
    .pipe(connect.reload())
})

gulp.task("sass", () => {
    return gulp.src("./app/sass/*.scss")
    .pipe(sass().on('error',sass.logError))
    .pipe(myth())
    .pipe(uglifycss())
    .pipe(gulp.dest("./dist/css"))
    .pipe(connect.reload())
});

gulp.task('scripts', () => {
    return gulp.src('./app/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default',))
        // .pipe(uglify())
        .pipe(gulp.dest('./dist/js'))
        .pipe(connect.reload())
});

gulp.task('images', () => {
    return gulp.src('app/img/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('./dist/img'))
        .pipe(connect.reload())
});

gulp.task('watch', () => {
    gulp.watch('app/*.html', gulp.series('html'));
    gulp.watch('app/sass/*.scss', gulp.series('sass'));
    gulp.watch('app/js/*.js', gulp.series('scripts'));
    gulp.watch('app/img/*', gulp.series('images'))
   
});

gulp.task('connect', function () {
    connect.server({
      root: './dist', 
      livereload: true
    });
  });

  gulp.task('default', gulp.parallel('html','sass', 'scripts', 'images', 'watch','connect'));