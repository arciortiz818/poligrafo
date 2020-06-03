/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

import router from "./routes";
import toastr from "toastr";

//urlBase: "https://poligrafo.herokuapp.com/"

Vue.mixin({
    data: function() {
        return {
            urlBase: "https://poligrafo.herokuapp.com/"
        };
    },
    methods: {
        showNotification: function(type, message, title) {
            toastr[type](message, title);
            toastr.options = {
                closeButton: false,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "2200",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            };
        },
        filtrarTabla() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filtro");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaDatos");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        },
        modalToggle(accion) {
            switch (accion) {
                case "nuevo":
                    $("#modal-nuevo").modal("toggle");
                    break;
                case "editar":
                    $("#modal-editar").modal("toggle");
                    break;
                case "eliminar":
                    $("#modal-eliminar").modal("toggle");
                    break;
            }
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router
});
