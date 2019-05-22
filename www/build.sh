#!/bin/bash

# If SASS is not installed yet
# npm install -g sass

# Renders CSS from SASS
sass css/application.sass css/all.css
printf "  rendered css/all.css"

# Renders index.html from index.pug
# If PUG is not installed yet
# npm install pug-cli -g
pug index.pug index.html