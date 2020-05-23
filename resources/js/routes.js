import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: require("./views/Home.vue").default
        },
        {
            path: "/programas",
            name: "programas",
            component: require("./views/Programas.vue").default
        },
        {
            path: "/estudiantes",
            name: "estudiantes",
            component: require("./views/Estudiantes.vue").default
        },
        {
            path: "/materias",
            name: "materias",
            component: require("./views/Materias.vue").default
        },
        {
            path: "/matriculas",
            name: "matriculas",
            component: require("./views/Matriculas.vue").default
        },
    ]
});
