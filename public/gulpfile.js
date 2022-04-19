var gulp = require('gulp');
var sass = require('gulp-sass');
var livereload = require('gulp-livereload');

gulp.task('sass', function () {
  return gulp.src('./sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'))
    .pipe(livereload());
});

gulp.task('watch', function () {
    livereload.listen();
  gulp.watch('./sass/**/*.scss', ['sass']);
  gulp.watch('../src/AppBundle/**/*.php', ['reload']);
  gulp.watch('../app/Resources/views/**/*.html.twig', ['reload']);


});
gulp.task('reload', function () {
  return gulp.src('./').pipe(livereload());
});
