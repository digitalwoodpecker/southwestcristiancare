
const ImageMinimizerPlugin = require( 'image-minimizer-webpack-plugin' );
const TerserPlugin = require( 'terser-webpack-plugin' );
const CopyPlugin = require( 'copy-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const ESLintPlugin = require( 'eslint-webpack-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const glob = require( 'glob' );
const path = require( 'path' );
const webpack = require( 'webpack' );
const process = require( 'process' );

const hmtUtls = {
	generateEntriesFromFolder( folder ) {
		if ( !folder ) {
			return {};
		}

		let splitSeparator = '/';

		if ( process && process.platform === 'win32' ) {
			splitSeparator = '\\';
		}

		return glob.sync( folder ).reduce( ( files, path ) => {
			const name = path.split( splitSeparator ).pop().replace( /\.[^]+$/, '' );
			const asset = './' + path;

			let assets = [asset];

			if ( name in files ) {
				assets = [...files[name], asset];
			}

			return { ...files, [name]: assets };
		}, {} );
	},
	getHost() {
		if ( !process.env.hmtUrl ) {
			return '';
		}

		let websiteUrl = new URL( process.env.hmtUrl );

		return websiteUrl.hostname;
	},
	getSSLFileName() {
		if ( process.env.hmtSSLFileName ) {
			return process.env.hmtSSLFileName;
		}

		return hmtUtls.getHost();
	},
	getProtocol() {
		if ( process.env.hmtUrl && process.env.hmtUrl.match( /https/ ) ) {
			return 'https';
		}

		return 'http';
	},
	getCertificatesFolder() {
		return process.env.hmtCertificatesFolder;
	},
	devServerConfig() {
		let themeSSLOptions = {
			key: hmtUtls.getCertificatesFolder() + hmtUtls.getSSLFileName() + '.key',
			cert: hmtUtls.getCertificatesFolder() + hmtUtls.getSSLFileName() + '.crt',
			requestCert: false,
		};

		if ( hmtUtls.getProtocol() !== 'https' ) {
			themeSSLOptions = {};
		}
		
		const port = process.env.PORT || 80;

		return {
			watchFiles: ['./**/*.php'],
			host: hmtUtls.getHost(),
			static: false,
			open: '/',
			allowedHosts: 'all',
			port: port,
			server: {
				type: hmtUtls.getProtocol(),
				options: themeSSLOptions
			},
			client: {
				webSocketURL: `auto://0.0.0.0:${port}/ws`
			},
			proxy: [
				{
					context: () => true,
					target: hmtUtls.getProtocol() + '://' + hmtUtls.getHost(),
					secure: false
				}
			],
			headers: {
				'Access-Control-Allow-Origin': '*'
			},
			devMiddleware: {
				index: false,
				serverSideRender: true,
				writeToDisk: true
			}
		};

	},
	moduleRules() {
		return [
			{
				test: /\.(woff(2)?|ttf|eot)$/,
				type: 'asset/resource',
				generator: {
					filename: './fonts/[name][ext]',
				},
			},
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: 'asset/resource',
				generator: {
					filename: './images/[name]-[contenthash][ext]',
				},
			},
			{
				test: /\.css$/i,
				use: ['style-loader', 'css-loader', 'sass-loader'],
			},
			{
				test: /\.s[ac]ss$/i,
				enforce: 'pre',
				loader: 'import-glob-loader2'
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'resolve-url-loader',
					'postcss-loader',
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true
						}
					}
				],
			},
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'],
						plugins: ['@babel/plugin-transform-class-properties']
					}
				}
			}
		];
	},
	pluginsConfig( argv, copyPatterns ) {
		return [
			new RemoveEmptyScriptsPlugin( { enabled: argv.mode === 'production' } ),
			new MiniCssExtractPlugin( {
				filename: argv.mode === 'development' ? '[name].css' : '[name]-[contenthash].css'
			} ),
			new webpack.ProvidePlugin( {
				$: 'jquery',
				jQuery: 'jquery',
				themeUtils: 'themeUtils',
				theme: 'theme'
			} ),
			new CopyPlugin( {
				patterns: copyPatterns,
			} ),
			new CleanWebpackPlugin(),
			new ESLintPlugin( {
				fix: true,
				files: [
					'src/**/*.js'
				]
			} ),
			new StylelintPlugin( {
				files: [
					'src/theme/scss/**/*.scss'
				]
			} ),
			new webpack.DefinePlugin( {
				'process.env': JSON.stringify( process.env )
			} ),
		];
	},
	optimizationConfig() {
		return {
			runtimeChunk: 'single',
			minimizer: [
				new ImageMinimizerPlugin( {
					minimizer: {
						implementation: ImageMinimizerPlugin.imageminMinify,
						options: {
							plugins: [
								'imagemin-gifsicle',
								'imagemin-mozjpeg',
								'imagemin-pngquant',
								'imagemin-jpegtran'
							],
						},
					},
				} ),
				new TerserPlugin()
			],
		};
	},
	outputConfig( argv, distDir ) {
		return {
			path: path.resolve( distDir, 'dist/' ),
			filename: argv.mode === 'development' ? '[name].js' : '[name]-[contenthash].js'
		};
	}
};

module.exports = hmtUtls;
