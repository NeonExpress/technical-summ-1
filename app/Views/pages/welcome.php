<?= $this->include('pages/header') ?>

<h1>Welcome</h1>

<p>Today's date: <strong><?= esc($today) ?></strong></p>

<h2>Tasks for Today</h2>

<?php if (empty($tasks)): ?>
    <div class="empty">
        No tasks scheduled for today.
    </div>
<?php else: ?>

    <?php foreach ($tasks as $task): ?>
        <div class="card">
            <h3><?= esc($task['title']) ?></h3>

            <p>
                Status:
                <span class="<?= esc($task['status']) ?>">
                    <?= esc(ucfirst($task['status'])) ?>
                </span>
            </p>

            <p>Date: <?= esc($task['task_date']) ?></p>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

<?= $this->include('pages/footer') ?>