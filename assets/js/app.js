/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

require('../../node_modules/jquery/dist/jquery.slim.js');
require('../../node_modules/popper.js/dist/popper.min.js');
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');
require('../../node_modules/holderjs/holder.min.js');

require('../../node_modules/bootstrap/dist/css/bootstrap.min.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
