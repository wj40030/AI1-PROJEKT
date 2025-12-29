<?php require APPROOT . '/app/Views/inc/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Panel Administratora</h1>
    <a href="<?php echo URLROOT; ?>/admin/logout" class="btn" style="background: #555;">Wyloguj</a>
</div>

<div class="grid">
    <!-- Zarządzanie Filmami -->
    <div class="card" style="grid-column: span 2;">
        <h2>Dodaj nowy film/serial</h2>
        <form action="<?php echo URLROOT; ?>/admin/add_movie" method="POST">
            <input type="text" name="title" placeholder="Tytuł" required>
            <textarea name="description" placeholder="Opis" required></textarea>
            <input type="number" name="release_year" placeholder="Rok produkcji" required>
            <label style="display: block; margin-bottom: 1rem;">
                <input type="checkbox" name="is_series" style="width: auto;"> Czy to serial?
            </label>
            <button type="submit" class="btn">Dodaj</button>
        </form>
    </div>

    <!-- Moderacja ocen -->
    <div class="card" style="grid-column: span 2;">
        <h2>Oceny do moderacji</h2>
        <?php if(empty($data['unapproved_ratings'])): ?>
            <p>Brak nowych ocen do moderacji.</p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 1px solid #555;">
                        <th>Film</th>
                        <th>Ocena</th>
                        <th>Komentarz</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['unapproved_ratings'] as $rating): ?>
                        <tr style="border-bottom: 1px solid #444;">
                            <td><?php echo $rating->movie_title; ?></td>
                            <td><?php echo $rating->rating; ?>/10</td>
                            <td><?php echo $rating->comment; ?></td>
                            <td>
                                <a href="<?php echo URLROOT . '/admin/approve_rating/' . $rating->id; ?>" style="color: #4caf50;">Zatwierdź</a> |
                                <a href="<?php echo URLROOT . '/admin/delete_rating/' . $rating->id; ?>" style="color: #e50914;">Usuń</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Lista filmów -->
    <div class="card" style="grid-column: span 2;">
        <h2>Zarządzaj filmami</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 1px solid #555;">
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Rok</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['movies'] as $movie): ?>
                    <tr style="border-bottom: 1px solid #444;">
                        <td><?php echo $movie->id; ?></td>
                        <td><?php echo $movie->title; ?></td>
                        <td><?php echo $movie->release_year; ?></td>
                        <td>
                            <a href="<?php echo URLROOT . '/admin/delete_movie/' . $movie->id; ?>" style="color: #e50914;" onclick="return confirm('Na pewno usunąć?')">Usuń</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/app/Views/inc/footer.php'; ?>
