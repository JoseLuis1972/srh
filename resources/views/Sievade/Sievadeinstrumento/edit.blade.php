<x-template-app.app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <x-template-tittle.tittle-header tittle="Catalogo de Sievade" caption=" Instrumento de gestion del rendimiento de origen" />
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body">
                        <x-template-tittle.tittle-caption
                            tittle="{{ isset($sievade->id_int_gest_rend) ? 'Modificar' : 'Agregar ' }}  Instrumento de gestion del rendimiento de origen"
                            route="{{ route('Sievadeinstrumento.list') }}" />

                        <br>
                        <form action="{{ route('Sievadeinstrumento.edit', $sievade->id_int_gest_rend) }}" method="POST" id="myForm" >
                            @csrf
                            <x-template-form.template-form-input-required label="Descripcion" type="text"
                                name="descripcion" placeholder="Descripcion"
                                grid="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8" autocomplete=""
                                value="{{ $sievade->descripcion }}" />

                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="estatus">Estatus</label>
                                <input type="checkbox" id="estatus" name="estatus" class="toggle-switch" {{ $sievade->estatus ? 'checked' : '' }}>
                            </div>

                            <x-template-button.button-form-footer routeBack="{{ route('Sievadeinstrumento.list') }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('assets/js/app/Sievade/Sievadeinstrumento/validate.js') }}"></script>
</x-template-app.app-layout>
