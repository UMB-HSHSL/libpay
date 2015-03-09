<?php
/**
 * Get/Set flash messages.
 *
 * @param string $type enum: warn, error, anything-else-is-diplayed-as-success
 * @param string $str the message to display
 *
 * @return string the message, wrapped in a styled div, or an empty string
 */
function flash_message($type = NULL, $str = NULL)
{
    $ci =& get_instance();

    $message = '';
    if ($type && $str) {
        $ci->session->set_flashdata('flash', array('type' => $type, 'message' => $str));
    }
    else {
        $message = $ci->session->flashdata('flash');
        if ($message && isset($message['type']) && isset($message['message'])) {
            if ('warn' == $message['type']) {
                $message = "<div class='alert alert-warning' role='alert'>{$message['message']}</div>";
            }
            elseif ('error' == $message['type']) {
                $message = "<div class='alert alert-danger' role='alert'>{$message['message']}</div>";
            }
            else {
                $message = "<div class='alert alert-success' role='alert'>{$message['message']}</div>";
            }
        }

    }

    return $message;
}