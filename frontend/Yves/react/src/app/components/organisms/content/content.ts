
import './content.scss';
import * as $ from 'jquery';
import { register } from '../../../libs/core';
import Component from '../../../components/base/base';

class Content extends Component {
    $html: any

    init() {
        this.$html = $('.js-content__html', this.$el);

        this.mapEvents();
        this.load()
    }

    mapEvents() {
        $(window).on('hashchange', this.onChange.bind(this));
    }

    onChange() {
        this.load();
    }

    load() { 
        console.log('loading', this.hash);

        // $.ajaxPrefilter(function (options) {
        //     options.async = true;
        // });
                
        $.ajax({
            method: 'GET',
            url: this.hash,
            success: this.onSuccess.bind(this),
            error: this.onError.bind(this)
        });
    }

    onSuccess(data) { 
        this.$html.html(data);
    }

    onError() { 
        window.location.href = this.hash;
    }
  
    get hash() {
        return (window.location.hash || '/').replace('#', '');    
    }

}

export default register('.js-content', Content);
