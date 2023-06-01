<?php declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\MainController;
use App\Core\TwigRenderer;

$routes = require_once __DIR__ . '/../resources/routes/web.php';

$twigRenderer = new TwigRenderer(__DIR__ . '/../public/templates');

$controller = new MainController($twigRenderer);

$result = Router::run($routes, $controller);

echo $result;