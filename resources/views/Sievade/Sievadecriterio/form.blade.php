<!-- TEMPLATE APP -->
<x-template-app.app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <x-template-tittle.tittle-header tittle="Catalogo de Sievade" caption="Organizacion" />
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body">
                        <x-template-tittle.tittle-caption
                            tittle="{{ isset($item->id_cat_organizacion) ? 'Modificar' : 'Agregar ' }} Criterio y principios"
                            route="{{ route('Sievadecriterio.list') }}" />

                        <br>
                       <!--<x-template-tittle.tittle-caption-secon tittle="Información Catalogo Beneficio" />-->

                       <form action="{{ route('Sievadecriterio.save') }}" method="POST" class="form-sample" id="myForm">
                        @csrf
                        <x-template-form.template-form-input-required label="Descripcion" type="text"
                            name="descripcion" placeholder="Descripcion"
                            grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                            value="{{ optional($item)->descripcion ?? '' }}" />

                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="estatus">Estatus</label>
                                <input type="checkbox" id="estatus" name="estatus" class="toggle-switch" checked>
                            </div>

                        <x-template-button.button-form-footer routeBack="{{ route('Sievadecriterio.list') }}" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/app/Sievade/Sievadecriterio/validate.js') }}"></script>
</x-template-app.app-layout>
