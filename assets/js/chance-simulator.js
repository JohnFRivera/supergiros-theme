const frmSimulador = document.getElementById('frmSimulador');
const ipMonto = document.getElementById('ipMonto');
const slModalidad = document.getElementById('slModalidad');
const btnCalcular = document.getElementById('btnCalcular');

const collapseDetalle = new bootstrap.Collapse('#collapseDetalle', {
  toggle: false,
});

const spanPremio = document.getElementById('spanPremio');

const spanVlrBruto = document.getElementById('spanVlrBruto');
const spanVlrIVA = document.getElementById('spanVlrIVA');
const spanVlrNeto = document.getElementById('spanVlrNeto');

const spanPrmBruto = document.getElementById('spanPrmBruto');
const spanPrmRetencion = document.getElementById('spanPrmRetencion');
const spanPrmNeto = document.getElementById('spanPrmNeto');

const IVA = 0.19;
const LIMITE = 2259000;
const RETENCION = 0.2;

// Funciones
const numberFormat = (value) => {
  return value.toLocaleString('es-CO');
};
function removeFormat(value) {
  let number = value.replace(/[^\d]/g, '');
  return parseInt(number, 10);
}
const calcularPremio = (monto = 0, modalidad = 0) => {
  let vlrBruto = parseInt(monto);
  let vlrIVA = vlrBruto * IVA;
  let vlrNeto = vlrBruto - vlrIVA;
  let prmBruto = vlrNeto * modalidad;
  let prmRetencion = prmBruto >= LIMITE ? prmBruto * RETENCION : 0;
  let prmNeto = prmBruto - prmRetencion;

  spanPremio.innerHTML = numberFormat(prmNeto);

  spanVlrBruto.innerHTML = `$ ${numberFormat(vlrBruto)}`;
  spanVlrIVA.innerHTML = `$ ${numberFormat(vlrIVA)}`;
  spanVlrNeto.innerHTML = `$ ${numberFormat(vlrNeto)}`;
  spanPrmBruto.innerHTML = `$ ${numberFormat(prmBruto)}`;
  spanPrmRetencion.innerHTML = `$ ${numberFormat(prmRetencion)}`;
  spanPrmNeto.innerHTML = `$ ${numberFormat(prmNeto)}`;
};

// Eventos
const handleInputMonto = (e) => {
  let monto = e.target.value;
  monto = monto.replace(/[^\d]/g, '');

  if (monto) {
    monto = parseInt(monto).toLocaleString('es-CO');
  }
  e.target.value = '$' + monto;
};
const handleCalcular = async (e) => {
  e.preventDefault();
  if (frmSimulador.reportValidity()) {
    btnCalcular.innerText = 'Volver a Jugar';
    btnCalcular.classList.replace('btn-secondary', 'btn-danger');
    await collapseDetalle.show();
    calcularPremio(removeFormat(ipMonto.value), slModalidad.value);
    frmSimulador.removeEventListener('submit', handleCalcular);
    frmSimulador.addEventListener('submit', handleReiniciarSimulador);
  }
};
const handleReiniciarSimulador = async (e) => {
  e.preventDefault();
  await collapseDetalle.hide();
  btnCalcular.innerText = 'Calcular';
  btnCalcular.classList.replace('btn-danger', 'btn-secondary');
  ipMonto.value = '';
  frmSimulador.removeEventListener('submit', handleReiniciarSimulador);
  frmSimulador.addEventListener('submit', handleCalcular);
};
ipMonto.addEventListener('input', handleInputMonto);
frmSimulador.addEventListener('submit', handleCalcular);
