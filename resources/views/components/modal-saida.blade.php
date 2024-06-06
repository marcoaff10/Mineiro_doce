<div>
    <div class="modal fade" id="saida" aria-hidden="true" aria-labelledby="saidaLabel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-secondary text-center" id="saidaLabel">
                        Saída
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
                                <option value="">Selecione um Motivo</option>
                                @foreach (MOTIVO_SAIDA as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="cliente">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select name="cliente" class="form-select" required>
                                <option value="">Selecione um Fornecedor</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->cliente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="col-5">
                                <label for="produto" class="form-label">Produto</label>
                                <select name="produto" id="produtoSaida" class="form-select" required>
                                    <option value="">Selecione um Produto</option>
                                    @foreach ($produtos as $produto)
                                        <option value="{{ $produto->id }}" data-estoque="{{$produto->id}}">
                                            {{ $produto->produto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-5">
                                <label class="form-label d-block">Estoque:</label>
                                <span id="estoque"></span>
                                <input type="hidden" id="estoqueHidden" value="">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="col-3" id="divQuantidade">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" name="quantidade" id="quantidadeSaida" class="form-control"
                                    required>
                                <div class="text-danger text-center alert-danger mt-2 d-none" id="error">Estoque
                                    insuficiente.</div>
                            </div>

                            <div class="col-3">
                                <label for="valor_unidade" class="form-label">Valor Uni.</label>
                                <input type="number" name="valor_unidade" id="valor_unidadeSaida" class="form-control"
                                    required>
                            </div>

                            <div class="col-3">
                                <label for="frete" class="form-label">Frete</label>
                                <input type="number" name="frete" id="freteSaida" class="form-control" required>
                            </div>


                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary" id="baixar" >
                                Baixar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
