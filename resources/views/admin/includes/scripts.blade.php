<script src="{{ asset('admin/assets_bkp/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('admin/assets_bkp/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets_bkp/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('admin/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('admin/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('admin/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('admin/js/custom.min.js') }}"></script>

<!-- Sweet-Alert  -->
<script src="{{ asset('admin/assets_bkp/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin/assets_bkp/plugins/sweetalert/jquery.sweet-alert.custom.js') }}">
</script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->

<script src="{{ asset('admin/assets_bkp/plugins/chartist-js/dist/chartist.min.js') }}"></script>
<script
    src="{{ asset('admin/assets_bkp/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}">
</script>
<!--c3 JavaScript -->
<script src="{{ asset('admin/assets_bkp/plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('admin/assets_bkp/plugins/c3-master/c3.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('admin/assets_bkp/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}">
</script>
<script src="{{ asset('admin/assets_bkp/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/js/dashboard3.js') }}"></script>
<script src="{{ asset('admin/assets_bkp/plugins/datatables/jquery.dataTables.min.js') }}">
</script>
<script src="{{ asset('admin/assets_bkp/plugins/switchery/dist/switchery.min.js') }}"></script>

<script
    src="{{ asset('admin/assets_bkp/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}">
</script>

<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{ asset('admin/assets_bkp/plugins/styleswitcher/jQuery.style.switcher.js') }}">
</script>
<!-- jQuery file upload -->
<script src="{{ asset('admin/assets_bkp/plugins/dropify/dist/js/dropify.min.js') }}"></script>
<!-- Date Picker Plugin JavaScript -->
<script
    src="{{ asset('admin/assets_bkp/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}">
</script>

<script src="{{ asset('admin/assets_bkp/plugins/select2/dist/js/select2.full.min.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('admin/assets_bkp/plugins/bootstrap-select/bootstrap-select.min.js') }}"
    type="text/javascript"></script>
<script type="text/javascript"
    src="{{ asset('admin/assets_bkp/plugins/multiselect/js/jquery.multi-select.js') }}">
</script>
<!-- Magnific popup JavaScript -->
<script
    src="{{ asset('admin/assets_bkp/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}">
</script>
<script
    src="{{ asset('admin/assets_bkp/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}">
</script>
<!-- wysuhtml5 Plugin JavaScript -->
<script src="{{ asset('admin/assets_bkp/plugins/tinymce/tinymce.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('admin/assets_bkp/plugins/moment/moment.js') }}"></script>
<script
    src="{{ asset('admin/assets_bkp/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<script src="{{ asset('admin/js/my_custom.js') }}"></script>



<!--   Core JS Files   -->
<script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>

<!-- <script src="{{ asset('admin/assets_bkp/plugins/datatables/jquery.dataTables.min.js') }}"></script> -->


<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>

<script src="{{ asset('admin/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
