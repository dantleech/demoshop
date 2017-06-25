
const path = require('path');
const oryx = require('@spryker/oryx');
const webpack = require('webpack');
const cssnext = require('postcss-cssnext');
const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const settings = require('./settings');

let postCssPlugins = [
    cssnext
];

if (settings.options.isProduction) {
    postCssPlugins = [
        ...postCssPlugins,

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

    entry: oryx.find(settings.entry, {
        'app': path.join(settings.paths.sourceDir, 'src/app.ts'),
        'vendor': path.join(settings.paths.sourceDir, 'src/vendor.ts')
    }),

    output: {
        path: settings.paths.publicDir,
        filename: './js/[name].js'
    },

    resolve: {
        modules: ['node_modules', settings.paths.sourcePath],
        extensions: ['.ts', '.tsx', '.js', '.json', '.css', '.scss'],
        alias: {
            'shared': settings.paths.sourceDir + '/src/app/_shared'
        }
    },

    module: {
        rules: [{
            test: /\.tsx?$/,
            loader: 'awesome-typescript-loader'
        }, {
            enforce: 'pre',
            test: /\.js$/,
            loader: 'source-map-loader'
        }, {
            test: /\.scss$/i,
            loader: ExtractTextPlugin.extract({
                fallback: 'style-loader',
                use: [{
                    loader: 'css-loader',
                    query: {
                        sourceMap: !settings.options.isProduction,
                        importLoaders: 2
                    }
                }, {
                    loader: 'postcss-loader',
                    options: {
                        sourceMap: !settings.options.isProduction
                    }    
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

        new webpack.optimize.CommonsChunkPlugin({
            name: 'manifest'
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
            filename: 'css/[name].css',
            allChunks: true
        }),

        new CopyPlugin([{
            from: path.join(settings.paths.sourceDir, 'src/manifest.json'),
            to: 'manifest.json'
        }, {
            from: path.join(settings.paths.sourceDir, 'static/images'),
            to: 'images'
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
