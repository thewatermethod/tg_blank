/*
	Open command prompt as administrator

	cd YOUR-THEME-DIRECTORY
	npm install gulp gulp-sass gulp-concat gulp-minify gulp-uglify gulp-sourcemaps run-sequence gulp-watch browser-sync gulp-clean gulp-csslint --save-dev 
	gulp

*/

//these are all the modules that you installed above
var gulp = require('gulp'),
	clean = require('gulp-clean'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	sourcemaps = require('gulp-sourcemaps'),
	cleanCSS = require('gulp-clean-css'),
	minify = require('gulp-minify'),
	runSequence = require('run-sequence'),
	browserSync = require('browser-sync').create(),
	sass = require( 'gulp-sass' ), 
	csslint = require('gulp-csslint');


// this task builds and minifies the sass into css for the theme
gulp.task( 'build-sass', function(){
	return gulp.src(['sass/vars.scss','sass/*.scss'])
		.pipe( sourcemaps.init() )
		.pipe( concat( 'compiled.scss') )
		.pipe( sass({ outputStyle: 'compressed' }).on('error', sass.logError) )
		.pipe( sourcemaps.write() )
		.pipe( gulp.dest('') ) 
});


// this task minifies the javascript
gulp.task('compress-js', function() {
return gulp.src(['js/*.js'])
   .pipe( concat( 'compiled.js' ) )
    .pipe(minify({
        ext:{
            src:'-debug.js',
            min:'.js'
        },
        exclude: [],
        ignoreFiles: []
    }))
    .pipe(gulp.dest(''))
});


// runs all the build processes
gulp.task('compile', function(){
	runSequence(
		'build-sass',
		'compress-js'
	);
});


// runs all the processes
gulp.task( 'default', function(){
	runSequence('compile');
});