
import './base.scss';
import * as $ from 'jquery';
import { register } from '../../libs/core';
import Component from '../../components/base/base';

class BaseTemplate extends Component {
    $toggler: any
    $sidebar: any
    $overlay: any
    
    init() {
        this.$toggler = $('.js-base-template__toggler', this.$el);
        this.$sidebar = $('.js-base-template__sidebar', this.$el);
        this.$overlay = $('.js-base-template__overlay', this.$el);
     
        this.mapEvents();
    }

    mapEvents() {
        this.$toggler.on('click', this.onClick.bind(this));
    }

    onClick() {
        this.toggleSide();
        return false;
    }

    toggleSide() {
        this.$el.toggleClass('u-is-shown');
        this.$sidebar.toggleClass('u-is-shown');
        this.$overlay.toggleClass('u-is-shown');
    }

}

export default register('.js-base-template', BaseTemplate);
