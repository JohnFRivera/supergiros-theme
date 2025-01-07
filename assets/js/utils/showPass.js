var userPass = document.getElementById('user_pass');
var showPass = document.getElementById('show_pass');

const handleShowPass = () => {
  var icon = showPass.children.item(0);
  if (userPass.type === 'password') {
    userPass.type = 'text';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  } else {
    userPass.type = 'password';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  }
};

showPass.addEventListener('click', handleShowPass);
