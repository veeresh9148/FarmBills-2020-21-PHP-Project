<!DOCTYPE html>
<html>
<head>
<style>
body {
  background-color: lightblue;
}

h1 {
  color: white;
  text-align: center;
}
</style>
</head>
<body>

<h1>Display Radio Buttons</h1>

<form action="/action_page.php">
  <p>Please select country or state:</p>
  <input type="radio" id="country" name="country" value="country">
  <label for="male">country</label><br>
  <input type="radio" id="state" name="state" value="state">
  <label for="female">state</label><br>
</form>

</body>
</html>
