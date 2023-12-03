const gulp      = require("gulp");
const babel     = require("gulp-babel");
const uglify    = require("gulp-uglify");
const rename    = require("gulp-rename");
const markdown  = require('gulp-markdown');
const wrapper   = require('gulp-wrapper');

// ~~~~~~~~~~~~~~~~~~
// Build default
const pkg = require("./package.json");
const credits = `/*!
${pkg.name} v${pkg.version}
${pkg.license} (c) ${new Date().getFullYear()} ${pkg.author}
${pkg.homepage}
*/`;

const moduleName = "customSelect";

const es5 = {
    header : `;(function () {`,
    footer : `this.${moduleName} = ${moduleName}; }).call(this);`
}

    function generateMinified(outputFolder) {

        return gulp.src("src/*.js")
            .pipe(babel({ presets: ["@babel/preset-env"] }))
            .pipe(wrapper({
                header: es5.header + '\n',
                footer: es5.footer + '\n'
            }))
            .pipe(uglify())
            .pipe(wrapper({
                header: credits + '\n',
            }))
            .pipe(rename({ suffix: ".min" }))
            .pipe(gulp.dest(outputFolder));
    }

const mjs = {
    footer : `export default ${moduleName};`
}

    function generateModule() {
        return gulp.src("src/*.js")
            .pipe(wrapper({
                footer: '\n' + mjs.footer + '\n'
            }))
            .pipe(gulp.dest("dist"));
    }

gulp.task("default", async function() {

    generateMinified("dist");
    generateModule();

});

// ~~~~~~~~~~~~~~~~~~
// Build Docs
const tpl = {
    header : `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>${pkg.name} v${pkg.version}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, shrink-to-fit=no" />
    <meta name="description" content="${pkg.description}" />
    <meta name="keywords" content="${(pkg.keywords).join(', ')}" />
    <meta name="author" content="${pkg.author}" />
    <meta property="og:title" content="${pkg.name} v${pkg.version}" />
    <meta property="og:description" content="${pkg.description}" />
    <meta property="og:image" content="https://alterebro.github.io/auto-resize-custom-select/custom-select-dark.png" />
    <meta property="og:url" content="${pkg.homepage}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@alterebro">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/github.min.css" />
    <link rel="stylesheet" href="docs.css" />
</head>
<body>
    <div class="markdown-body">`,
    footer : `  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
<script src="customSelect.min.js" charset="utf-8"></script>
<script src="docs.js" charset="utf-8"></script>
</body>
</html>`
};

function generateDocs() {
    return gulp.src("README.md")
        .pipe(markdown({
            xhtml : true,
            breaks: true
        }))
        .pipe(wrapper({
            header: tpl.header + '\n',
            footer: tpl.footer + '\n'
        }))
        .pipe(rename({
            basename: "index",
        }))
        .pipe(gulp.dest("docs"))
}

gulp.task("docs", async function() {

    generateDocs();
    generateMinified("docs");
});
