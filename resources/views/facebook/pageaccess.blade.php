<!DOCTYPE html>
<html>
<head>
    <title>Get Page Access Token</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #f44336;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Get Page Access Token</h1>
        <form action="{{ route('get_page_access_token') }}" method="post">
            @csrf
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" placeholder="Enter ID" value="{{ old('id') }}">
            @error('id')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="access_token">Access Token:</label>
            <input type="text" name="access_token" id="access_token" placeholder="Enter Access Token" value="{{ old('access_token') }}">
            @error('access_token')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="submit" value="Get Access">
        </form>
    </div>
</body>
</html>
