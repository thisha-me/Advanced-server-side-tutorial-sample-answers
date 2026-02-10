<!DOCTYPE html>
<html>

<head>
  <title><?php echo $period; ?> Period</title>
</head>

<body>

  <h2><?php echo $period; ?> Period</h2>

  <p><strong>Time:</strong> <?php echo $info['time']; ?></p>

  <h3>Dinosaurs</h3>
  <ul>
    <?php foreach ($info['dinosaurs'] as $dino): ?>
      <li><?php echo $dino; ?></li>
    <?php endforeach; ?>
  </ul>

  <a href="<?php echo site_url('dinosaurs/periods'); ?>">
    ← Back to periods
  </a>

</body>

</html>