@echo off
echo *** start encoding (BEST QUALITY) ***
echo *** Made by Surendra sonawane ***
echo *** chicken3301@gmail.com ***

REM Create output folder if it doesn't exist
if not exist "converted" (
    mkdir "converted"
)

for %%a in (
    *.wav
    *.flac
    *.aac
    *.ogg
    *.opus
    *.m4a
    *.wma
    *.aiff
    *.alac
) do (
    ffmpeg -y -i "%%a" -map_metadata 0 -id3v2_version 3 -vn -c:a libmp3lame -q:a 0 "converted\%%~na.mp3"
)

echo *** end encoding ***
pause

