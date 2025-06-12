<?php

namespace App\View;

use App\Core\BaseView;

class AddView extends BaseView {
    private ?string $error;

    public function __construct(?string $error = null) {
        $this->error = $error;
    }

    protected function content(): void {
        ?>
        <h1>Create a New Post</h1>

        <?php if ($this->error): ?>
            <p class="error-message"><?= htmlspecialchars($this->error) ?></p>
<?php endif; ?>

<form class="form-post" method="post" enctype="multipart/form-data">
    <label>Title:<br><input type="text" name="title" required></label><br>
    <label>Content:<br><textarea name="content" required></textarea></label><br>
    <label>Picture:<br><input type="file" name="picture"></label><br>
    <label>Category ID (temporaire):<br><input type="number" name="category"></label><br>
    <button type="submit">Add Post</button>
</form>
        <?php
    }
}
