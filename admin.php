<?php
    include "db.php";
    include "partials/navigation.php";
    include_once "functions.php";

    if(!isset($_SESSION['logged_in'])) {
        redirect("login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['edit_user'])) {
            update_user($_POST['user_id'], $_POST['email']);
        }

        if(isset($_POST['delete_user'])) {
            delete_user($_POST['user_id']);
        }
    }

    $sql = "SELECT * FROM users";
    $users = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

    if(!$sql) {
        echo "Something went wrong! " . mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/admin.css">

</head>
<body class="admin">

<h1>Manage Users</h1>

<div class="container">
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td> <?php echo $user['id']; ?> </td>
                    <td> <?php echo $user['username']; ?> </td>
                    <td> <?php echo $user['email']; ?> </td>
                    <td> <?php transform_date($user['reg_date']); ?> </td>
                    <td>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="user_id" value=<?php echo $user['id'] ?>>
                            <input type="email" name="email" value="<?php echo $user['email'] ?>" required>
                            <button class="edit" type="submit" name="edit_user">Edit</button>
                        </form>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value=<?php echo $user['id'] ?>>
                            <button class="delete" type="submit" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Include Footer -->
</body>
</html>
