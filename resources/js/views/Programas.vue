<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Programas</h1>
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
                    @click="resetProgramaSeleccionado()"
                  >
                    <i class="fas fa-plus-square mr-2"></i> Nuevo Programa
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
                    <th style="width: 10%;">ID</th>
                    <th style="width: 50%;">Nombre</th>
                    <th style="width: 30%;">Plan</th>
                    <th style="width: 10%;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(programa, index) in programas" :key="programa.id">
                    <td class="text-center">
                      <div>{{ index + 1 }}</div>
                    </td>
                    <td>
                      <div>{{ programa.nombre }}</div>
                    </td>
                    <td>
                      <div>{{ programa.plan }}</div>
                    </td>
                    <td class="text-center col-acciones">
                      <div class="justify-content-">
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-editar"
                          @click="cargarPrograma(programa)"
                        >
                          <i class="fas fa-edit fa-lg"></i>
                        </button>
                        <span class="col"></span>
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-eliminar"
                          @click="cargarPrograma(programa)"
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
              <h4 class="modal-title">Nuevo Programa</h4>
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
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for>
                        <i class="fas fa-book"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.nombre"
                        type="text"
                        placeholder="Nombre Programa"
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
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.plan"
                        type="text"
                        placeholder="SNIES"
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
                  @click="insertarPrograma()"
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
              <h4 class="modal-title">Editar Programa</h4>
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
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for class="col-form-label">
                        <i class="fas fa-book"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.nombre"
                        type="text"
                        class="form-control"
                        placeholder="Nombre Programa"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.plan"
                        type="text"
                        class="form-control"
                        placeholder="SNIES"
                      />
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
                  @click="actualizarPrograma()"
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
              <h4 class="modal-title">Eliminar Programa</h4>
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
                        <!-- <span class="input-group-text">Nombre</span> -->
                      </div>
                      <label for class="col-form-label">
                        <i class="fas fa-book"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.nombre"
                        type="text"
                        class="form-control"
                        placeholder="Nombre Programa"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">
                        <i class="fas fa-pencil-alt"></i>
                      </label>
                      <input
                        v-model="programaSeleccionado.plan"
                        type="text"
                        class="form-control"
                        placeholder="SNIES"
                      />
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
                  @click="eliminarPrograma()"
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
      programas: {},
      programaSeleccionado: {
        id: "",
        nombre: "",
        plan: ""
      }
    };
  },
  mounted() {
    this.getProgramas();
  },
  methods: {
    getProgramas() {
      axios
        .get(this.urlBase + "api/programas")
        .then(data => {
          this.programas = data.data.programas;
        })
        .catch(error => {
          console.log(error);
        });
    },
    insertarPrograma() {
      axios
        .post(this.urlBase + "api/programas", this.programaSeleccionado)
        .then(data => {
          this.modalToggle("nuevo");
          this.getProgramas();
          this.showNotification(
            "success",
            "Insertado correctamente",
            "Insertar Programa"
          );
          this.resetProgramaSeleccionado();
        })
        .catch(err => {
          console.log(err);
        });
    },
    detallePrograma(id) {
      axios.get(this.urlBase + "api/programas/" + id).then(data => {
        this.cargarPrograma(data.data.programa);
      });
    },
    actualizarPrograma() {
      axios
        .patch(this.urlBase + "api/programas/" + this.programaSeleccionado.id, {
          nombre: this.programaSeleccionado.nombre,
          plan: this.programaSeleccionado.plan
        })
        .then(data => {
          this.resetProgramaSeleccionado();
          this.modalToggle("editar");
          this.getProgramas();
          this.showNotification(
            "success",
            "Actualizado correctamente",
            "Modificar Programa"
          );
        })
        .catch(err => {
          console.log(err);
        });
    },
    eliminarPrograma() {
      axios
        .delete(this.urlBase + "api/programas/" + this.programaSeleccionado.id)
        .then(data => {
          this.resetProgramaSeleccionado();
          this.modalToggle("eliminar");
          this.getProgramas();
          this.showNotification(
            "success",
            "Eliminado correctamente",
            "Eliminar Programa"
          );
        });
    },
    cargarPrograma(data) {
      this.programaSeleccionado = {
        id: data.id,
        nombre: data.nombre,
        plan: data.plan
      };
    },
    resetProgramaSeleccionado() {
      this.programaSeleccionado.id = 0;
      this.programaSeleccionado.nombre = "";
      this.programaSeleccionado.plan = "";
    }
  }
};
</script>
