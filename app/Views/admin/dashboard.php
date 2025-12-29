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

            <div style="display: flex; gap: 2rem; margin-bottom: 1rem;">
                <div style="flex: 1;">
                    <label>Kategorie:</label>
                    <div style="max-height: 150px; overflow-y: auto; background: #222; padding: 0.5rem; border-radius: 4px;">
                        <?php foreach($data['categories'] as $category): ?>
                            <label style="display: block; margin-bottom: 0.3rem;">
                                <input type="checkbox" name="categories[]" value="<?php echo $category->id; ?>" style="width: auto;"> <?php echo $category->name; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div style="flex: 1;">
                    <label>Streamingi:</label>
                    <div style="max-height: 150px; overflow-y: auto; background: #222; padding: 0.5rem; border-radius: 4px;">
                        <?php foreach($data['streamings'] as $streaming): ?>
                            <label style="display: block; margin-bottom: 0.3rem;">
                                <input type="checkbox" name="streamings[]" value="<?php echo $streaming->id; ?>" style="width: auto;"> <?php echo $streaming->name; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

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

    <!-- Zarządzanie Kategoriami -->
    <div class="card">
        <h2>Kategorie</h2>
        <form action="<?php echo URLROOT; ?>/admin/add_category" method="POST" style="margin-bottom: 1rem;">
            <input type="text" name="name" placeholder="Nowa kategoria" required>
            <button type="submit" class="btn">Dodaj</button>
        </form>
        <table style="width: 100%; border-collapse: collapse;">
            <?php foreach($data['categories'] as $category): ?>
                <tr style="border-bottom: 1px solid #444;">
                    <td><?php echo $category->name; ?></td>
                    <td style="text-align: right;">
                        <a href="<?php echo URLROOT . '/admin/delete_category/' . $category->id; ?>" style="color: #e50914;" onclick="return confirm('Usunąć kategorię?')">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Zarządzanie Streamingami -->
    <div class="card">
        <h2>Streamingi</h2>
        <form action="<?php echo URLROOT; ?>/admin/add_streaming" method="POST" style="margin-bottom: 1rem;">
            <input type="text" name="name" placeholder="Nazwa platformy" required>
            <input type="url" name="url" placeholder="URL (https://...)" required>
            <button type="submit" class="btn">Dodaj</button>
        </form>
        <table style="width: 100%; border-collapse: collapse;">
            <?php foreach($data['streamings'] as $streaming): ?>
                <tr style="border-bottom: 1px solid #444;">
                    <td><?php echo $streaming->name; ?></td>
                    <td style="text-align: right;">
                        <a href="<?php echo URLROOT . '/admin/delete_streaming/' . $streaming->id; ?>" style="color: #e50914;" onclick="return confirm('Usunąć streaming?')">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require APPROOT . '/app/Views/inc/footer.php'; ?>
