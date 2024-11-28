<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Consultas Privadas Pendientes - ArxaTEC</h5>
                <small class="text-muted float-end">Selecciona una consulta para justificar si no puedes realizar la videollamada</small>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID Consulta</th>
                            <th>Cliente DNI</th>
                            <th>Asunto</th>
                            <th>Tipo de Servicio</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7</td>
                            <td>CLI124</td>
                            <td>Divorcio y Custodia</td>
                            <td>consulta privada</td>
                            <td>2024-10-24</td>
                            <td>10:00:00</td>
                            <td>Necesito asesoramiento sobre un acuerdo de custodia en mi proceso de divorcio.</td>
                            <td><span class="badge bg-success">tomada</span></td>
                            <td>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#justificarModal" data-id="7">Justificar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>CLI125</td>
                            <td>Conflicto Laboral</td>
                            <td>consulta privada</td>
                            <td>2024-10-23</td>
                            <td>09:30:00</td>
                            <td>Estoy enfrentando un conflicto laboral con mi empleador. Quiero saber mis opciones legales.</td>
                            <td><span class="badge bg-success">tomada</span></td>
                            <td>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#justificarModal" data-id="8">Justificar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>CLI126</td>
                            <td>Herencia y Testamento</td>
                            <td>consulta privada</td>
                            <td>2024-10-22</td>
                            <td>15:00:00</td>
                            <td>Quiero redactar un testamento y asegurar la correcta distribución de mis bienes.</td>
                            <td><span class="badge bg-success">tomada</span></td>
                            <td>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#justificarModal" data-id="9">Justificar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Justificación -->
<div class="modal fade" id="justificarModal" tabindex="-1" aria-labelledby="justificarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="justificarModalLabel">Justificación de No Toma de Videollamada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="consultaId">
                    <div class="mb-3">
                        <label for="justificacion" class="form-label">Motivo de la justificación</label>
                        <textarea class="form-control" id="justificacion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estadoConsulta" class="form-label">Estado de la Consulta</label>
                        <select class="form-select" id="estadoConsulta" required>
                            <option value="tomada" selected>Tomada</option>
                            <option value="justificada">Justificada</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>