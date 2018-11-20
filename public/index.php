<?php
    define('PUBLIC', dirname(__FILE__));
    define('ROOT', dirname(dirname(__FILE__)));
    define('DS', DIRECTORY_SEPARATOR);
    define('APP', ROOT.DS.'app');
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
?>

<pre>
    <?php
        echo BASE_URL;
    ?>
</pre>
