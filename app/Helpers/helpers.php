<?php

if (!function_exists('render_view')) {
    /**
     * renders the view
     * usage render_view('view_file_path', ['data' => ['title' => 'title']])
     *
     * @param $file string
     * @param $value array
     * @return string
     */
    function render_view($file, array $value = [])
    {
        ob_start();
        extract($value);
        include __DIR__ . '/../../views/' . $file;
        return ltrim(ob_get_clean());
    }
}