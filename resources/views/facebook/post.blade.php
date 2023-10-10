<!DOCTYPE html>
<html>
<head>
    <title>Post Coupon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        textarea,
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
        <h1>Post Coupon</h1>
        <form action="{{ route('post_coupon') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="id">Group ID:</label>
            <textarea name="id" id="id" cols="30" rows="10">{{ old('id') }}</textarea>
            @error('id')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="photo">URL Photo:</label>
            <input type="text" name="photo" id="photo" value="{{ old('photo') }}">
            @error('photo')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10">{{ old('message') }}</textarea>
            @error('message')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="delay">Delay</label>
            <input type="text" name="delay" id="delay" placeholder="Enter delay" value="{{ old('delay') }}">
            @error('delay')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>

