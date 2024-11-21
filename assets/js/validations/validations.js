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

//edit-user

const editUserForm = document.querySelector('.editUsers-form');

if (editUserForm) {
  const editUserNameField = editUserForm.querySelector('input[name="name"]');
  editUserNameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z\s]/g;
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre solo puede contener letras y espacios.");
      showError(editUserNameField, "El nombre solo puede contener letras y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(editUserNameField);
    }
  });

  const editUserLastnameField = editUserForm.querySelector('input[name="lastname"]');
  editUserLastnameField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z\s]/g;
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El apellido solo puede contener letras y espacios.");
      showError(editUserLastnameField, "El apellido solo puede contener letras y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(editUserLastnameField);
    }
  });

  const editUserEmailField = editUserForm.querySelector('input[name="email"]');
  editUserEmailField.addEventListener('input', function(e) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("Por favor, ingresa un correo electrónico válido.");
      showError(editUserEmailField, "Por favor, ingresa un correo electrónico válido.");
    } else {
      e.target.setCustomValidity("");
      clearError(editUserEmailField);
    }
  });

  const editUserPhoneField = editUserForm.querySelector('input[name="phone_number"]');
  editUserPhoneField.addEventListener('input', function(e) {
    const regex = /^[0-9]*$/;
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El teléfono solo puede contener números.");
      showError(editUserPhoneField, "El teléfono solo puede contener números.");
    } else {
      e.target.setCustomValidity("");
      clearError(editUserPhoneField);
    }
  });

  const editUserRoleField = editUserForm.querySelector('input[name="role"]');
  editUserRoleField.addEventListener('input', function(e) {
    const regex = /[^a-zA-Z\s]/g;
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El rol solo puede contener letras y espacios.");
      showError(editUserRoleField, "El rol solo puede contener letras y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(editUserRoleField);
    }
  });

  

  editUserForm.addEventListener('submit', function(e) {
    let isValid = true;
    const fields = [
      editUserNameField,
      editUserLastnameField,
      editUserEmailField,
      editUserPhoneField,
      editUserRoleField,
     
    ];

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

//edit-product

const editProductForm = document.querySelector('.editProduct-form');
if (editProductForm) {
  const nameField = editProductForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function (e) {
    const regex = /[^a-zA-Z0-9\s]/g;
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre del producto solo puede contener letras, números y espacios.");
      showError(nameField, "El nombre del producto solo puede contener letras, números y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  const slugField = editProductForm.querySelector('input[name="slug"]');
  slugField.addEventListener('input', function (e) {
    const regex = /[^a-zA-Z0-9\-]/g;
    if (regex.test(e.target.value)) {
      e.target.setCustomValidity("El slug solo puede contener letras, números y guiones.");
      showError(slugField, "El slug solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(slugField);
    }
  });

  const descriptionField = editProductForm.querySelector('textarea[name="description"]');
  if (descriptionField) {
    descriptionField.addEventListener('input', function (e) {
      if (e.target.value.trim() === "") {
        e.target.setCustomValidity("La descripción no puede estar vacía.");
        showError(descriptionField, "La descripción no puede estar vacía.");
      } else {
        e.target.setCustomValidity("");
        clearError(descriptionField);
      }
    });
  }

  editProductForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [nameField, slugField, descriptionField].filter(Boolean);
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

const fileInputtwo = document.querySelector('.editProduct-form input[name="cover"]');
if (fileInputtwo) {
  fileInputtwo.addEventListener('change', function (e) {
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

function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}

function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}


//create-client

// Obtener el formulario
const createClientForm = document.querySelector('.createClient-form');
if (createClientForm) {
  // Validación para el campo "Nombre"
  const nameField = createClientForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function (e) {
    const regex = /^[a-zA-Z\s]+$/; // Solo letras y espacios
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre solo puede contener letras y espacios.");
      showError(nameField, "El nombre solo puede contener letras y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  // Validación para el campo "Email"
  const emailField = createClientForm.querySelector('input[name="email"]');
  emailField.addEventListener('input', function (e) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Formato de email
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("Ingrese un email válido.");
      showError(emailField, "Ingrese un email válido.");
    } else {
      e.target.setCustomValidity("");
      clearError(emailField);
    }
  });

  // Validación para el campo "Número de teléfono"
  const phoneField = createClientForm.querySelector('input[name="phone_number"]');
  phoneField.addEventListener('input', function (e) {
    const regex = /^\d{10}$/; // Solo números, 10 dígitos
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El teléfono debe tener 10 dígitos numéricos.");
      showError(phoneField, "El teléfono debe tener 10 dígitos numéricos.");
    } else {
      e.target.setCustomValidity("");
      clearError(phoneField);
    }
  });

  // Validación para el campo "Suscripción"
  const suscriptionField = createClientForm.querySelector('select[name="suscribed"]');
  suscriptionField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar una opción.");
      showError(suscriptionField, "Debe seleccionar una opción.");
    } else {
      e.target.setCustomValidity("");
      clearError(suscriptionField);
    }
  });

  // Validación para el campo "Contraseña"
  const passwordField = createClientForm.querySelector('input[name="password"]');
  passwordField.addEventListener('input', function (e) {
    if (e.target.value.length < 6) {
      e.target.setCustomValidity("La contraseña debe tener al menos 6 caracteres.");
      showError(passwordField, "La contraseña debe tener al menos 6 caracteres.");
    } else {
      e.target.setCustomValidity("");
      clearError(passwordField);
    }
  });

  // Validación al enviar el formulario
  createClientForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [nameField, emailField, phoneField, suscriptionField, passwordField];
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

// Función para mostrar mensajes de error
function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}

// Función para limpiar mensajes de error
function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}



//edit-client

// Obtener el formulario
const editClientForm = document.querySelector('.editClient-form');

if (editClientForm) {
  // Validación para el campo "Nombre"
  const nameField = editClientForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function (e) {
    const regex = /^[a-zA-Z\s]+$/; // Solo letras y espacios
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El nombre solo puede contener letras y espacios.");
      showError(nameField, "El nombre solo puede contener letras y espacios.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  // Validación para el campo "Email"
  const emailField = editClientForm.querySelector('input[name="email"]');
  emailField.addEventListener('input', function (e) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Formato de email
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("Ingrese un email válido.");
      showError(emailField, "Ingrese un email válido.");
    } else {
      e.target.setCustomValidity("");
      clearError(emailField);
    }
  });

  // Validación para el campo "Número de teléfono"
  const phoneField = editClientForm.querySelector('input[name="phone_number"]');
  phoneField.addEventListener('input', function (e) {
    const regex = /^\d{10}$/; // Solo números, 10 dígitos
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El teléfono debe tener 10 dígitos numéricos.");
      showError(phoneField, "El teléfono debe tener 10 dígitos numéricos.");
    } else {
      e.target.setCustomValidity("");
      clearError(phoneField);
    }
  });

  // Validación para el campo "Suscripción"
  const suscriptionField = editClientForm.querySelector('select[name="suscribed"]');
  suscriptionField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar una opción.");
      showError(suscriptionField, "Debe seleccionar una opción.");
    } else {
      e.target.setCustomValidity("");
      clearError(suscriptionField);
    }
  });

  // Validación para el campo "Contraseña"
  const passwordField = editClientForm.querySelector('input[name="password"]');
  passwordField.addEventListener('input', function (e) {
    if (e.target.value.length < 6) {
      e.target.setCustomValidity("La contraseña debe tener al menos 6 caracteres.");
      showError(passwordField, "La contraseña debe tener al menos 6 caracteres.");
    } else {
      e.target.setCustomValidity("");
      clearError(passwordField);
    }
  });

  // Validación al enviar el formulario
  editClientForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [nameField, emailField, phoneField, suscriptionField, passwordField];
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

// Función para mostrar mensajes de error
function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}

// Función para limpiar mensajes de error
function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}

//create-cupon

// Obtener el formulario
const createCuponForm = document.querySelector('.createcupon-form');
if (createCuponForm) {
  // Validación para el campo "Nombre del cupón"
  const nameField = createCuponForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function (e) {
    if (e.target.value.trim() === "") {
      e.target.setCustomValidity("El nombre del cupón es obligatorio.");
      showError(nameField, "El nombre del cupón es obligatorio.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  // Validación para el campo "Código del cupón"
  const codeField = createCuponForm.querySelector('input[name="code"]');
  codeField.addEventListener('input', function (e) {
    const regex = /^[A-Za-z0-9]+$/; // Solo letras y números
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El código solo puede contener letras y números.");
      showError(codeField, "El código solo puede contener letras y números.");
    } else {
      e.target.setCustomValidity("");
      clearError(codeField);
    }
  });

  // Validación para el campo "Porcentaje de descuento"
  const percentageField = createCuponForm.querySelector('input[name="percentage"]');
  percentageField.addEventListener('input', function (e) {
    if (e.target.value < 0 || e.target.value > 100) {
      e.target.setCustomValidity("El porcentaje de descuento debe estar entre 0 y 100.");
      showError(percentageField, "El porcentaje de descuento debe estar entre 0 y 100.");
    } else {
      e.target.setCustomValidity("");
      clearError(percentageField);
    }
  });

  // Validación para el campo "Monto mínimo requerido"
  const minAmountField = createCuponForm.querySelector('input[name="min_amount"]');
  minAmountField.addEventListener('input', function (e) {
    if (e.target.value < 0) {
      e.target.setCustomValidity("El monto mínimo debe ser un valor positivo.");
      showError(minAmountField, "El monto mínimo debe ser un valor positivo.");
    } else {
      e.target.setCustomValidity("");
      clearError(minAmountField);
    }
  });

  // Validación para el campo "Fecha de inicio"
  const startDateField = createCuponForm.querySelector('input[name="start_date"]');
  startDateField.addEventListener('input', function (e) {
    if (new Date(e.target.value) < new Date()) {
      e.target.setCustomValidity("La fecha de inicio no puede ser anterior a la fecha actual.");
      showError(startDateField, "La fecha de inicio no puede ser anterior a la fecha actual.");
    } else {
      e.target.setCustomValidity("");
      clearError(startDateField);
    }
  });

  // Validación para el campo "Fecha de finalización"
  const endDateField = createCuponForm.querySelector('input[name="end_date"]');
  endDateField.addEventListener('input', function (e) {
    if (new Date(e.target.value) < new Date(startDateField.value)) {
      e.target.setCustomValidity("La fecha de finalización no puede ser anterior a la fecha de inicio.");
      showError(endDateField, "La fecha de finalización no puede ser anterior a la fecha de inicio.");
    } else {
      e.target.setCustomValidity("");
      clearError(endDateField);
    }
  });

  // Validación para el campo "Cantidad mínima de productos"
  const minProductField = createCuponForm.querySelector('input[name="min_product"]');
  minProductField.addEventListener('input', function (e) {
    if (e.target.value < 0) {
      e.target.setCustomValidity("La cantidad mínima de productos debe ser un valor positivo.");
      showError(minProductField, "La cantidad mínima de productos debe ser un valor positivo.");
    } else {
      e.target.setCustomValidity("");
      clearError(minProductField);
    }
  });

  // Validación para el campo "Número máximo de usos"
  const maxUsesField = createCuponForm.querySelector('input[name="max_uses"]');
  maxUsesField.addEventListener('input', function (e) {
    if (e.target.value < 1) {
      e.target.setCustomValidity("El número máximo de usos debe ser al menos 1.");
      showError(maxUsesField, "El número máximo de usos debe ser al menos 1.");
    } else {
      e.target.setCustomValidity("");
      clearError(maxUsesField);
    }
  });

  // Validación para el campo "Solo válido para primera compra"
  const validFirstPurchaseField = createCuponForm.querySelector('select[name="valid_only_first_purchase"]');
  validFirstPurchaseField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar una opción.");
      showError(validFirstPurchaseField, "Debe seleccionar una opción.");
    } else {
      e.target.setCustomValidity("");
      clearError(validFirstPurchaseField);
    }
  });

  // Validación al enviar el formulario
  createCuponForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [nameField, codeField, percentageField, minAmountField, startDateField, endDateField, minProductField, maxUsesField, validFirstPurchaseField];
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

// Función para mostrar mensajes de error
function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}

// Función para limpiar mensajes de error
function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}



//edit-cupon

// Obtener el formulario
const editCuponForm = document.querySelector('.editCupon-form');
if (editCuponForm) {
  // Validación para el campo "Nombre del cupón"
  const nameField = editCuponForm.querySelector('input[name="name"]');
  nameField.addEventListener('input', function (e) {
    if (e.target.value.trim() === "") {
      e.target.setCustomValidity("El nombre del cupón es obligatorio.");
      showError(nameField, "El nombre del cupón es obligatorio.");
    } else {
      e.target.setCustomValidity("");
      clearError(nameField);
    }
  });

  // Validación para el campo "Código del cupón"
  const codeField = editCuponForm.querySelector('input[name="code"]');
  codeField.addEventListener('input', function (e) {
    const regex = /^[A-Za-z0-9]+$/; // Solo letras y números
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El código solo puede contener letras y números.");
      showError(codeField, "El código solo puede contener letras y números.");
    } else {
      e.target.setCustomValidity("");
      clearError(codeField);
    }
  });

  // Validación para el campo "Porcentaje de descuento"
  const percentageField = editCuponForm.querySelector('input[name="percentage"]');
  percentageField.addEventListener('input', function (e) {
    if (e.target.value < 0 || e.target.value > 100) {
      e.target.setCustomValidity("El porcentaje de descuento debe estar entre 0 y 100.");
      showError(percentageField, "El porcentaje de descuento debe estar entre 0 y 100.");
    } else {
      e.target.setCustomValidity("");
      clearError(percentageField);
    }
  });

  // Validación para el campo "Monto mínimo requerido"
  const minAmountField = editCuponForm.querySelector('input[name="min_amount"]');
  minAmountField.addEventListener('input', function (e) {
    if (e.target.value < 0) {
      e.target.setCustomValidity("El monto mínimo debe ser un valor positivo.");
      showError(minAmountField, "El monto mínimo debe ser un valor positivo.");
    } else {
      e.target.setCustomValidity("");
      clearError(minAmountField);
    }
  });

  // Validación para el campo "Fecha de inicio"
  const startDateField = editCuponForm.querySelector('input[name="start_date"]');
  startDateField.addEventListener('input', function (e) {
    if (new Date(e.target.value) < new Date()) {
      e.target.setCustomValidity("La fecha de inicio no puede ser anterior a la fecha actual.");
      showError(startDateField, "La fecha de inicio no puede ser anterior a la fecha actual.");
    } else {
      e.target.setCustomValidity("");
      clearError(startDateField);
    }
  });

  // Validación para el campo "Fecha de finalización"
  const endDateField = editCuponForm.querySelector('input[name="end_date"]');
  endDateField.addEventListener('input', function (e) {
    if (new Date(e.target.value) < new Date(startDateField.value)) {
      e.target.setCustomValidity("La fecha de finalización no puede ser anterior a la fecha de inicio.");
      showError(endDateField, "La fecha de finalización no puede ser anterior a la fecha de inicio.");
    } else {
      e.target.setCustomValidity("");
      clearError(endDateField);
    }
  });

  // Validación para el campo "Cantidad mínima de productos"
  const minProductField = editCuponForm.querySelector('input[name="min_product"]');
  minProductField.addEventListener('input', function (e) {
    if (e.target.value < 0) {
      e.target.setCustomValidity("La cantidad mínima de productos debe ser un valor positivo.");
      showError(minProductField, "La cantidad mínima de productos debe ser un valor positivo.");
    } else {
      e.target.setCustomValidity("");
      clearError(minProductField);
    }
  });

  // Validación para el campo "Número máximo de usos"
  const maxUsesField = editCuponForm.querySelector('input[name="max_uses"]');
  maxUsesField.addEventListener('input', function (e) {
    if (e.target.value < 1) {
      e.target.setCustomValidity("El número máximo de usos debe ser al menos 1.");
      showError(maxUsesField, "El número máximo de usos debe ser al menos 1.");
    } else {
      e.target.setCustomValidity("");
      clearError(maxUsesField);
    }
  });

  // Validación para el campo "Solo válido para primera compra"
  const validFirstPurchaseField = editCuponForm.querySelector('select[name="valid_only_first_purchase"]');
  validFirstPurchaseField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar una opción.");
      showError(validFirstPurchaseField, "Debe seleccionar una opción.");
    } else {
      e.target.setCustomValidity("");
      clearError(validFirstPurchaseField);
    }
  });

  // Validación al enviar el formulario
  editCuponForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [nameField, codeField, percentageField, minAmountField, startDateField, endDateField, minProductField, maxUsesField, validFirstPurchaseField];
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

// Función para mostrar mensajes de error
function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}

// Función para limpiar mensajes de error
function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}

// create-orden


const createOrdenForm = document.querySelector('.createorden-form');

if (createOrdenForm) {
  
  const folioField = createOrdenForm.querySelector('input[name="folio"]');
  folioField.addEventListener('input', function (e) {
    const regex = /^[a-zA-Z0-9-]+$/; // Letras, números y guiones
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El folio solo puede contener letras, números y guiones.");
      showError(folioField, "El folio solo puede contener letras, números y guiones.");
    } else {
      e.target.setCustomValidity("");
      clearError(folioField);
    }
  });

  
  const totalField = createOrdenForm.querySelector('input[name="total"]');
  totalField.addEventListener('input', function (e) {
    const regex = /^\d+(\.\d{1,2})?$/; // Número decimal con hasta 2 decimales
    if (!regex.test(e.target.value)) {
      e.target.setCustomValidity("El total debe ser un número válido (puede incluir hasta 2 decimales).");
      showError(totalField, "El total debe ser un número válido (puede incluir hasta 2 decimales).");
    } else {
      e.target.setCustomValidity("");
      clearError(totalField);
    }
  });

  
  const clientField = createOrdenForm.querySelector('select[name="client_id"]');
  clientField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar un cliente.");
      showError(clientField, "Debe seleccionar un cliente.");
    } else {
      e.target.setCustomValidity("");
      clearError(clientField);
    }
  });

  
  const orderStatusField = createOrdenForm.querySelector('select[name="order_status_id"]');
  orderStatusField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar un estado para la orden.");
      showError(orderStatusField, "Debe seleccionar un estado para la orden.");
    } else {
      e.target.setCustomValidity("");
      clearError(orderStatusField);
    }
  });

  
  const paymentTypeField = createOrdenForm.querySelector('select[name="payment_type_id"]');
  paymentTypeField.addEventListener('change', function (e) {
    if (e.target.value === "") {
      e.target.setCustomValidity("Debe seleccionar un tipo de pago.");
      showError(paymentTypeField, "Debe seleccionar un tipo de pago.");
    } else {
      e.target.setCustomValidity("");
      clearError(paymentTypeField);
    }
  });

  
  const presentationsContainer = document.getElementById('presentations-container');
  presentationsContainer.addEventListener('input', function (e) {
    const presentationItems = presentationsContainer.querySelectorAll('.presentation-item');
    presentationItems.forEach(item => {
      const select = item.querySelector('select');
      const quantity = item.querySelector('input[type="number"]');

      if (!select.value) {
        select.setCustomValidity("Debe seleccionar una presentación.");
        showError(select, "Debe seleccionar una presentación.");
      } else {
        select.setCustomValidity("");
        clearError(select);
      }

      if (!quantity.value || quantity.value <= 0) {
        quantity.setCustomValidity("La cantidad debe ser mayor a 0.");
        showError(quantity, "La cantidad debe ser mayor a 0.");
      } else {
        quantity.setCustomValidity("");
        clearError(quantity);
      }
    });
  });

  
  createOrdenForm.addEventListener('submit', function (e) {
    let isValid = true;
    const fields = [folioField, totalField, clientField, orderStatusField, paymentTypeField];
    fields.forEach(field => {
      if (!field.checkValidity()) {
        isValid = false;
        showError(field, "Este campo es obligatorio o contiene datos incorrectos.");
      } else {
        clearError(field);
      }
    });

    
    const presentationItems = presentationsContainer.querySelectorAll('.presentation-item');
    presentationItems.forEach(item => {
      const select = item.querySelector('select');
      const quantity = item.querySelector('input[type="number"]');
      if (!select.checkValidity() || !quantity.checkValidity()) {
        isValid = false;
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Por favor, corrija los errores antes de enviar el formulario.");
    }
  });
}


function showError(field, message) {
  const error = field.parentNode.querySelector('.error-message');
  if (!error) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
  }
}


function clearError(field) {
  const error = field.parentNode.querySelector('.error-message');
  if (error) {
    error.remove();
  }
}












});
