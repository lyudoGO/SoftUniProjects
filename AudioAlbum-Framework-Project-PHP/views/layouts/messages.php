<?php

renderMessages('infoMessages', 'alert-success');
renderMessages('errorMessages', 'alert-danger');

function renderMessages($messagesKey, $cssClass) {
    if (isset($_SESSION[$messagesKey]) && count($_SESSION[$messagesKey]) > 0) {
    	echo '<div class="alert ' . $cssClass . '">';
    	echo '<button type="button" class="close" data-dismiss="alert">×</button>';
        echo '<ul>';
        foreach ($_SESSION[$messagesKey] as $msg) {
            echo "<li>" . htmlspecialchars($msg) . '</li>';
        }
        echo '</ul></div>';
    }
    $_SESSION[$messagesKey] = [];
}