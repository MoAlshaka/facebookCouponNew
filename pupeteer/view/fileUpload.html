<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Upload</title>
  </head>
  <body>
    <h1>Image Upload</h1>
    <form id="uploadForm" enctype="multipart/form-data">
      <input type="file" name="image" accept="image/*" required />
      <button type="submit" id="submit">Upload Image</button>
    </form>
    <div id="responce"></div>

    <script>
      const resDiv = document.getElementById("responce");
      document.getElementById("uploadForm").addEventListener("submit", (e) => {
        e.preventDefault();
      });
      document.getElementById("submit").addEventListener("click", async (e) => {
        e.preventDefault();

        const formData = new FormData();
        const fileInput = document.querySelector('input[type="file"]');
        formData.append("image", fileInput.files[0]);

        try {
          const response = await fetch("http://localhost:3000/upload", {
            method: "POST",
            body: formData,
          });

          if (response.ok) {
            console.log("Image uploaded successfully");
            const responseData = await response.json();
            // Set the response as innerHTML of the container
            resDiv.textContent = `Response: ${JSON.stringify(responseData)}`;

            // You can add code here to handle a successful upload
          } else {
            console.error("Image upload failed");
            // You can add code here to handle a failed upload
          }
        } catch (error) {
          console.error("Error:", error);
          // You can add code here to handle any network errors
        }
      });
    </script>
  </body>
</html>
