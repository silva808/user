

class Nodo {
    constructor(id, tipo, valor) {
        this.id = id;
        this.tipo = tipo; // 'paciente' o 'slot'
        this.valor = valor; // Puntaje para pacientes, null para slots
        this.aristas = [];
    }

    conectarCon(nodo) {
        this.aristas.push(nodo);
    }
}

class Grafo {
    constructor() {
        this.nodos = [];
    }

    agregarNodo(nodo) {
        this.nodos.push(nodo);
    }

    encontrarNodo(id) {
        return this.nodos.find(nodo => nodo.id === id);
    }

    // Intenta asignar un slot a un paciente basado en la disponibilidad y el puntaje
    asignarCita(paciente) {
        let slotAsignado = null;
        // Filtrar slots que cumplen con el rango de fechas y horas del paciente
        const slotsDisponibles = this.nodos.filter(nodo => nodo.tipo === 'slot' && nodo.aristas.length === 0 && this.cumpleConRango(nodo, paciente));
        slotsDisponibles.sort((a, b) => a.id.localeCompare(b.id)); // Ordenar slots por fecha y hora

        if (slotsDisponibles.length > 0) {
            slotAsignado = slotsDisponibles[0];
            paciente.conectarCon(slotAsignado);
            slotAsignado.conectarCon(paciente);
        }

        return slotAsignado;
    }

    cumpleConRango(slot, paciente) {

        // Implementar la lógica que verifica si el slot está dentro del rango de disponibilidad del paciente
        return true; // Simplificación para el ejemplo
    }
      imprimirPacientes() {
        console.log("Pacientes registrados:");
        this.nodos.filter(nodo => nodo.tipo === 'paciente').forEach(paciente => {
            console.log(`ID: ${paciente.id}, Puntaje: ${paciente.valor}`);
        });}
}

// Ejemplo de uso
let grafo = new Grafo();

// Crear y agregar slots al grafo
['2024-03-05', '2024-03-06'].forEach(fecha => {
    ['08:00', '08:15', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00'].forEach(hora => {
        let slot = new Nodo(`${fecha} ${hora}`, 'slot', null);
        grafo.agregarNodo(slot);
    });
});
function procesarDatos(event) {
    event.preventDefault(); // Prevenir recarga de página

    // Obtener datos del formulario
    let pacienteId = document.getElementById('nombre').value;
    const embarazada = document.getElementById('embarazada').value === 'si' ? 5 : 0;
    const trabajo = parseInt(document.getElementById('trabajo').value);
    const enfermedad = parseInt(document.getElementById('enfermedad').value);

    let puntaje = embarazada + trabajo + enfermedad; // Cálculo del puntaje

    // Verificar si el paciente ya existe en el grafo
    let pacienteExistente = grafo.encontrarNodo(pacienteId);
    if (pacienteExistente) {
        console.log(`El paciente ${pacienteId} ya fue registrado.`);
        return; // Detener la ejecución si el paciente ya existe
    }
    
    let paciente = new Nodo(pacienteId, 'paciente', puntaje);
    grafo.agregarNodo(paciente);

    let slotAsignado = grafo.asignarCita(paciente);

    if (slotAsignado) {
        console.log(`Cita asignada a ${pacienteId} (Puntaje: ${paciente.valor}) en ${slotAsignado.id}`);
    } else {
        console.log(`No se pudo asignar cita a ${pacienteId}`);
    }

}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formularioAsignacion').addEventListener('submit', procesarDatos);
});
