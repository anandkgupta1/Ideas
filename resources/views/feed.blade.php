<!-- resources/views/feed.blade.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
      /* Reset some default styles */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
  
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
      }
  
      .container {
        background-color: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 100%;
        max-width: 500px;
      }
  
      h1 {
        text-align: center;
        margin-bottom: 20px;
      }
  
      label {
        display: block;
        margin: 10px 0 5px;
      }
  
      input, select, textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
      }
  
      button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }
  
      button:hover {
        background-color: #45a049;
      }
  
      .hidden {
        display: none;
      }
  
      @media (max-width: 600px) {
        .container {
          padding: 15px;
        }
  
        h1 {
          font-size: 24px;
        }
  
        button {
          font-size: 14px;
        }
      }
    </style>
  </head>
<body>
    <div class="container">
        <h1>Feedback</h1>
        <h6 style="text-align: center">Share your valuable feedback with us..</h6>
        
        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="">Select Rating</option>
                <option value="Fair">Fair</option>
                <option value="Good">Good</option>
                <option value="Very Good">Very Good</option>
                <option value="Excellent">Excellent</option>
            </select>

            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>