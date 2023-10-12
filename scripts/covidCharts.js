function renderMentalHealthChart() {
  var chartMentalHealth = document.getElementById("chartMentalHealth");
  if (chartMentalHealth) {
    new Chart(chartMentalHealth, {
      type: 'bar',
      data: mentalHealthData,
      options: {
        plugins: {
          title: {
            text: 'Coronavirus Impact On Mental Health',
            display: true,
            font: {
              size: function (context) {
                return context.chart.width > 500 ? 30 : 15;
              }
            }
          },
          legend: {
            display: function (context) {
              return context.chart.width > 500;
            }
          }
        },
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        }
      },
    });
  }
}

function renderPhysicalHealthChart() {
  var chartPhysicalHealth = document.getElementById("chartPhysicalHealth");
  if (chartPhysicalHealth) {
    new Chart(chartPhysicalHealth, {
      type: 'bar',
      data: physicalHealthData,
      options: {
        plugins: {
          title: {
            text: 'Coronavirus Impact On Physical Health',
            display: true,
            font: {
              size: function (context) {
                return context.chart.width > 500 ? 30 : 15;
              }
            }
          },
          legend: {
            display: function (context) {
              return context.chart.width > 500;
            },
          }
        },
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        }
      }
    });
  }
}

function renderCovidCharts() {
  renderMentalHealthChart();
  renderPhysicalHealthChart();
}