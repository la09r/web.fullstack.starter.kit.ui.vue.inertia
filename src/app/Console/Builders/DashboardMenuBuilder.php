<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Console\Builders;

class DashboardMenuBuilder
{
    public static function build()
    {
        $result = [];

        $path = base_path('resources/php/menu/Dashboard');
        $files = scandir($path);

        foreach ($files as $file)
        {
            if($file == '.' || $file == '..') { continue; }
            $items = require($path . '/' . $file);

            if(empty($items)) { continue; }
            $result = array_merge($result, $items);
        }

        return $result;
    }
}