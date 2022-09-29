/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import React, {Component} from 'react';
import { ReactDOM } from 'react-DOM';

class App extends Component {
    render() {
        return (
            <div>
                Hola
            </div>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('root'))

// start the Stimulus application
// import './bootstrap';import React from 'react';

