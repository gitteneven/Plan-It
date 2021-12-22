{
  const handleSubmitForm = e => {
    const $form = e.currentTarget;
    if (!$form.checkValidity()) {
      e.preventDefault();
      const inputs = document.querySelectorAll(`.input`);
      inputs.forEach($input => showValidationInfo($input));
    }
  };

  const handleInputField = e => {
    const $input = e.currentTarget;
    const $error = $input.parentElement.querySelector(`.error`);
    if ($input.checkValidity()) {
      $error.textContent = ``;
    }
  };

  const showTypeMismatch = type => {
    switch (type) {
    case `email`:
      return `e-mailadres`;
    case `url`:
      return `website url`;
    case `tel`:
      return `telefoonnummer`;
    }
  };

  const showValidationInfo = $input => {
    // selecteren van het error veld bij elk element
    const $error = $input.parentElement.querySelector(`.error`);

    // controle of het veld ingevuld is
    if ($input.validity.valueMissing) {
      $error.textContent = `Dit veld is verplicht`;
    }
    // controle of input matcht met type attribute
    if ($input.validity.typeMismatch) {
      $error.textContent = `Er wordt een ${showTypeMismatch($input.getAttribute(`type`))} verwacht`;
    }
    // controle of de maximale lengte niet overschreden is
    if ($input.validity.tooLong) {
      $error.textContent = `Input mag maximum ${$input.getAttribute(`maxlength`)} karakters bevatten`;
    }
    // controle of de minimale lengte wel gehaald werd
    if ($input.validity.tooShort) {
      $error.textContent = `Input moet minimum ${$input.getAttribute(`minlength`)} karakters bevatten`;
    }
    // controle of de input groter of gelijk is aan de kleinst mogelijke waarde
    if ($input.validity.rangeUnderflow) {
      $error.textContent = `De waarde moet groter of gelijk zijn aan ${$input.getAttribute(`min`)}`;
    }
    // controle of de input kleiner of gelijk is aan de grootst mogelijke waarde
    if ($input.validity.rangeOverflow) {
      $error.textContent = `De waarde moet kleiner of gelijk zijn aan ${$input.getAttribute(`max`)}`;
    }
  };

  const handleBlurInput = e => {
    showValidationInfo(e.currentTarget);
  };

  const init = () => {
    const $form = document.querySelector(`form`);
    $form.noValidate = true;
    $form.addEventListener(`submit`, handleSubmitForm);

    const inputs = document.querySelectorAll(`.inputValidate`);
    inputs.forEach($input => {
      $input.addEventListener(`blur`, handleBlurInput);
      $input.addEventListener(`input`, handleInputField);
    });
  };

  init();
}

