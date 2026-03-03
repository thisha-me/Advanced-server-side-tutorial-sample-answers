<!DOCTYPE html>
<html>

<head>
  <title>To-Do App</title>
</head>

<body class="container mt-5">

  <h2>My To-Do List</h2>

  <form method="post" action="">
    <div>
      <input type="text" name="action_title"
        class="form-control" placeholder="Enter new task">
    </div>
    <button type="submit">Add Task</button>
  </form>

  <hr>

  <ul>
    <?php if (!empty($actions)) : ?>
      <?php foreach ($actions as $action) : ?>
        <li>
          <?php echo $action->action_title; ?>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>No tasks yet</li>
    <?php endif; ?>
  </ul>

</body>

</html>