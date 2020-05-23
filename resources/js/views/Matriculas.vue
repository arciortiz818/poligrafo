<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Matriculas</h1>
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
                  <input class="form-control" type="text" v-model="estudiante.nombre" />
                </div>
                <div class="form-group">
                  <label for class="col-form-label">Programa</label>
                  <select class="form-control" v-model="id_programa">
                    <option
                      v-for="option in programas"
                      :key="option.id"
                      :value="option.id"
                    >{{ option.nombre }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="btn btn-success" @click="seleccionarPrograma()">Mostrar</div>
                </div>
              </form>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      docEstudiante: "",
      estudiante: [],
      programas: {},
      id_programa: ""
    };
  },
  methods: {
    buscarEstudiante() {
      let url =
        "http://localhost:8000/api/estudiantes/documento/" + this.docEstudiante;
      axios
        .get(url)
        .then(data => {
          this.estudiante = data.data.estudiante;
          this.getProgramas();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getProgramas() {
      axios.get("http://localhost:8000/api/programas").then(data => {
        this.programas = data.data.programas;
      });
    },
    seleccionarPrograma() {
      console.log(this.id_programa);
    }
  }
};
</script>
