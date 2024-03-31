<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $image = "uploads/" . $_FILES['image']['name']; // Corrected image path
    $feedback = $_POST['feedback'];

    // Upload image to server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert feedback into table
    $sql = "INSERT INTO feedback (name, rating, image, feedback) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $rating, $image, $feedback);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .feedback-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .rating {
            display: flex;
            cursor: pointer;
        }

        .star {
            font-size: 24px;
            padding: 0 0.5em;
            color: #ccc;
        }

        .star.selected {
            color: #ffc107;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="feedback-form">
        <h1>Feedback Form</h1>
        <form id="feedbackForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="rating">Rating:</label>
            <div class="rating" id="starRating">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
            </div>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        const ratingContainer = document.getElementById('starRating');
        let selectedRating = 0;

        ratingContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('star')) {
                const value = parseInt(event.target.getAttribute('data-value'), 10);

                // Toggle the selected state
                if (value === selectedRating) {
                    selectedRating = 0;
                } else {
                    selectedRating = value;
                }

                updateRating();
            }
        });

        function updateRating() {
            const stars = ratingContainer.querySelectorAll('.star');
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'), 10);
                star.classList.toggle('selected', value <= selectedRating);
            });

            // You can save the selectedRating value to your backend or perform other actions here
            console.log('Selected Rating:', selectedRating);
        }

        document.getElementById('feedbackForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Add your logic to handle form submission here
            // You can access the selectedRating variable to get the rating value

            alert('Feedback submitted!'); // Example alert for demonstration purposes
        });

        document.getElementById('feedbackForm').addEventListener('submit', function (e) {
            e.preventDefault();
        
            const newFeedback = {
                name: document.getElementById('name').value,
                rating: selectedRating,
                image: document.getElementById('image').value, // You can handle image upload separately
                feedback: document.getElementById('feedback').value
            };
        
            // Convert the feedback object to a query string
            const queryString = Object.entries(newFeedback)
                .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
                .join('&');
        
            // Redirect to ash_feedbacks.html with the feedback as URL parameters
            window.location.href = `ash_feedbacks.html?${queryString}`;
        });
    </script>
</body>
</html>