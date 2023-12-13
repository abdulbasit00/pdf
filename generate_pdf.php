<style>
        /* Apply basic styling to create a two-column layout */
        .container {
            display: flex;
        }

        .half-box {
            width: 50%;
            box-sizing: border-box;
            padding: 10px;
        }
    </style>
<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the raw value of the textarea from the $_POST array
        $textareaValue = $_POST["myTextarea"];

        // Replace newline characters with HTML line breaks
        $formattedTextareaValue = nl2br(htmlspecialchars($textareaValue, ENT_QUOTES, 'UTF-8'));

        // Divide the formatted textarea value into two halves
        $halfLength = ceil(strlen($formattedTextareaValue) / 2);
        $firstHalf = substr($formattedTextareaValue, 0, $halfLength);
        $secondHalf = substr($formattedTextareaValue, $halfLength);

        // Display the retrieved value in two separate boxes
        echo '<div class="container">';
        echo '<div class="half-box">' . $firstHalf . '</div>';
        echo '<div class="half-box">' . $secondHalf . '</div>';
        echo '</div>';
    }
    ?>
    