<x-template-app.app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <x-template-tittle.tittle-header tittle="Catalogo de Sievade" caption=" Catalogo Valor de Indicador" />
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body">
                        <x-template-tittle.tittle-caption
                            tittle="{{ isset($sievade->id_val_ind) ? 'Modificar' : 'Agregar ' }}  Catalogo Valor de Indicador"
                            route="{{ route('Sievadevalor.list') }}" />

                        <br>
                        <form action="{{ route('Sievadevalor.edit', $sievade->id_val_ind) }}" method="POST" id="myForm">
                            @csrf
                            <x-template-form.template-form-input-required label="Descripcion" type="text"
                                name="descripcion" placeholder="Descripcion"
                                grid="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8" autocomplete=""
                                value="{{ $sievade->descripcion }}" />

                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="estatus">Estatus</label>
                                <input type="checkbox" id="estatus" name="estatus" class="toggle-switch" {{ $sievade->estatus ? 'checked' : '' }}>
                            </div>

                            <x-template-button.button-form-footer routeBack="{{ route('Sievadevalor.list') }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/app/Sievade/Sievadevalor/validate.js') }}"></script>
</x-template-app.app-layout>

