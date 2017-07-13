import * as $ from 'jquery';
import * as core from './app/libs/core';

import './app/shell';
import './app/components/atoms/overlay/overlay';
import './app/components/molecules/card/card';
import './app/components/organisms/header/header';
import './app/components/organisms/content/content';
import './app/components/organisms/sidebar/sidebar';
import './app/components/organisms/footer/footer';
import './app/templates/base/base';
import './app/templates/product/product';
import './app/utils';

$(document).ready(core.init);

if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/main-sw.js');
    });
}
