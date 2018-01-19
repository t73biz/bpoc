const path = require('path');

module.exports = {
    entry: ['./js/lib/react/index.jsx'],
    output: {
        path: path.resolve(__dirname, 'js/dist'),
        filename: 'bpoc.bundle.js'
    },
    module: {
        loaders: [
            {test: /\.jsx$/, exclude: /node_modules/, loader: 'babel-loader'},
            { test: /\.css$/, loader: "style-loader!css-loader" }
        ]
    }
};