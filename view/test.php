<?php
session_start();
// Check if session has started
if (session_status() === PHP_SESSION_NONE) {
    // Session has not started
    echo "Session has not started.";
} else {
    // Session has started
    echo "Session has started.";
}
?>