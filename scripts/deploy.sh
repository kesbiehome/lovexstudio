#!/bin/bash

git fetch origin
git reset --hard origin/master
git merge origin/develop --no-ff --no-edit
git push origin HEAD:master
cd ./wp-content/themes/lovexstudio
rm -rf assets/js/*.js.LICENSE.txt
rm -rf src/
rm -rf postcss.config.js
rm -rf node_modules/
rm -rf package*.json
rm -rf .babelrc .browserslistrc .editorconfig .eslintrc.js .prettierignore .stylelintrc .gitignore
rm -rf webpack.config.js CONTRIBUTING.md CHANGELOG.md composer.json
git add .
git commit -m "Release package"
git push origin HEAD:production-temp --force
git reset --hard origin/production
git merge origin/production-temp --no-ff --no-edit
git push origin HEAD:production
git push origin :production-temp