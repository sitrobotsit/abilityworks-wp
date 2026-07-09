const webpack = require('webpack');
const path = require('path');

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

// const TerserPlugin = require('terser-webpack-plugin');

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: [
    './src/js/script.js',
    './src/scss/style.scss',
  ],
  output: {
    filename: './js/script.min.js',
    path: path.resolve(__dirname)
  },
  module: {
    rules: [
      // perform js babelization on all .js files
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ['babel-preset-env']
          }
        }
      },
      // compile all .scss files to plain old css
      {
        test: /\.(sass|scss)$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
      },
      {
        test: /\.(png|jp(e*)g|gif)$/,
        use: [{
          loader: 'url-loader',
          options: {
            outputPath: './images/',
            publicPath: '../images/',
            limit: 8000, // Convert images < 8kb to base64 strings
            name: '[hash]-[name].[ext]'
          }
        }]
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf|svg)$/,
        use: {
          loader: 'file-loader',
          options: {
            outputPath: './fonts/',
            publicPath: '../fonts/',
          }
        }
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery"
    }),
    // extract css into dedicated file
    new MiniCssExtractPlugin({
      filename: './css/style.min.css'
    }),
    new BrowserSyncPlugin({
      files: [
        './**/*.php',
        './css/*.css',
      ],
      injectChanges: true,
      // injectCss: true,
      proxy: 'http://abilityworks.local'
    }, {
      reload: false
    })
  ],
  optimization: {
    minimizer: [
      // enable the js minification plugin
      new UglifyJSPlugin({
        cache: true,
        parallel: true
      }),
      new OptimizeCSSAssetsPlugin({})
    ],
    // splitChunks: {
    //   chunks: 'all'
    // },
    // minimize: true,
    // minimizer: [new TerserPlugin()],
  }
};
