const fs        = require('fs-extra');
const gulp      = require('gulp');
const exec      = require('child_process').execSync;
const glob      = require('glob');
const del       = require('del').sync;
const zip       = require('gulp-zip');


const config = {
    temp: __dirname + '/temp',
    cwd: __dirname + '/temp/supportbubble',
    libs: [
        {
            'dir': '',
            'del': ['/*.lock', '/gulpfile.js', '/*.json', '/.gitignore', '/.gitmodules', '/*.xml', '/node_modules'],
            'command': false
        },
        {
            'dir': '/frontend',
            'del': ['/src', '/*.json', '/*.log', '/*.js', '/*.lock', '/node_modules'],
            'command': 'npm install && npm run prettier && npm run build'
        },
        {
            'dir': '/framework/options/app',
            'del': ['/src', '/*.json', '/*.log', '/*.js', '/*.lock', '/node_modules'],
            'command': 'npm install && npm run prettier && npm run build'
        },
        {
            'dir': '/framework/assets/pricing-page',
            'del': ['/*.*', '/.*', '/node_modules'],
            'command': 'npm install && npm run build'
        },
    ]   
}


gulp.task('copy', (done) => {
    if (fs.existsSync(config.temp)) {
        del(config.temp);
    }
    
    fs.mkdirSync(config.temp);
    fs.mkdirSync(config.cwd);
    
    return gulp.src('./**')
        .pipe(gulp.dest(config.cwd));
});

gulp.task('commands', (done) => {
    config.libs.forEach(lib => {
        let dir = config.cwd + lib.dir;
        
        console.log('Running Command:', lib.command);

        if (fs.existsSync(dir) && lib.command) {
            console.log('In Folder:', dir);
            
            exec(lib.command, {
                cwd: dir
            }, function(error, stdout, stderr) {
                console.log(error, stdout, stderr);
            });
        }
    });
    
    done();
});

gulp.task('clean', (done) => {
    config.libs.forEach(lib => {
        lib.del.forEach(item => {
            item = config.cwd + lib.dir + item;
                del(item);
        });
    });
    
    done();
});

gulp.task('zip', (done) => {
    console.log('Zipping Now:', glob.sync('./temp/**'));

    return gulp.src('./temp/**')
        .pipe(zip('plugin.zip'))
        .pipe(gulp.dest('./'))
        .on('end', function() {
            del('./temp');
        })
});


gulp.task('build:zip', gulp.series('copy', 'commands', 'clean', 'zip'));
