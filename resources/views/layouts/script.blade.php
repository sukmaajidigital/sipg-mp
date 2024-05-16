<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>

<!-- Script Datatable -->
<script>
    $(document).ready(function() {
        $('.dtTable').DataTable({
            "lengthChange": true,
            "autoWidth": true,
            "initComplete": function(settings, json) {
                $(".dtTable").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "lengthMenu": [
                [10, 50, 100, 200, -1],
                [10, 50, 100, 200, "All"]
            ], // Customize the entries per page
            "pageLength": 100
        });
    })
    $(document).ready(function() {
        $('.dtTable100').DataTable({
            "lengthChange": true,
            "autoWidth": true,
            "initComplete": function(settings, json) {
                $(".dtTable100").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "fixedColumns": {
                leftColumns: 2,
            },
            "lengthMenu": [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ], // Customize the entries per page
            "pageLength": 100
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('.dtTableFix5').DataTable({
            "lengthChange": true,
            "autoWidth": true,
            "initComplete": function(settings, json) {
                $(".dtTableFix5").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "fixedColumns": {
                leftColumns: 5,
            },
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('.dtTableFix3').DataTable({
            "lengthChange": true,
            "autoWidth": true,
            "initComplete": function(settings, json) {
                $(".dtTableFix3").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "fixedColumns": {
                leftColumns: 3,
            },
            "searching": false,
            "lengthMenu": [
                [10, 50, 100, 200, -1],
                [10, 50, 100, 200, "All"]
            ], // Customize the entries per page
            "pageLength": -1
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('.dtTableFix2').DataTable({
            "lengthChange": true,
            "autoWidth": true,
            "initComplete": function(settings, json) {
                $(".dtTableFix2").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>");
            },
            "fixedColumns": {
                leftColumns: 2,
            },
        });
    })
</script>

{{-- SCRIPT FORM VALIDATION --}}
<script>
    // fungsi untuk mereset elemen form
    function resetForm(formId) {
        var form = $('.' + formId);

        // Menghapus kelas is-invalid dan is-valid dari semua elemen dalam formulir
        form.find('.input-group').removeClass('is-invalid is-valid');
        form.find('.is-valid').removeClass('is-valid');
        form.find('.is-invalid').removeClass('is-invalid');

        // Menghapus pesan kesalahan yang ditambahkan oleh jQuery Validation
        form.find('.invalid-feedback').remove();

        // Menghapus nilai input
        form[0].reset();

        // Mereset status validasi
        form.validate().reset();
    }

    // fungsi memberikan rule dan pesan serta elemen pada form
    $(function() {
        // custom rules
        jQuery.validator.addMethod("letter", function(value, element) {
            return this.optional(element) || /^[A-Za-z.',-\s]+$/.test(value);
        }, "Input must be letters.");

        jQuery.validator.addMethod("alphanum", function(value, element) {
            return this.optional(element) || /^[a-z][a-z0-9\._]*$/.test(value);
        }, "Inputan harus berupa dan diawali huruf kecil, angka, underscore (_), atau titik (.) ");

        // variable untuk rule yg sama
        var req = "Data harus diisi!"
        var chose = "This field must be selected."
        var element = {
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                $(element).closest('.input-group').removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                var parentInputGroup = $(element).closest('.input-group');
                if (parentInputGroup.find('.is-invalid').length == 0) {
                    parentInputGroup.removeClass('is-invalid').addClass('is-valid');
                }
            }
            // highlight: function(element, errorClass, validClass) {
            //     $(element).addClass('is-invalid');
            // },
            // unhighlight: function(element, errorClass, validClass) {
            //     $(element).removeClass('is-invalid');
            // }
        };

        // Validasi untuk data status
        $('.add_edit_status').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    name_status: {
                        required: true,
                    },
                },
                ...element
            })
        });

        // Validasi untuk data grade
        $('.add_edit_grade').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    name_grade: {
                        required: true,
                    },
                },
                ...element
            })
        });
        // Validasi untuk data dept
        $('.add_edit_dept').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    name_dept: {
                        required: true,
                    },
                },
                ...element
            })
        });
        // Validasi untuk data job
        $('.add_edit_job').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    name_job: {
                        required: true,
                    },
                },
                ...element
            })
        });

    });
</script>
<script>
    // fungsi memberikan rule dan pesan serta elemen pada form
    $(function() {
        // custom rules
        jQuery.validator.addMethod("letter", function(value, element) {
            return this.optional(element) || /^[A-Za-z.',-\s]+$/.test(value);
        }, "Input must be letters.");

        jQuery.validator.addMethod("alphanum", function(value, element) {
            return this.optional(element) || /^[a-z][a-z0-9\._]*$/.test(value);
        }, "Inputan harus berupa dan diawali huruf kecil, angka, underscore (_), atau titik (.) ");

        // variable untuk rule yg sama
        var req = "Data harus diisi!"
        var chose = "This field must be selected."
        var element = {
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                $(element).closest('.input-group').removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                var parentInputGroup = $(element).closest('.input-group');
                if (parentInputGroup.find('.is-invalid').length == 0) {
                    parentInputGroup.removeClass('is-invalid');
                }
            }
        };

        // Validasi untuk data user
        $('.add_edit_user').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    // nik: {
                    //     required: true,
                    //     remote: {
                    //         url: '/check-empcode',
                    //         type: 'post',
                    //         data: {
                    //             nik: function() {
                    //                 return $('#nik').val();
                    //             }
                    //         }
                    //     }
                    // },
                    name: {
                        required: true,
                        letter: true,
                    },
                    id_status: "required",
                    id_dept: "required",
                    id_job: "required",
                    id_grade: "required",
                    sex: "required",
                    start: "required",
                    email: {
                        required: true,
                        email: true,
                        // remote: {
                        //     url: '/check-email',
                        //     type: 'get',
                        //     data: {
                        //         email: function() {
                        //             return $('#email').val();
                        //         }
                        //     }
                        // }
                    },
                    no_ktp: {
                        required: true,
                        number: true,
                    },
                    no_telpon: {
                        required: true,
                        number: true,
                    },
                    tax_number: {
                        number: true,
                    },
                    account_number: {
                        number: true,
                    },
                    status_pernikahan: "required",
                    role_app: "required",
                },
                messages: {
                    // nik: {
                    //     remote: "Emp Code already exists."
                    // },
                    id_status: {
                        required: chose
                    },
                    id_dept: {
                        required: chose
                    },
                    id_job: {
                        required: chose
                    },
                    id_grade: {
                        required: chose
                    },
                    sex: {
                        required: chose
                    },
                    status_pernikahan: {
                        required: chose
                    },
                    role_app: {
                        required: chose
                    },
                },
                ...element
            })
        });
    });
</script>

<script>
    // fungsi memberikan rule dan pesan serta elemen pada form
    $(function() {
        // custom rules
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z.',-\s]+$/.test(value);
        }, "Input must alphabet!");

        // Menambahkan aturan validasi untuk input number
        jQuery.validator.addMethod("positiveNum", function(value, element) {
            return value >= 0;
        }, "Please enter a positive number.");

        jQuery.validator.addMethod("validNum", function(value, element) {
            // Use regex to check if the input contains only numbers
            return /^[0-9]*$/.test(value);
        }, "Please enter a valid number");

        // variable untuk rule yg sama
        var element = {
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        };

        // Validasi untuk data salary per grade
        $('.salary-grade-form').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    @if (isset($grades))
                        @foreach ($grades as $grade)
                            "rate_salary[{{ $grade->id }}]": {
                                positiveNum: true,
                                validNum: true
                            },
                        @endforeach
                    @endif
                },
                ...element
            })
        });

        // Validasi untuk data salary per year
        $('.salary-year-form').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    @if (isset($users))
                        @foreach ($users as $key => $user)
                            "ability[{{ $key }}]": {
                                positiveNum: true,
                                validNum: true
                            },
                            "fungtional_allowance[{{ $key }}]": {
                                validNum: true
                            },
                            "family_allowance[{{ $key }}]": {
                                validNum: true
                            },
                            "adjustment[{{ $key }}]": {
                                validNum: true
                            },
                            "transport_allowance[{{ $key }}]": {
                                validNum: true
                            },
                        @endforeach
                    @endif
                },
                ...element
            })
        });

        // Validasi untuk data salary per year
        $('.salary-month-form').each(function() {
            var form = $(this);
            form.validate({
                rules: {
                    @if (isset($salary_years))
                        @foreach ($salary_years as $key => $sy)
                            "hour_call[{{ $key }}]": {
                                positiveNum: true,
                            },
                            "thr[{{ $key }}]": {
                                validNum: true
                            },
                            "bonus[{{ $key }}]": {
                                validNum: true
                            },
                            "incentive[{{ $key }}]": {
                                validNum: true
                            },
                            "union[{{ $key }}]": {
                                validNum: true
                            },
                            "absent[{{ $key }}]": {
                                validNum: true
                            },
                            "electricity[{{ $key }}]": {
                                validNum: true
                            },
                            "cooperative[{{ $key }}]": {
                                validNum: true
                            },
                        @endforeach
                    @endif
                },
                ...element
            })
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.allocation').select2();
    });
</script>

<script>
    function updateRealTimeClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var day = now.getDate();
        // var month = now.getMonth() + 1; // Bulan dimulai dari 0, sehingga perlu ditambahkan 1
        var monthAbbreviations = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var month = monthAbbreviations[now.getMonth()];
        var year = now.getFullYear();

        // Format waktu dan tanggal sesuai kebutuhan
        var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes;

        var formattedDate = day + '/' + month + '/' + year;

        // Update elemen HTML dengan waktu dan tanggal terbaru
        document.getElementById('real-time-clock').innerHTML = '[' + formattedTime + ' ' + formattedDate + ']';
    }

    // Pembaruan setiap detik (1000 milidetik)
    setInterval(updateRealTimeClock, 1000);

    // Panggil untuk pertama kali saat halaman dimuat
    updateRealTimeClock();
</script>
