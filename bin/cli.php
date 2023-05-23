<?php

require __DIR__ . '/vendor/autoload.php';

try {
    unset($argv[0]);

    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
    });

    $className = '\\MyProject\\Cli\\' . array_shift($argv);
    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Класс "' . $className . '" не найден');
    }

    $classInheritor = new ReflectionClass($className);

    $classInheritor->isSubClassOf(MyProject\Cli\AbstractCommand::class) ? $result = 'yes' : $result = 'no';
    echo $result;

    $params = [];
    foreach ($argv as $argument) {
        preg_match('/^-(.+)=(.+)$/', $argument, $matches);
        if (!empty($matches)) {
            $paramName = $matches[1];
            $paramValue = $matches[2];

            $params[$paramName] = $paramValue;
        }
    }

    $class = new $className($params);
    $class->execute();

} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage(); 
}