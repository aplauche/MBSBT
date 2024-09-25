/**
 * External Dependencies
 */
const path = require( 'path' );
const CopyWebpackPlugin = require('copy-webpack-plugin');
// const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const glob  = require('glob');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');



/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );



module.exports = (env, argv) => {

  const config = {
      ...defaultConfig,
      entry: {
        ...defaultConfig.entry(),
        admin: './assets/scss/editor.scss',
        main: './assets/scss/main.scss',
        index: './assets/js/index.js',
        editor: './assets/js/editor.js',
      },
      module: {
        ...defaultConfig.module,
        rules: [
          ...defaultConfig.module.rules,
          // Disable hashing on font and image files. This allows preloading and caching
          {
            test: /\.(woff|woff2|eot|ttf|otf)$/i,
            type: 'asset/resource',
            generator: {
              filename: 'fonts/[name][ext]',
            },
          },
          {
            test: /\.(webp|png|jpe?g|gif)$/,
            type: 'asset/resource',
            generator: {
              filename: 'images/[name][ext]',
            },
          },
        ],
      },
      plugins: [
        ...defaultConfig.plugins,

        new RemoveEmptyScriptsPlugin(),

        new CopyWebpackPlugin({
          patterns: [
            {
              from: '**/*.{jpg,jpeg,png,gif,svg}',
              to: 'images/[path][name][ext]',
              context: path.resolve(process.cwd(), 'assets/images'),
              noErrorOnMissing: true,
            },
            {
              from: '*.svg',
              to: 'images/icons/[name][ext]',
              context: path.resolve(process.cwd(), 'assets/images/icons'),
              noErrorOnMissing: true,
            },
            {
              from: '**/*.{woff,woff2,eot,ttf,otf}',
              to: 'fonts/[path][name][ext]',
              context: path.resolve(process.cwd(), 'assets/fonts'),
              noErrorOnMissing: true,
            },
            // ...copyPluginPatterns, // Include patterns for PHP and JSON files
          ],
        }),
      ]
  }
      

  return config

}

