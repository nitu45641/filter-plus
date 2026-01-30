const gulp = require('gulp');

const paths = {
  src: [
    '**/*',
    '!node_modules/**',
    '!vendor/**',
    '!build/**',
    '!dist/**',
    '!scripts/**',
    '!src/**',          // Exclude source files (used by webpack)
    '!webpack.config.js',
    '!gulpfile.js',
    '!package.json',
    '!package-lock.json',
    '!composer.json',
    '!composer.lock',
    '!phpcs.xml',
    '!phpcs.xml.dist',
    '!LICENSE.txt',
    '!DEVELOPMENT.md',
    '!js.LICENSE.txt',          // Exclude webpack license file at root
    '!**/js.LICENSE.txt',       // Exclude any nested js.LICENSE.txt
    '!**/js.LICENSE.*.txt',     // Exclude hashed variants (e.g., js.LICENSE.12345.txt)
    '!assets/js/js.LICENSE.txt',
    '!.git/**',
    '!.github/**',
    '!.gitlab/**',
    '!.vscode/**',
    '!.idea/**',
    '!.DS_Store',
    '!*.log',
    '!*.map',                   // Exclude source maps
    '!**/*.map',
  ],
  build: 'dist/filter-plus',
  zip_dest: 'dist',
};

const clean = async () => {
  const { deleteAsync } = await import('del');
  return deleteAsync(['dist']);
};

const copyFiles = () => {
  return gulp.src(paths.src)
    .pipe(gulp.dest(paths.build));
};

// Extra safety: remove any js.LICENSE artifacts from assets/js when packaging
const purgeLicenseArtifacts = async () => {
  const { deleteAsync } = await import('del');
  return deleteAsync([
    'assets/js/js.LICENSE.txt',
    'assets/js/js.LICENSE.*.txt',
    'assets/css/*.map'
  ]);
};

const createZip = async () => {
  const zip = (await import('gulp-zip')).default;
  return gulp.src(`${paths.build}/**`)
    .pipe(zip('filter-plus.zip'))
    .pipe(gulp.dest(paths.zip_dest));
};

const build = gulp.series(clean, purgeLicenseArtifacts, copyFiles, createZip);

exports.clean = clean;
exports.copy = copyFiles;
// Run the full build pipeline when creating a zip to ensure files are present
exports.zip = gulp.series(clean, purgeLicenseArtifacts, copyFiles, createZip);
exports.purgeLicenses = purgeLicenseArtifacts;
exports.default = build;
