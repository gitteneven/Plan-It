<article class="signup">

 <h1 class="signup__title subtitle">Sign up</h1>
 <section class="border login__wrap">

     <form class="signup__form" method="post" action="index.php?page=signup" enctype="multipart/form-data" <?php if(!empty($part1) && $part1==false) {echo 'style="display: none;"';} ?>>
         <input type="hidden" name="action" value="signup">

         <label class="signup__label ">
            <span class="form__text">What is your firstname?</span>
            <span class="error"><?php if(!empty($errors['name'])){ echo $errors['name'];} ?></span>
            <input type="text" class="size1" name="name" class="signup__input signup--name" size="5">
        </label>
        <label class="signup__label ">
            <span class="form__text">What is your email adress?</span>
            <span class="error"><?php if(!empty($errors['email'])){ echo $errors['email'];} ?></span>
            <input type="email" name="email" class="signup__input signup--email">
        </label>
         <label class="signup__label ">
            <span class="form__text">What is your surname?</span>
            <span class="error"><?php if(!empty($errors['surname'])){ echo $errors['surname'];} ?></span>
            <input type="text" class="size1" name="surname" class="signup__input signup--surname">
          </label>
          <label class="signup__label ">
             <span class="form__text">What is your password?</span>
             <span class="error"><?php if(!empty($errors['password'])){ echo $errors['password'];} ?></span>
             <input type="password" class="size1" name="password" class="signup__input signup--password" >
         </label>
         <label class="signup__label ">
            <span class="form__text">How may we call you?</span>
            <span class="error"><?php if(!empty($errors['username'])){ echo $errors['username'];} ?></span>
            <input type="text" class="size1" name="username" class="signup__input signup--name">
        </label>
         <label class="signup__label ">
            <span class="form__text">Your password again? </span>
            <span class="error"></span>
            <input type="password" class="size1" name="password2" class="signup__input signup--password" >
        </label>
        <!-- <label class="signup__label c1">
            <span class="form__text">Upload profile picture:</span>
            <span class="error"><?php //if(!empty($errors['picture'])){ echo $errors['picture'];}?></span>
            <input type="file" name="picture" accept="image/png, image/jpeg, image/gif" class="signup__input" >
        </label> -->

        <input type="submit" class="signup--button button" value="Choose streaming services">

</form>

<!-- <?php if(!empty($part1) && $part1==false){ ?>
   <form class="signup__form" method="post" action="index.php?page=signup" enctype="multipart/form-data">
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
    <input type="checkbox" id="netflix" name="strOption[]" value="Netflix" class="option filter" >
    Netflix</label></li>
    <li ><label>
    <input type="checkbox" id="disney+" name="strOption[]" value="Disney+" class="option filter" >
    Disney+</label></li>

  </ul>
      <input type="submit" class="signup__button" value="SIGN UP">
  </form>
  <?php
} ?>
</section> -->

 <!-- <script src="js/validate.js"></script> -->
</article>
