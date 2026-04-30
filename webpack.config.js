const path                    = require( 'path' );
const MiniCssExtractPlugin    = require( 'mini-css-extract-plugin' );
const { WebpackManifestPlugin } = require( 'webpack-manifest-plugin' );

module.exports = ( env, argv ) => {
  const isDev = argv.mode !== 'production';

  return {
    entry: {
      main: [
        './src/index.js',
        './scss/main.scss',
      ],
    },

    output: {
      path:     path.resolve( __dirname, 'dist' ),
      filename: 'js/[name].[contenthash:8].js',
      clean:    true,
    },

    // source-map in dev  — separate .map file, no eval(), Customizer works
    // false in production — no source maps, smaller bundle, no source exposure
    devtool: isDev ? 'source-map' : false,

    module: {
      rules: [
        // JS
        {
          test:    /\.js$/,
          exclude: /node_modules/,
          use:     { loader: 'babel-loader' },
        },
        // SCSS
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
            {
              loader:  'sass-loader',
              options: {
                api:            'modern',
                implementation: require( 'sass' ),
              },
            },
          ],
        },
      ],
    },

    plugins: [
      new MiniCssExtractPlugin( {
        filename: 'css/[name].[contenthash:8].css',
      } ),
      new WebpackManifestPlugin( {
        fileName:  'assets.json',
        publicPath: '',
        filter:    ( file ) => file.name === 'main.js' || file.name === 'main.css',
        generate:  ( seed, files ) => {
          const out = { main: {} };
          files.forEach( f => {
            if ( f.name === 'main.js'  ) out.main.js  = f.path;
            if ( f.name === 'main.css' ) out.main.css = f.path;
          } );
          return out;
        },
      } ),
    ],

    resolve: {
      extensions: [ '.js', '.scss' ],
    },

    // Dev server / watch mode optimisations
    watchOptions: {
      ignored: /node_modules/,
    },
  };
};