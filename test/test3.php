<!DOCTYPE html>
<html>
<head>
  <title>Toggle Forms</title>
  <script>
    function toggleForms() {
      var form1 = document.getElementById("form1");
      var form2 = document.getElementById("form2");

      if (form1.style.display === "none") {
        form1.style.display = "block";
        form2.style.display = "none";
      } else {
        form1.style.display = "none";
        form2.style.display = "block";
      }
    }
  </script>
</head>
<body>
  <a href="#" onclick="toggleForms()">Toggle Forms</a>

  <form id="form1" style="display: block;">
    <!-- Form 1 content here -->
    <h2>Form 1</h2>
    <label for="name1">Name:</label>
    <input type="text" id="name1" name="name1">
    <!-- Add more fields as needed -->
  </form>

  <form id="form2" style="display: none;">
    <!-- Form 2 content here -->
    <h2>Form 2</h2>
    <label for="name2">Name:</label>
    <input type="text" id="name2" name="name2">
    <!-- Add more fields as needed -->
  </form>
</body>
</html>
