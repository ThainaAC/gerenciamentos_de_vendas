<?php

class Validator
{
    public static function texto($valor)
    {
        return isset($valor) && trim($valor) !== "";
    }

    public static function numero($valor)
    {
        return isset($valor) && is_numeric($valor) && $valor >= 0;
    }

    public static function inteiroPositivo($valor)
    {
        return isset($valor) &&
               filter_var($valor, FILTER_VALIDATE_INT) !== false &&
               $valor > 0;
    }

    public static function email($valor)
    {
        return isset($valor) && filter_var($valor, FILTER_VALIDATE_EMAIL);
    }

    public static function telefone($valor)
    {
        return isset($valor) &&
               preg_match('/^[0-9()\-\s+]{8,20}$/', $valor);
    }

    public static function data($valor)
    {
        $data = DateTime::createFromFormat('Y-m-d', $valor);

        return $data && $data->format('Y-m-d') === $valor;
    }

    public static function dataHoje($valor)
    {
        if (!self::data($valor)) {
            return false;
        }

        return $valor === date('Y-m-d');
    }
}
?>

