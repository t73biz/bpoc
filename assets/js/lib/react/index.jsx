import React, {Component} from 'react';
import ReactDOM from 'react-dom';


class Main extends Component {
    render() {
        return (
            <div>Hi There from React! Good to see you, {this.props.name}</div>
        );
    };
}

const root = document.getElementById('bpoc-root');
const data = root.dataset;

ReactDOM.render(<Main name={data.name} />, root);