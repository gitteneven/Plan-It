<article class="signup">

 <h1 class="signup__title subtitle">Sign up</h1>
 <section class="border login__wrap">


   <form class="signup__form" method="post" action="index.php?page=signup2" enctype="multipart/form-data">
      <input type="hidden" name="action" value="streaming">
      <!-- <h2 class=subtitle>Choose your streaming services:</h2> -->

      <label class="country input" for="country">What country are you from?
    <select id="country" class="country" name="country[]" size="1">
    <?php foreach($countries as $country): ?>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <?php endforeach; ?>
      </select> <br>
       <span class="error"><?php if(!empty($errors['text'])){ echo $errors['text'];} ?></span>
    <p class="form__text">What streaming services do you use?</p>
    <ul name="strInput" id="strInput" class="strList">

    <li ><label class="">
    <input type="checkbox" id="netflix" name="strOption[]" value="netflix" class="option str_netflix" >
    </label></li>
    <li ><label>
    <input type="checkbox" id="disney+" name="strOption[]" value="disney" class="option str_disney" >
    </label></li>
    <li>
    <input type="checkbox" id="amazonPrime" name="strOption[]" value="amazon_prime" class="option str_prime" >
    </label></li>
    <li>
    <input type="checkbox" id="hbomax" name="strOption[]" value="hbo_max" class="option str_hbo" >
    </label></li>
    <li>
    <input type="checkbox" id="hulu" name="strOption[]" value="hulu" class="option str_hulu" >
    </label></li>

  </ul>
      <input type="submit" class="signup--button button" value="SIGN UP">
  </form>
</section>

 <!-- <script src="js/validate.js"></script> -->
</article>
