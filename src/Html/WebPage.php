<?php

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title;
    private string $body = "";

    /**
     * Constructeur de la classe WebPage
     *
     * @param string $title
     */
    public function __construct(string $title ="")
    {
        $this->title=$title;
    }

    /**
     * getter de la head de la WebPage
     *
     * @return string head
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * getter du title de la WebPage
     *
     * @return string title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * accesseur du title de la WebPage
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $t = "title";
        if ($title == '') {
            $t = "title";
        } else {
            $t = $title;
        }
        $this->title="$t";
    }

    /**
     * getter du body de la WebPage
     *
     * @return string body
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * fonction qui ajoute $content dans $this->>head
     *
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $a = $content;
        $this->head .= $a;
    }

    /**
     * fonction qui ajoute du Css à un $this->head
     *
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $c = $css;
        $this->head .= "<style>$c</style>";
    }

    /**
     * fonction qui ajoute le lien vers le fichier css au $this->head
     *
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $u = $url;
        $this->head .= "<link rel=\"stylesheet\" href=\"$u\">";
    }

    /**
     * fonction qui ajoute un contenu JavaScript dans $this->head
     *
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $j = $js;
        $this->head .= "<script>$j</script>";
    }

    /**
     * fonction qui ajoute le lien vers le fichier Js au $this->head
     *
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $u = $url;
        $this->head .= "<script src=\"$u\"></script>";
    }

    /**
     * fonction qui ajoute $content à $this->body
     *
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $c = $content;
        $this->body .= $c;
    }

    /**
     * Produit la page web
     *
     * @return void
     */
    public function toHTML(): string
    {
        // return "<html lang=\"fr\"><head>$this->head<title>$this->title</title></head><body>$this->body</body></html>";
        return <<<HTML
            <!doctype html>
            <html lang="fr">
                <head>{$this->head}
                <title>{$this->title}</title>
                <meta charset="utf-8" />
                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                </head>
                <body>{$this->body}</body>
            </html>
        HTML;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return str_replace("&#039", '&apos', htmlspecialchars($string));
    }

    /**
     * Donne la date et l'heure de la dernière modification du script principal.
     *
     * @return string la date et l'heure de la dernière modification du script principal.
     */
    public function getLastModification(): string
    {
        return date("F d Y H:i:s.", getlastmod());
    }
}
