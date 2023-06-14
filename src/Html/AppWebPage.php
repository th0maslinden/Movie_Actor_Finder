<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    /**
     * Constructeur de la classe AppWebPage
     *
     * @param string $title
     */
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl("/css/style.css");
    }

    /**
     * Produit la page web complète avec la structure HTML conforme à la maquette de l'application
     *
     * @return string
     */
    public function toHTML(): string
    {
        $title = $this->getTitle();
        $head = $this->getHead();
        $body = $this->getBody();

        return <<<HTML
            <!doctype html>
            <html lang="fr">
                <head>
                    $head
                    <title>$title</title>
                    <meta charset="utf-8" />
                    <meta http-equiv="x-ua-compatible" content="ie=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />
                    <link rel="stylesheet" href="/css/style.css" />
                </head>
                <body>
                    $body
                </body>
            </html>
        HTML;
    }
}
