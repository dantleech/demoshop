
import './content.scss';
import * as $ from 'jquery';
import { register } from '../../../libs/core';
import Component from '../../../components/base/base';

class Content extends Component {
    $html: any

    init() {
        this.$html = $('.js-content__html', this.$el);

        this.mapEvents();
        this.load();
    }

    mapEvents() {
        $(window).on('hashchange', this.onChange.bind(this));
    }

    onChange() {
        this.load();
    }

    load() {
        const that = this;
        console.log('loading', this.hash);

        fetch(this.hash + '?fetch=1').then(function (response) {
            return response.text().then(function (data) {
                that.$html.html(data);
            });
        }).catch(function (err) {
            that.fallback();
        });
    }

    fallback() {
        const that = this;
        console.log('fallback');

        fetch('/offline?fetch=1').then(function (response) {
            if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' + response.status);
                return;
            }

            response.text().then(function (data) {
                that.$html.html(data);
            });
        }).catch(function (err) {
            console.log('Fetch Error :-S', err);
        });
    }

    get hash() {
        return (window.location.hash || '/').replace('#', '');
    }

}

export default register('.js-content', Content);
