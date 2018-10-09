<?php

//1º Mais usado funciona 80% das vezes.
\DB::listen(function ($sql) {
    $pattern = str_replace('?', '%s', $sql->sql);

    $bindings = array_map(function ($binding) {
        if (is_bool($binding)) {
            return var_export($binding, true);
        }

        return sprintf("'%s'", $binding);
    }, $sql->bindings);

    $data = vsprintf($pattern, $bindings);

    dd($data);
    echo '<pre>';
    print_r($data);
    echo PHP_EOL . '##########' . PHP_EOL;
});

//2º Funcionou em alguma vezes que o primeiro falhou.

DB::enableQueryLog();
$queries = DB::getQueryLog();
dd($queries);
