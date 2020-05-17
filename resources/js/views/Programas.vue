<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <button
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#modal-default"
            >Nuevo Programa</button>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">Start creating your amazing application!</div>
              <div class="card-footer">Footer</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <section>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title">Nuevo Programa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" />
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {};
</script>
