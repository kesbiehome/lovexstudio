#!/bin/bash

git fetch origin
git reset --hard origin/develop
cd ./wp-content/themes/lovexstudio
git add --all assets/
git commit -m "Build assets"
git push origin HEAD:develop