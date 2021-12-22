<article class="login">

 <h1 class="login__title subtitle">Log In</h1>
 <section class="login__wrap border">
     <form class="login__form" method="post" action="index.php?page=login" >
         <input type="hidden" name="action" value="login">
      <span class="error"><?php if(!empty($errorLogin)){ echo $errorLogin;} ?></span>
         <label class="login__label">
            <span class="form__text text--login inputValidate">What is your username?</span>
            <span class="error"><?php if(!empty($errors['username--login'])){ echo $errors['username--login'];} ?></span>
            <input type="text" name="username" class="login__input" size="10" required>
        </label>
         <label class="login__label">
            <span class="form__text text--login inputValidate">What is your password? </span>
            <span class="error"><?php if(!empty($errors['password--login'])){ echo $errors['password--login'];} ?></span>
            <input type="password" name="password" class="login__input" required>
        </label>
        <a class="signup--link" href="index.php?page=signup">No account yet? Sign up here!</a>
        <input type="submit" class="button button--login" value="LOG IN">
</form>
</section>
</article>
