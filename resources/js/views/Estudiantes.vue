<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Estudiantes</h1>
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
                    <input id="filtro" type="text" class="form-control" @keyup="filtrarTabla()" />
                  </div>
                </div>
                <div class="col-2 offset-6">
                  <button
                    class="btn bg-navy"
                    data-toggle="modal"
                    data-target="#modal-nuevo"
                    @click="resetEstudianteSeleccionado()"
                  >Nuevo Estudiante</button>
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
                    <th style="width: 25%;">Nombre</th>
                    <th style="width: 12%;">T. Dcto</th>
                    <th style="width: 12%;">Documento</th>
                    <th style="width: 26%;">Email</th>
                    <th style="width: 10%;">Celular</th>
                    <th style="width: 10%;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(estudiante, index) in estudiantes" :key="estudiante.id">
                    <td class="text-center">
                      <div>{{ index + 1 }}</div>
                    </td>
                    <td>
                      <div>{{ estudiante.nombre }}</div>
                    </td>
                    <td>
                      <div>{{ estudiante.tipo_documento }}</div>
                    </td>
                    <td>
                      <div>{{ estudiante.numero_documento }}</div>
                    </td>
                    <td>
                      <div>{{ estudiante.email }}</div>
                    </td>
                    <td>
                      <div>{{ estudiante.numero_celular }}</div>
                    </td>
                    <td class="text-center col-acciones">
                      <div class="justify-content-">
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-editar"
                          @click="cargarEstudiante(estudiante)"
                        >
                          <i class="fas fa-edit fa-lg"></i>
                        </button>
                        <span class="col"></span>
                        <button
                          class="col-1"
                          data-toggle="modal"
                          data-target="#modal-eliminar"
                          @click="cargarEstudiante(estudiante)"
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
              <h4 class="modal-title">Nuevo Estudiante</h4>
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
                      <label for>Nombre</label>
                      <input
                        v-model="estudianteSeleccionado.nombre"
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
                      <label for class="col-form-label">Tipo Documento</label>
                      <input
                        v-model="estudianteSeleccionado.tipo_documento"
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
                      <label for class="col-form-label">Numero Documento</label>
                      <input
                        v-model="estudianteSeleccionado.numero_documento"
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
                      <label for class="col-form-label">Email</label>
                      <input
                        v-model="estudianteSeleccionado.email"
                        type="email"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">Celular</label>
                      <input
                        v-model="estudianteSeleccionado.numero_celular"
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
                  @click="insertarEstudiante()"
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
              <h4 class="modal-title">Editar Estudiante</h4>
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
                      <label for>Nombre</label>
                      <input
                        v-model="estudianteSeleccionado.nombre"
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
                      <label for class="col-form-label">Tipo Documento</label>
                      <input
                        v-model="estudianteSeleccionado.tipo_documento"
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
                      <label for class="col-form-label">Numero Documento</label>
                      <input
                        v-model="estudianteSeleccionado.numero_documento"
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
                      <label for class="col-form-label">Email</label>
                      <input
                        v-model="estudianteSeleccionado.email"
                        type="email"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">Celular</label>
                      <input
                        v-model="estudianteSeleccionado.numero_celular"
                        type="text"
                        class="form-control"
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
                  @click="actualizarEstudiante()"
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
              <h4 class="modal-title">Eliminar Estudiante</h4>
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
                      <label for>Nombre</label>
                      <input
                        v-model="estudianteSeleccionado.nombre"
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
                      <label for class="col-form-label">Tipo Documento</label>
                      <input
                        v-model="estudianteSeleccionado.tipo_documento"
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
                      <label for class="col-form-label">Numero Documento</label>
                      <input
                        v-model="estudianteSeleccionado.numero_documento"
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
                      <label for class="col-form-label">Email</label>
                      <input
                        v-model="estudianteSeleccionado.email"
                        type="email"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form group col">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text">@</span> -->
                      </div>
                      <label for class="col-form-label">Celular</label>
                      <input
                        v-model="estudianteSeleccionado.numero_celular"
                        type="text"
                        class="form-control"
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
                  @click="eliminarEstudiante()"
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
      estudiantes: {},
      estudianteSeleccionado: {
        id: "",
        nombre: "",
        numero_documento: 0,
        email: "",
        numero_celular: "",
        tipo_documento: ""
      }
    };
  },
  mounted() {
    this.getEstudiantes();
  },
  methods: {
    getEstudiantes() {
      axios.get(this.urlBase + "api/estudiantes").then(data => {
        this.estudiantes = data.data.estudiantes;
      });
    },
    insertarEstudiante() {
      axios
        .post(
          this.urlBase + "api/estudiantes",
          this.estudianteSeleccionado
        )
        .then(data => {
          this.modalToggle("nuevo");
          this.getEstudiantes();
          this.showNotification(
            "success",
            "Insertado correctamente",
            "Insertar Estudiante"
          );
          this.resetEstudianteSeleccionado();
        })
        .catch(err => {
          console.log(err);
        });
    },
    detalleEstudiante(id) {
      axios.get(this.urlBase + "api/estudiantes/" + id).then(data => {
        this.cargarEstudiante(data.data.estudiante);
      });
    },
    actualizarEstudiante() {
      axios
        .patch(
          this.urlBase + "api/estudiantes/" +
            this.estudianteSeleccionado.id,
          this.estudianteSeleccionado
        )
        .then(data => {
          this.resetEstudianteSeleccionado();
          this.modalToggle("editar");
          this.getEstudiantes();
          this.showNotification(
            "success",
            "Actualizado correctamente",
            "Modificar Estudiante"
          );
        })
        .catch(err => {
          console.log(err);
        });
    },
    eliminarEstudiante() {
      axios
        .delete(
          "api/estudiantes/" +
            this.estudianteSeleccionado.id
        )
        .then(data => {
          this.resetEstudianteSeleccionado();
          this.modalToggle("eliminar");
          this.getEstudiantes();
          this.showNotification(
            "success",
            "Eliminado correctamente",
            "Eliminar Estudiante"
          );
        });
    },
    cargarEstudiante(data) {
      this.estudianteSeleccionado = {
        id: data.id,
        nombre: data.nombre,
        numero_documento: data.numero_documento,
        email: data.email,
        numero_celular: data.numero_celular,
        tipo_documento: data.tipo_documento
      };
    },
    resetEstudianteSeleccionado() {
      this.estudianteSeleccionado = {
        id: "",
        nombre: "",
        numero_documento: 0,
        email: "",
        numero_celular: "",
        tipo_documento: ""
      };
    }
  }
};
</script>
