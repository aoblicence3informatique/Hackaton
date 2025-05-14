<h2>Signalements</h2>
<?php if (isset($reports) && is_array($reports) && count($reports) > 0): ?>
    <?php foreach ($reports as $report): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <strong><?php echo htmlspecialchars($report['category']); ?></strong><br>
            <?php if (!empty($report['photo'])): ?>
                <img src="<?php echo htmlspecialchars($report['photo']); ?>" width="200"><br>
            <?php endif; ?>
            <?php echo nl2br(htmlspecialchars($report['description'])); ?><br>
            GPS: <?php echo htmlspecialchars($report['latitude']) . ', ' . htmlspecialchars($report['longitude']); ?><br>
            <form action="index.php?action=vote" method="POST">
                <input type="hidden" name="report_id" value="<?php echo htmlspecialchars($report['id']); ?>">
                <button type="submit">👍 Voter</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun signalement disponible pour le moment.</p>
<?php endif; ?>
