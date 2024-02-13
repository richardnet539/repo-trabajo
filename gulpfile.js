import { init, reload, stream } from 'browser-sync';
import gulp from 'gulp';
import autoprefixer from 'gulp-autoprefixer';
import concat from 'gulp-concat';
import jshint from 'gulp-jshint';
import rename from 'gulp-rename';
import gulpSass from 'gulp-sass';
import sourcemaps from "gulp-sourcemaps";
import uglify from 'gulp-uglify';
import dartSass from 'sass';

const { dest, parallel, series, src, task, watch } = gulp;
const { init: initSource, write } = sourcemaps;

const sass = gulpSass(dartSass);

const sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

// Lint Task
task('lint', () =>
  src(['js/dev/scripts.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
);

// Sass Task with sourcemaps
task("sass-sourcemap", () =>
  src("scss/style.scss")
    .pipe(initSource())
    .pipe(sass(sassOptions).on("error", sass.logError))
    .pipe(autoprefixer())
    .pipe(write())
    .pipe(rename("style.css"))
    .pipe(dest("./"))
    .pipe(stream())
);

// Sass Task
task('sass', () =>
  src('scss/style.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(rename('style.css'))
    .pipe(dest('./'))
);

// Js Task with sourcepams
task("scripts-sourcemap", () =>
  src(["js/dev/scripts.js"])
    .pipe(concat("scripts-all.js"))
    .pipe(dest("js/dev"))
    .pipe(initSource())
    .pipe(rename("scripts.min.js"))
    .pipe(uglify())
    .pipe(write())
    .pipe(dest("js"))
);

// Js Task
task('scripts', () =>
  src(['js/dev/scripts.js'])
    .pipe(concat('scripts-all.js'))
    .pipe(dest('js/dev'))
    .pipe(rename('scripts.min.js'))
    .pipe(uglify())
    .pipe(dest('js'))
);

// Static Server
task('serve', () => {
  init({
		// server: "./",
		// proxy: 'http://cte-blogs.ctdesarrollo.org/jorge.ortega/wordpress',
		// proxy: 'http://cte-blogs.ctdesarrollo.org/liga-de-debate/',
		proxy: 'https://ligaDebate-blog.ctdesarrollo-sdr.org/',
		serveStatic: ['.', './scss', './js'],
		rewriteRules: [
			{
				match: /wp-content\/themes\/ligaDebate-blog\/style.css/g,
				replace: 'style.css',
			},
      {
				match: /wp-content\/themes\/ligaDebate-blog\/js\/scripts.min.js/g,
				replace: 'js/scripts.min.js',
			},
		],
		notify: {
			styles: {
				top: 'auto',
				bottom: '0',
			},
		},
	});
  watch('js/**/*.js', series('lint', 'scripts-sourcemap'))
		.on('change', reload);
  watch('scss/**/*.scss', series('sass-sourcemap'))
		.on('change', reload);
  watch(['*.php', 'template-parts/**/*.php', 'js/**/*.js']).on('change', reload);
});

// Local Develpment Task
task('dev', parallel('serve' , 'lint'));

// Production Task
task('default', series('sass', 'scripts'));