import React, { Component } from 'react';

export default class Box extends Component {
    constructor (props) {
        super(props);
        this.handleColorChange = props.onColorChange;
    }

    render() {
        return (
            <div className="color-box"><button onClick={this.handleColorChange} style={{backgroundColor: this.props.color}}>Change This Color!</button>{this.props.color}</div>
        )
    }
}