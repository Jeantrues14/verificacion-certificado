$(document).ready(function() {
                        $('#miTabla').DataTable( {
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                            },
                            "pagingType": "full_numbers",
                            "searching": true,
                            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                            "dom": '<"d-flex justify-content-between"lfB><rtip>',
                        } );
} );