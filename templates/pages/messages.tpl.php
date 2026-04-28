<h2>Received Messages</h2>

<?php if (isset($error_msg)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red;">
        <?= htmlspecialchars($error_msg) ?>
    </div>
<?php elseif (empty($messages)): ?>
    <p>No messages found in the database.</p>
<?php else: ?>
    <table class="table table-striped table-bordered mt-4" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #333; color: white;">
            <tr>
                <th style="padding: 10px;">Date</th>
                <th style="padding: 10px;">Sender</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td style="padding: 10px; white-space: nowrap;"><?= htmlspecialchars($msg['sent_at']) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($msg['sender_name']) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($msg['sender_email']) ?></td>
                    <td style="padding: 10px;"><?= nl2br(htmlspecialchars($msg['message_text'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>