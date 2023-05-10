#!/bin/bash

git fetch origin
git reset --hard origin/develop
cd ./wp-content/themes/lovexstudio
npm run fix
npm run build
git add --all assets/
git commit -m "Build assets"
git push origin HEAD:develop