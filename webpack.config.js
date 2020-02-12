var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
.setOutputPath('web/build/')
// public path used by the web server to access the output path
.setPublicPath('/build')

.addEntry('addressbook', './assets/js/app.js')
//.addEntry('page2', './assets/js/page2.js')

// will require an extra script tag for runtime.js
// but, you probably want this, unless you're building a single-page app
.enableSingleRuntimeChunk()

.cleanupOutputBeforeBuild()
.enableSourceMaps(!Encore.isProduction())

.enableVersioning(true)
.enableSassLoader()
.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();