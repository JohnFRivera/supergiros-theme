const innerError = (error, container) => {
  let title = '';
  let message = '';
  switch (error.name) {
    case 'TypeError':
      title = 'Error de tipos';
      message = `Se intenta realizar una operación en un tipo de datos incompatible. <b>${error.message}.</b>`;
      break;
    case 'ReferenceError':
      title = 'Error de referencia';
      message = `Intenta acceder a una variable que no ha sido declarada. <b>${error.message}.</b>`;
      break;
    case 'SyntaxError':
      title = 'Error de sintaxis';
      message = `Hay un error de sintaxis en el código. <b>${error.message}.</b>`;
      break;
    case 'RangeError':
      title = 'Error de rango';
      message = `Un valor está fuera del rango permitido. <b>${error.message}.</b>`;
      break;
    default:
      title = error.name;
      message = error.message;
      break;
  }
  container.innerHTML = `
    <div class="w-100 align-content-center" style="height: ${container.clientHeight}px;">
        <div class="w-50 shadow-sm bg-body rounded-1 mx-auto p-3 alert alert-dismissible fade show" role="alert">
            <div class="d-flex justify-content-between">
                <h5 class="text-danger mb-3">
                    <i class="bi bi-x-circle-fill me-1"></i>
                    ${title}
                </h5>
                <button type="button" class="btn-close small shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <p class="mb-3">${message}</p>
            <div class="bg-danger bg-opacity-75 rounded-1 p-3">
              <p class="small font-monospace text-white lh-sm mb-0">${error.stack}</p>
            </div>
        </div>
    </div>
    `;
};
