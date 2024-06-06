<div>
    <div class="modal fade" id="entrada" aria-hidden="true" aria-labelledby="entradaLabel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-success text-center" id="entradaLabel">
                        Entrada
                        <i class="bi bi-plus-circle-fill ms-1"></i>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('entrada.produtos') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo</label>
                            <select name="motivo" id="motivoEntrada" class="form-select" required>
                                <option value="">Selecione um Motivo</option>
                                @foreach (MOTIVO_ENTRADA as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="fornecedor">
                            <label for="fornecedor" class="form-label">Fornecedor</label>
                            <select name="fornecedor" class="form-select" required>
                                <option value="">Selecione um Fornecedor</option>
                                @foreach ($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->fornecedor }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produto" class="form-label">Produto</label>
                            <select name="produto" id="produto" class="form-select" required>
                                <option value="">Selecione um Produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->produto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex  justify-content-between mb-4">
                            <div class="col-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" name="quantidade" id="quantidade" class="form-control" required>
                            </div>

                            <div class="col-3">
                                <label for="valor_unidade" class="form-label">Valor Uni.</label>
                                <input type="number" name="valor_unidade" id="valor_unidade" class="form-control"
                                    required>
                            </div>

                            <div class="col-3">
                                <label for="frete" class="form-label">Frete</label>
                                <input type="number" name="frete" id="frete" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">
                                Entrar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
