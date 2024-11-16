document.addEventListener('DOMContentLoaded', function() {
  //create productos
  const productForm = document.querySelector('.product-form');
  if (productForm) {
    const nameField = productForm.querySelector('input[name="name"]');
    nameField.addEventListener('input', function(e) {
      const regex = /[^a-zA-Z0-9\s]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El nombre del producto solo puede contener letras, números y espacios.");
        showError(nameField, "El nombre del producto solo puede contener letras, números y espacios.");
      } else {
        e.target.setCustomValidity("");
        clearError(nameField);
      }
    });

    const slugField = productForm.querySelector('input[name="slug"]');
    slugField.addEventListener('input', function(e) {
      const regex = /[^a-zA-Z0-9\-]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
        showError(slugField, "El slug solo puede contener letras, números y guiones.");
      } else {
        e.target.setCustomValidity("");
        clearError(slugField);
      }
    });

    productForm.addEventListener('submit', function(e) {
      let isValid = true;
      const fields = [nameField, slugField];
      fields.forEach(field => {
        if (!field.checkValidity()) {
          isValid = false;
          showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
        } else {
          clearError(field);
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert("Por favor, corrija los errores antes de enviar el formulario.");
      }
    });
  }

  const fileInput = document.querySelector('.product-form input[name="cover"]');
  if (fileInput) {
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const fileType = file.type;
        if (!fileType.startsWith('image/')) {
          alert('Por favor, selecciona un archivo de imagen.');
          e.target.value = '';
        }
      }
    });
  }
  // create usuario
  const userForm = document.querySelector('.users-form');
  if (userForm) {
    //
    const userNameField = userForm.querySelector('input[name="name"]');
    userNameField.addEventListener('input', function(e) {
      const regex = /[^a-zA-Z\s]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El nombre solo puede contener letras y espacios.");
        showError(userNameField, "El nombre solo puede contener letras y espacios.");
      } else {
        e.target.setCustomValidity("");
        clearError(userNameField);
      }
    });

    const userLastnameField = userForm.querySelector('input[name="lastname"]');
    userLastnameField.addEventListener('input', function(e) {
      const regex = /[^a-zA-Z\s]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El apellido solo puede contener letras y espacios.");
        showError(userLastnameField, "El apellido solo puede contener letras y espacios.");
      } else {
        e.target.setCustomValidity("");
        clearError(userLastnameField);
      }
    });

    const userEmailField = userForm.querySelector('input[name="email"]');
    userEmailField.addEventListener('input', function(e) {
      if (!e.target.value.includes('@')) {
        e.target.setCustomValidity("El correo debe incluir '@'.");
        showError(userEmailField, "El correo debe incluir '@'.");
      } else {
        e.target.setCustomValidity("");
        clearError(userEmailField);
      }
    });

    const userPhoneField = userForm.querySelector('input[name="phone_number"]');
    userPhoneField.addEventListener('input', function(e) {
      const regex = /[^0-9]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El teléfono solo puede contener números.");
        showError(userPhoneField, "El teléfono solo puede contener números.");
      } else {
        e.target.setCustomValidity("");
        clearError(userPhoneField);
      }
    });

    const userRoleField = userForm.querySelector('input[name="role"]');
    userRoleField.addEventListener('input', function(e) {
      const regex = /[^a-zA-Z\s]/g;
      if (regex.test(e.target.value)) {
        e.target.setCustomValidity("El rol solo puede contener letras.");
        showError(userRoleField, "El rol solo puede contener letras.");
      } else {
        e.target.setCustomValidity("");
        clearError(userRoleField);
      }
    });

    const userAvatarField = userForm.querySelector('input[name="profile_photo_file"]');
    userAvatarField.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file && !file.type.startsWith('image/')) {
        e.target.setCustomValidity("Por favor, selecciona un archivo de imagen.");
        showError(userAvatarField, "Por favor, selecciona un archivo de imagen.");
        e.target.value = '';
      } else {
        e.target.setCustomValidity("");
        clearError(userAvatarField);
      }
    });


    userForm.addEventListener('submit', function(e) {
      let isValid = true;
      const fields = [userNameField, userLastnameField, userEmailField, userPhoneField, userRoleField, userAvatarField];
      fields.forEach(field => {
        if (!field.checkValidity()) {
          isValid = false;
          showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
        } else {
          clearError(field);
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert("Por favor, corrija los errores antes de enviar el formulario de usuario.");
      }
    });
  }

 
  function showError(field, message) {
    let errorElement = field.parentElement.querySelector('.invalid-feedback');
    if (!errorElement) {
      errorElement = document.createElement('div');
      errorElement.classList.add('invalid-feedback');
      field.parentElement.appendChild(errorElement);
    }
    errorElement.innerText = message;
    field.classList.add('is-invalid');
  }

  function clearError(field) {
    let errorElement = field.parentElement.querySelector('.invalid-feedback');
    if (errorElement) {
      errorElement.innerText = '';
    }
    field.classList.remove('is-invalid');
  }

  //agg-category

const categoryForm = document.querySelector('.newcategory-form');

if (categoryForm) {
  const nameField = categoryForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; // 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField = categoryForm.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; // Solo permite letras, números y guiones
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = categoryForm.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  categoryForm.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}

function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}


function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}

//edit-category

const editcategoryForm = document.querySelector('.edit-categoryform');

if (editcategoryForm ) {
  const nameField = editcategoryForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField =editcategoryForm.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = editcategoryForm.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  editcategoryForm.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}

function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}

//new-brand

const aggbrandform = document.querySelector('.newbrands-form');

if (aggbrandform) {
  const nameField = aggbrandform.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField =aggbrandform.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = aggbrandform.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  aggbrandform.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}

function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}




//edit-brand

const editbrandForm = document.querySelector('.edit-brandform');

if (editbrandForm ) {
  const nameField = editbrandForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField =editbrandForm.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = editbrandForm.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  editbrandForm.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}

function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}

//agg-new-tang

const newtagsform = document.querySelector('.add-tag-form');

if (newtagsform ) {
  const nameField = newtagsform.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField =newtagsform.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = newtagsform.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  newtagsform.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}

function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}

//edit-brand

const editangsForm = document.querySelector('.edit-tag-form');

if (editangsForm ) {
  const nameField = editangsForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\s]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre de la categoría solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre de la categoría solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField =editangsForm.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z0-9\-]/g; 
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = editangsForm.querySelector('textarea[name="description"]');
  descriptionField.addEventListener('input', function(e) {
    if (e.target.value.trim() === '') {
      e.target.setCustomValidity("La descripción es obligatoria.");
      showError(descriptionField, "La descripción es obligatoria.");
    } else {
      e.target.setCustomValidity("");
      clearError(descriptionField);
    }
  });

  editangsForm.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField];

    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (!errorElement) {
    errorElement = document.createElement('div');
    errorElement.classList.add('invalid-feedback');
    field.parentElement.appendChild(errorElement);
  }
  errorElement.innerText = message;
  field.classList.add('is-invalid');
}

function clearError(field) {
  let errorElement = field.parentElement.querySelector('.invalid-feedback');
  if (errorElement) {
    errorElement.innerText = '';
  }
  field.classList.remove('is-invalid');
}







});
