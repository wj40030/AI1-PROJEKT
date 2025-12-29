<?php require APPROOT . '/app/Views/inc/header.php'; ?>

<h1>Wyszukiwarka filmów i seriali</h1>

<form action="<?php echo URLROOT . '/movies'; ?>" method="GET" class="filters">
    <div>
        <label>Tytuł</label>
        <input type="text" name="title" value="<?php echo $data['filters']['title']; ?>" placeholder="Szukaj...">
    </div>
    <div>
        <label>Kategoria</label>
        <select name="category">
            <option value="">Wszystkie</option>
            <?php foreach($data['categories'] as $category): ?>
                <option value="<?php echo $category->id; ?>" <?php echo $data['filters']['category'] == $category->id ? 'selected' : ''; ?>>
                    <?php echo $category->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Streaming</label>
        <select name="streaming">
            <option value="">Wszystkie</option>
            <?php foreach($data['streamings'] as $streaming): ?>
                <option value="<?php echo $streaming->id; ?>" <?php echo $data['filters']['streaming'] == $streaming->id ? 'selected' : ''; ?>>
                    <?php echo $streaming->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="display: flex; align-items: flex-end;">
        <button type="submit" class="btn" style="width: 100%;">Filtruj</button>
    </div>
</form>

<div class="grid">
    <?php foreach($data['movies'] as $movie): ?>
        <div class="card">
            <h3><?php echo $movie->title; ?> (<?php echo $movie->release_year; ?>)</h3>
            <p><strong>Typ:</strong> <?php echo $movie->is_series ? 'Serial' : 'Film'; ?></p>
            <p><strong>Kategorie:</strong> <?php echo $movie->categories; ?></p>
            <p><strong>Dostępne na:</strong> <?php echo $movie->streamings; ?></p>
            <a href="<?php echo URLROOT . '/movies/show/' . $movie->id; ?>" class="btn">Szczegóły</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require APPROOT . '/app/Views/inc/footer.php'; ?>
