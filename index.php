<?php

$apiKey = "";
$query=isset($_GET['q']) ? $_GET['q']:'all';
$url="https://gnews.io/api/v4/search?q=".urlencode($query)."&lang=en&token=".$apiKey;
$response=file_get_contents($url);
$data=json_decode($response,true);
$articles=$data['articles']??[];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Aggregator</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="main-container">
        <h1 class="heading">Live -News-Agg</h1>
        <form method="get">
            <input type="text" name="q"  placeholder="search the topic(e.g.,bitcoin,sports)" value="<?=htmlspecialchars($query)?>">
        </form>
        <?php if(!empty($articles)):?>
                <?php foreach($articles as $article):?>
                        <div class="card">
                        <?php if(!empty($article['image'])):?>
                                <img src="<?= $article['image'] ?>" alt="news image">
                        <?php endif;?>
                        <div class="card-body">
                            <h2 class="card-title"><?=$article['title']?></h2>
                            <p class="card-text"><?=$article['description']?></p>
                            <a href="<?=$article['url']?>">Read More</a>
                    
                        </div>  
                     </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p class="no-articles">No articles found or API error.</p>
    <?php endif; ?>
    </div>
</body>
</html>
