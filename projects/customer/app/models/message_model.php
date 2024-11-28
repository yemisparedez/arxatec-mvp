<?php
// Incluir la configuración de conexión
include '../../database/connection/connect.php';

class MessageModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Function to add a new message
    public function addMessage($client_dni, $lawyer_dni, $subject, $message)
    {
        $sql = "INSERT INTO servicio_consultas_mensajes (dni_cliente, dni_abogado, asunto, mensaje, estado)
            VALUES (?, ?, ?, ?, 'pendiente')";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssss", $client_dni, $lawyer_dni, $subject, $message);
        return $stmt->execute();
    }

    // Function to get the list of lawyers
    public function getLawyersList()
    {
        $sql = "SELECT dni, nombres, apellidos FROM usuarios WHERE tipo_usuario = 'abogado' AND estado = 'activo'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Función para obtener los mensajes filtrados por el DNI del cliente
    public function getMessagesByClientDni($client_dni)
    {
        $sql = "SELECT m.id, m.asunto, m.mensaje, m.respuesta, m.fecha_consulta, m.estado, 
                   c.nombres AS client_name, a.nombres AS lawyer_name
            FROM servicio_consultas_mensajes m
            LEFT JOIN usuarios c ON m.dni_cliente = c.dni
            LEFT JOIN usuarios a ON m.dni_abogado = a.dni
            WHERE m.dni_cliente = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $client_dni);
        $stmt->execute();
        return $stmt->get_result(); // Retorna el resultado
    }
}
