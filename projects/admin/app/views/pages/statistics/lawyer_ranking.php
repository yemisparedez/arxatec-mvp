<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Ranking de Tareas del Abogado - ArxaTEC</h5>
                <small class="text-muted float-end">Consulta y rankea las tareas completadas por el abogado</small>
            </div>
            <div class="card-body">
                <form action="rank_lawyer_tasks.php" method="GET">
                    <div class="mb-3">
                        <label for="lawyer" class="form-label">Seleccionar Abogado</label>
                        <select class="form-control" id="lawyer" name="lawyer" required>
                            <option value="">Elige un abogado</option>
                            <!-- Aquí puedes agregar opciones dinámicamente con PHP -->
                            <option value="1">Juan Pérez</option>
                            <option value="2">Ana López</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskType" class="form-label">Tipo de Tarea</label>
                        <select class="form-control" id="taskType" name="taskType">
                            <option value="">Todas las Tareas</option>
                            <option value="legal">Legal</option>
                            <option value="administrativa">Administrativa</option>
                            <option value="investigacion">Investigación</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dateRange" class="form-label">Rango de Fechas</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Fecha de inicio">
                        <input type="date" class="form-control mt-2" id="endDate" name="endDate" placeholder="Fecha de fin">
                    </div>
                    <button type="submit" class="btn btn-primary">Ver Ranking</button>
                </form>

                <!-- Tabla para mostrar los resultados de las tareas -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tarea</th>
                                <th>Fecha de Completado</th>
                                <th>Tipo</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes agregar las filas dinámicamente con PHP -->
                            <tr>
                                <td>1</td>
                                <td>Redacción de contrato</td>
                                <td>15/10/2024</td>
                                <td>Legal</td>
                                <td>4.5</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Consulta con cliente</td>
                                <td>10/10/2024</td>
                                <td>Administrativa</td>
                                <td>4.7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>