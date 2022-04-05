const { task, series, src, dest } = require('gulp');

const minify = require('gulp-minify');

task('js:build', () => {
	const options = {
		ext: {
			min: '.min.js',
		},
	};

	return src(`./js/**/*.js`).pipe(minify(options)).pipe(dest(`./public/js`));
});

task('default', series('js:build'));
