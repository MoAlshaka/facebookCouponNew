@echo off
cd /d ".\"

set "directoryPath=.\node_modules"

if not exist "%directoryPath%" (
    echo The directory does not exist. Running the command.
    start cmd /k npm install
    start cmd /k npm i -g nodemon
) else (
    echo The directory already exists.
    start cmd /k nodemon app.js
    start cmd /k pocketbase.exe serve
)


