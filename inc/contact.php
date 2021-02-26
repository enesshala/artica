

<!-- Contact Us -->
<div id="contact" class="contact bg-secondary-color text-center white-color clear">
  <div class="container">
    <br />
    <h1>FEEL FREE TO ASK US ANYTHING</h1>
    <h3 class="mt-3 mb-3">CONTACT US</h3>
    <img src="img/white-line.jpg" alt="" />
    <p class="mt-3 mb-3">Donec sollicitudin molestie malesuada. Curabitur aliquet quam id
      dui posuere blandit. Nulla porttitor accumsan tinci <br />
      dunt. Quisque velit nisi, pretium ut lacinia in, elemena porttitor
      accumsan tincidunt. Quisque velit nisi, pretium ut lac <br />
      inia in, elementum id enim. Vestibulum ac diam sit anet.</p>
    <div class="contact-address mt-3">
      <div class="info">
        <img src="img/home.jpg" alt="" />
        <br />
        <p>ADDRESSE</p>
        <br />
        <p>Awesome Street 234,NY</p>
      </div>
      <div class="info">
        <img src="img/mail.jpg" alt="" />
        <br />
        <p>ADDRESSE</p>
        <br />
        <p>Awesome Street 234,NY</p>
      </div>
      <div class="info">
        <img src="img/phone.jpg" alt="" />
        <br />
        <p>ADDRESSE</p>
        <br />
        <p>Awesome Street 234,NY</p>
      </div>
    </div>
    <form action="success.php" class="contact-form" method="post" id="contact-form">
      <div class="fields">
        <input class="input" type="text" name="name" placeholder="Enter Name" id="name" />
        <input class="input" type="tel" name="phone" id="phone" placeholder="Phone Number" />
        <input class="input" type="mail" name="email" placeholder="Enter Mail" id="email" />
        <input class="input" style="width: 100%" type="text" name="subject" placeholder="Enter Subject" id="subject" />
      </div>
      <div class="questions">
        <div class="gender">
          <br />
          <p>What is your gender</p>
          <label for="male">
            Male<input type="radio" id="male" name="gender" value="Male" />
          </label>
          <label for="female">Female<input type="radio" id="female" name="gender" value="Female" /></label>
          <label for="other">Other<input type="radio" id="other" name="gender" value="Other" /></label>
        </div>
        <br />
        <!-- radio boxes -->
        <p id="sport__question">Your favourite sports?</p>
        <div class="sport__options">
          <label for="swim" class="checkbox__label">Swimming
            <input type="checkbox" name="sport[]" id="swim" value="Swimming" />
          </label>

          <label for="skii" class="checkbox__label">Skiing
            <input type="checkbox" name="sport[]" id="skii" value="Skiing" />
          </label>

          <label for="glide" class="checkbox__label">gliding
            <input type="checkbox" name="sport[]" id="glide" value="Skiing" />
          </label>
        </div>
      </div>

      <!-- Options -->
      <br />
      <p id="issue__question">Your problem type?</p>
      <div class="issue__options">
        <select name="issues" id="issues" class="select__box">
          <option value="issue" selected disabled>I have issues with:</option>
          <option value="device">Device</option>
          <option value="web">Web</option>
          <option value="management">Management</option>
          <option value="service">Your services</option>
          <option value="hosting">Hosting</option>
          <option value="Domain">Domain</option>
        </select>
      </div>

      <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter Message" class="col-12"></textarea>
      <input type="submit" name="submit_contact" value="Send Message" />
      <div class="success__message" id="success__msg">
        <p></p>
      </div>
    </form>
  </div>
  <hr class="mt-3" />