const fs = require('fs-extra');
const gulp = require('gulp');
const exec = require('child_process').execSync;
const del = require('del').sync;
const zip = require('gulp-zip');
const axios = require('axios');
const wpPot = require('gulp-wp-pot');
const gettextParser = require("gettext-parser");

const zip_config = {
    temp: __dirname + '/temp',
    cwd: __dirname + '/temp/supportbubble',
    libs: [
        {
            'dir': '',
            'del': ['/temp', '/*.lock', '/gulpfile.js', '/*.json', '/.gitignore', '/.gitmodules', '/*.xml', '/node_modules', '/plugin.zip'],
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
            'del': ['/*.*', '/.*', '/node_modules', '/src'],
            'command': 'npm install && npm run build'
        },
    ]   
}

const translate_config = {
    domain: 'supportbubble',
    package: 'SupportBubble',
    folder: './languages/',
    languages: [
        {
            api: 'ar',
            wp: ['ar'],
            name: "Arabic",
            nativeName: "العربية",
            dir: "rtl",
        },
        {
            api: 'de',
            wp: ['de_DE', 'de_CH_informal', 'de_CH', 'de_DE_formal', 'de_AT'],
            name: "German",
            nativeName: "Deutsch",
            dir: "ltr",
        },
        {
            api: 'es',
            wp: ['es_CL', 'es_EC', 'es_PE', 'es_CR', 'es_AR', 'es_CO', 'es_UY', 'es_PR', 'es_GT', 'es_VE', 'es_ES', 'es_MX'],
            name :"Spanish",
            nativeName :"Español",
            dir :"ltr",
        },
        {
            api: 'id',
            wp: ['id_ID'],
            name: "Indonesian",
            nativeName: "Indonesia",
            dir: "ltr",
        },
        {
            api: 'fr',
            wp: ['fr_FR', 'fr_BE', 'fr_CA'],
            name: "French",
            nativeName: "Français",
            dir: "ltr",
        },
        {
            api: 'zh-Hant',
            wp: ['zh_TW'],
            name:"Chinese Traditional",
            nativeName :"繁體中文",
            dir :"ltr",
        },
        {
            api: 'nl',
            wp: ['nl_NL', 'nl_BE', 'nl_NL_formal'],
            name: "Dutch",
            nativeName: "Nederlands",
            dir: "ltr",
        },
        {
            api: 'pt',
            wp: ['pt_AO', 'pt_BR', 'pt_PT', 'pt_PT_ao90'],
            name: "Portuguese",
            nativeName: "Português",
            dir: "ltr",
        },
        {
            api: 'ur',
            wp: ['ur'],
            name: "Urdu",
            nativeName: "اردو",
            dir: "rtl",
        },
        {
            api: 'ru',
            wp: ['ru_RU'],
            name: "Russian",
            nativeName: "Русский",
            dir: "ltr",
        },
        {
            api: 'bn',
            wp: ['bn_BD'],
            name: "Bangla",
            nativeName: "বাংলা",
            dir: "ltr",
    
        },
        {
            api: 'ja',
            wp: ['ja'],
            name: "Japanese",
            nativeName: "日本語",
            dir: "ltr",
        }
    ]
}

let translate = async (text, code) => {
    const options = {
        method: 'POST',
        url: 'https://microsoft-translator-text.p.rapidapi.com/translate',
        params: {
            to: code,
            from: "en",
            'api-version': '3.0',
            profanityAction: 'NoAction',
            textType: 'plain'
        },
        headers: {
            'content-type': 'application/json',
            'x-rapidapi-key': '04a8ad7367msh8cb71cda86e02b3p1dff40jsn743d878a550e',
            'x-rapidapi-host': 'microsoft-translator-text.p.rapidapi.com'
        },
        data: [{Text: text}]
    };
    
    let res = await axios.request(options);

    return res.data[0]['translations'][0]['text'];
}

gulp.task('build:translate:pot', function () {
    return gulp.src(['./**/*.php', '!./framework/**/*'])
        .pipe(wpPot({
            domain: translate_config.domain,
            package: translate_config.package
        }))
        .pipe(gulp.dest(translate_config.folder + translate_config.domain + '.pot'));
});

gulp.task('build:translate:mo', async function (done) {    
    var input = require('fs').readFileSync(translate_config.folder + translate_config.domain + '.pot');
  
    for (const language of translate_config.languages) {
        console.log(language.nativeName);

        var po = gettextParser.po.parse(input);
        for(let k in po.translations['']) {
        
        if(po.translations[''][k] && po.translations[''][k].msgstr && po.translations[''][k].msgstr[0] == '') {
                let translation = await translate(k, language.api)
                po.translations[''][k].msgstr[0] = translation
                
                if( ! po.translations[''][k].comments) {
                    po.translations[''][k].comments = {}
                }
            }
        } 
        
        const output = gettextParser.mo.compile(po);
        
        for (const local of language.wp) {
            fs.writeFileSync(translate_config.folder + translate_config.domain + '-' + local +'.mo', output);
        }
    }
    
    done();
});

gulp.task('build:zip:temp', (done) => {
    if (fs.existsSync(zip_config.temp)) {
        del(zip_config.temp);
    }
    
    fs.mkdirSync(zip_config.temp);
    fs.mkdirSync(zip_config.cwd);
    
    return gulp.src('./**')
        .pipe(gulp.dest(zip_config.cwd));
});

gulp.task('build:zip:commands', (done) => {
    zip_config.libs.forEach(lib => {
        let dir = zip_config.cwd + lib.dir;
        
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

gulp.task('build:zip:clean', (done) => {
    zip_config.libs.forEach(lib => {
        lib.del.forEach(item => {
            item = zip_config.cwd + lib.dir + item;
                del(item);
        });
    });
    
    done();
});

gulp.task('build:zip:archive', () => {
    return gulp.src('./temp/**')
        .pipe(zip('plugin.zip'))
        .pipe(gulp.dest('./'))
});


gulp.task('build:zip', gulp.series('build:zip:temp', 'build:zip:commands', 'build:zip:clean', 'build:zip:archive'));
gulp.task('build:translate', gulp.series('build:translate:pot', 'build:translate:mo'));
