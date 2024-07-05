<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員列表</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="text-center mt-5">會員列表</h2>
        <table class="table table-striped table-bordered mt-4 text-center">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                  <?php if ($user['id'] == $_SESSION['user_id']) : ?>
                    <form method="POST" action="/delete_user" style="display:inline;">
                      <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                      <button type="submit" class="btn btn-danger">刪除</button>
                      <a href="members" class="btn btn-primary">修改會員資料</a>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="text-center">
          <a href="/home" class="btn btn-primary mt-3">回首頁</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>