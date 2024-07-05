<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>首頁</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mt-5">歡迎, <?php echo $userName; ?></h2>
        <div class="card mt-4">
          <div class="card-body text-center">
            <h5 class="card-title">會員資料</h5>
            <p class="card-text">Email: <?php echo $userEmail; ?></p>
            <a href="members" class="btn btn-primary">修改會員資料</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>