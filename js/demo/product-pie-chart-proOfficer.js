$(document).ready(function(){    // })

    $.ajax({          //})
      url : "handlers/chart-po_handler.php?type=productCategory",
      method : "GET",
      dataType: 'json',
      success : function(data){  
        // var proc_yr=[];
        // var num_dogs=[];


                var catName=[];
                var proCount=[];
                

                $.each(data, function(key,value){
                // console.log(value.spec_des+": "+value.specCount);
                // proc_yr.push(value.proc_year);
                // num_dogs.push(value.tot_dogs);  

              //variable name      //sql column name
                catName.push(value.categoryName);
                proCount.push(value.noOfProducts);  

                });







                    // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Pie Chart Example
            var ctx = document.getElementById("pieChart");
            var pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            // labels: ["Direct", "Referral", "Social","e","f"],
                            labels: catName,  //variable name
                            datasets: [{
                            // data: [55, 30, 15,56,32],
                            data: proCount ,  //variable name
                            backgroundColor: ['#4e73df', '#C71585', '#36b9cc','#FFD700','#2e59d9','#808000','#BA55D3','#FFFF00','#1cc88a'],   //,  ,#4e73df  #DC143C ,1cc88a , violet red  #C71585,gold -#FFD700,17a673
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1,,)",
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#DC143C",    //DC143C  858796
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            },
                            legend: {
                            display: true
                            },
                            cutoutPercentage: 0,
                        },
                        // end of options
                        
            });
            // end new chart



        },// end of succes
       
        error:function(){
          
        }

 
   

      });

    });




              // Pie chart
// var ctxL = document.getElementById("pieChart").getContext('2d');
// var myLineChart = new Chart(ctxL, {
//   plugins: [ChartDataLabels],
//   type: 'pie',
//   data: {
//     // labels: ["January", "February", "March", "April", "May"],
//     labels: catName, 
//     datasets: [
//       {
//         label: "Traffic",
//         // data: [30, 45, 62, 65, 61],
//         data: proCount,
//         backgroundColor: [
//           "rgba(63, 81, 181, 0.5)", "rgba(77, 182, 172, 0.5)", "rgba(66, 133, 244, 0.5)", "rgba(156, 39, 176, 0.5)", "rgba(233, 30, 99, 0.5)"
//         ],
//       }
//     ]
//   },
//   options: {
//     responsive: true,
//     legend: {
//       display: true,
//     },
//     plugins: {
//       datalabels: {
//         formatter: (value, ctx) => {
//           let sum = 0;
//           let dataArr = ctx.chart.data.datasets[0].data;
//           dataArr.map(data => {
//             sum += data;
//           });
//           let percentage = (value * 100 / sum).toFixed(2) + "%";
//           return percentage;
//         },
//         color: 'white',
//         labels: {
//           title: {
//             font: {
//               size: '14'
//             }
//           }
//         }
//       }
//     }
//   }
// });
















    // Pie chart
// var ctxL = document.getElementById("pieChart").getContext('2d');
// var myLineChart = new Chart(ctxL, {
//   plugins: [ChartDataLabels],
//   type: 'pie',
//   data: {
//     labels: ["January", "February", "March", "April", "May"],
//     datasets: [
//       {
//         label: "Traffic",
//         data: [30, 45, 62, 65, 61],
//         backgroundColor: [
//           "rgba(63, 81, 181, 0.5)", "rgba(77, 182, 172, 0.5)", "rgba(66, 133, 244, 0.5)", "rgba(156, 39, 176, 0.5)", "rgba(233, 30, 99, 0.5)"
//         ],
//       }
//     ]
//   },
//   options: {
//     responsive: true,
//     legend: {
//       display: true,
//     },
//     plugins: {
//       datalabels: {
//         formatter: (value, ctx) => {
//           let sum = 0;
//           let dataArr = ctx.chart.data.datasets[0].data;
//           dataArr.map(data => {
//             sum += data;
//           });
//           let percentage = (value * 100 / sum).toFixed(2) + "%";
//           return percentage;
//         },
//         color: 'white',
//         labels: {
//           title: {
//             font: {
//               size: '14'
//             }
//           }
//         }
//       }
//     }
//   }
// });











