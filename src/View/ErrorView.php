<?php

namespace App\View;

use App\Core\BaseView;


class ErrorView extends BaseView
{
    public function __construct(private string $errorMsg)
    {
    }

    protected function content(): void
    {
        ?>
        <div class="error-message">
            <h1>Oops something went wrong</h1>
            <p><?= htmlspecialchars($this->errorMsg) ?></p>
        </div>
        <?php
    }
}
