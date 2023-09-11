       <!-- jQuery -->
       <script src="{{ URL::asset('/assets/js/jquery-3.6.3.min.js') }}"></script>

       <!-- Slimscroll JS -->
       <script src="{{ URL::asset('/assets/js/bootstrap.bundle.min.js') }}"></script>

       <!-- Slimscroll JS -->
       <script src="{{ URL::asset('/assets/js/jquery.slimscroll.min.js') }}"></script>

       <!-- Select2 JS -->
       <script src="{{ URL::asset('/assets/js/select2.min.js') }}"></script>

       <!-- Data Table JS -->
       <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

       <!-- Dropify JS -->
       <script src="{{ URL::asset('/assets/plugins/dropify-master/dist/js/dropify.min.js') }}"></script>

       <!-- Sweetalert -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
           integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
           crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <!-- Datetimepicker JS -->
       <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
       <script src="{{ URL::asset('/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
       <script src="{{ URL::asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

       <!-- Custom JS -->
       @vite(['resources/js/script.js'])

       <script>
           $('body').on('click', '.btn-delete', function() {
               const title = $(this).data('confirm-title') || "Anda yakin?";
               const text = $(this).data('confirm-text') || "Anda yakin menghapus data ini?";
               const icon = $(this).data('confirm-icon') || "warning";
               const action = $(this).data('action');

               if (!action) {
                   return;
               }

               swal({
                       title,
                       text,
                       icon,
                       buttons: [
                           "Batalkan",
                           "Ya, Lakukan"
                       ]
                   })
                   .then(function(willDelete) {
                       if (willDelete) {
                           const form = $(`<form action="${action}" method="POST">
                            @csrf
                            @method('delete')
                        </form>`);
                           $('body').append(form);
                           form.submit();
                       }
                   });
           });
       </script>

       <script>
           $(document).ready(function() {
               $('.js-example-basic-single').select2();
           });
       </script>
