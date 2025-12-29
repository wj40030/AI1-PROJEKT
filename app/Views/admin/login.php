<?php require APPROOT . '/app/Views/inc/header.php'; ?>

<div style="max-width: 400px; margin: 5rem auto;">
    <div class="card">
        <h2>Logowanie Administratora</h2>
        <?php if(isset($data['error'])): ?>
            <p style="color: #e50914;"><?php echo $data['error']; ?></p>
        <?php endif; ?>
        <form action="<?php echo URLROOT; ?>/admin/login" method="POST">
            <div>
                <label>Użytkownik</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label>Hasło</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Zaloguj</button>
        </form>
        <p style="font-size: 0.8rem; color: #888; margin-top: 1rem;">Domyślne: admin / admin123</p>
    </div>
</div>

<?php require APPROOT . '/app/Views/inc/footer.php'; ?>
