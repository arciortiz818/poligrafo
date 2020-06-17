<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Materias</h1>
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
                <div class="col-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-search"></i>
                      </span>
                    </div>
                    <input
                      id="filtro"
                      type="text"
                      class="form-control"
                      @keyup="filtrarTabla()"
                      placeholder="Filtrar por Nombre"
                    />
                  </div>
                </div>
                <div class="col-2 offset-6">
                  <button
                    class="btn bg-navy"
                    data-toggle="modal"
                    data-target="#modal-nuevo"
                    @click="resetMateriaSeleccionada()"
                  >
                    <i class="fas fa-plus-square mr-2"></i>Nueva Materia
                  </button>
                </div>
              </div>
              <hr class="bg-navy" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <!-- Tabla de Registros -->
            <div class="table-responsive-sm">
              <table
                id="tablaDatos"
                class="table table-condensed table-bordered table-hover table-sm"
              >
                <thead>
                  <tr class="text-center bg-navy">
                    <th style="width: 5%;">ID</th>
                    <th style="width: 30%;">Nombre</th>
                    <th style="width: 25%;">Programa</th>
                    <th style="width: 15%;">Semestre</th>
                    <th style="width: 5%;">Creditos</th>
                    <th style="width: 10%;">Valor</th>
                    <th style="width: 10%;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(materia, index) in materias" :key="materia.id">
                    <td class="text-center">
                      <div>{{ index + 1 }}</div>
                    </td>
                    <td>
                      <div>{{ materia.nombre }}</div>
                    </td>
                    <td>
                      <div>{{ materia.nombre_programa }}</div>
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
                    <td class="text-center col-acciones">
                      <div class="justify-content-">
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-editar"
                          @click="cargarMateria(materia)"
                        >
                          <i class="fas fa-edit fa-lg"></i>
                        </button>
                        <span class="col"></span>
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-eliminar"
                          @click="cargarMateria(materia)"
                        >
                          <i class="fas fa-trash fa-lg"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Fin Tabla de Registros -->
            <div class="col-md-12 text-center">
              <ul class="pagination pagination-lg pager" id="developer_page"></ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sección Formularios Modales -->
    <section class="content">
      <!-- Formulario Modal para Nuevo Registro -->
      <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title">Nueva Materia</h4>
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
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Código</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-keyboard"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.codigo"
                        type="text"
                        placeholder="Código Materia"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.nombre"
                        type="text"
                        placeholder="Nombre Materia"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-list-ol"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.semestre"
                        type="text"
                        placeholder="Semestre"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-edit mr-2"></i> Programa
                      </label>
                      <select
                        class="form-control"
                        v-model="materiaSeleccionada.id_programa"
                        placeholder="Programa"
                      >
                        <option
                          v-for="option in programas"
                          :key="option.id"
                          :value="option.id"
                        >{{ option.nombre }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-credit-card mr-2"></i> Créditos
                      </label>
                      <input
                        v-model="materiaSeleccionada.creditos"
                        type="text"
                        placeholder="Créditos"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-money-bill-alt mr-2"></i> Vr. Crédito
                      </label>
                      <input
                        v-model="materiaSeleccionada.valor"
                        placeholder="Valor / Crédito"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-center">
              <div class="col-6">
                <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  @click="insertarMateria()"
                >Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin Formulario Modal para Nuevo Registro -->

      <!-- Formulario Modal para Editar Registro -->
      <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title">Editar Materia</h4>
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
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Código</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-keyboard"></i>
                      </label>
                      <input v-model="materiaSeleccionada.codigo" type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input v-model="materiaSeleccionada.nombre" type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-list-ol"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.semestre"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-edit"></i>
                      </label>
                      <select class="form-control" v-model="materiaSeleccionada.id_programa">
                        <option
                          v-for="option in programas"
                          :key="option.id"
                          :value="option.id"
                        >{{ option.nombre }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">Creditos</label>
                      <input
                        v-model="materiaSeleccionada.creditos"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-money-bill-alt"></i>
                      </label>
                      <input v-model="materiaSeleccionada.valor" type="email" class="form-control" />
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-center">
              <div class="col-6 offset-3">
                <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  @click="actualizarMateria()"
                >Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin Formulario Modal para Editar Registro -->

      <!-- Formulario Modal para Eliminar Registro -->
      <div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title">Eliminar Materia</h4>
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
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Código</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-keyboard"></i>
                      </label>
                      <input v-model="materiaSeleccionada.codigo" type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input v-model="materiaSeleccionada.nombre" type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-list-ol"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.semestre"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-edit"></i>
                      </label>
                      <select class="form-control" v-model="materiaSeleccionada.id_programa">
                        <option
                          v-for="option in programas"
                          :key="option.id"
                          :value="option.id"
                        >{{ option.nombre }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-credit-card"></i>
                      </label>
                      <input
                        v-model="materiaSeleccionada.creditos"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-money-bill-alt"></i>
                      </label>
                      <input v-model="materiaSeleccionada.valor" type="email" class="form-control" />
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-center">
              <div class="col-6 offset-3">
                <button
                  type="button"
                  class="btn btn-secondary btn-block"
                  @click="eliminarMateria()"
                >Eliminar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin Formulario Modal para Eliminar Registro -->
    </section>
    <!-- Fin Sección Formularios Modales -->
  </div>
</template>

<style>
tbody > tr {
  line-height: 20px;
}
td > div {
  height: 20px;
  vertical-align: middle;
}
.col-acciones button {
  padding: 0px 0px 0px 0px;
  margin: 0px 0px 0px 0px;
  border: none;
}
</style>

<script>
export default {
  data: () => {
    return {
      filter: "",
      materias: {},
      programas: {},
      materiaSeleccionada: {
        id: "",
        codigo: "",
        nombre: "",
        semestre: "",
        id_programa: "",
        nombre_programa: "",
        creditos: 0,
        valor: 0
      }
    };
  },
  mounted() {
    this.getMaterias();
    this.getProgramas();
  },
  methods: {
    getMaterias() {
      axios.get(this.urlBase + "api/materias").then(data => {
        this.materias = data.data.materias;
      });
    },
    insertarMateria() {
      console.log(this.materiaSeleccionada);
      axios
        .post(this.urlBase + "api/materias", this.materiaSeleccionada)
        .then(data => {
          this.modalToggle("nuevo");
          this.getMaterias();
          this.showNotification(
            "success",
            "Insertado correctamente",
            "Insertar Estudiante"
          );
          this.resetMateriaSeleccionada();
        })
        .catch(err => {
          console.log(err);
        });
    },
    detalleMateria(id) {
      axios.get(this.urlBase + "api/estudiantes/" + id).then(data => {
        this.cargarMateria(data.data.materia);
      });
    },
    actualizarMateria() {
      axios
        .patch(
          this.urlBase + "api/materias/" + this.materiaSeleccionada.id,
          this.materiaSeleccionada
        )
        .then(data => {
          this.modalToggle("editar");
          this.getMaterias();
          this.showNotification(
            "success",
            "Actualizado correctamente",
            "Modificar Estudiante"
          );
          this.resetMateriaSeleccionada();
        })
        .catch(err => {
          console.log(err);
        });
    },
    eliminarMateria() {
      axios
        .delete(this.urlBase + "api/materias/" + this.materiaSeleccionada.id)
        .then(data => {
          this.modalToggle("eliminar");
          this.getMaterias();
          this.showNotification(
            "success",
            "Eliminado correctamente",
            "Eliminar Materia"
          );
          this.resetMateriaSeleccionada();
        });
    },
    cargarMateria(data) {
      //this.programas = this.getProgramas();
      this.materiaSeleccionada = {
        id: data.id,
        codigo: data.codigo,
        nombre: data.nombre,
        semestre: data.semestre,
        id_programa: data.id_programa,
        nombre_programa: data.nombre_programa,
        creditos: data.creditos,
        valor: data.valor
      };
    },
    resetMateriaSeleccionada() {
      this.materiaSeleccionada = {
        id: "",
        codigo: "",
        nombre: "",
        semestre: "",
        id_programa: "",
        nombre_programa: "",
        creditos: 0,
        valor: 0
      };
    },
    getProgramas() {
      axios.get(this.urlBase + "api/programas").then(data => {
        this.programas = data.data.programas;
      });
    }
  }
};
</script>
