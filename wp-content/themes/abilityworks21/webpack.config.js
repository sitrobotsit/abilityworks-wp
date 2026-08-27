const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: ['./src/js/script.js', './src/scss/style.scss'],
  output: {
    filename: './js/script.min.js',
    path: path.resolve(__dirname),
    assetModuleFilename: 'fonts/[hash][ext][query]',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.(sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              implementation: require('sass'),
              sassOptions: {
                quietDeps: true,
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'slash-div'],
              },
            },
          },
        ],
      },
      {
        test: /\.(png|jpe?g|gif)$/i,
        type: 'asset',
        parser: {
          dataUrlCondition: {
            maxSize: 8000,
          },
        },
        generator: {
          // Emitted under theme/images/; CSS lives in theme/css/
          filename: 'images/[hash][ext][query]',
          publicPath: '../',
        },
      },
      {
        test: /\.(woff2?|eot|ttf|otf|svg)$/i,
        type: 'asset/resource',
        generator: {
          // Emitted under theme/fonts/; CSS lives in theme/css/
          filename: 'fonts/[hash][ext][query]',
          publicPath: '../',
        },
      },
    ],
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
    }),
    new MiniCssExtractPlugin({
      filename: './css/style.min.css',
    }),
    new BrowserSyncPlugin(
      {
        files: ['./**/*.php', './css/*.css'],
        injectChanges: true,
        proxy: 'http://localhost:8080',
      },
      {
        reload: false,
      }
    ),
  ],
  optimization: {
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
  },
};
