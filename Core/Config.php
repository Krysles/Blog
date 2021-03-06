<?php
namespace App\Core;

class Config
{
    private static $params;

    public static function get($name, $defaultValue = null)
    {
        $params = self::getParams();
        if (isset($params[$name])) {
            $value = $params[$name];
        } else {
            $value = $defaultValue;
        }
        return $value;
    }

    private static function getParams() {
        if (self::$params == null) {
            $pathFile = "Config/". Router::getEnvironment() .".ini";
            if (!file_exists($pathFile)) {
                throw new \Exception("Aucun fichier de configuration trouvé");
            } else {
                self::$params = parse_ini_file($pathFile);
            }
        }
        return self::$params;
    }
}