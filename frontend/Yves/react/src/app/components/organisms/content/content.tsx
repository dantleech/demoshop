
import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { HashRouter, Route } from 'react-router-dom'

import { Home } from '../../../templates/home/home';
import { Product } from '../../../templates/product/product';

const Router = () => (
    <HashRouter>
        <div>
            <Route exact path="/" component={Home} />
            <Route path="/product/:id" component={Product} />
        </div>
    </HashRouter>
)

ReactDOM.render(<Router />, document.getElementById('content'));
