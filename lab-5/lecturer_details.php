<?php
$lecturers = array(
    array('id' => "K004901", 'name' => "Prof. Dr. Abdullah Mohd Zin", 'room' => "Bilik 1 (Level 1)", 'email' => "abdullah@ukm.edu.my", 'tel' => "+603-89211111"),
    array('id' => "K012964", 'name' => "Prof. Dr. Azuraliza Abu Bakar", 'room' => "BTDR, Blok G (Level 1)", 'email' => "azuraliza@ukm.edu.my", 'tel' => "+603-89216177"),
    array('id' => "K009683", 'name' => "Assoc. Prof. Dr. Haslina Arshad", 'room' => "Bilik 2 (Level 2)", 'email' => "haslina@ukm.edu.my", 'tel' => "+603-89212222"),
    array('id' => "K007915", 'name' => "Assoc. Prof. Dr. Mohd Juzaiddin Ab Aziz", 'room' => "BTDP, Blok A (Level 1)", 'email' => "juzaiddin@ukm.edu.my", 'tel' => "+603-89216183")
);

if (empty($_GET['id'])):
    exit("Error: Lecturer ID is missing.");
endif;

$id = $_GET['id'];
$lecturer = null;

foreach ($lecturers as $item):
    if ($item['id'] == $id):
        $lecturer = $item;
        break;
    endif;
endforeach;

if ($lecturer === null):
    exit("Error: Lecturer not found.");
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lecturer Details</title>
</head>
<body>
    <h1><?= htmlspecialchars($lecturer['name']); ?></h1>
    <hr>
    <table border="1" cellpadding="10">
        <tr>
            <td colspan="2">
                <img src="<?= urlencode($lecturer['id']); ?>.jpg" width="300" alt="Lecturer photo">
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= htmlspecialchars($lecturer['email']); ?></td>
        </tr>
        <tr>
            <td>Room</td>
            <td><?= htmlspecialchars($lecturer['room']); ?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><?= htmlspecialchars($lecturer['tel']); ?></td>
        </tr>
    </table>
</body>
</html>