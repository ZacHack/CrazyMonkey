@echo off
TITLE CrazyMonkey IRC bot by ZacHack
MODE CON: COLS=120 LINES=50
goto run
:run
color 0A
cls
echo CrazyMonkey is an IRC bot made by ZacHack
echo If you have any trouble make a issue at https://github.com/ZacHack/CrazyMonkey/issues
echo .
echo DO NOT sell this product
echo DO NOT claim this product as yours
echo .
echo Starting CrazyMonkey...
php CrazyMonkey.php || goto fail
:fail
echo CrazyMonkey has stopped working! D:
