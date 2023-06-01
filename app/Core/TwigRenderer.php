<?php declare(strict_types=1);

namespace App\Core;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;

class TwigRenderer
{
    private Environment $twig;

    public function __construct(string $templatePath)
    {
        $loader = new FilesystemLoader($templatePath);
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data): string
    {
        try {
            return $this->twig->render($template, $data);
        } catch (LoaderError $error) {
            return 'Template loading error';
        }
    }
}