<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
  </head>
  <body>
    <h1>Send a POST Request</h1>
    <div>
      <!-- Create a Laravel form -->
      <form method="POST" action="{{ route('uplode_reels') }}">
        @csrf <!-- Include CSRF token for security -->

        <label for="message">Message:</label>
        <textarea
          id="message"
          name="message"
          cols="80"
          rows="30"
          style="direction: rtl"
        >
          message body
        </textarea>

        <label for="delay">Delay Between Actions (in sec):</label>
        <input type="number" id="delay" name="delay" placeholder="Enter delay" value="2" />

        <label for="Postdelay">Delay Between Posts (in min):</label>
        <input type="number" id="Postdelay" name="Postdelay" placeholder="Enter delay" value="2" />

        <button type="submit" id="sendButton">Send</button>
      </form>
    </div>
    <div id="response">
      <!-- Display response from the server here -->
    </div>

  </body>
</html>
