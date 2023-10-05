<!DOCTYPE html>
<html>
  <head>
    <title>Send POST Request</title>
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
        height: 200px;
        overflow-y: scroll;
      }
      table {
        border-collapse: collapse;
        width: 100%;
      }

      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <h1>Get Groups IDs</h1>
    <div>
      <form action="{{route('scrapid')}}" method="post">
      @csrf
        <label for="searchGroup">Message:</label>
        <input
          type="text"
          id="searchGroup"
          name="searchGroup"
          placeholder="Put Groups Name"
          value="cars"
        />
        <label for="groupNumber">Number of Pages to Scrap:</label>
        <input
          type="number"
          id="groupNumber"
          name="groupNumber"
          placeholder="Put Groups Name"
          value="3"
        />
        <label for="delay">Delay Between Actions (in sec):</label>
        <input
          type="number"
          id="delay"
          name="delay"
          placeholder="Enter delay"
          value="2"
        />
        <button type="submit">Send</button>
        <button type="button" id="downloadButton">Download Excel</button>
      </form>
    </div>
    <div id="response">
       @if(isset($responses))
            <div class="alert alert-success">
                {{ $responses }}
            </div>
        @endif
    </div>




    <!-- use version 0.20.0 -->
    <script
      lang="javascript"
      src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"
    ></script>

  </body>
</html>
