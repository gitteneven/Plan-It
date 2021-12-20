<article class="signup">

 <h1 class="signup__title subtitle">Sign up</h1>
 <section class="border login__wrap signup__wrap">


   <form class="signup__form" method="post" action="index.php?page=signup2" enctype="multipart/form-data">
      <input type="hidden" name="action" value="streaming">
      <!-- <h2 class=subtitle>Choose your streaming services:</h2> -->
      <span class="error"><?php if(!empty($errors['country'])){ echo $errors['country'];} ?></span><br>
      <label class="country input form__text" for="country">What country are you from?
    <select id="country" class="country country--selector" name="country[]" size="1" required>
    <?php foreach($countries as $country): ?>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <?php endforeach; ?>
      </select>
    </label> <br>

    <p class="form__text">What streaming services do you use?</p>
    <ul name="strInput" id="strInput" class="strList">

    <li ><label class="">
    <input type="checkbox" id="netflix" name="strOption[]" value="netflix" class="option str_netflix" >
    </label></li>
    <li ><label>
    <input type="checkbox" id="disney+" name="strOption[]" value="disney" class="option str_disney" >
    </label></li>
    <li><label>
    <input type="checkbox" id="amazonPrime" name="strOption[]" value="amazon_prime" class="option str_prime" >
    </label></li>
    <li><label>
    <input type="checkbox" id="hbomax" name="strOption[]" value="hbo_max" class="option str_hbo" >
    </label></li>
    <li><label>
    <input type="checkbox" id="hulu" name="strOption[]" value="hulu" class="option str_hulu" >
    </label></li>

  </ul>
      <input type="submit" class="signup--button signup--button2 button" value="SIGN UP">
  </form>
</section>

 <!-- <script src="js/validate.js"></script> -->
</article>
