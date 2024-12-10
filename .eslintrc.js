module.exports = {
	parser: '@babel/eslint-parser',
	parserOptions: {
		'sourceType': 'module',
		'ecmaVersion': 2020,
		requireConfigFile: false,
		babelOptions: {
			plugins: ['@babel/plugin-transform-class-properties'],
		},

	},
	extends: [
		'eslint:recommended',
	],
	env: {
		'browser': true,
		'node': true
	},
	globals: {
		'jQuery': true,
		'$': true,
		'themeUtils': true,
		'Marionette': true,
		'theme': true,
		'nfRadio': true,
		'mainSettings': true,
		'preLocationHash': true,
		'buttonSettings': true,
		'YT': true,
		'Backbone': true,
		'themeVars': true,
		'google': true,
		'Proxy': true,
		'Swiper': true
	},
	rules: {
		'indent': ['error', 'tab'],
		'linebreak-style': ['error', 'unix'],
		'quotes': ['error', 'single'],
		'semi': ['error', 'always'],
		'no-inner-declarations': 'off',
		'no-duplicate-imports': 'error',
		'no-prototype-builtins': 'off',
		'camelcase': 'error',
		'eqeqeq': 'error',
		'curly': 'error',
		'space-in-parens': [ 'error', 'always' ],
		'space-infix-ops': 'error',
		'space-unary-ops': 'error',
		'space-before-function-paren': ['error', 'never'],
		'space-before-blocks': 'error',
		'one-var': ['error', 'never'],
		'no-empty': 'error',
		'keyword-spacing': 'error',
		'max-depth': ['error', 4],
		'complexity': ['error', 7],
	}
};