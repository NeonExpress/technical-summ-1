<?= $this->include('pages/header') ?>

<h1>Profile</h1>

<?php if ($user): ?>

    <div class="card">
        <h2><?= esc($user['full_name']) ?></h2>

        <p>
            <strong>Username:</strong>
            <?= esc($user['username']) ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= esc($user['email']) ?>
        </p>

        <p>
            <strong>Account Created:</strong>
            <?= esc($user['created_at']) ?>
        </p>
    </div>

<?php else: ?>

    <div class="empty">
        No user profile found.
    </div>

<?php endif; ?>

<?= $this->include('pages/footer') ?>