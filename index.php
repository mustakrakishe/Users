<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container px-0 py-4">

        <a href="/" class="text-dark text-decoration-none">
            <h1 class="text-center mb-3">Users</h1>
        </a>

        <div class="d-flex justify-content-center">
            <form id="seedUsers" action="http/seed.php" method="post">
                <label for="amount" class="form-label">Добавить записи</label>
                <div class="input-group" style="width: 250px">
                    <input type="number" name="amount" class="form-control" placeholder="Количество">
                    <button type="tubmit" class="btn btn-outline-secondary">Добавить</button>
                </div>
            </form>
        </div>

        <table id="users-table" class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Age</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
</body>

</html>