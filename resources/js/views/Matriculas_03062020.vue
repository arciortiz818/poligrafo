<template>
    <div id="viewMatriculas">
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
                                <div class="col-7">
                                    <form>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label
                                                        for
                                                        class="col-form-label"
                                                        >Documento</label
                                                    >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input
                                                        class="form-control input-sm"
                                                        type="text"
                                                        v-model="docEstudiante"
                                                    />
                                                </div>
                                                <div class="col-2">
                                                    <button
                                                        type="button"
                                                        class="btn btn-primary"
                                                        @click="
                                                            buscarEstudiante()
                                                        "
                                                    >
                                                        Buscar
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label
                                                        class="col-form-label"
                                                        >Nombre del
                                                        Estudiante</label
                                                    >
                                                    <input
                                                        class="col form-control input-sm"
                                                        type="text"
                                                        name=""
                                                        :value="
                                                            estudiante.nombre
                                                        "
                                                    />
                                                </div>
                                                <div class="col-6">
                                                    <label
                                                        class="col-form-label"
                                                        >Telefono</label
                                                    >
                                                    <input
                                                        class="col form-control input-sm"
                                                        type="text"
                                                        name=""
                                                        :value="
                                                            estudiante.numero_celular
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label"
                                                >Programa</label
                                            >
                                            <select
                                                class="form-control "
                                                v-model="id_programa"
                                                @change="seleccionarPrograma()"
                                            >
                                                <option
                                                    v-for="option in programas"
                                                    :key="option.id"
                                                    :value="option.id"
                                                    >{{ option.nombre }}</option
                                                >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div
                                                class="btn btn-success"
                                                @click="matricular()"
                                            >
                                                Matricular
                                            </div>
                                            <a
                                                class="btn btn-success"
                                                :href="linkPdf"
                                            >
                                                Imprimir Liquidación
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            Créditos Seleccionados:
                                            {{ creditosSel }}
                                        </div>
                                        <div class="form-group">
                                            Valor Matricula: {{ valorSel }}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3" id="pdf">
                    <div class="col-12">
                        <!-- contenido -->
                        <div class="row row-cols-3">
                            <div
                                class="col"
                                v-for="nivel in pensum"
                                :key="nivel.semestre"
                            >
                                <div class="card card-info">
                                    <div class="card-header">
                                        {{ nivel.semestre }}
                                    </div>
                                    <div class="card-body pt-0 pb-0 pl-0 pr-0">
                                        <div
                                            class="list-group checkbox-list-group"
                                            v-for="(materia,
                                            index) in nivel.materias"
                                            :key="nivel.materias.nombre"
                                        >
                                            <div class="list-group-item">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        v-model="seleccionados"
                                                        :value="materia"
                                                        @change="
                                                            porMatricular()
                                                        "
                                                        @click="
                                                            validar(
                                                                materia.nombre
                                                            )
                                                        "
                                                    />
                                                    <span
                                                        class="list-group-item-text"
                                                    >
                                                        <i class="fa fa-fw"></i>
                                                        {{ materia.nombre }}
                                                    </span>
                                                    <br />
                                                    <span
                                                        class="list-group-item-text"
                                                    >
                                                        Créditos:
                                                        {{ materia.creditos }}
                                                    </span>
                                                    <br />
                                                    <span
                                                        class="list-group-item-text"
                                                    >
                                                        Valor:
                                                        {{ materia.valor }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<style media="screen">
#viewMatriculas {
    font-size: 10pt;
}
</style>
<script>
import jsPDF from "jspdf";

export default {
    data() {
        return {
            docEstudiante: "",
            estudiante: [],
            programas: [],
            id_programa: "",
            materias: [],
            pensum: [],
            seleccionados: [],
            valorSel: 0,
            creditosSel: 0,
            linkPdf: ""
        };
    },
    methods: {
        buscarEstudiante() {
            let url =
                this.urlBase + "api/estudiantes/documento/" +
                this.docEstudiante;
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
            axios.get(this.urlBase + "api/programas").then(data => {
                this.programas = data.data.programas;
            });
        },
        seleccionarPrograma() {
            this.getMaterias();
        },
        getMaterias() {
            axios
                .get(
                    this.urlBase + "api/materias/programa/" +
                        this.id_programa
                )
                .then(response => {
                    this.materias = response.data.materias;

                    this.materias.forEach(element => {
                        let tmpSemestre = element.semestre;
                        let tmpMaterias = [];

                        let found = this.pensum.find(
                            el => el.semestre == "Semestre " + tmpSemestre
                        );

                        if (found < 0 || found == undefined) {
                            this.materias.forEach(item => {
                                if (item.semestre == tmpSemestre) {
                                    tmpMaterias.push(item);
                                }
                            });

                            this.pensum.push({
                                semestre: "Semestre " + tmpSemestre,
                                materias: tmpMaterias
                            });
                        }
                    });
                });
        },
        porMatricular() {
            this.creditosSel = 0;
            this.valorSel = 0;
            for (var i = 0; i < this.seleccionados.length; i++) {
                this.creditosSel += this.seleccionados[i].creditos;
                this.valorSel += this.seleccionados[i].valor;
            }
        },
        validar(nombre) {
            if (this.seleccionados.length == 6) {
                this.showNotification(
                    "error",
                    "Máximo 6 materias",
                    "Matricular Estudiante"
                );
            }
            if (this.creditosSel >= 16) {
                this.showNotification(
                    "error",
                    "Máximo 6 materias",
                    "Matricular Estudiante"
                );
            }
        },
        matricular() {
            this.linkPdf =
                this.urlBase + "matriculas/estudiante/" +
                this.docEstudiante;
        }
    }
};
</script>
