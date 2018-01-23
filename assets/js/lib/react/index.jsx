// Libraries
import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

// Components
import Box from './components/Box.jsx';

class Main extends Component {

    constructor (props) {
        super(props);
        this.state = {
            color: "#00FF00"
        };
    }

    onColorChange = () => {
        let self = this;
        axios.get('http://www.colr.org/json/color/random')
            .then((response) => {
                self.setState({color: "#" + response.data.new_color});
            })
            .catch((error) =>{
                console.log(error);
            });
    };

    render() {
        return (
            <div>
                <div>Hi There from React! Good to see you, {this.props.name}</div>
                <Box onColorChange={this.onColorChange} color={this.state.color} />
            </div>
        );
    };
}

const root = document.getElementById('bpoc-root');
const data = root.dataset;

ReactDOM.render(<Main name={data.name} />, root);