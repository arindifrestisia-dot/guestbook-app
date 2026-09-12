<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/logobsip.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  {{-- <link rel="stylesheet" href="style.css"> --}}
  <script src="https://kit.fontawesome.com/dcd12fa6ed.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- stylesheet -->
  <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
  <!-- Material Icons Link -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <title>Guestbook BSIP</title>
  <style>
    .fade-in {
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }
  
    .fade-in-active {
      opacity: 1;
    }
  </style>
</head>

<body class="font-sans select-none fade-in">
  @include('sweetalert::alert')
  @yield('content')

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('monthlySalesChart').getContext('2d');

      // Fetch the data from Laravel controller
      @if (isset($data))
        const data = @json($data);
        console.log('Data:', data);

        new Chart(ctx, {
          type: 'line', // Line chart for time series
          data: {
            labels: data.labels, // X-axis labels (Months)
            datasets: [{
              label: 'Pengunjung Datang',
              data: data.values, // Y-axis data (Number of proposals)
              borderColor: 'rgba(75, 192, 192, 1)',
              backgroundColor: 'rgba(74, 222, 128, 1)',
              fill: true,
              tension: 0.1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: true
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return 'Jumlah Pengunjung: ' + context.raw;
                  }
                }
              }
            },
            scales: {
              x: {
                title: {
                  display: true,
                  text: 'Bulan'
                }
              },
              y: {
                title: {
                  display: true,
                  text: 'Jumlah Pengunjung'
                },
                min: 0
              }
            }
          }
        });
      @endif
    });

    const satisfactionChartCtx = document.getElementById('averageSatisfactionChart').getContext('2d');

    @if (isset($averageSatisfactionScores) && $averageSatisfactionScores->isNotEmpty())
      const labels = @json($averageSatisfactionScores->pluck('month'));
      const averageScores = @json($averageSatisfactionScores->pluck('average_score'));

      const averageSatisfactionChart = new Chart(satisfactionChartCtx, {
        type: 'line', // your chart type
        data: {
          labels: labels,
          datasets: [{
            label: 'Rata-Rata Skor Kepuasan',
            data: averageScores,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(74, 222, 128, 1)',
            fill: true,
            borderWidth: 3
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Satisfaction Score'
              }
            }
          }
        }
      });
    @endif

    document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('keperluanChart').getContext('2d');

    // Fetch the data from Laravel controller
    @if (isset($dataKeperluan))
    const dataKeperluan = @json($dataKeperluan); // Data from controller (associative array)
    console.log('Data Keperluan:', dataKeperluan);

    // Extract labels and values from dataKeperluan
    const labels = Object.keys(dataKeperluan); // Keys as labels
    const values = Object.values(dataKeperluan); // Values as data

    new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: labels, // Dynamically use keys from dataKeperluan
            datasets: [{
                label: 'Jumlah Pengunjung',
                data: values, // Dynamically use values from dataKeperluan
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y', // Horizontal bar chart
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Jumlah Pengunjung: ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Jumlah Pengunjung'
                    },
                    min: 0 // Ensure x-axis starts from 0
                },
                y: {
                    title: {
                        display: true,
                        text: 'Keperluan'
                    }
                }
            }
        }
    });
    @endif
});

document.addEventListener('DOMContentLoaded', function() {
    const ctxAge = document.getElementById('ageChart').getContext('2d');

    // Fetch the data from Laravel controller
    @if (isset($ageData))
      const ageData = @json($ageData);
      console.log('Age Data:', ageData);

      new Chart(ctxAge, {
        type: 'bar', // Bar chart for age distribution
        data: {
          labels: Object.keys(ageData), // Umur sebagai label X
          datasets: [{
            label: 'Jumlah Pengunjung',
            data: Object.values(ageData), // Jumlah untuk setiap umur
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return 'Jumlah: ' + context.raw;
                }
              }
            }
          },
          scales: {
            x: {
              title: {
                display: true,
                text: 'Umur'
              }
            },
            y: {
              title: {
                display: true,
                text: 'Jumlah Pengunjung'
              },
              min: 0
            }
          }
        }
      });
    @endif
  });

  </script>
</body>

</html>
