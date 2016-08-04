$(document).ready(function () {
    
       /* $foto = document.getElementById("foto");
        if(isSet($foto)) {
            
                               window.location =   "http://localhost:7777/humanic/application/modules/humanic-portal/kandidaat.php";            
            }*/
       
     
        $cv = document.getElementById("cv");
        if(isSet($cv)) {
            
                               window.location =   "http://localhost:7777/humanic/application/modules/humanic-portal/kandidaat.php";            
            }
         
       $("#buttonCv").click(function() {
            var newWindow = '';
            var left = (screen.width/2)-(200);
            var top = (screen.height/2)-(150);

            newWindow = window.open("http://localhost:7777/humanic/popUpCV.php", 'popupCV', 'height=300, width=400, left='+left+', top='+top);
            if (window.focus) 
            {
                newWindow.focus();
            }
            return false;
        })
        
        $("#buttonFoto").click(function() {
            var newWindow = '';
            var left = (screen.width/2)-(200);
            var top = (screen.height/2)-(150);

            newWindow = window.open("http://localhost:7777/humanic/popUpFoto.php", 'popupFoto', 'height=300, width=400, left='+left+', top='+top);
            if (window.focus) 
            {
                newWindow.focus();
            }
            return false;
        })
        



	$("#rijbewijsCheck").change(function() {
				
				if ($("#rijbewijsCheck").prop("checked") == true) {
					$("#auto").show();
				}
				else {
					$("#auto").hide();
					$("#autoCheck").prop("checked", false);
				}
			});
			
            $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        if ($("#functieCheck1").prop("checked") === true) {
                $("#ervaringSlider1").show();


                $('#ervaring1').slider({

                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                });
                $("#ervaring1").on("slide", function(slideEvt) {
                        $("#ex1SliderVal").text(slideEvt.value); 
                });
                $("#ervaring1").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });

            }
            else {					
                    $("#ervaringSlider1").hide();
            };

	$("#functieCheck1").change(function() {
				
				if ($("#functieCheck1").prop("checked") == true) {
					$("#ervaringSlider1").show();
                                        
					
					$('#ervaring1').slider({
						value : 0,
						tooltip : 'hide',
						formatter: function(value) {
                                                    return 'Current value: ' + value;
						}
					});
					$("#ervaring1").on("slide", function(slideEvt) {
						$("#ex1SliderVal").text(slideEvt.value); 
					});
                                        $("#ervaring1").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
                                        
				}
				else {					
					$("#ervaringSlider1").hide();
				}
	});
        
        if ($("#functieCheck2").prop("checked") === true) {
                $("#ervaringSlider2").show();

                $('#ervaring2').slider({
                                                        tooltip : 'hide',
                                                        formatter: function(value) {
                                                                return 'Current value: ' + value;
                                                        }
                });
                $("#ervaring2").on("slide", function(slideEvt) {
                        $("#ex2SliderVal").text(slideEvt.value); 
                });
                $("#ervaring2").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {					
                $("#ervaringSlider2").hide();
        };
	
	$("#functieCheck2").change(function() {
				
				if ($("#functieCheck2").prop("checked") == true) {
					$("#ervaringSlider2").show();
					
					$('#ervaring2').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring2").on("slide", function(slideEvt) {
						$("#ex2SliderVal").text(slideEvt.value); 
					});
                                        $("#ervaring2").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider2").hide();
				}
	});	
	
        if ($("#functieCheck3").prop("checked") === true) {
                $("#ervaringSlider3").show();

                $('#ervaring3').slider({
                                                        
                                                        tooltip : 'hide',
                                                        formatter: function(value) {
                                                                return 'Current value: ' + value;
                                                        }
                });
                $("#ervaring3").on("slide", function(slideEvt) {
                        $("#ex3SliderVal").text(slideEvt.value); 
                });
                $("#ervaring3").on("slideStop", function(slideEvt) {
                        $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {					
                $("#ervaringSlider3").hide();
            };

	$("#functieCheck3").change(function() {
				
				if ($("#functieCheck3").prop("checked") == true) {
					$("#ervaringSlider3").show();
					
					$('#ervaring3').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring3").on("slide", function(slideEvt) {
						$("#ex3SliderVal").text(slideEvt.value); 
					});
                                        $("#ervaring3").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider3").hide();
				}
	});	
	
        if ($("#functieCheck4").prop("checked") === true) {
            $("#ervaringSlider4").show();

            $('#ervaring4').slider({
                                                    
                                                    tooltip : 'hide',
                                                    formatter: function(value) {
                                                            return 'Current value: ' + value;
                                                    }
            });
            $("#ervaring4").on("slide", function(slideEvt) {
                    $("#ex4SliderVal").text(slideEvt.value); 
            });
            $("#ervaring4").on("slideStop", function(slideEvt) {
                    $(this).val($(this).data('slider').getValue()); 
            });
        }
        else {					
                $("#ervaringSlider4").hide();
        };
        
	$("#functieCheck4").change(function() {
				
				if ($("#functieCheck4").prop("checked") == true) {
					$("#ervaringSlider4").show();
					
					$('#ervaring4').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring4").on("slide", function(slideEvt) {
						$("#ex4SliderVal").text(slideEvt.value); 
					});
                                        $("#ervaring4").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider4").hide();
				}
	});
        
        if ($("#functieCheck5").prop("checked") === true) {
            $("#ervaringSlider5").show();

            $('#ervaring5').slider({
                                                    
                                                    tooltip : 'hide',
                                                    formatter: function(value) {
                                                            return 'Current value: ' + value;
                                                    }
            });
            $("#ervaring5").on("slide", function(slideEvt) {
                    $("#ex5SliderVal").text(slideEvt.value); 
            });
            $("#ervaring5").on("slideStop", function(slideEvt) {
                    $(this).val($(this).data('slider').getValue()); 
            });
        }
        else {					
                $("#ervaringSlider5").hide();
        };
		
	$("#functieCheck5").change(function() {
				
				if ($("#functieCheck5").prop("checked") == true) {
					$("#ervaringSlider5").show();
					
					$('#ervaring5').slider({
										value : 0,
										tooltip : 'hide',
										formatter: function(value) {
											return 'Current value: ' + value;
										}
					});
					$("#ervaring5").on("slide", function(slideEvt) {
						$("#ex5SliderVal").text(slideEvt.value); 
					});
                                        $("#ervaring5").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
				}
				else {					
					$("#ervaringSlider5").hide();
				}
	});
	
    if ($("#functieCheck6").prop("checked") === true) {
                    $("#ervaringSlider6").show();

                    $('#ervaring6').slider({
                       
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring6").on("slide", function(slideEvt) {
                            $("#ex6SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring6").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
        else {	

                        $("#ervaringSlider6").hide();
        };
        
	$("#functieCheck6").change(function() {
				
            if ($("#functieCheck6").prop("checked") == true) {
                    $("#ervaringSlider6").show();

                    $('#ervaring6').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring6").on("slide", function(slideEvt) {
                            $("#ex6SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring6").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider6").hide();
            }
	});
	
        if ($("#functieCheck7").prop("checked") === true) {
            $("#ervaringSlider7").show();

            $('#ervaring7').slider({
                
                tooltip : 'hide',
                formatter: function(value) {
                    return 'Current value: ' + value;
                }
            });
            $("#ervaring7").on("slide", function(slideEvt) {
                    $("#ex7SliderVal").text(slideEvt.value); 
            });
            $("#ervaring7").on("slideStop", function(slideEvt) {
                                        $(this).val($(this).data('slider').getValue()); 
                                });
            }
        else {	

                $("#ervaringSlider7").hide();
        };
        
        $("#functieCheck7").change(function() {
				
            if ($("#functieCheck7").prop("checked") == true) {
                    $("#ervaringSlider7").show();

                    $('#ervaring7').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring7").on("slide", function(slideEvt) {
                            $("#ex7SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring7").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider7").hide();
            }
	});
        
        if ($("#functieCheck8").prop("checked") === true) {
            $("#ervaringSlider8").show();

            $('#ervaring8').slider({
                
                tooltip : 'hide',
                formatter: function(value) {
                    return 'Current value: ' + value;
                }
            });
            $("#ervaring8").on("slide", function(slideEvt) {
                    $("#ex8SliderVal").text(slideEvt.value); 
            });
            $("#ervaring8").on("slideStop", function(slideEvt) {
                                        $(this).val($(this).data('slider').getValue()); 
                                });
        }
        else {	

                $("#ervaringSlider8").hide();
        };

        $("#functieCheck8").change(function() {
				
            if ($("#functieCheck8").prop("checked") == true) {
                    $("#ervaringSlider8").show();

                    $('#ervaring8').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring8").on("slide", function(slideEvt) {
                            $("#ex8SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring8").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
					});
            }
            else {	

                    $("#ervaringSlider8").hide();
            }
	});
    
        if ($("#functieCheck9").prop("checked") === true) {
              $("#ervaringSlider9").show();

              $('#ervaring9').slider({
                
                  tooltip : 'hide',
                  formatter: function(value) {
                      return 'Current value: ' + value;
                  }
              });
              $("#ervaring9").on("slide", function(slideEvt) {
                      $("#ex9SliderVal").text(slideEvt.value); 
              });
              $("#ervaring9").on("slideStop", function(slideEvt) {
                                          $(this).val($(this).data('slider').getValue()); 
              });
        }
        else {	

                $("#ervaringSlider9").hide();
        };
        
        $("#functieCheck9").change(function() {
				
            if ($("#functieCheck9").prop("checked") == true) {
                    $("#ervaringSlider9").show();

                    $('#ervaring9').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring9").on("slide", function(slideEvt) {
                            $("#ex9SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring9").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
                    });
            }
            else {	

                    $("#ervaringSlider9").hide();
            }
	});
        
        if ($("#functieCheck10").prop("checked") === true) {
                $("#ervaringSlider10").show();

                $('#ervaring10').slider({
                
                    tooltip : 'hide',
                    formatter: function(value) {
                        return 'Current value: ' + value;
                    }
                });
                $("#ervaring10").on("slide", function(slideEvt) {
                        $("#ex10SliderVal").text(slideEvt.value); 
                });
                $("#ervaring10").on("slideStop", function(slideEvt) {
                                            $(this).val($(this).data('slider').getValue()); 
                });
        }
        else {	

                $("#ervaringSlider10").hide();
        };
        
        $("#functieCheck10").change(function() {
				
            if ($("#functieCheck10").prop("checked") == true) {
                    $("#ervaringSlider10").show();

                    $('#ervaring10').slider({
                        value : 0,
                        tooltip : 'hide',
                        formatter: function(value) {
                            return 'Current value: ' + value;
                        }
                    });
                    $("#ervaring10").on("slide", function(slideEvt) {
                            $("#ex10SliderVal").text(slideEvt.value); 
                    });
                    $("#ervaring10").on("slideStop", function(slideEvt) {
						$(this).val($(this).data('slider').getValue()); 
                    });
            }
            else {	

                    $("#ervaringSlider10").hide();
            }
	});

});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};





/* $(function(){
			$('#ervaring1').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			$('#ervaring2').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			});
			
			$("#ervaring1").on("slide", function(slideEvt) {
				$("#ex1SliderVal").text(slideEvt.value); 
			});
			
			
			$("#ervaring2").on("slide", function(slideEvt) {
				$("#ex21SliderVal").text(slideEvt.value); 
			});
 */


/* $("#functieCheck1").change(function() {	
					alert("oke");
}); */
/* $(function(){
				$('#ervaring1').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring2').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring3').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring4').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring5').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
				$('#ervaring6').slider({
							value : 0,
							tooltip : 'hide',
							formatter: function(value) {
								return 'Current value: ' + value;
							}
						});
			}): */
				/* $('#ervaring1').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				
				$('#ervaring2').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				$('#ervaring3').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});	
				$('#ervaring4').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});	
				$('#ervaring5').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
				$('#ervaring6').slider({
					value : 0,
					tooltip : 'hide',
					formatter: function(value) {
					return 'Current value: ' + value;
					}
				});
 */
            /* }); */
			$("#ervaring1").on("slide", function(slideEvt) {
				$("#ex1SliderVal").text(slideEvt.value);
			});
			$("#ervaring2").on("slide", function(slideEvt) {
				$("#ex2SliderVal").text(slideEvt.value);
			});
			
			$("#ervaring3").on("slide", function(slideEvt) {
				$("#ex3SliderVal").text(slideEvt.value);
			});
			$("#ervaring4").on("slide", function(slideEvt) {
				$("#ex4SliderVal").text(slideEvt.value);
			});
			$("#ervaring5").on("slide", function(slideEvt) {
				$("#ex5SliderVal").text(slideEvt.value);
			});
			$("#ervaring6").on("slide", function(slideEvt) {
				$("#ex6SliderVal").text(slideEvt.value);
			});
                  