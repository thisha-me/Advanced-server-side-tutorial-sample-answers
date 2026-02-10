<!DOCTYPE html>
<html>
<head>
    <title>Geological Periods</title>
</head>
<body>

<h2>Geological Periods</h2>

<ul>
    <?php foreach ($periods as $period): ?>
        <li>
            <a href="<?php echo site_url('dinosaurs/getinfo/' . $period); ?>">
                <?php echo $period; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
