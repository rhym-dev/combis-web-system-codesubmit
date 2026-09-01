<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Resume Generator</title>
    <link rel="stylesheet" href="COMBIS_Assignment1_DRG.css">
    <style>
        h3 {
            margin: 10px;
            padding: 0;

            font-weight: normal;
        }
    </style>
</head>

<body>

    <?php
    $fullName = "Edrian Rhymes D. Combis";
    $email = "edriancombis@gmail.com";
    $address = "Alcala, Pangasinan";
    $phoneNumber = "09235543423";
    $fatherName = "Eduardo Z. Combis";
    $motherName = "Ruby D. Combis";
    $program = "BS Information Technology";
    $careerTrack = "";
    $techSkills = "";

    if ($program == "BS Information Technology") {
        $careerTrack = "Systems Administrator";
    } elseif ($program == "BS Computer Science") {
        $careerTrack = "Software Developer";
    } else {
        $careerTrack = "Error";
    }

    if ($careerTrack == "Systems Administrator") {
        $techSkills =
            "
            <ol>
                <li>Linux OS</li>
                <li>Apache Server Configuration</li>
                <li>Hardware Troubleshooting</li>
            </ol>
            ";
    } elseif ($careerTrack == "Software Developer")
        $techSkills =
            "
            <ol>
                <li>PHP</li>
                <li>MySQL</li>
                <li>Conditional Logic</li>
                <li>Object-Oriented Programming</li>
            </ol>
            ";

    echo "<h1>$fullName</h1>";
    echo "<h3>Address: $address</h3>";
    echo "<h3>Email: $email</h3>";
    echo "<h3>Father's Name: $fatherName</h3>";
    echo "<h3>Mother's Name: $motherName</h3>";
    echo "<h3>Phone Number: $phoneNumber</h3>";
    echo "<hr>";

    echo "<h2>Career Objective</h2>";
    echo "<h3>Program: $program</h3>";
    echo "<h3>Career Track: $careerTrack</h3>";
    echo "<h3>Technical Skills: $techSkills</h3>";
    ?>

</body>


</html>