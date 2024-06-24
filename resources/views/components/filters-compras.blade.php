<div class="row my-3">
    <div class="row justify-content-between align-items-center">

        <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" id="tipoFilterCompra" class="form-select">
                <option value="">Tipo</option>
                <option value="preco">Preço</option>
                <option value="quantidade">Quantidade</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
            <label class="form-label">De</label>
            <input type="date" name="de" id="compraDe" class=" form-control">
        </div>

        <div class="col-sm-12 col-md-3 col-lg-3 mb-md-3 mb-lg-3">
            <label class="form-label">Até</label>
            <input type="date" name="ate" id="compraAte" class=" form-control">
        </div>

        <div class="col-sm-12 col-md-2 col-lg-2 mb-3 pt-4">
            <button id="compraFilter" class="btn btnInfo text-white fw-bold">Filtrar</button>
        </div>
    </div>
</div>
