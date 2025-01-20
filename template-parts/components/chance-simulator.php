<div class="position-relative shadow rounded-1 mb-4">
    <div class="banner-chance rounded-top-1" style="height: 170px;">
        <div class="h-100 align-content-end">
            <div class="bg-white rounded-top-circle" style="height: 85px;"></div>
        </div>
    </div>
    <img class="position-absolute top-0 start-50 translate-middle-x mt-4" src="<?php echo esc_url(sgnv_get_image_url('logos/logo-chance.webp')) ?>" alt="Logo Chance" width="180px">
    <div class="bg-white rounded-bottom-1">
        <form class="w-50 mx-auto mb-4" id="frmSimulador">
            <label class="w-100 text-center fw-medium mb-1" style="color: #093B81;" for="ipMonto">Monto</label>
            <div class="shadow-sm rounded-1 mb-2">
                <input class="form-control shadow-none bg-white rounded-1 text-center" placeholder="$0" type="text" id="ipMonto" autocomplete="off" required />
            </div>
            <label class="w-100 text-center fw-medium mb-1" style="color: #093B81;" for="slModalidad">Modalidad</label>
            <div class="shadow-sm rounded-1 mb-4">
                <select class="form-select shadow-none bg-white rounded-1 text-center" id="slModalidad" required>
                    <option value="5">1 CIFRA</option>
                    <option value="50">2 CIFRA</option>
                    <option value="400">3 CIFRA</option>
                </select>
            </div>
            <button class="btn btn-secondary rounded-1 w-100 mb-2" type="submit" id="btnCalcular">Calcular</button>
        </form>
        <div class="collapse" id="collapseDetalle">
            <div class="bg-danger mb-4 py-4 px-5">
                <div class="mb-4">
                    <h6 class="text-white text-center fw-bold lh-1 mb-0">PREMIO</h6>
                    <h1 class="text-center fw-bolder lh-1" style="color: #FED612;">
                        <span class="h4 fw-bold align-top me-1">$</span><span id="spanPremio">300.000.000</span>
                    </h1>
                </div>
                <div class="position-relative hstack gap-4 border rounded-1 text-white py-3 px-4">
                    <h6 class="position-absolute top-0 start-50 translate-middle text-bg-danger fw-bold px-2">DETALLE</h6>
                    <div class="w-50">
                        <div class="vstack gap-2">
                            <div class="hstack align-items-center justify-content-between">
                                <small>Valor Bruto</small>
                                <small id="spanVlrBruto">$0</small>
                            </div>
                            <div class="hstack align-items-center justify-content-between">
                                <small>Valor IVA</small>
                                <small id="spanVlrIVA">$0</small>
                            </div>
                            <div class="hstack align-items-center justify-content-between">
                                <small>Valor Neto</small>
                                <small id="spanVlrNeto">$0</small>
                            </div>
                        </div>
                    </div>
                    <div class="vr"></div>
                    <div class="w-50">
                        <div class="vstack gap-2">
                            <div class="hstack align-items-center justify-content-between">
                                <small>Premio Bruto</small>
                                <small id="spanPrmBruto">$0</small>
                            </div>
                            <div class="hstack align-items-center justify-content-between">
                                <small>Retención 20%</small>
                                <small id="spanPrmRetencion">$0</small>
                            </div>
                            <div class="hstack align-items-center justify-content-between">
                                <small>Premio Neto</small>
                                <small id="spanPrmNeto">$0</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <small class="d-block opacity-75 text-center lh-1 px-4 pb-4">Al reclamar un premio recuerda revisar los <a href="#">Requisitos para Pago de Premios</a></small>
    </div>
</div>
