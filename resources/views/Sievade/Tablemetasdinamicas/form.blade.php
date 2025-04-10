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
                            tittle="{{ isset($item->id_val_ind) ? 'Modificar' : 'Agregar ' }} Valor de Indicador"
                            route="{{ route('Tablemetasdinamicas.list') }}" />
                        <br>
                       <!--<x-template-tittle.tittle-caption-secon tittle="Información Catalogo Beneficio" />-->

                       <form action="{{ route('Tablemetasdinamicas.save') }}" method="POST" class="form-sample" id="myForm">
                       @csrf


                        <div class="row">

                          <x-template-form.template-form-select-required :selectValue=" $selecalineacion"
                              :selectEdit=" $selecalineacionEdit" name="id_alineacion_pnd" tittle="Alineación al PND"
                              grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />


                           <x-template-form.template-form-select-required :selectValue=" $selectMetaI"
                              :selectEdit=" $selectMetaIEdit" name="id_meta_individual" tittle="Tipo de Mesa Individual"
                              grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />
                        </div>

                        <div class="row">
                          <x-template-form.template-form-select-required :selectValue=" $selectinstrumento"
                             :selectEdit=" $selectinstrumentoEdit" name="id_int_gest_rend" tittle="Instrumento de Gestión"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />
                        </div>

                        <hr style="height: 3px; background-color: grey; border: none;">
                           <h5 style="text-align: center;">DESCRIPCION DEL OBJETIVO O META INSTITUCIONAL</h5>
                        <hr style="height: 3px; background-color: grey; border: none;">


                         <div class="row">
                          <x-template-form.template-form-select-required :selectValue=" $selectverbo"
                             :selectEdit=" $selectverboEdit" name="id_verbo" tittle="Verbo en infinitivo"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />
                        </div>


                        <div class="row">
                          <x-template-form.template-form-input-required label="Descripción de Objetivo y/o Meta, Objetivo y/o Función" type="text"
                             name="desc_um_medicina" placeholder="DESCRIPCION DE OBJETIVO Y/O FUNCION, Y/O FUNCION"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->desc_um_medicina ?? '' }}" />
                         </div>

                         <div class="row">
                          <x-template-form.template-form-input-required label="Objetivo de Contribución" type="text"
                             name="obj_contribucion" placeholder="OBJETIVO DE CONTRIBUCION"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->obj_contribucion ?? '' }}" />
                         </div>


                        <hr style="height: 3px; background-color: grey; border: none;">
                           <h5 style="text-align: center;">DESCRIPCION DE LOS PARAMETROS DE EVALUACIÓN</h5>
                        <hr style="height: 3px; background-color: grey; border: none;">


                       <div class="row">
                          <x-template-form.template-form-input-required label="Satisfactorio" type="text"
                             name="satisfactorio" placeholder="SATISFACTORIO"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->satisfactorio ?? '' }}" />
                         </div>


                        <div class="row">
                          <x-template-form.template-form-input-required label="No Satisfactorio" type="text"
                             name="no_satisfactorio" placeholder="NO SATISFACTORIO"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->no_satisfactorio ?? '' }}" />
                         </div>

                         <div class="row">
                          <x-template-form.template-form-input-required label="Deficiente" type="text"
                             name="no_aprobatorio" placeholder="DEFICIENTE"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->no_aprobatorio ?? '' }}" />
                         </div>


                        <hr style="height: 3px; background-color: grey; border: none;">


                        <div class="row">
                          <x-template-form.template-form-select-required :selectValue=" $selecunidad"
                             :selectEdit=" $selecunidadEdit" name="id_tipo_unidad" tittle="Tipo de Unidad  de Medida"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />
                        </div>


                        <div class="row">
                          <x-template-form.template-form-input-required label="Porcentaje Asignado" type="text"
                             name="peso_ind" placeholder="PORCENTAJE ASIGNADO"
                             grid="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" autocomplete=""
                             value="{{optional($item)->peso_ind ?? '' }}" />
                         </div>

                       <h5 style="height: 3px; background-color: grey; border: none;">
                       <h5 style="text-align: center;">  PARAMETROS DE EVALUACIÓN</h5>
                       <h5 style="height: 3px; background-color: grey; border: none;"></h5><br>
                       <h5 style="text-align: left;">  PARAMETROS </h5><br>
                       <h5 style="text-align: left;">  *   EXCELENTE :  Solo aplica cuando el logro de la meta es superior en terminos de la unidad de medida inicialmente</h5>
                       <h5 style="text-align: left;">                   programado y debera ser documentado de acuerdo a la fuente citadas en el  establecimiento de metas.  </h5>
                       <h5 style="text-align: left;">
                       <h5 style="text-align: left;">  *   SATISFACTORIO :  entre 85% y 95%  </h5>
                       <h5 style="text-align: left;">  *   ACEPTABLE :   del 75%  al 84%  </h5>
                       <h5 style="text-align: left;">  *   NO ACEPTABLE : Menor al 75%  </h5>


                       <div class="row">
                           <x-template-form.template-form-select-required :selectValue=" $selectMetaI"
                              :selectEdit=" $selectMetaIEdit" name="id_meta_individual" tittle="Valor del parámetro  alcanzado"
                              grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" />

                          <x-template-form.template-form-input-required label="Unidad de Medida"
                             name="desc_um_medicina" placeholder="UNIDAD DE MEDIDA"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" autocomplete=""
                             value="{{optional($item)->desc_um_medicina ?? '' }}" />
                        </div>

                        <div class="row">
                          <x-template-form.template-form-input-required label="Ponderación" type="text"
                             name="desc_um_medicina" placeholder="PONDERACION"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" autocomplete=""
                             value="{{optional($item)->desc_um_medicina ?? '' }}" />

                          <x-template-form.template-form-input-required label="Calificación" type="text"
                             name="desc_um_medicina" placeholder="CALIFICACION"
                             grid="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" autocomplete=""
                             value="{{optional($item)->desc_um_medicina ?? '' }}" />
                        </div>

                       <h5 style="text-align: left;">  Unidad de Medida: </h5><br>
                       <h5 style="text-align: left;">  Peso o Ponderación:   25  %  </h5>
                       <h5 style="text-align: left;">  Una vez incorporada o verificada toda la información de las metas de desempeño individual, puede procederse a calificarlas </h5>
                       <h5 style="text-align: left;">  seleccionando el valor del  parámetro de resultado alcanzado, de acuerdo a los soportes de evidencia</h5>


                        <x-template-button.button-form-footer routeBack="{{ route('Tablemetasdinamicas.list') }}" />

                       </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/app/Sievade/Tablemetasdinamicas/validate.js') }}"></script>
</x-template-app.app-layout>
