<?php

class LibGlobale
{

    static function print_html_table($array, $titre)
    {
        Controller::render_template("viewTable.php", Controller::$base_directory,
            array('array' => $array, 'titre' => $titre));
    }


}