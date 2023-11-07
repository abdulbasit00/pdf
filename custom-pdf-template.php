<?php
/*
Template Name: Custom PDF Template
*/

require_once('tcpdf/tcpdf.php');

if (isset($_POST["generate_pdf"])) {
    // Ensure no output before PDF generation
    ob_clean();

    $full_name = sanitize_text_field($_POST["full_name"]);
    $email = sanitize_email($_POST["email"]);
    $phone = sanitize_text_field($_POST["phone"]);
    $address = sanitize_text_field($_POST["address"]);

    $image_path = '';

    // Handle file upload
    if (isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] == 0) {
        $file_name = sanitize_text_field($_FILES["file_upload"]["name"]);
        $file_temp = $_FILES["file_upload"]["tmp_name"];

        // Define the absolute server path to the upload directory
        $upload_directory = "C:/xampp/htdocs/wordpress-practice-project/wp-content/uploads/"; // Replace with your actual path

        // Move the uploaded file to the destination folder
        move_uploaded_file($file_temp, $upload_directory . $file_name);

        $image_path = $upload_directory . $file_name;
    }

    // Create a PDF instance
    $pdf = new TCPDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();

    // Create a table with two columns for left and right sections
    $pdf->setFillColor(240, 240, 240);
    $pdf->SetXY(10, 30); // Set initial position
    $pdf->SetFont('helvetica', '', 12);

    // Left Column
    $pdf->Cell(60, 10, 'Full Name:', 0, 0, 'L', 1);
    $pdf->Cell(0, 10, $full_name, 0, 1, 'L', 0);

    $pdf->Cell(60, 10, 'Email:', 0, 0, 'L', 1);
    $pdf->Cell(0, 10, $email, 0, 1, 'L', 0);

    $pdf->Cell(60, 10, 'Phone Number:', 0, 0, 'L', 1);
    $pdf->Cell(0, 10, $phone, 0, 1, 'L', 0);

    // Right Column (Image)
    if (!empty($image_path) && file_exists($image_path)) {
        $pdf->Image($image_path, 100, 30, 80); // Adjust the coordinates and size as needed
    }

    // Address (spanning both columns)
    $pdf->SetXY(10, 80);
    $pdf->Cell(0, 10, 'Address:', 0, 1, 'L', 1);
    $pdf->SetXY(10, 90);
    $pdf->MultiCell(170, 10, $address, 0, 'L', 0);

    // Output the PDF to the browser for download
    $pdf->Output('customer_details.pdf', 'D');
    exit; // Ensure no further PHP processing

} else {
    get_header(); // Include the header of your theme

    // Display the form
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1>Customer Details Form</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required><br><br>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea><br><br>

                <!-- File upload input -->
                <label for="file_upload">Upload File:</label>
                <input type="file" id="file_upload" name="file_upload"><br><br>

                <input type="submit" name="generate_pdf" value="Generate PDF">
            </form>
        </main>
    </div>
    <?php
    get_footer(); // Include the footer of your theme
}
// ... (previous code)

if (isset($_POST["generate_pdf"])) {
    // Ensure no output before PDF generation
    ob_clean();

    // ... (previous code for form data and image upload)

    // Create a PDF instance
    $pdf = new TCPDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false;
    $pdf->AddPage();

    // Add content to the PDF
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Customer Details', 0, 1, 'C');

    // Add the local logo image (replace 'logo.png' with your logo file)
    $logo_path = 'path/to/your/logo.png';
    if (file_exists($logo_path)) {
        $pdf->Image($logo_path, 10, 10, 40); // Adjust the coordinates and size as needed
    }

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Full Name: $full_name", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Phone Number: $phone", 0, 1);
    $pdf->Cell(0, 10, "Address: $address", 0, 1);

    // Embed the uploaded image (if any) in the PDF
    if (!empty($image_path) && file_exists($image_path)) {
        $pdf->Image($image_path, 100, 60, 80); // Adjust the coordinates and size as needed
    }

    // Output the PDF to the browser for download
    $pdf->Output('customer_details.pdf', 'D');
    exit; // Ensure no further PHP processing
}
