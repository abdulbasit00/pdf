<?php
/*
Template Name: Custom PDF Template
*/

require_once('tcpdf/tcpdf.php');

if (isset($_POST["generate_pdf"])) {
    $full_name = sanitize_text_field($_POST["full_name"]);
    $email = sanitize_email($_POST["email"]);
    $phone = sanitize_text_field($_POST["phone"]);
    $address = sanitize_text_field($_POST["address"]);

    // Create a PDF instance
    $pdf = new TCPDF();
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();

    // Add content to the PDF
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Customer Details', 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Full Name: $full_name", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Phone Number: $phone", 0, 1);
    $pdf->Cell(0, 10, "Address: $address", 0, 1);

    // Output the PDF to the browser for download
    $pdf->Output('customer_details.pdf', 'D');
} else {
    get_header(); // Include the header of your theme

    // Display the form
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1>Customer Details Form</h1>
            <form action="" method="post">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required><br><br>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea><br><br>

                <input type="submit" name="generate_pdf" value="Generate PDF">
            </form>
        </main>
    </div>
    <?php
    get_footer(); // Include the footer of your theme
}
