<!DOCTYPE html>
<html>
<head>
    <title>Page Post Coupon</title>
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

        input[type="text"],
        textarea {
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
    </style>

</head>
<body>
    <div class="container">
        <h1>Page Post Coupon</h1>
        <form action="{{ route('page_post_coupon_it_self') }}" method="post">
            @csrf
            <label for="photo">URL Photo:</label>
            <input type="text" name="photo" id="photo">

            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>

            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>
