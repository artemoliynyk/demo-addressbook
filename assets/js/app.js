/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../scss/app.scss';

require('bootstrap');


$(document).ready(function () {
    $('.btn-delete').click(function (e) {
        if(!confirm('Are you sure want to delete this contact?')) {
            e.preventDefault();
            return false;
        }
    });
});
