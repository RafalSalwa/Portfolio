'use strict'
const path = require('path');
const Encore = require('@symfony/webpack-encore');
const dotenv = require('dotenv-webpack')

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    .addEntry('app', './assets/app.js')
    .addEntry('ux', './assets/ux.js')
    .addEntry('react', './assets/react.js')

    .splitEntryChunks()

    .enableReactPreset()

    .enableStimulusBridge('./assets/controllers.json')

    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    .enableSassLoader()
    .configureDevServerOptions((options) => {
        options.liveReload = true;
        options.static = {
            watch: false
        };
        options.watchFiles = {
            paths: ['src/**/*.php', 'templates/**/*'],
        };
        options.allowedHosts = 'all';
    })
    .enableTypeScriptLoader()

    .copyFiles({
        from: './assets/img',
        includeSubdirectories: true,
        to: 'img/[path][name].[ext]',
    })
    .configureImageRule({
        type: 'asset',
    })
    .autoProvidejQuery({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
    .addPlugin(new dotenv({
        ignoreStub: true,
    }))
;
console.log(process.env.NODE_ENV);
module.exports = Encore.getWebpackConfig();
