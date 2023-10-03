<!DOCTYPE html>
<html>
<head>
    <title>Share Post</title>
    <style>
        /* Style the form container */
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Style labels */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Style input and textarea fields */
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        /* Style error messages */
        .error-message {
            color: red;
            margin-top: 5px;
        }

        /* Style submit button */
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

    </style>
</head>
<body>
    <div class="container">
        <h1>Share Post</h1>
        <form action="{{ route('share_post') }}" method="post">
            @csrf
            <label for="post_id">Post Id</label>
            <input type="text" name="post_id" id="post_id" placeholder="Enter post_id" value="{{ old('post_id') }}">
            @error('post_id')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="group_id">Group IDs:</label>
            <textarea name="group_id" id="group_id" cols="30" rows="10">{{ old('group_id') }}</textarea>
            @error('group_id')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10">{{ old('message') }}</textarea>
            @error('message')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="submit" value="Share Post">
        </form>
    </div>
</body>
</html>
