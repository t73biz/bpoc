module.exports = {
    entry: ['./lib/react/index.js'],
    output: {
        path: __dirname + 'dist',
        filename: 'bpoc.bundle.js'
    },
    module: {
        loaders: [
            {test: /\.js$/, exclude: /node_modules/, loader: 'babel-loader'},
            { test: /\.css$/, loader: "style-loader!css-loader" }
        ]
    }
};