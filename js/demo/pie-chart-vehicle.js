$(document).ready(function(){    // })

    $.ajax({          //})
      url : "handlers/chart-do_handler.php?type=vehicleTypes",
      method : "GET",
      dataType: 'json',
      success : function(data){  
        // var proc_yr=[];
        // var num_dogs=[];


                var vehType=[];    //Vehicle_TYPE
                var vehCount=[];
                

                $.each(data, function(key,value){
                // console.log(value.spec_des+": "+value.specCount);
                // proc_yr.push(value.proc_year);
                // num_dogs.push(value.tot_dogs);  

              //variable name      //sql column name
              vehType.push(value.Vehicle_TYPE);
              vehCount.push(value.noOfVehicles);  

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
                            labels: vehType,  //variable name
                            datasets: [{
                            // data: [55, 30, 15,56,32],
                            data: vehCount ,  //variable name  BA55D3  4e73df
                            backgroundColor: ['#BA55D3', '#C71585', '#36b9cc','#FFD700','#2e59d9','#808000','#BA55D3','#FFFF00','#1cc88a'],   //,  ,#4e73df  #DC143C ,1cc88a , violet red  #C71585,gold -#FFD700,17a673
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
