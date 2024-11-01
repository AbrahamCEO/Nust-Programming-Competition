<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    exit;
}

include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $competition_id = $_POST['competition_id'];

    // Handle file upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $logo = $_FILES['logo'];
        $logo_path = 'uploads/' . basename($logo['name']); // Set the upload directory

        // Move the uploaded file to the designated folder
        if (move_uploaded_file($logo['tmp_name'], $logo_path)) {
            $query = "UPDATE competitions SET title='$title', description='$description', start_date='$start_date', end_date='$end_date', logo_path='$logo_path' WHERE id='$competition_id'";
        } else {
            echo "Failed to upload logo.";
            exit;
        }
    } else {
        $query = "UPDATE competitions SET title='$title', description='$description', start_date='$start_date', end_date='$end_date' WHERE id='$competition_id'";
    }

    if (mysqli_query($conn, $query)) {
        header("location:adminhome.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM competitions WHERE id='" . $_GET['competition_id'] . "'";
$result = mysqli_query($conn, $query);
$competition = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Competition</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">

<div style="width: 100%; max-width: 800px; margin: 0 auto; padding: 20px;">
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 24px;">Edit Competition</h1>
        <a href="adminhome.php" style="text-decoration: none; color: #007bff; font-weight: bold;">Back to Dashboard</a>
    </header>

    <form action="edit_competition.php?competition_id=<?php echo htmlspecialchars($_GET['competition_id']); ?>" method="POST" enctype="multipart/form-data" style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <input type="hidden" name="competition_id" value="<?php echo htmlspecialchars($competition['id']); ?>">
        
        <label style="display: block; margin-bottom: 10px;">
            Competition Name:
            <input type="text" name="title" value="<?php echo htmlspecialchars($competition['title']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
        </label>

        <label style="display: block; margin-bottom: 10px;">
            Description:
            <textarea name="description" rows="4" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;"><?php echo htmlspecialchars($competition['description']); ?></textarea>
        </label>

        <label style="display: block; margin-bottom: 10px;">
            Start Date:
            <input type="date" name="start_date" value="<?php echo htmlspecialchars($competition['start_date']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
        </label>

        <label style="display: block; margin-bottom: 10px;">
            End Date:
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($competition['end_date']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
        </label>

        <label style="display: block; margin-bottom: 10px;">
            Logo:
            <input type="file" name="logo" accept="image/*" style="margin-top: 5px;">
            <?php if (!empty($competition['logo_path'])): ?>
                <img src="<?php echo htmlspecialchars($competition['logo_path']); ?>" alt="Current Logo" style="display: block; max-width: 100px; margin-top: 10px;">
            <?php endif; ?>
        </label>

        <button type="submit" style="display: inline-block; width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Save Changes</button>
    </form>
</div>

</body>
</html>
