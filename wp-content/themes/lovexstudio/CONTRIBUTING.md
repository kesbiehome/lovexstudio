# CONTRIBUTING

## Using this template

1. Clone this template to wp-content/themes/<theme_folder_name>
2. Find all `ct_child_theme_` and change to your prefix theme, for example: `ct_mosaic_`, `gomsu_`
3. Find all `ct-child-theme` and change to your prefix theme, for example `ct-mosaic` or `gomsu`.

## Setup Dev Environment

1. Install NodeJS `npm install`
2. Install PHP Composer `composer install`
3. Edit proxy domain in `webpack.config.js`

```
proxy: {
	target: 'http://local.test/',
	...
}
```

## Start dev

1. Run `npm run dev` to start dev and open `localhost:3000`

## Test

**NodeJS**

1. Run `npm run test` for testing source code.
2. Run `npm run fix` to fix automatically CSS/JS and tab indent automatically.

**PHP**

1. Run `composer lint` to test PHPCS (PHP Coding Standard).
2. Run `composer fix` to fix PHPCS automatically (not all).

## Project structure

```
src/postcss/blocks/*.css - Contains css file for blocks/*.php
src/js/blocks/*.js - Contains JS file for blocks/*.php
src/js/libs/*.js - Contains internal JS libs
src/components/*.jsx - React Components
blocks.json - Register block to visible on page block editor (using ACF)
```
