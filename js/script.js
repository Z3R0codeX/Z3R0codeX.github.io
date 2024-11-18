document.addEventListener("DOMContentLoaded", function () {
    // Valores iniciales para estadísticas
    const stats = {
      totalServicios: 120,
      realizados: 80,
      pendientes: 30,
      cancelados: 10,
    };
  
    // Actualizar estadísticas clave
    document.getElementById("totalServicios").textContent = stats.totalServicios;
    document.getElementById("realizados").textContent = stats.realizados;
    document.getElementById("pendientes").textContent = stats.pendientes;
    document.getElementById("cancelados").textContent = stats.cancelados;
  
    // Gráfico de Distribución de Servicios
    new Chart(document.getElementById("servicesChart"), {
      type: "doughnut",
      data: {
        labels: ["Realizados", "Pendientes", "Cancelados"],
        datasets: [
          {
            data: [stats.realizados, stats.pendientes, stats.cancelados],
            backgroundColor: ["#28a745", "#ffc107", "#dc3545"],
          },
        ],
      },
    });
  
    // Gráfico de Tendencias Mensuales (Placeholder)
    new Chart(document.getElementById("monthlyTrendsChart"), {
      type: "line",
      data: {
        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        datasets: [
          {
            label: "Adopciones",
            data: [10, 12, 11, 2, 14, 7, 20, 12, 23, 3, 21, 32],
            borderColor: "#007bff",
            fill: false,
          },
          {
            label: "Adiestramiento",
            data: [5, 8, 15, 12, 25, 11, 20, 28, 32, 20, 25, 12],
            borderColor: "#fffff",
            fill: false,
          },
          {
            label: "Consulta Medica",
            data: [10, 12, 15, 20, 25, 30, 35, 40, 50, 60, 70, 80],
            borderColor: "#28a745",
            fill: false,
          },
          {
            label: "Consulta Estetica",
            data: [8, 12, 10, 22, 15, 25, 30, 22, 32, 28, 39, 42],
            borderColor: "#dc3545",
            fill: false,
          },
        ],
      },
    });
  
    // Acción para el botón de filtro
    document.getElementById("filterButton").addEventListener("click", function () {
      const startDate = document.getElementById("startDate").value;
      const endDate = document.getElementById("endDate").value;
  
      if (startDate && endDate) {
        alert(`Filtrar resultados desde ${startDate} hasta ${endDate}`);
        // Lógica para actualizar gráficos y estadísticas según el rango de fechas
      } else {
        alert("Por favor selecciona ambas fechas.");
      }
    });
  });
  