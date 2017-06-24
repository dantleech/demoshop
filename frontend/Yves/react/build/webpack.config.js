
const path = require('path');
const oryx = require('@spryker/oryx');
const webpack = require('webpack');
const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const settings = require('./settings');

let postCssPlugins = [];

if (settings.options.isProduction) {
    postCssPlugins = [
        autoprefixer({
            browsers: ['last 4 versions']
        })
    ];
}

let config = {
    context: settings.paths.rootDir,
    stats: settings.options.isVerbose ? 'normal' : 'errors-only',
    devtool: settings.options.isProduction ? false : 'cheap-module-eval-source-map',

    watch: settings.options.isWatching,
    watchOptions: {
        aggregateTimeout: 300,
        poll: 500,
        ignored: /node_modules/
    },

    entry: oryx.find(settings.entry, {
        'app': path.join(settings.paths.sourceDir, 'app.entry.js'),
        'vendor': path.join(settings.paths.sourceDir, 'vendor.entry.js')
    }),

    output: {
        path: settings.paths.publicDir,
        filename: './js/[name].js'
    },

    resolve: {
        modules: ['node_modules', settings.paths.sourcePath],
        extensions: ['.js', '.css', '.scss']
    },

    module: {
        rules: [{
            test: /\.jsx?/i,
            loader: 'babel-loader'
        }, {
            test: /\.scss$/i,
            loader: ExtractTextPlugin.extract({
                fallback: 'style-loader',
                use: [{
                    loader: 'css-loader',
                    query: {
                        sourceMap: !settings.options.isProduction
                    }
                }, {
                    loader: 'postcss-loader'
                }, {
                    loader: 'sass-loader',
                    query: {
                        sourceMap: !settings.options.isProduction,
                        outputStyle: settings.options.isProduction ? 'compressed' : 'expanded'
                    }
                }]
            })
        }]
    },

    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor'
        }),
        new webpack.LoaderOptionsPlugin({
            options: {
                context: settings.paths.rootDir,
                postcss: postCssPlugins
            }
        }),
        new webpack.DefinePlugin({
            DEV: !settings.options.isProduction,
            'process.env': {
                'NODE_ENV': settings.options.isProduction ? '"production"' : '"development"'
            }
        }),
        new ExtractTextPlugin({
            filename: 'css/[name].css'
        }),
        new CopyPlugin([{
            from: path.join(settings.paths.sourceDir, 'img'),
            to: 'img'
        }])
    ]
};

if (settings.options.isProduction) {
    config.plugins = [
        ...config.plugins,
        new webpack.optimize.UglifyJsPlugin({
            output: {
                comments: false,
                source_map: null
            },
            sourceMap: true,
            mangle: false,
            compress: {
                warnings: false,
                dead_code: true
            }
        })
    ];
}

module.exports = config;
