<div class="row my-3">
    <div class="row justify-content-center align-items-center">
        <input type="hidden" name="id" id="produtoId" value="{{ $id }}">
        <div class="col-sm-12 col-md-6 col-lg-6 mb-3 text-start">
            <label class="form-label">Tipo</label>
            <select name="tipo" id="tipoFilterProduto" class="form-select">
                <option value="">Tipo</option>
                <option value="venda">Venda</option>
                <option value="compra">Compra</option>
            </select>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 mb-3 text-start">
            <label class="form-label">Por</label>
            <select name="por" id="por" class="form-select">
                <option value="">Filtrar por</option>
                <option value="preco">Preço</option>
                <option value="quantidade">Quantidade</option>
            </select>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 mb-3 text-start">
            <label class="form-label">De</label>
            <input type="date" name="de" id="produtoDe" class=" form-control">
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 mb-md-3 mb-lg-3 text-start">
            <label class="form-label">Até</label>
            <input type="date" name="ate" id="produtoAte" class=" form-control">
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 mb-3 pt-4 text-start">
            <button id="analiseProdutoFilter" class="btn btnInfo text-white fw-bold">Filtrar</button>
        </div>
    </div>
</div>
