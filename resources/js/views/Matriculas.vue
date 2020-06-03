<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Matrículas</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content mt-0">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card-header">
              <div class="row">
                <div class="col-6">
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">Documento</label>
                      <input class="form-control" type="text" v-model="docEstudiante" />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <button class="btn btn-primary" @click="buscarEstudiante()">Buscar</button>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="bg-navy" />
              <form>
                <div class="form-group">
                  Estudiante
                  <input class="form-control" type="text" v-model="estudiante.nombre" />
                  Periodo
                  <select class="form-control" disabled>
                    <option value="2020-2">2020-02</option>
                    <option value="2021-1">2021-01</option>
                    <option value="2021-2">2021-02</option>
                    <option value="2022-1">2022-01</option>
                  </select>
                </div>
                <hr class="bg-navy" />
                <div class="form-group">
                  <label for class="col-form-label">Programa</label>
                  <select class="form-control" v-model="id_programa" @click="buscarMaterias()">
                    <option
                      v-for="option in programas"
                      :key="option.id"
                      :value="option.id"
                    >{{ option.nombre }}</option>
                  </select>
                </div>
              </form>

              <div class="col-8">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-search"></i>
                    </span>
                  </div>
                  <input id="filtro" type="text" class="form-control" @keyup="filtrarTabla()" />
                </div>
                <div class="input-group mb-3">
                  <div class="form-group col">
                  <!-- <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  data-toggle="modal"
                  data-target="#modal-nuevo"
                  >Guardar Matrícula</button> -->
                  <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  @click="insertarMatricula()"
                  >Guardar Matrícula</button>
                  </div>
                 <div class="form-group col">
                    <button
                    type="button"
                    class="btn btn-secondary btn-block"
                    @click="reporteMatricula()"
                    >Ver Liquidación</button>
                 </div>
                </div>
              </div>
              <!-- Datos: {{seleccionados}} -->
              <div class="table-responsive-sm">
                <table
                  id="tablaDatos"
                  class="table table-condensed table-bordered table-hover table-sm">
                  <thead>
                    <tr class="text-center bg-navy">
                      <th style="width: 5%;">#</th>
                      <th style="width: 5%;">ID</th>
                      <th style="width: 10%;">Código</th>
                      <th style="width: 45%;">Nombre</th>
                      <th style="width: 15%;">Semestre</th>
                      <th style="width: 10%;">Creditos</th>
                      <th style="width: 10%;">Valor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(materia, index) in materias" :key="materia.id">
                      <td class="text-center col-acciones">
                        <input type="checkbox" aria-label="" v-model="seleccionados" :value="materia" @change="sumarMateria()">
                      </td>
                      <td class="text-center">
                        <div>{{ index + 1 }}</div>
                      </td>
                      <td>
                        <div>{{ materia.codigo }}</div>
                      </td>
                      <td>
                        <div>{{ materia.nombre }}</div>
                      </td>
                      <td>
                        <div>{{ materia.semestre }}</div>
                      </td>
                      <td>
                        <div>{{ materia.creditos }}</div>
                      </td>
                      <td>
                        <div>{{ materia.valor }}</div>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <!-- contenido -->
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <!-- Formulario Modal para Nuevo Registro -->
      <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title">Nueva Matrícula</h4>
              <button
                type="button"
                class="close text-white"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="input-group mb-3" v-for="materia in seleccionados" :key="materia.id">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Código</span> -->
                      </div>
                      <label for>Código</label>
                      <input type="text" class="form-control" :value="materia.codigo"/>
                    </div>
                  </div>
                  <label for>Subtotal</label>
                    <input type="text" class="form-control" :value="valor_matricula"/>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-center">
              <div class="col-6">
                <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  @click="insertarMatricula()"
                >Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin Formulario Modal para Nuevo Registro -->
    </section>
    <!-- Fin Sección Formularios Modales -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: "",
      docEstudiante: "",
      estudiante: [],
      programas: {},
      id_programa: "",
      materias: {},
      creditos_a_matricular: 0,
      valor_matricula: 0,
      seleccionados: [],
      orden_pago: {
        fecha_pago_ordinario: "",
        fecha_pago_extra: "",
        subtotal: "",
        descuento: 0,
        id_estudiante: "",
        periodo: ""
      },
      maxima: 0,
      matricula: {
        id_materia: 0,
        id_orden_pago: 0
      },
      linkPdf: ''
    };
  },
  mounted() {
    this.getMaxima();
  },
  methods: {
    sumarMateria(){
      if(this.seleccionados.length > 0){
        this.creditos_a_matricular = 0;
        this.valor_matricula = 0;
        for(let i = 0;i<this.seleccionados.length;i++){
          this.creditos_a_matricular += this.seleccionados[i].creditos;
          this.valor_matricula += this.seleccionados[i].valor;
        }
        //console.log('Total Creditos:' + this.creditos_a_matricular)
        //console.log('Total Valor:' + this.valor_matricula)
        console.log('Total Valor:' + this.seleccionados)
      }      
    },
    insertarMatricula() {
      if(this.seleccionados.length < 7 && this.seleccionados.length > 0){
        if(this.creditos_a_matricular < 19){

          this.orden_pago = {
            id: this.maxima + 1,
            fecha_pago_ordinario: "2020-06-21",
            fecha_pago_extra: "2020-07-21",
            subtotal: this.valor_matricula,
            descuento: 0,
            id_estudiante: this.estudiante.id,
            periodo: "2020-02"
          };
          axios
            .post(this.urlBase + "api/orden_pago", this.orden_pago)
            .then(data => {
              this.grabarMatricula();
            })
            .catch(err => {
              console.log(err);
            });
        }else{
          this.showNotification(
            "warning",
            "No puede seleccionar más de 18 créditos",
            "Insertar Matrícula"
          );
        }
      }else {
        this.showNotification(
            "warning",
            "No puede seleccionar más de 6 materias o no seleccionar ninguna",
            "Insertar Matrícula"
          );
      }
    },
    async grabarMatricula(){
      for(let i = 0;i<this.seleccionados.length;i++){
        this.matricula = {
          id_materia: this.seleccionados[i].id,
          id_orden_pago: this.maxima + 1
        };
        await axios.post(this.urlBase + "api/matriculas", this.matricula);
      }
      this.showNotification(
        "success",
        "Matriculado correctamente",
        "Insertar Matrícula"
      );
      this.reporteMatricula();
    },
    reporteMatricula(){
      this.linkPdf = this.urlBase + "matriculas/estudiante/"+ this.docEstudiante;
      window.open(this.linkPdf, '_blank');
    },
    buscarEstudiante() {
      let url =
        this.urlBase + "api/estudiantes/documento/" + this.docEstudiante;
      axios
        .get(url)
        .then(data => {
          console.log(data.data.estudiante)
          this.estudiante = data.data.estudiante;
          this.getProgramas();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getProgramas() {
      axios.get(this.urlBase + "api/programas").then(data => {
        this.programas = data.data.programas;
      });
    },
    buscarMaterias() {
      /* axios.get(this.urlBase + "api/materias").then(data => {
        this.materias = data.data.materias;
        console.log(this.id_programa)
      }); */
      let url2 =
        this.urlBase + "api/materias/programa/" + this.id_programa;
      axios
        .get(url2)
        .then(data => {
          this.materias = data.data.materias;
          //this.getProgramas();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getMaxima() {
      axios.get(this.urlBase + "api/orden_pago").then(data => {
        console.log(data.data.ordenPago)
        this.maxima = data.data.ordenPago;
      });
    }
  },
  
};
</script>
