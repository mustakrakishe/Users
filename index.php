<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/jquery-3.6.0.min.js"></script>
    <script defer src="js/script.js"></script>
</head>

<body>
    <div class="container px-0 py-4">

        <a href="/" class="text-dark text-decoration-none">
            <h1 class="text-center mb-3">Users</h1>
        </a>

        <div id="status" class="text-primary text-center"></div>

        <div class="d-flex justify-content-center">
            <form id="seed" action="http/seed.php" method="post">
                <label for="amount" class="form-label">Добавить записи</label>
                <div class="input-group" style="width: 250px">
                    <input type="number" name="amount" class="form-control" placeholder="Количество">
                    <button type="tubmit" class="btn btn-outline-secondary">Добавить</button>
                </div>
            </form>
        </div>

        <form id="search" action="http/index.php" method="get"></form>

        <table id="users" class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Age</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>

            <tbody>
                <tr name="filters" class="align-middle">
                    <td width="20%">
                        <input type="range" name="age-min" form="search" id="age-min" min="18" max="40" value="18" class="form-range">
                        <input type="range" name="age-max" form="search" id="age-max" min="18" max="40" value="40" class="form-range">

                        <output id="age-min-output"></output> - <output id="age-max-output"></output>
                    </td>
                    <td width="20%">
                        <input type="search" name="name" form="search" class="form-control" placeholder="Первые буквы (Андр, Ол...)">
                    </td>
                    <td width="30%">
                        <input type="search" name="email" form="search" class="form-control" placeholder="Полный адрес (example@example.com...)">
                    </td>
                    <td>
                        <input type="search" name="phone" form="search" class="form-control" placeholder="Код оператора (098, 050, 067...)">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>