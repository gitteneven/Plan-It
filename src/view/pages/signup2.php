<article class="signup">

 <h1 class="signup__title">Sign up</h1>
 <section class="">


   <form class="signup__form" method="post" action="index.php?page=signup2" enctype="multipart/form-data">
      <input type="hidden" name="action" value="streaming">
      <h2 class=subtitle>Choose your streaming services:</h2>

      <label class="country input" for="country">Choose your country:
    <select id="country" class="country" name="country[]" size="1">
    <?php foreach($countries as $country): ?>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                <?php endforeach; ?>
      </select> <br>
       <span class="error"><?php if(!empty($errors['text'])){ echo $errors['text'];} ?></span>

    <ul name="strInput" id="strInput" class="strInput">
    <p class="form__text">Select your streaming services:</p>
    <li ><label>
    <input type="checkbox" id="netflix" name="strOption[]" value="netflix" class="option filter" >
    Netflix</label></li>
    <li ><label>
    <input type="checkbox" id="disney+" name="strOption[]" value="disney" class="option filter" >
    Disney+</label></li>
    <li>
    <input type="checkbox" id="amazonPrime" name="strOption[]" value="amazon_prime" class="option filter" >
    Amazon Prime</label></li>
    <li>
    <input type="checkbox" id="hbomax" name="strOption[]" value="hbo_max" class="option filter" >
    HBO Max</label></li>
    <li>
    <input type="checkbox" id="hulu" name="strOption[]" value="hulu" class="option filter" >
    Hulu</label></li>

  </ul>
      <input type="submit" class="signup__button" value="SIGN UP">
  </form>
</section>

 <!-- <script src="js/validate.js"></script> -->
</article>
