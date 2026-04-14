<?php

if (!function_exists('formatarCbo')) {
    function formatarCbo($cbo)
    {
        if (empty($cbo) || strlen($cbo) < 6) {
            return $cbo;
        }

        return substr($cbo, 0, 4) . '-' . substr($cbo, 4, 2);
    }
}

if (!function_exists('formatarCpf')) {
    function formatarCpf($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11) {
            return $cpf;
        }

        return  substr($cpf, 0, 3) . '.' .
            substr($cpf, 3, 3) . '.' .
            substr($cpf, 6, 3) . '-' .
            substr($cpf, 9, 2);
    }
}

if (!function_exists('statusFuncionario')) {
    function statusFuncionario($status)
    {
        return $status == 1 ? 'Ativo' : 'inativo';
    }
}


if (!function_exists('encodeId')) {
    function encodeId($id)
    {
        return rtrim(strtr(base64_encode($id), '+/', '-_'), '=');
    }
}

if (!function_exists('decodeId')) {
    function decodeId($hash)
    {
        $base64 = strtr($hash, '-_', '+/');

        $padding = strlen($base64) % 4;
        if ($padding > 0) {
            $base64 .= str_repeat('=', 4 - $padding);
        }

        return base64_decode($base64);
    }
}
