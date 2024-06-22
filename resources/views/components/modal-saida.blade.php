<div>
    <div class="modal fade" id="saida" aria-hidden="true" aria-labelledby="saidaLabel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger text-center" id="saidaLabel">
                        Saída
                        <i class="bi bi-dash-circle-fill ms-1"></i>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Motivo</label>
                        <select name="motivo" id="motivoSaida" class="form-select" required>
                            <option value="">Selecione um Motivo</option>
                            @foreach (MOTIVO_SAIDA as $key => $value)
                                <option value="{{ $key }}" data-motivo="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="d-none" id="modalVendas">
                        <x-modal-saidas-venda :saidas="$saidas" />
                    </div>

                    <div class="d-none" id="modalSaidas">
                        <x-modal-saidas :produtos="$produtos" />
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
