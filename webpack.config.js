<<<<<<< HEAD
const HtmlWebPackPlugin = require('html-webpack-plugin');
=======
//const HtmlWebPackPlugin = require('html-webpack-plugin');
>>>>>>> 6020ad6 (initial commit)
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const postcssPresetEnv = require('postcss-preset-env');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const webpack = require('webpack');

module.exports = (env, {mode}) => {
  console.log(mode);
  return {
    output: {
<<<<<<< HEAD
      filename: '[name].[fullhash].js'
    },
    devServer: {
      hot: true
    },
    module: {
      rules: [
        {
=======
      filename: 'script.js'
    },
    devServer: {
      hot: true,
      port: 3000,
      headers: {
        'Access-Control-Allow-Origin': '*'
      }
    },
    module: {
      rules: [
        /*{
>>>>>>> 6020ad6 (initial commit)
          test: /\.html$/,
          use: [
            {
              loader: 'html-srcsets-loader',
              options: {
                attrs: [':src', ':srcset']
              }
            }
          ]
<<<<<<< HEAD
        },
=======
        },*/
>>>>>>> 6020ad6 (initial commit)
        {
          test: /\.(jpe?g|png|svg|webp)$/,
          type: 'asset/resource'
        },
        {
          test: /\.css$/,
          use: [
            mode === 'production' ? MiniCssExtractPlugin.loader : 'style-loader',
            'css-loader',
            'resolve-url-loader',
            {
              loader: 'postcss-loader',
              options: {
                sourceMap: true,
                postcssOptions: {
                  plugins: [
                    require('postcss-import'),
                    postcssPresetEnv({stage: 0})
                  ]
                }
              }
            }
          ]
        }
      ]
    },
    plugins: [
<<<<<<< HEAD
      new HtmlWebPackPlugin({
        template: './src/index.html',
        filename: './index.html'
      }),
      new MiniCssExtractPlugin({
        filename: 'style.[contenthash].css'
=======
      /*new HtmlWebPackPlugin({
        template: './src/index.html',
        filename: './index.html'
      }),*/
      new MiniCssExtractPlugin({
        filename: 'style.css'
>>>>>>> 6020ad6 (initial commit)
      }),
      new OptimizeCSSAssetsPlugin(),
      new webpack.HotModuleReplacementPlugin()
    ]
  };
};
