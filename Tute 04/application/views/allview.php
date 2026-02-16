<h2>All Movies</h2>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 20px;
        color: #333;
    }

    h2 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
    }

    .movie-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .movie-card {
        background-color: #fff;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        min-width: 200px;
        text-align: center;
    }

    .movie-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .movie-title {
        font-weight: bold;
        color: #2980b9;
        margin-bottom: 5px;
    }

    .movie-year {
        color: #555;
    }

    .back-button {
        display: inline-block;
        margin: 30px auto 0 auto; /* center horizontally */
        padding: 10px 20px;
        text-decoration: none;
        color: #fff;
        background-color: #2980b9;
        border-radius: 5px;
        transition: background-color 0.2s;
    }

    .back-button:hover {
        background-color: #1f5d8f;
    }

    .back-container {
        text-align: center; /* center the button */
    }
</style>

<div class="movie-list">
<?php foreach($movies as $movie): ?>
    <div class="movie-card">
        <div class="movie-title"><?php echo $movie->title; ?></div>
        <div class="movie-year">(<?php echo $movie->release_year; ?>)</div>
    </div>
<?php endforeach; ?>
</div>

<div class="back-container">
    <a class="back-button" href="<?php echo site_url('Movies'); ?>">Back</a>
</div>
