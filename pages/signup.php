<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signup</title>
    <link rel="stylesheet" href="../assets/css/login.css" />
  </head>
  <body>
    <div class="container">
      <form action="#" class="form" id="form1">
        <h2 class="form__title">Sign Up</h2>
        <input type="text" placeholder="FirstName" class="input" />
        <input type="text" placeholder="LastName" class="input" />
        <input type="tel" placeholder="PhoneNumber" class="input" />

        <div class="mode">
          <input id="radio1" name="mode" type="radio" value="buyer" /><label
            for="radio1"
            >Buyer</label
          >

          <input id="radio2" name="mode" type="radio" value="seller" /><label
            for="radio2"
            >Seller</label
          >
        </div>

        <input type="url" placeholder="Profile-Link" class="input" />
<label for="dor">Address</label>

        <div id="dor">
            <label for="dorm">Dorm Number:</label>
            <input type="text" id="dorm" name="dorm">
        </div>
        
        <div id="dor">
            <label for="block">Block Number:</label>
            <input type="text" id="block" name="block">
        </div>
        <button class="btn">Sign Up</button>
      </form>
    </div>
  </body>
</html>
