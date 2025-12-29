<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['title']; ?></title>
</head>
<body>
    <h1><?php echo $data['title']; ?></h1>
    <p><?php echo $data['description']; ?></p>
    
    <h2>Wpisy z bazy danych (Tabela 'posts'):</h2>
    <ul>
        <?php foreach($data['db_test'] as $post) : ?>
            <li>
                <strong><?php echo $post->title; ?></strong><br>
                <?php echo $post->body; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
