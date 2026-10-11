<?= $this->include('pages/header') ?>

<h1>Complete Task List</h1>

<?php if (empty($tasks)): ?>
    <div class="empty">
        No tasks found.
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Status</th>
                <th>Date</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['id']) ?></td>
                    <td><?= esc($task['title']) ?></td>
                    <td class="<?= esc($task['status']) ?>">
                        <?= esc(ucfirst($task['status'])) ?>
                    </td>
                    <td><?= esc($task['task_date']) ?></td>
                    <td><?= esc($task['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= $this->include('pages/footer') ?>
