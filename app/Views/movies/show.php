<?php require APPROOT . '/app/Views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/movies" class="btn" style="margin-bottom: 1rem;">Powrót</a>

<div class="card">
    <h1><?php echo $data['movie']->title; ?> (<?php echo $data['movie']->release_year; ?>)</h1>
    <p><strong>Kategorie:</strong> <?php echo $data['movie']->categories; ?></p>
    <p><strong>Opis:</strong> <?php echo $data['movie']->description; ?></p>
    
    <h3>Gdzie obejrzeć:</h3>
    <ul>
        <?php foreach($data['movie']->streamings as $s): ?>
            <li>
                <a href="<?php echo $s->url; ?>" target="_blank" style="color: var(--primary);">
                    <?php echo $s->name; ?>
                </a> 
                <?php echo $s->seasons ? '(Sezony: ' . $s->seasons . ')' : ''; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="card">
    <h3>Dodaj ocenę</h3>
    <?php if(isset($_GET['success'])): ?>
        <p style="color: #4caf50;">Dziękujemy! Twoja ocena została przesłana do moderacji.</p>
    <?php endif; ?>
    <form action="<?php echo URLROOT; ?>/movies/rate" method="POST">
        <input type="hidden" name="movie_id" value="<?php echo $data['movie']->id; ?>">
        <div style="margin-bottom: 1rem;">
            <label>Ocena (1-10)</label>
            <input type="number" name="rating" min="1" max="10" required>
        </div>
        <div style="margin-bottom: 1rem;">
            <label>Komentarz</label>
            <textarea name="comment" rows="4"></textarea>
        </div>
        <button type="submit" class="btn">Wyślij</button>
    </form>
</div>

<div class="card">
    <h3>Oceny użytkowników</h3>
    <?php if(empty($data['ratings'])): ?>
        <p>Brak zatwierdzonych ocen dla tego filmu.</p>
    <?php else: ?>
        <?php foreach($data['ratings'] as $rating): ?>
            <div style="border-bottom: 1px solid #444; padding: 1rem 0;">
                <strong>Ocena: <?php echo $rating->rating; ?>/10</strong>
                <p><?php echo $rating->comment; ?></p>
                <small style="color: #888;"><?php echo $rating->created_at; ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require APPROOT . '/app/Views/inc/footer.php'; ?>
