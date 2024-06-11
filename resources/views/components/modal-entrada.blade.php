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
                    <div class="mb-3">
                        <label for="selecionar" class="form-label">Motivo</label>
                        <select name="selecionar" id="motivoEntrada" class="form-select" required>
                            <option value="">Selecione um Motivo</option>
                            @foreach (MOTIVO_ENTRADA as $key => $value)
                                <option value="{{ $key }}" data-motivo="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-none" id="modalCompras">
                        <x-modal-entrada-compra :entradas="$entradas" />
                    </div>

                    <div class="d-none" id="modalEntradas">
                        <x-modal-entradas :produtos="$produtos" />
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
