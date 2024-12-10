require( 'dotenv' ).config( { path: './.env' } );

const { WebpackManifestPlugin } = require( 'webpack-manifest-plugin' );

module.exports = ( env, argv ) => {
	if ( argv.mode === 'development' && !process.env.hmtUrl ) {
		console.log( '\x1b[31mConfigure your .env file by following the .env.example file or the .env file inside the HMT parent theme.' );
		process.exit( 0 );
	}

	const hmtUtls = require( './src/build/utls' );

	const copyPatterns = [
		{
			from: 'src/theme/img/**/*',
			to: 'images/[name][ext]',
		}
	];

	return {
		mode: argv.mode ? argv.mode : 'development',
		entry: {
			main: [
				'./src/theme/js/main.js',
				'./src/theme/scss/load.scss',
			],
			...hmtUtls.generateEntriesFromFolder( './src/theme/{js,scss}/blocks/section-*' ),
		},
		output: hmtUtls.outputConfig( argv, __dirname ),
		devtool: 'source-map',
		watchOptions: {
			poll: 1000,
			ignored: /node_modules/,
		},
		plugins: [
			...hmtUtls.pluginsConfig( argv, copyPatterns ),
			new WebpackManifestPlugin( {
				publicPath: '',
				filter: ( file ) => {
					if ( file.isAsset ) {
						return false;
					}

					return true;
				}
			} ),
		],
		devServer: hmtUtls.devServerConfig(),
		externals: {
			jquery: 'jQuery'
		},
		optimization: hmtUtls.optimizationConfig( argv ),
		module: {
			rules: hmtUtls.moduleRules()
		},
	};
};
