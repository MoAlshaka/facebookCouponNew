<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #333;
    }

    div {
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      margin: 20px;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"] {
      width: 98%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    button {
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    #response {
      margin-top: 20px;
    }
  </style>
  <body>
      <h1>Add Cookies</h1>
    <div>
      <form action="{{route('add_cookies')}}" method="POST">
        @csrf
        <label for="emails">Add your Emails:</label>
        <textarea id="emails" name="emails" cols="80" rows="30"></textarea>
        <label for="delay">Delay Between Actions (in sec):</label>
        <input type="number" id="delay" name="delay" placeholder="Enter delay" value="2" />
        <button type="submit">Send</button>
      </form>
    </div>
    <div id="response">
      <!-- Display response from the server here -->
        @if(isset($responses))
            <div class="alert alert-success">
                {{ $responses }}
            </div>
        @endif
    </div>
  </body>
</html>
