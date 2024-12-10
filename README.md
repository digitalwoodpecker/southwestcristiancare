# Harbinger Marketing Theme Child

**Requires at least:** WordPress 6.5
**Requires PHP:** 8.0.7

## Dependencies

1. Latest version of [NodeJS](http://nodejs.org/) (min v16.20.0)
2. Latest version of one of the following package managers:

- [NPM](https://www.npmjs.com/) (min v8.19.0)
- [Yarn](https://yarnpkg.com/) (min v1.22.0)

## Install

In the theme root directory run: `npm install` or `yarn install`

## Development

Please review the readme file of the parent theme to get a better idea of how the build process works. This readme file includes some details related only to the child theme.

### Development Configuration

1. Copy the `.env.example` to `.env`
2. Configure the following options:
  - `hmtUrl`: the hostname of your local instance (e.g. `https://hmt.local`)
  - `hmtCertificatesFolder`: path to the folder that contains the SSL certificate of the hostname.
  - `hmtSSLFileName`: (optional) if the SSL file uses a different name than the hostname(e.g. `htm.local`), this variable can be used to set a custom file name.

### Parent JavaScript app object

The parent theme has a global object (`window.app`) which includes helper functions that can be used inside the child theme. For example, `window.app.loadVendor( ... )`, `window.app.main.customScrollbarsForSection( ... );`. Instead of duplicating these functions inside the child theme, the global object can be used directly. For the available app functions, please check the `src/theme/js/app.js` file inside the parent theme.
