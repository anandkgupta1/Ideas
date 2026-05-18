{{-- @extends('layout.layout') --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile View</title>
  <style>
    /* Reset some default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background-color: white;
      width: 100%;
      max-width: 600px;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .profile-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .profile-info label {
      font-weight: bold;
      color: #333;
    }

    .profile-info div {
      display: flex;
      justify-content: space-between;
    }

    .profile-info div span {
      color: #555;
    }

    .profile-info .full-width {
      grid-column: span 2;
    }

    .btn-edit {
      display: block;
      width: 100%;
      margin-top: 20px;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .btn-edit:hover {
      background-color: #45a049;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 600px) {
      .profile-info {
        grid-template-columns: 1fr;
      }

      .profile-info div {
        flex-direction: column;
      }

      .profile-info div span {
        margin-top: 5px;
      }

      .btn-edit {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Profile</h1>

    <div class="profile-info">
        
      <div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="">
      </div>

      <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="">
      </div>

      <div class="full-width">
        <label for="address">Address:</label>
        <input type="text" name="address" value="">
      </div>

      <div class="full-width">
        <label for="email">Email:</label>
        <input type="email" name="email" value="">
      </div>
    </div>

    <button class="btn-edit">Edit Profile</button>
  </div>

</body>
</html>
{{-- @endsection --}}