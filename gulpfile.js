const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');

let files = {
    scss: {
        src: 'assets/scss/**/*.scss',
        dist: 'assets/css'
    }
}

gulp.task('styles', () => {
    return gulp.src(files.scss.src)
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest(files.scss.dist));
});

gulp.task('clean', () => {
    return del([
        files.scss.dist,
    ]);
});

gulp.task('watch', () => {
    gulp.watch(files.scss.src, (done) => {
        gulp.series(['clean', 'styles'])(done);
    });
});

gulp.task('default', gulp.series(['clean', 'styles']));
