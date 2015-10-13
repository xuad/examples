var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sourceMaps = require('gulp-sourcemaps'),
	minifyCss = require('gulp-minify-css'),
	concat = require('gulp-concat');

var config = {
	themeDir: './files/default-theme',
	bowerDir: './bower_components',
	destinationDir: './files/default-theme',
	destinationCssDir: './files/default-theme/css'
};

gulp.task('css-default', function ()
{
	gulp.src(
		[
			config.bowerDir + '/bootstrap/dist/css/bootstrap.min.css',
			config.themeDir + '/scss/default.scss'
		])
		.pipe(sourceMaps.init())
		.pipe(sass({
			includePaths: [
				config.bowerDir + '/bootstrap-sass/stylesheets/stylesheets'
			]
		}).on('error', sass.logError))
		.pipe(minifyCss())
		.pipe(sourceMaps.write())
		.pipe(concat('default.css'))
		.pipe(gulp.dest(config.destinationCssDir))
	;
});

// Css watcher
gulp.task('watch-css-default', function()
{
	gulp.watch(config.themeDir + '/scss/*.scss', ['css-default']);
});