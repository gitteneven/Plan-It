<article class="signup">

 <h1 class="signup__title">Sign up</h1>
 <section class="">
     <form class="signup__form" method="post" action="index.php?page=signup" enctype="multipart/form-data">
         <input type="hidden" name="action" value="signup">

         <label class="signup__label c1">
            <span class="form__text">Firstname:</span>
            <span class="error"><?php if(!empty($errors['name'])){ echo $errors['name'];} ?></span>
            <input type="text" name="name" class="signup__input signup--name" size="10">
        </label>
         <label class="signup__label c2">
            <span class="form__text">Surname:</span>
            <span class="error"><?php if(!empty($errors['surname'])){ echo $errors['surname'];} ?></span>
            <input type="text" name="surname" class="signup__input signup--surname">
        </label>
         <label class="signup__label c1">
            <span class="form__text">Username:</span>
            <span class="error"><?php if(!empty($errors['username'])){ echo $errors['username'];} ?></span>
            <input type="text" name="username" class="signup__input signup--name">
        </label>
        <label class="signup__label c2">
            <span class="form__text">Email:</span>
            <span class="error"><?php if(!empty($errors['email'])){ echo $errors['email'];} ?></span>
            <input type="email" name="email" class="signup__input signup--email">
        </label>
         <label class="signup__label c1">
            <span class="form__text">Password:</span>
            <span class="error"><?php if(!empty($errors['password'])){ echo $errors['password'];} ?></span>
            <input type="password" name="password" class="signup__input signup--password" >
        </label>
         <label class="signup__label c2">
            <span class="form__text">Confirm password:</span>
            <span class="error"></span>
            <input type="password" name="password2" class="signup__input signup--password" >
        </label>
        <!-- <label class="signup__label c1">
            <span class="form__text">Upload profile picture:</span>
            <span class="error"><?php //if(!empty($errors['picture'])){ echo $errors['picture'];}?></span>
            <input type="file" name="picture" accept="image/png, image/jpeg, image/gif" class="signup__input" >
        </label> -->

        <input type="submit" class="signup__button" value="SIGN UP">

</form>
</section>

 <!-- <script src="js/validate.js"></script> -->
</article>
