<?php
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['biodata_form'])) {
    exit("Invalid access.");
}

$valid_universities = ['UPM', 'UKM', 'UM', 'USM', 'UTM'];

$data = [
    "name" => trim($_POST['name'] ?? ''),
    "age" => trim($_POST['age'] ?? ''),
    "gender" => trim($_POST['gender'] ?? ''),
    "address" => trim($_POST['address'] ?? ''),
    "email" => trim($_POST['email'] ?? ''),
    "dob" => trim($_POST['dob'] ?? ''),
    "height" => trim($_POST['height'] ?? ''),
    "phone" => trim($_POST['phone'] ?? ''),
    "color" => trim($_POST['color'] ?? ''),
    "fbtwig" => trim($_POST['fbtwig'] ?? ''),
    "photo" => $_FILES['photo']['name'] ?? null,
    "university" => $_POST['university'] ?? '',
    "matricnum" => trim($_POST['matricnum'] ?? '')
];

$errors = [];

if ($data['name'] == '') {
    $errors[] = "Please insert your name.";
}

if ($data['age'] == '' || !filter_var($data['age'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 100]])) {
    $errors[] = "Age must be an integer between 0 and 100.";
}

if (!in_array($data['gender'], ['male', 'female'], true)) {
    $errors[] = "Please select a valid sex.";
}

if ($data['address'] == '') {
    $errors[] = "Please insert your address.";
} elseif (strlen($data['address']) > 255) {
    $errors[] = "Address cannot exceed 255 characters.";
}

if (!preg_match('/.+@.*[Uu][Kk][Mm].*/', $data['email'])) {
    $errors[] = "Please enter a valid email address.";
}

$date = strtotime($data['dob']);
if (!$date) {
    $errors[] = "Please enter a valid date of birth.";
}

if ($data['height'] == '' || !filter_var($data['height'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 100, "max_range" => 200]])) {
    $errors[] = "Height must be between 100 and 200 cm.";
}

if (!preg_match('/^\+60\d{2}-\d{7}$/', $data['phone'])) {
    $errors[] = "Phone number must follow +60##-####### format.";
}

if (!preg_match('/^#[a-fA-F0-9]{6}$/', $data['color'])) {
    $errors[] = "Please select a valid colour.";
}

if ($data['fbtwig'] == '' || !filter_var($data['fbtwig'], FILTER_VALIDATE_URL)) {
    $errors[] = "Please enter a valid URL.";
}

if (empty($data['photo'])) {
    $errors[] = "Select a valid photo.";
}

if (!in_array($data['university'], $valid_universities, true)) {
    $errors[] = "Please select a valid university.";
}

if ($data['matricnum'] == '') {
    $errors[] = "Please insert your matric number.";
}

if (!empty($errors)) {
    echo "<h2>Validation Errors</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo count($errors) . " error(s) detected.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Validate Biodata</title>
</head>
<body>
    <h1>Validate Biodata</h1>
    <p>Please review your information before saving.</p>
    <form action="save_biodata.php" method="post">
        <table border="1" cellpadding="10">
            <tr><td>Name:</td><td><?= htmlspecialchars($data['name']); ?></td></tr>
            <tr><td>Age:</td><td><?= htmlspecialchars($data['age']); ?></td></tr>
            <tr><td>Gender:</td><td><?= htmlspecialchars($data['gender']); ?></td></tr>
            <tr><td>Address:</td><td><?= htmlspecialchars($data['address']); ?></td></tr>
            <tr><td>Email:</td><td><?= htmlspecialchars($data['email']); ?></td></tr>
            <tr><td>Date of Birth:</td><td><?= date("d-m-Y", strtotime($data['dob'])); ?></td></tr>
            <tr><td>Height:</td><td><?= htmlspecialchars($data['height']); ?></td></tr>
            <tr><td>Tel:</td><td><?= htmlspecialchars($data['phone']); ?></td></tr>
            <tr><td>My Favorite Color:</td><td><?= htmlspecialchars($data['color']); ?></td></tr>
            <tr><td>Fb/TW/IG:</td><td><?= htmlspecialchars($data['fbtwig']); ?></td></tr>
            <tr><td>Photo:</td><td><?= htmlspecialchars($data['photo']); ?></td></tr>
            <tr><td>My University:</td><td><?= htmlspecialchars($data['university']); ?></td></tr>
            <tr><td>My Matric Number:</td><td><?= htmlspecialchars($data['matricnum']); ?></td></tr>
        </table>
        <hr>
        <?php foreach ($data as $key => $value): ?>
            <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
        <?php endforeach; ?>
        <input type="button" value="Back" onclick="history.back()">
        <input type="submit" name="biodata_validate" value="Save My Biodata">
    </form>
</body>
</html>