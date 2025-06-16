<?php
namespace Sekolintsika\Mail;

use Symfony\Component\Mime\Email;
use Twig\Environment;

class ConstructeurEmail
{
    private Email $email;
    private Environment $twig;

    // Valeurs à injecter dans le template
    private string $expediteur = '';
    private string $destinataire = '';
    private string $sujet = '';
    private string $contenu = '';

    private string $template = 'common'.DIRECTORY_SEPARATOR . 'email_template.html.twig';

    public function __construct()
    {
        $this->email = new Email();
        $rootPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'templates';
        $this->twig = new Environment(
            new \Twig\Loader\FilesystemLoader($rootPath)
        );
    }

    public function setExpediteur(string $adresse, ?string $nom = null): self
    {
        $exp = $nom ? "$nom <$adresse>" : $adresse;
        $this->email->from($exp);
        $this->expediteur = $exp;
        return $this;
    }

    public function setDestinataire(string $adresse, ?string $nom = null): self
    {
        $dest = $nom ? "$nom <$adresse>" : $adresse;
        $this->email->to($dest);
        $this->destinataire = $dest;
        return $this;
    }

    public function setSujet(string $sujet): self
    {
        $this->email->subject($sujet);
        $this->sujet = $sujet;
        return $this;
    }

    public function setContenu(string $texte): self
    {
        $this->contenu = $texte;
        return $this;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;
        return $this;
    }

    public function getEmail(): Email
    {
        $html = $this->twig->render($this->template, [
            'expediteur' => $this->expediteur,
            'destinataire' => $this->destinataire,
            'sujet' => $this->sujet,
            'contenu' => $this->contenu,
        ]);

        $this->email->html($html);
        $this->email->text(strip_tags($this->contenu));

        return $this->email;
    }
}
