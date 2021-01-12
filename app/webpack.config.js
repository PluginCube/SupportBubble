const sveltePreprocess = require('svelte-preprocess');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const path = require('path');

const mode = process.env.NODE_ENV || 'development';
const prod = mode === 'production';
const watch = !prod;

module.exports = {
	entry: {
		bundle: ['./src/main.js']
	},
	resolve: {
		alias: {
			svelte: path.resolve('node_modules', 'svelte'),
			store$: path.resolve(__dirname, 'src/store'),
		},
		extensions: ['.mjs', '.js', '.svelte'],
		mainFields: ['svelte', 'browser', 'module', 'main']
	},
	output: {
		path: __dirname + '/dist',
		filename: '[name].js',
		chunkFilename: '[name].[id].js'
	},
	module: {
		rules: [
			{
				test: /\.svelte$/,
				resolve: {
					fullySpecified: false // load Svelte correctly
				},		  
				use: [
					{
						loader: 'svelte-loader',
						options: {
							dev: false,
							emitCss: false,
							hotReload: true,
							preprocess: sveltePreprocess()			
						}
					}
				]
			},
			{
				test: /\.css$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
				]
			},
			{
				test: /\.(png|jpe?g|gif|woff|woff2|eot|ttf|svg)$/i,
				use: [
					{
						loader: 'file-loader',
						options: {
							esModule: false,
							outputPath: 'assets',
							publicPath: './assets'
						}
					},
				],
			},		
		]
	},
	mode,
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name].css'
		})
	],
	devtool: prod ? false: 'source-map',
	watch,
	stats: { children: false }
};
