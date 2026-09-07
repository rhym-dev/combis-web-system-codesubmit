<?php

$name = "";
$email = "";
$address = "";
$program = "";
$birthday = "";
$phoneNumber = "";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $program = trim($_POST["program"] ?? "");
    $birthday = trim($_POST["birthday"] ?? "");
    $phoneNumber = trim($_POST["phoneNumber"] ?? "");


    // NAME VALIDATION
    if ($name === "") {
        $errors["name"] = "Name is required.";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "Name must be at least 2 characters long.";
    } elseif (!preg_match("/^[a-zA-Z .'-]+$/", $name)) {
        $errors["name"] = "Name can only contain letters, spaces, periods, apostrophes, and hyphens.";
    }


    // EMAIL VALIDATION
    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }


    // ADDRESS VALIDATION
    if ($address === "") {
        $errors["address"] = "Address is required.";
    } elseif (strlen($address) < 5) {
        $errors["address"] = "Address must be at least 5 characters long.";
    }


    // PROGRAM VALIDATION
    $validPrograms = [
        "Bachelor of Science in Information Technology",
        "Bachelor of Science in Computer Science",
        "Bachelor of Science in Computer Engineering"
    ];

    if ($program === "") {
        $errors["program"] = "Please select a program.";
    } elseif (!in_array($program, $validPrograms)) {
        $errors["program"] = "Please select a valid program.";
    }


    // BIRTHDAY VALIDATION
    if ($birthday === "") {

        $errors["birthday"] = "Birth date is required.";
    } else {

        $date = DateTime::createFromFormat("Y-m-d", $birthday);

        if (!$date || $date->format("Y-m-d") !== $birthday) {

            $errors["birthday"] = "Please enter a valid birth date.";
        } elseif ($date > new DateTime()) {

            $errors["birthday"] = "Birth date cannot be in the future.";
        }
    }


    // PHONE NUMBER VALIDATION
    if ($phoneNumber === "") {

        $errors["phoneNumber"] = "Phone number is required.";
    } elseif (!preg_match("/^09[0-9]{9}$/", $phoneNumber)) {

        $errors["phoneNumber"] =
            "Phone number must be exactly 11 digits and start with 09.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resume Form</title>

    <style>
        * {
            box-sizing: border-box;

            font-family:
                'Lucida Sans',
                'Lucida Sans Regular',
                'Lucida Grande',
                'Lucida Sans Unicode',
                Geneva,
                Verdana,
                sans-serif;
        }


        body {

            margin: 0;

            padding: 40px 20px;

            background-color: #f4f6f8;

            color: #263238;
        }


        #maindiv {

            width: 100%;

            max-width: 700px;

            margin: auto;

            background-color: white;

            border-radius: 16px;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);

            overflow: hidden;
        }


        #formHeader {

            padding: 28px 40px;

            background-color: #263238;

            color: white;
        }


        #formHeader h2 {

            margin: 0;

            font-size: 25px;

            font-weight: 600;
        }


        #formHeader p {

            margin: 7px 0 0;

            color: #cfd8dc;

            font-size: 13px;
        }


        #formBody {

            padding: 35px 40px;
        }


        .formGroup {

            margin-bottom: 24px;
        }


        .label {

            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: bold;

            color: #37474f;
        }


        .fieldRow {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .input {

            width: 100%;

            padding: 11px 13px;

            background-color: white;

            border: 1px solid #b0bec5;

            border-radius: 7px;

            outline: none;

            font-size: 14px;

            color: #263238;

            transition: 0.2s;
        }


        .fieldRow .input {

            flex: 1;
        }


        .input:focus {

            border-color: #546e7a;

            box-shadow:
                0 0 0 3px rgba(84, 110, 122, 0.12);
        }


        select.input {

            cursor: pointer;
        }


        .error {

            color: #d32f2f;

            font-size: 12px;

            font-weight: bold;

            white-space: nowrap;
        }


        .inputError {

            border-color: #d32f2f;
        }


        .buttonContainer {

            display: flex;

            justify-content: center;

            gap: 12px;

            margin-top: 30px;

            padding-top: 25px;

            border-top: 1px solid #e0e0e0;
        }


        button {

            padding: 11px 22px;

            border-radius: 7px;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }


        #submitbtn {

            border: none;

            background-color: #263238;

            color: white;
        }


        #submitbtn:hover {

            background-color: #37474f;
        }


        #resetbtn {

            border: 1px solid #b0bec5;

            background-color: white;

            color: #37474f;
        }


        #resetbtn:hover {

            background-color: #eceff1;
        }


        @media (max-width: 700px) {

            body {

                padding: 20px 10px;
            }


            #formBody {

                padding: 25px 20px;
            }


            #formHeader {

                padding: 25px 20px;
            }


            .fieldRow {

                display: block;
            }


            .error {

                display: block;

                margin-top: 6px;

                white-space: normal;
            }


            .buttonContainer {

                flex-direction: column;
            }


            button {

                width: 100%;
            }

        }
    </style>

</head>


<body>

    <div id="maindiv">

        <div id="formHeader">

            <h2>Resume Form</h2>

            <p>
                Enter your information below.
            </p>

        </div>


        <div id="formBody">

            <form method="POST" action="">


                <!-- NAME -->

                <div class="formGroup">

                    <label for="name" class="label">
                        Full Name
                    </label>

                    <div class="fieldRow">

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="input <?php echo isset($errors['name']) ? 'inputError' : ''; ?>"
                            placeholder="Enter your name"
                            value="<?php echo htmlspecialchars($name); ?>">

                        <?php if (isset($errors["name"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["name"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- EMAIL -->

                <div class="formGroup">

                    <label for="email" class="label">
                        Email Address
                    </label>

                    <div class="fieldRow">

                        <input
                            type="text"
                            name="email"
                            id="email"
                            class="input <?php echo isset($errors['email']) ? 'inputError' : ''; ?>"
                            placeholder="Enter your email"
                            value="<?php echo htmlspecialchars($email); ?>">

                        <?php if (isset($errors["email"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["email"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- ADDRESS -->

                <div class="formGroup">

                    <label for="address" class="label">
                        Address
                    </label>

                    <div class="fieldRow">

                        <input
                            type="text"
                            name="address"
                            id="address"
                            class="input <?php echo isset($errors['address']) ? 'inputError' : ''; ?>"
                            placeholder="Enter your address"
                            value="<?php echo htmlspecialchars($address); ?>">

                        <?php if (isset($errors["address"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["address"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- PROGRAM -->

                <div class="formGroup">

                    <label for="program" class="label">
                        Program
                    </label>

                    <div class="fieldRow">

                        <select
                            name="program"
                            id="program"
                            class="input <?php echo isset($errors['program']) ? 'inputError' : ''; ?>">

                            <option value="">
                                Select your program
                            </option>

                            <option
                                value="Bachelor of Science in Information Technology"
                                <?php
                                if ($program === "Bachelor of Science in Information Technology") {
                                    echo "selected";
                                }
                                ?>>
                                Bachelor of Science in Information Technology
                            </option>

                            <option
                                value="Bachelor of Science in Computer Science"
                                <?php
                                if ($program === "Bachelor of Science in Computer Science") {
                                    echo "selected";
                                }
                                ?>>
                                Bachelor of Science in Computer Science
                            </option>

                            <option
                                value="Bachelor of Science in Computer Engineering"
                                <?php
                                if ($program === "Bachelor of Science in Computer Engineering") {
                                    echo "selected";
                                }
                                ?>>
                                Bachelor of Science in Computer Engineering
                            </option>

                        </select>


                        <?php if (isset($errors["program"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["program"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- BIRTH DATE -->

                <div class="formGroup">

                    <label for="birthday" class="label">
                        Birth Date
                    </label>

                    <div class="fieldRow">

                        <input
                            type="date"
                            name="birthday"
                            id="birthday"
                            class="input <?php echo isset($errors['birthday']) ? 'inputError' : ''; ?>"
                            value="<?php echo htmlspecialchars($birthday); ?>">

                        <?php if (isset($errors["birthday"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["birthday"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- PHONE NUMBER -->

                <div class="formGroup">

                    <label for="phoneNumber" class="label">
                        Phone Number
                    </label>

                    <div class="fieldRow">

                        <input
                            type="text"
                            name="phoneNumber"
                            id="phoneNumber"
                            class="input <?php echo isset($errors['phoneNumber']) ? 'inputError' : ''; ?>"
                            placeholder="09XXXXXXXXX"
                            value="<?php echo htmlspecialchars($phoneNumber); ?>">

                        <?php if (isset($errors["phoneNumber"])): ?>

                            <span class="error">
                                <?php echo htmlspecialchars($errors["phoneNumber"]); ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- BUTTONS -->

                <div class="buttonContainer">

                    <button
                        type="submit"
                        id="submitbtn">
                        Generate Resume
                    </button>

                    <button
                        type="reset"
                        id="resetbtn">
                        Clear Form
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>

</html>