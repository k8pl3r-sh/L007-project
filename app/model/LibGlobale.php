<?php

class LibGlobale
{

    static function print_html_table($array, $titre)
    {
        ControllerFamily::render_template("viewTable.php", ControllerFamily::$base_directory,
            array('array' => $array, 'titre' => $titre));
    }


}