<?php
// Render function
function render($layout, $page)
{
    $content = ob_get_contents();
    ob_end_clean();
    require_once($layout);
}
// Shutdown function
register_shutdown_function('render', $layout, $page);
// Start output buffering
ob_start();
    