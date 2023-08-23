<!-- Modal -->
<div class="modal fade" id="qrestudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar QR Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formularioQR" action="./validar_cedula.php" method="post">
          <!-- Campo de entrada de texto -->
          <div class="mb-3">
            <label for="documento" class="form-label">Documento:</label>
            <input type="text" class="form-control" id="documento" name="documento">
          </div>

          <!-- Campo de selección de carreras -->
          <div class="mb-3">
            <label for="selectCarrera" class="form-label">Carrera:</label>
            <select class="form-select" id="selectCarrera" name="id_carrera">
              <option value="">Seleccionar Carrera</option>
              <?php foreach ($carreras as $carrera) { ?>
                <option value="<?php echo $carrera['id_carrera']; ?>">
                  <?php echo $carrera['nombre']; ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div id="resultadoValidacion"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Buscar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>