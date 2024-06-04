<div>
    <div class="modal fade" id="saida" aria-hidden="true" aria-labelledby="saidaLabel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-secondary text-center" id="saidaLabel">
                        Entrada
                        <i class="bi bi-dash-circle-fill ms-1"></i>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('saida.produtos') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo</label>
                            <select name="motivo" id="motivoSaida" class="form-select" required>
                                <option value="">Selecione um motivo para a saida</option>
                                <option value="venda">Venda</option>
                                <option value="doacao">Doação</option>
                                <option value="avulso">Avulso</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="cliente">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select name="cliente" class="form-select">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->cliente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 ">
                            <label for="produto" class="form-label">Produto</label>
                            <select name="produto" id="produtoSaida" class="form-select" required>
                                <option value="">Selecione um produto</option>
                                @foreach ($produtos->items() as $produto)
                                    <option value="{{ $produto->id }}">
                                        {{ $produto->produto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-md-flex d-lg-flex justify-content-between mb-4">
                            <div class="col-sm-12 col-md-5 col-lg-5 mb-3 d-flex justify-content-between">
                                <div class="col-5">
                                    <label for="quantidade" class="form-label">Quantidade</label>
                                    <input type="number" name="quantidade" id="quantidadeSaida" class="form-control"
                                        required>
                                </div>

                                <div class="col-5">
                                    <label for="valor_unidade" class="form-label">Valor Uni.</label>
                                    <input type="number" name="valor_unidade" id="valor_unidadeSaida" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-5 col-lg-5 mb-3 d-flex justify-content-between">
                                <div class="col-5">
                                    <label for="frete" class="form-label">Frete</label>
                                    <input type="number" name="frete" id="freteSaida" class="form-control" required>
                                </div>

                                <div class="col-5">
                                    <label for="valor_total" class="form-label">Ganho Bruto</label>
                                    <input type="number" name="valor_total" id="valor_totalSaida" class="form-control"
                                        required>
                                </div>

                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary">
                                Baixar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
