
const oryx = require('@spryker/oryx');
const configuration = require('./webpack.config');

// build the assets with webpack
oryx.build(configuration);
