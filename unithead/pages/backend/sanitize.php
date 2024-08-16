<?php
function sanitizeQuillContent($content)
{
    // Allow only specific HTML tags
    $allowedTags = '<p><br><strong><em><u><h1><h2><h3><h4><h5><h6><ol><ul><li><blockquote>';

    // First, strip all HTML tags except those specifically allowed
    $content = strip_tags($content, $allowedTags);

    // Remove any potential script injections
    $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);

    // Remove any `on*` attributes
    $content = preg_replace('/(<[^>]+) on\w+="[^"]*"/i', '$1', $content);

    // Remove any `style` attributes
    $content = preg_replace('/(<[^>]+) style="[^"]*"/i', '$1', $content);

    return $content;
}
