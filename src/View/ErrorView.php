<?php

namespace App\View;

use App\Core\BaseView;

// Vue utilisée pour afficher une erreur à l'utilisateur
class ErrorView extends BaseView {
    
    // Le message d'erreur est injecté au moment de l'appel de la vue
    public function __construct(private string $errorMsg) {}

    // Affiche un message d'erreur mis en forme
    protected function content(): void {
        echo "<h1>Oops something went wrong</h1>
        <p>$this->errorMsg</p>"; // Affiche dynamiquement le message d'erreur reçu
    }
}
