set APP_DIR=%cd%

-d auto_prepend_file="$PWD/vendor/autoload.php"

php -d display_errors -d auto_prepend_file=%cd%\vendor\autoload.php -S localhost:8000 -t public/


