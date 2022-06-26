<?php
require_once '../model/ModelFamily.php';
require_once '../model/LibGlobale.php';


class Controller
{

    public static $base_directory = "/app/view";

    public static function accueil()
    {

        self::render_template("viewAccueil.php", ControllerFamily::$base_directory,
            array('titre' => "Bienvenue sur la généalogie des familles"));
    }

    public static function render_template($to_render, $directory, $params = array())
    {
        // On s'assure d'avoir tous les paramètres nécessaires
        extract($params);

        include 'config.php';

        require($root . ControllerFamily::$base_directory . '/baseHead.php');
        ob_start();
        include($root . $directory . '/' . $to_render);
        $applied_template = ob_get_contents();
        ob_end_clean();

        echo $applied_template;

        require($root . ControllerFamily::$base_directory . '/baseFooter.php');

    }

    public static function require_family_selected($namespace, $function, $args = null)
    {
        if (is_null(ControllerFamily::getSelectedFamily()))
            return self::render_template("viewErreurFamille.html", Controller::$base_directory,
                array('titre' => "Bienvenue sur la généalogie des familles"));
        return call_user_func(array($namespace, $function), $args);

    }
}